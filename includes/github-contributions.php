<?php
/**
 * GitHub Contributions Graph Component
 * Brutalist Portfolio // Adrian Santiago // 2026 Archive
 *
 * Replicates layout & interactive features of the GitHub contribution calendar
 * adapted natively into clean PHP, Vanilla JS, and Brutalist CSS.
 */

require_once __DIR__ . '/github-api.php';

if (!function_exists('renderContributionSvg')) {
    function renderContributionSvg($calendar) {
        if (empty($calendar) || empty($calendar['weeks'])) {
            return '<div class="github-empty-notice">// NO ACTIVITY DATA AVAILABLE FOR THIS TIMEFRAME</div>';
        }

        $cellSize = 12;
        $cellGap = 3;
        $step = $cellSize + $cellGap; // 15px
        $leftOffset = 36;
        $topOffset = 24;

        $weeks = $calendar['weeks'];
        $numWeeks = count($weeks);
        $svgWidth = $leftOffset + ($numWeeks * $step) + 8;
        $svgHeight = $topOffset + (7 * $step) + 8;

        $svg = '<svg class="github-calendar-svg" viewBox="0 0 ' . $svgWidth . ' ' . $svgHeight . '" width="' . $svgWidth . '" height="' . $svgHeight . '" role="grid" aria-label="Contribution Activity Grid">';

        // 1. Month Labels
        $svg .= '<g class="graph-month-labels" aria-hidden="true">';
        if (!empty($calendar['months'])) {
            foreach ($calendar['months'] as $m) {
                $mX = $leftOffset + ($m['weekIndex'] * $step);
                $svg .= '<text x="' . $mX . '" y="16" class="graph-month-text">' . htmlspecialchars($m['name']) . '</text>';
            }
        }
        $svg .= '</g>';

        // 2. Day Labels (Mon, Wed, Fri)
        $svg .= '<g class="graph-day-labels" aria-hidden="true">';
        $dayLabels = [
            1 => 'Mon',
            3 => 'Wed',
            5 => 'Fri'
        ];
        foreach ($dayLabels as $wDay => $label) {
            $dY = $topOffset + ($wDay * $step) + 10;
            $svg .= '<text x="0" y="' . $dY . '" class="graph-day-text">' . $label . '</text>';
        }
        $svg .= '</g>';

        // 3. Grid Cells
        $svg .= '<g class="graph-cells-group" role="rowgroup">';
        foreach ($weeks as $wIdx => $week) {
            $colX = $leftOffset + ($wIdx * $step);
            $svg .= '<g class="graph-week-column" transform="translate(' . $colX . ', 0)">';

            foreach ($week['days'] as $wDay => $day) {
                if ($day === null) {
                    continue;
                }
                $rowY = $topOffset + ($wDay * $step);
                $count = (int)$day['count'];
                $level = (int)$day['level'];
                $date = htmlspecialchars($day['date']);
                $dateFormatted = date('M j, Y', strtotime($day['date']));
                $label = ($count === 0 ? "No contributions" : "{$count} contribution" . ($count === 1 ? '' : 's')) . " on {$dateFormatted}";

                $svg .= '<rect class="contrib-cell contrib-lvl-' . $level . '" '
                     . 'data-date="' . $date . '" '
                     . 'data-count="' . $count . '" '
                     . 'data-level="' . $level . '" '
                     . 'data-date-formatted="' . htmlspecialchars($dateFormatted) . '" '
                     . 'x="0" y="' . $rowY . '" '
                     . 'width="' . $cellSize . '" height="' . $cellSize . '" '
                     . 'rx="0" ry="0" '
                     . 'tabindex="0" '
                     . 'role="gridcell" '
                     . 'aria-label="' . htmlspecialchars($label) . '" />';
            }

            $svg .= '</g>';
        }
        $svg .= '</g>';

        $svg .= '</svg>';
        return $svg;
    }
}

// Fetch all available years data
$allYearsData = GitHubContributions::getAllYearsData();
$availableYears = $allYearsData['years'] ?? [(int)date('Y')];
$initialYear = $availableYears[0] ?? (int)date('Y');
$initialCalendar = $allYearsData['calendars'][$initialYear] ?? null;
?>

<!-- ========================================================================
     SECTION: GITHUB CONTRIBUTIONS RADAR (Modular Brutalist Activity Telemetry)
     ======================================================================== -->
<section class="github-section section-target" id="contributions" role="region" aria-label="GitHub Contributions & Activity Archive">
    <!-- Texture Overlay: High-contrast monochrome screen grain -->
    <div class="hero-grain-overlay" aria-hidden="true"></div>

    <div class="projects-archive-container">
        <div class="archive-section github-archive-section">
            <!-- Section Header -->
            <div class="archive-header">
                <h3 class="archive-title morph-text" data-text="CONTRIBUTION GRAPH">CONTRIBUTION GRAPH</h3>
            </div>

            <!-- Main Layout: 2-Column Responsive Split (Graph Card + Year Selector Sidebar) -->
            <div class="github-contributions-layout">
                <!-- Left/Center Display Pane: Brutalist Activity Card -->
                <article class="github-display-card" aria-label="Contribution Calendar Panel">
                    <!-- Card Top Header -->
                    <div class="github-card-header">
                        <div class="github-header-stats">
                            <span class="github-stat-number" id="githubTotalCount"><?= number_format($initialCalendar['totalContributions'] ?? 0) ?></span>
                            <div class="github-stat-meta">
                                <span class="github-stat-label">CONTRIBUTIONS</span>
                                <span class="github-stat-year" id="githubActiveYearLabel">IN <?= htmlspecialchars((string)$initialYear) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Graph Canvas Wrapper with Mobile Horizontal Scroll Protection -->
                    <div class="github-graph-scroll-wrap" id="githubGraphScrollWrap" role="region" aria-label="GitHub Contribution Graph grid" tabindex="0">
                        <div class="github-graph-inner" id="githubGraphContainer">
                            <?= renderContributionSvg($initialCalendar) ?>
                        </div>
                    </div>

                    <!-- Card Bottom Footer / Legend -->
                    <div class="github-card-footer">
                        <div class="github-legend" aria-label="Contribution activity intensity legend">
                            <span class="legend-text">LESS</span>
                            <div class="legend-cells">
                                <span class="legend-cell lvl-0" title="0 contributions"></span>
                                <span class="legend-cell lvl-1" title="1-2 contributions"></span>
                                <span class="legend-cell lvl-2" title="3-5 contributions"></span>
                                <span class="legend-cell lvl-3" title="6-9 contributions"></span>
                                <span class="legend-cell lvl-4" title="10+ contributions"></span>
                            </div>
                            <span class="legend-text">MORE</span>
                        </div>
                    </div>
                </article>

                <!-- Year Selector Sidebar (Victor Eke Pattern + Brutalist Tag Aesthetic) -->
                <aside class="github-years-sidebar" aria-label="Select contribution year">
                    <div class="years-button-group" role="tablist">
                        <?php foreach ($availableYears as $yr): ?>
                            <button 
                                type="button" 
                                class="brutalist-year-btn <?= ($yr === $initialYear) ? 'is-active' : '' ?>" 
                                data-year="<?= $yr ?>"
                                role="tab"
                                aria-selected="<?= ($yr === $initialYear) ? 'true' : 'false' ?>"
                                title="View GitHub contributions for <?= $yr ?>"
                            >
                                <span class="btn-year-num"><?= $yr ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <!-- Brutalist Floating Tooltip -->
    <div class="github-tooltip" id="githubTooltip" role="tooltip" aria-hidden="true"></div>

    <!-- Pre-cached JSON Dataset for Instant Zero-Latency Year Switching -->
    <script id="github-contributions-dataset" type="application/json">
        <?= json_encode($allYearsData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>
    </script>
</section>
