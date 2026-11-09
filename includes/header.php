<?php
/**
 * Brutalist Portfolio - Header Component
 * Adrian Santiago Portfolio
 */
$basePath = isset($basePath) ? $basePath : '';
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
if ($currentPage === 'index' || $currentPage === '') {
    $currentPage = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adrian Santiago — Creative Developer & UI Architect. High-impact brutalist digital experiences with interactive eye-tracking.">
    <meta name="theme-color" content="#A6A6A6">
    <title>ADRIAN SANTIAGO // Brutalist Portfolio</title>
    <link rel="icon" type="image/svg+xml" href="<?= $basePath ?>assets/images/branding/header_logo_eydi.svg">

    <!-- Preload Eye-Tracking Portrait Assets -->
    <link rel="preload" as="image" href="<?= $basePath ?>assets/images/Man_base_looking_straight_0.png">
    <link rel="preload" as="image" href="<?= $basePath ?>assets/images/Man_looking_upward_and_left_1.png">
    <link rel="preload" as="image" href="<?= $basePath ?>assets/images/Man_looking_to_left_2.png">
    <link rel="preload" as="image" href="<?= $basePath ?>assets/images/Man_looking_down_left_3.png">
    <link rel="preload" as="image" href="<?= $basePath ?>assets/images/Man_looking_downward_left_4.png">

    <!-- Google Fonts: Syncopate (Headings) & Inter (Body & Nav) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Syncopate:wght@400;700&display=swap" rel="stylesheet">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">
</head>
<body>
    <!-- Custom Inverted Brutalist Cursor Component (Large Solid Triangle with Difference Inversion) -->
    <div class="custom-cursor" id="customCursor" aria-hidden="true">
        <div class="cursor-dot" id="cursorDot"></div>
        <div class="cursor-triangle-wrap" id="cursorTriangleWrap">
            <svg class="cursor-triangle" id="cursorTriangle" viewBox="-28 -30 56 56" width="52" height="52" aria-hidden="true">
                <polygon points="0,-28 24,14 -24,14" fill="#FFFFFF"/>
            </svg>
        </div>
    </div>
    <!-- Top Navigation matching reference layout -->
    <header class="site-header" id="siteHeader">
        <nav class="site-nav" aria-label="Main Navigation">
            <a href="<?= $basePath ?>index.php" class="nav-link <?= ($currentPage === 'home') ? 'active' : '' ?>">home</a>
            <a href="<?= $basePath ?>projects.php" class="nav-link <?= ($currentPage === 'projects') ? 'active' : '' ?>">projects</a>
            <a href="<?= $basePath ?>experience.php" class="nav-link <?= ($currentPage === 'experience') ? 'active' : '' ?>">experience</a>
            <a href="<?= $basePath ?>tools.php" class="nav-link <?= ($currentPage === 'tools') ? 'active' : '' ?>">tools</a>
            <a href="<?= $basePath ?>contact.php" class="nav-link <?= ($currentPage === 'contact') ? 'active' : '' ?>">contact</a>
        </nav>
    </header>
