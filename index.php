<?php
/**
 * Brutalist Portfolio - Homepage / Hero Section
 * Interactive Eye-Tracking Showcase
 */
require_once 'includes/header.php';
?>

<main class="hero-wrapper" id="heroWrapper" role="main">
    <!-- Texture Overlay: High-contrast monochrome screen grain exclusive to hero -->
    <div class="hero-grain-overlay" aria-hidden="true"></div>

    <section class="hero-grid" id="heroGrid" aria-label="Adrian Santiago Interactive Hero">
        <!-- Left Pane Component: Screen-Dominant Asymmetrical Typographic Layout -->
        <div class="hero-left-pane">
            <div class="hero-eyebrow">
                <span class="eyebrow-text">PORTFOLIO ARCHIVE</span>
            </div>

            <!-- Giant Screen-Dominant Stacked Name -->
            <h1 class="hero-name" aria-label="Adrian Santiago">
                <span class="name-row name-first">ADRIAN</span>
                <span class="name-row name-last">SANTIAGO</span>
            </h1>

            <!-- Personal Introduction & Brutalist System Meta -->
            <div class="hero-info-block">
                <p class="hero-description">
                    Creative Developer &amp; Video Editor building responsive web applications, interactive interfaces, and digital media.
                </p>

                <div class="hero-meta-row">
                    <div class="meta-tag">
                        <span class="tag-label">TIMEZONE</span>
                        <span class="tag-val">UTC+8 [MANILA]</span>
                    </div>
                    <div class="meta-tag">
                        <span class="tag-label">STACK</span>
                        <span class="tag-val">PHP • JS • CSS • MOTION</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Pane Component: Full-Bleed High-Contrast Portrait Cut Slicing Edge -->
        <div class="hero-right-pane" id="portraitPane">
            <div class="portrait-stage" id="portraitStage">
                <!-- Layer 0: Straight-facing Base Portrait (Initial & Center) -->
                <img 
                    src="assets/images/Man_base_looking_straight_0.png" 
                    alt="Adrian Santiago looking straight forward" 
                    class="portrait-layer layer-0 is-active is-base"
                    data-gaze-index="0"
                    data-gaze-name="DIRECT"
                    loading="eager"
                    decoding="async"
                />

                <!-- Layer 1: Eyes Looking Upper-Left -->
                <img 
                    src="assets/images/Man_looking_upward_and_left_1.png" 
                    alt="Adrian Santiago looking upward and left" 
                    class="portrait-layer layer-1"
                    data-gaze-index="1"
                    data-gaze-name="UPPER-LEFT"
                    loading="eager"
                    decoding="async"
                />

                <!-- Top Screen Easter Egg: Spinning Cat (assets/images/top.gif) -->
                <div class="portrait-top-gif" id="portraitTopGif" aria-hidden="true">
                    <img src="assets/images/top.gif" alt="Spinning Cat Easter Egg" class="top-gif-img" />
                </div>

                <!-- Layer 2: Eyes Looking Directly Left -->
                <img 
                    src="assets/images/Man_looking_to_left_2.png" 
                    alt="Adrian Santiago looking to left" 
                    class="portrait-layer layer-2"
                    data-gaze-index="2"
                    data-gaze-name="MIDDLE-LEFT"
                    loading="eager"
                    decoding="async"
                />

                <!-- Layer 3: Eyes Looking Lower-Left -->
                <img 
                    src="assets/images/Man_looking_down_left_3.png" 
                    alt="Adrian Santiago looking down left" 
                    class="portrait-layer layer-3"
                    data-gaze-index="3"
                    data-gaze-name="LOWER-LEFT"
                    loading="eager"
                    decoding="async"
                />

                <!-- Layer 4: Eyes Looking Bottom-Left -->
                <img 
                    src="assets/images/Man_looking_downward_left_4.png" 
                    alt="Adrian Santiago looking downward left" 
                    class="portrait-layer layer-4"
                    data-gaze-index="4"
                    data-gaze-name="BOTTOM-LEFT"
                    loading="eager"
                    decoding="async"
                />
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
