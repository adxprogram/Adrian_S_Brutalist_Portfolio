<?php
/**
 * Brutalist Portfolio - Header Component
 * Adrian Santiago Portfolio // All-In-One Brutalist Edition
 */
$basePath = isset($basePath) ? $basePath : '';
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
if ($currentPage === 'index' || $currentPage === '') {
    $currentPage = 'home';
}
$isHome = ($currentPage === 'home');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adrian Santiago — Creative Developer &amp; UI Architect. High-impact brutalist digital experiences with interactive eye-tracking and kinetic morphing.">
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
    <!-- Custom Inverted Brutalist Cursor Component (Continuous Polygon Vertex Morph) -->
    <div class="custom-cursor" id="customCursor" aria-hidden="true">
        <div class="cursor-dot" id="cursorDot"></div>
        <div class="cursor-triangle-wrap" id="cursorTriangleWrap">
            <svg class="cursor-triangle" id="cursorTriangle" viewBox="-32 -32 64 64" width="56" height="56" aria-hidden="true">
                <polygon id="cursorMorphPoly" points="0,-24 6.67,-10.67 13.33,2.67 20,16 0,16 -20,16 -13.33,2.67 -6.67,-10.67" fill="#FFFFFF"/>
            </svg>
        </div>
    </div>

    <!-- Top Navigation (Anchors with Smooth Scroll & Hanging Brutalist Tabs) -->
    <header class="site-header" id="siteHeader">
        <!-- Brutalist Mobile Hamburger Button (Strictly <= 900px) -->
        <button class="nav-toggle" id="navToggle" aria-label="Toggle Navigation Menu" aria-expanded="false" aria-controls="mobileNavOverlay">
            <span class="nav-toggle-icon" id="navToggleIcon" aria-hidden="true">☰</span>
        </button>

        <!-- Desktop Navigation Tabs (Strictly > 900px) -->
        <nav class="site-nav" id="siteNav" aria-label="Main Navigation">
            <a href="<?= $isHome ? '#home' : $basePath . 'index.php#home' ?>" class="nav-link <?= $isHome ? 'active' : '' ?>" data-nav="home">home</a>
            <a href="<?= $isHome ? '#projects' : $basePath . 'index.php#projects' ?>" class="nav-link" data-nav="projects">projects</a>
            <a href="<?= $isHome ? '#experience' : $basePath . 'index.php#experience' ?>" class="nav-link" data-nav="experience">experience</a>
            <a href="<?= $isHome ? '#tools' : $basePath . 'index.php#tools' ?>" class="nav-link" data-nav="tools">tools</a>
            <a href="<?= $isHome ? '#contact' : $basePath . 'index.php#contact' ?>" class="nav-link" data-nav="contact">contact</a>
        </nav>

        <!-- Brutalist Mobile Fullscreen Navigation Overlay (Strictly <= 900px) -->
        <div class="mobile-nav-overlay" id="mobileNavOverlay" aria-hidden="true">
            <nav class="mobile-nav" aria-label="Mobile Navigation">
                <a href="<?= $isHome ? '#home' : $basePath . 'index.php#home' ?>" class="mobile-nav-link <?= $isHome ? 'active' : '' ?>" data-nav="home">home</a>
                <a href="<?= $isHome ? '#projects' : $basePath . 'index.php#projects' ?>" class="mobile-nav-link" data-nav="projects">projects</a>
                <a href="<?= $isHome ? '#experience' : $basePath . 'index.php#experience' ?>" class="mobile-nav-link" data-nav="experience">experience</a>
                <a href="<?= $isHome ? '#tools' : $basePath . 'index.php#tools' ?>" class="mobile-nav-link" data-nav="tools">tools</a>
                <a href="<?= $isHome ? '#contact' : $basePath . 'index.php#contact' ?>" class="mobile-nav-link" data-nav="contact">contact</a>
            </nav>
        </div>
    </header>
