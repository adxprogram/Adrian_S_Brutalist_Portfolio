<?php
/**
 * GitHub GraphQL API Service & Local Cache Provider
 * Brutalist Portfolio // Adrian Santiago
 *
 * Securely queries GitHub GraphQL API for user contributions,
 * implements file-based local caching, and provides stale-cache
 * fallback logic for offline / expired token resilience.
 */

class GitHubContributions {
    private static $config = null;

    /**
     * Load configuration safely
     */
    public static function getConfig() {
        if (self::$config === null) {
            $configFile = dirname(__DIR__) . '/config.php';
            if (file_exists($configFile)) {
                self::$config = require $configFile;
            } else {
                self::$config = [
                    'github_username' => getenv('GITHUB_USERNAME') ?: 'adxprogram',
                    'github_token'    => getenv('GITHUB_TOKEN') ?: '',
                    'cache_dir'       => dirname(__DIR__) . '/data/cache',
                    'cache_ttl'       => 14400,
                ];
            }
        }
        return self::$config;
    }

    /**
     * Get the cache directory, ensuring it exists
     */
    private static function getCacheDir() {
        $cfg = self::getConfig();
        $dir = $cfg['cache_dir'] ?? (dirname(__DIR__) . '/data/cache');
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        return $dir;
    }

    /**
     * Fetch available contribution years for username
     */
    public static function getContributionYears() {
        $cfg = self::getConfig();
        $username = $cfg['github_username'] ?? 'adxprogram';
        $cacheFile = self::getCacheDir() . "/years_{$username}.json";
        $cacheTTL = $cfg['cache_ttl'] ?? 14400;

        // Fresh cache check
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTTL)) {
            $cached = json_decode(file_get_contents($cacheFile), true);
            if (is_array($cached) && !empty($cached['years'])) {
                return $cached['years'];
            }
        }

        // GraphQL Query for available years
        $query = <<<'GRAPHQL'
query($login: String!) {
  user(login: $login) {
    contributionsCollection {
      contributionYears
    }
  }
}
GRAPHQL;

        $res = self::executeQuery($query, ['login' => $username]);
        if (!empty($res['data']['user']['contributionsCollection']['contributionYears'])) {
            $years = $res['data']['user']['contributionsCollection']['contributionYears'];
            @file_put_contents($cacheFile, json_encode([
                'years' => $years,
                'cached_at' => time()
            ]));
            return $years;
        }

        // Stale cache fallback
        if (file_exists($cacheFile)) {
            $cached = json_decode(file_get_contents($cacheFile), true);
            if (is_array($cached) && !empty($cached['years'])) {
                return $cached['years'];
            }
        }

        // Bundled fallback seed
        $fallback = self::getFallbackSeed();
        if (!empty($fallback['years'])) {
            return $fallback['years'];
        }

        // Default default years
        $currentYear = (int)date('Y');
        return [$currentYear, $currentYear - 1, $currentYear - 2];
    }

    /**
     * Fetch contribution calendar data for a specific year (or current year)
     */
    public static function getCalendarForYear($year = null) {
        $cfg = self::getConfig();
        $username = $cfg['github_username'] ?? 'adxprogram';
        $currentYear = (int)date('Y');
        $targetYear = $year ? (int)$year : $currentYear;

        $cacheFile = self::getCacheDir() . "/calendar_{$username}_{$targetYear}.json";
        $cacheTTL = $cfg['cache_ttl'] ?? 14400;

        // 1. Fresh Cache Check
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTTL)) {
            $raw = file_get_contents($cacheFile);
            $parsed = json_decode($raw, true);
            if (is_array($parsed) && isset($parsed['weeks'])) {
                $parsed['is_stale'] = false;
                $parsed['source'] = 'cache';
                return $parsed;
            }
        }

        // 2. Query GitHub GraphQL API
        $from = "{$targetYear}-01-01T00:00:00Z";
        $to = "{$targetYear}-12-31T23:59:59Z";

        $query = <<<'GRAPHQL'
query($login: String!, $from: DateTime, $to: DateTime) {
  user(login: $login) {
    name
    login
    avatarUrl
    createdAt
    contributionsCollection(from: $from, to: $to) {
      contributionYears
      contributionCalendar {
        totalContributions
        weeks {
          contributionDays {
            date
            weekday
            contributionCount
            contributionLevel
          }
        }
        months {
          name
          year
          firstDay
          totalWeeks
        }
      }
    }
  }
}
GRAPHQL;

        $res = self::executeQuery($query, [
            'login' => $username,
            'from'  => $from,
            'to'    => $to
        ]);

        if (
            !empty($res['data']['user']['contributionsCollection']['contributionCalendar'])
        ) {
            $user = $res['data']['user'];
            $calendar = $user['contributionsCollection']['contributionCalendar'];
            $years = $user['contributionsCollection']['contributionYears'] ?? [$targetYear];

            $normalized = self::normalizeCalendarData($calendar, $targetYear, $username, $years);
            $normalized['is_stale'] = false;
            $normalized['source'] = 'live_api';
            $normalized['cached_at'] = time();

            // Save fresh cache
            @file_put_contents($cacheFile, json_encode($normalized));

            return $normalized;
        }

        // 3. Stale Cache Fallback
        if (file_exists($cacheFile)) {
            $raw = file_get_contents($cacheFile);
            $parsed = json_decode($raw, true);
            if (is_array($parsed) && isset($parsed['weeks'])) {
                $parsed['is_stale'] = true;
                $parsed['source'] = 'stale_cache';
                $parsed['stale_reason'] = $res['error'] ?? 'API unavailable or token expired';
                return $parsed;
            }
        }

        // 4. Bundled Seed Fallback
        $seed = self::getFallbackSeed($targetYear);
        if ($seed) {
            $seed['is_stale'] = true;
            $seed['source'] = 'bundled_seed';
            $seed['stale_reason'] = $res['error'] ?? 'Network offline, showing archived snapshot';
            return $seed;
        }

        // 5. Ultimate synthetic empty year fallback so UI never breaks
        return self::generateSyntheticCalendar($targetYear, $username);
    }

    /**
     * Get all active years calendar data in one combined payload
     */
    public static function getAllYearsData() {
        $years = self::getContributionYears();
        $dataset = [];
        foreach ($years as $yr) {
            $dataset[$yr] = self::getCalendarForYear($yr);
        }
        return [
            'years' => $years,
            'calendars' => $dataset
        ];
    }

    /**
     * Execute a cURL POST to GitHub GraphQL endpoint
     */
    private static function executeQuery($query, $variables = []) {
        $cfg = self::getConfig();
        $token = $cfg['github_token'] ?? '';

        if (empty($token)) {
            return ['error' => 'GitHub token is missing in config.php'];
        }

        $endpoint = 'https://api.github.com/graphql';
        $payload = json_encode([
            'query' => $query,
            'variables' => $variables
        ]);

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'User-Agent: AdrianSantiago-BrutalistPortfolio/2.0',
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 7);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return ['error' => 'cURL Error: ' . $curlError];
        }

        if ($httpCode !== 200) {
            return ['error' => "GitHub API HTTP Status: {$httpCode}", 'raw' => $response];
        }

        $decoded = json_decode($response, true);
        if (!is_array($decoded)) {
            return ['error' => 'Invalid JSON from GitHub GraphQL API'];
        }

        if (!empty($decoded['errors'])) {
            $msg = $decoded['errors'][0]['message'] ?? 'GraphQL Error';
            return ['error' => $msg, 'errors' => $decoded['errors']];
        }

        return $decoded;
    }

    /**
     * Normalize calendar data for consistent rendering and month label placement
     */
    private static function normalizeCalendarData($calendar, $year, $username, $allYears = []) {
        $total = (int)($calendar['totalContributions'] ?? 0);
        $weeks = $calendar['weeks'] ?? [];

        // Build week matrix and calculate exact month column offsets
        $normalizedWeeks = [];
        $months = [];
        $lastMonth = -1;

        foreach ($weeks as $wIndex => $week) {
            $days = $week['contributionDays'] ?? [];
            $normDays = [];

            // Weekday index 0 = Sun, 1 = Mon, ... 6 = Sat
            $dayMap = [];
            foreach ($days as $day) {
                $wDay = (int)$day['weekday'];
                $dateStr = $day['date'];
                $count = (int)$day['contributionCount'];
                $level = $day['contributionLevel'] ?? 'NONE';

                // Map level to numeric index 0..4
                $levelIndex = 0;
                switch ($level) {
                    case 'FIRST_QUARTILE':  $levelIndex = 1; break;
                    case 'SECOND_QUARTILE': $levelIndex = 2; break;
                    case 'THIRD_QUARTILE':  $levelIndex = 3; break;
                    case 'FOURTH_QUARTILE': $levelIndex = 4; break;
                    default:
                        if ($count > 0) {
                            $levelIndex = ($count >= 10) ? 4 : (($count >= 5) ? 3 : (($count >= 2) ? 2 : 1));
                        } else {
                            $levelIndex = 0;
                        }
                        break;
                }

                $dayObj = [
                    'date' => $dateStr,
                    'weekday' => $wDay,
                    'count' => $count,
                    'level' => $levelIndex,
                ];
                $dayMap[$wDay] = $dayObj;

                // Month label tracking
                $time = strtotime($dateStr);
                $monthNum = (int)date('n', $time);
                if ($monthNum !== $lastMonth) {
                    // Check if this month starts in this week or is the first week
                    $dayOfMonth = (int)date('j', $time);
                    if ($dayOfMonth <= 7 || empty($months)) {
                        $months[] = [
                            'name' => date('M', $time),
                            'month' => $monthNum,
                            'weekIndex' => $wIndex,
                            'year' => (int)date('Y', $time)
                        ];
                        $lastMonth = $monthNum;
                    }
                }
            }

            // Fill all 7 days (0 to 6)
            for ($d = 0; $d <= 6; $d++) {
                $normDays[$d] = $dayMap[$d] ?? null;
            }

            $normalizedWeeks[] = [
                'weekIndex' => $wIndex,
                'days' => $normDays
            ];
        }

        return [
            'username' => $username,
            'year' => (int)$year,
            'years' => $allYears,
            'totalContributions' => $total,
            'weeks' => $normalizedWeeks,
            'months' => $months
        ];
    }

    /**
     * Fallback seed data loader
     */
    private static function getFallbackSeed($year = null) {
        $seedFile = dirname(__DIR__) . '/data/github_fallback.json';
        if (file_exists($seedFile)) {
            $json = json_decode(file_get_contents($seedFile), true);
            if (is_array($json)) {
                if ($year && isset($json['calendars'][$year])) {
                    return $json['calendars'][$year];
                }
                return $json;
            }
        }
        return null;
    }

    /**
     * Synthetic empty calendar for offline emergency fallback
     */
    private static function generateSyntheticCalendar($year, $username) {
        $normalizedWeeks = [];
        $months = [];
        $startDate = new DateTime("{$year}-01-01");
        $endDate = new DateTime("{$year}-12-31");
        $curr = clone $startDate;

        $wIndex = 0;
        $currentWeek = array_fill(0, 7, null);
        $lastMonth = -1;

        while ($curr <= $endDate) {
            $wDay = (int)$curr->format('w');
            $dateStr = $curr->format('Y-m-d');
            $monthNum = (int)$curr->format('n');

            if ($monthNum !== $lastMonth && (int)$curr->format('j') <= 7) {
                $months[] = [
                    'name' => $curr->format('M'),
                    'month' => $monthNum,
                    'weekIndex' => $wIndex,
                    'year' => (int)$year
                ];
                $lastMonth = $monthNum;
            }

            $currentWeek[$wDay] = [
                'date' => $dateStr,
                'weekday' => $wDay,
                'count' => 0,
                'level' => 0
            ];

            if ($wDay === 6 || $curr == $endDate) {
                $normalizedWeeks[] = [
                    'weekIndex' => $wIndex,
                    'days' => $currentWeek
                ];
                $wIndex++;
                $currentWeek = array_fill(0, 7, null);
            }

            $curr->modify('+1 day');
        }

        return [
            'username' => $username,
            'year' => (int)$year,
            'years' => [(int)$year],
            'totalContributions' => 0,
            'weeks' => $normalizedWeeks,
            'months' => $months,
            'is_stale' => true,
            'source' => 'synthetic'
        ];
    }
}

// Handle Direct HTTP API Calls (AJAX / Fetch)
if (isset($_SERVER['SCRIPT_FILENAME']) && realpath($_SERVER['SCRIPT_FILENAME']) === realpath(__FILE__)) {
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: public, max-age=300');
    header('Access-Control-Allow-Origin: *');

    $action = $_GET['action'] ?? 'calendar';
    $year = isset($_GET['year']) ? (int)$_GET['year'] : null;

    if ($action === 'years') {
        $years = GitHubContributions::getContributionYears();
        echo json_encode(['years' => $years]);
        exit;
    }

    if ($action === 'all') {
        $all = GitHubContributions::getAllYearsData();
        echo json_encode($all);
        exit;
    }

    // Default: calendar for specific or current year
    $data = GitHubContributions::getCalendarForYear($year);
    echo json_encode($data);
    exit;
}
