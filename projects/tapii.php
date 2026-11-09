<?php
$projectId = 'tapii-nfc';
$basePath = '../';
require_once __DIR__ . '/../data/projects.php';

$currentProject = null;
$currentIndex = 0;
foreach ($projects as $idx => $p) {
    if ($p['id'] === $projectId) {
        $currentProject = $p;
        $currentIndex = $idx + 1;
        break;
    }
}
if (!$currentProject) { header('Location: ../projects.php'); exit; }
require_once __DIR__ . '/../includes/header.php';
?>
<main class="case-study-wrapper" role="main">
    <!-- Screen Grain Texture Overlay matching Brutalist System -->
    <div class="page-grain-overlay" aria-hidden="true"></div>

    <div class="page-container">
        <div class="case-study-hero">
            <h1 class="page-title"><?= htmlspecialchars($currentProject['title']) ?></h1>
            <p class="page-intro"><?= htmlspecialchars($currentProject['description']) ?></p>
        </div>
        <div class="case-study-image-frame">
            <img src="../<?= htmlspecialchars($currentProject['image']) ?>" alt="<?= htmlspecialchars($currentProject['title']) ?>" class="case-study-image" />
        </div>
        <div class="page-placeholder-card">
            <span class="card-status">[ HARDWARE // SYSTEM ARCHITECTURE ]</span>
            <p>Edge redirect routing layer matching smart physical tags to dynamic virtual personas with instantaneous cryptographic challenge-response authentication.</p>
            <a href="../projects.php" class="back-btn">&larr; RETURN TO PROJECTS ARCHIVE</a>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
