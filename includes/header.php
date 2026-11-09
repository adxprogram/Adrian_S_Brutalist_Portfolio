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
                <polygon id="cursorMorphPoly" points="0,-26 6,-13 12,0 24,15 0,15 -24,15 -12,0 -6,-13" fill="#FFFFFF"/>
            </svg>
        </div>
    </div>

    <!-- Top Navigation (Anchors with Smooth Scroll & Hanging Brutalist Tabs) -->
    <header class="site-header" id="siteHeader">
        <nav class="site-nav" id="siteNav" aria-label="Main Navigation">
            <a href="<?= $isHome ? '#home' : $basePath . 'index.php#home' ?>" class="nav-link <?= $isHome ? 'active' : '' ?>" data-nav="home">home</a>
            <a href="<?= $isHome ? '#projects' : $basePath . 'index.php#projects' ?>" class="nav-link" data-nav="projects">projects</a>
            <a href="<?= $isHome ? '#experience' : $basePath . 'index.php#experience' ?>" class="nav-link" data-nav="experience">experience</a>
            <a href="<?= $isHome ? '#tools' : $basePath . 'index.php#tools' ?>" class="nav-link" data-nav="tools">tools</a>
            <a href="<?= $isHome ? '#contact' : $basePath . 'index.php#contact' ?>" class="nav-link" data-nav="contact">contact</a>
        </nav>
    </header>
