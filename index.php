<?php
/**
 * Brutalist Portfolio - Complete Single-Page Showcase
 * Adrian Santiago Portfolio // 2026 Archive // Kinetic Morph Edition
 */

// 1. Load Projects Dataset
require_once __DIR__ . '/data/projects.php';

// 2. Header Include
require_once __DIR__ . '/includes/header.php';
?>

<main id="mainContent" role="main">
    <!-- ========================================================================
         SECTION 1: HERO / HOMEPAGE (Eye-Tracking & Kinetic Morph Stage)
         ======================================================================== -->
    <section class="hero-wrapper section-target" id="home" role="region" aria-label="Adrian Santiago Interactive Hero">
        <!-- Texture Overlay: High-contrast monochrome screen grain exclusive to hero -->
        <div class="hero-grain-overlay" aria-hidden="true"></div>

        <div class="hero-grid" id="heroGrid">
            <!-- Left Pane Component: Screen-Dominant Asymmetrical Typographic Layout -->
            <div class="hero-left-pane">
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
                            <span class="tag-val">UTC+8 MANILA</span>
                        </div>
                        <div class="meta-tag">
                            <span class="tag-label">STACK</span>
                            <span class="tag-val">PHP • JS • CSS • MOTION</span>
                        </div>
                        <!-- <div class="meta-tag">
                            <span class="tag-label">FORM ENGINE</span>
                            <span class="tag-val" id="metaFormEngine">KINETIC EUCLIDEAN</span>
                        </div> -->
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

                    <button
                        type="button"
                        class="portrait-cat-button"
                        id="portraitCatButton"
                        aria-label="Toggle cat animation"
                        aria-pressed="false"
                    >
                        <span aria-hidden="true">🐈‍⬛</span>
                    </button>

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
        </div>
    </section>

    <!-- ========================================================================
         SECTION 2: PROJECTS (Interactive Split Stage + Archive)
         ======================================================================== -->
    <section class="projects-page-wrapper section-target" id="projects" role="region" aria-label="Selected Projects Showcase">
        <!-- Texture Overlay: High-contrast monochrome screen grain like home -->
        <div class="hero-grain-overlay" aria-hidden="true"></div>

        <!-- 1. Top Header & Title Bar (Constrained) -->
        <div class="projects-header-container">
            <header class="projects-header">
                <h2 class="projects-title morph-text" data-text="PROJECTS">PROJECTS</h2>
                <a href="#contact" class="projects-cta-pill" aria-label="Wanna see more? Contact Adrian">
                    wanna see more?
                </a>
            </header>
        </div>

        <!-- 2. Split Stage (Fixed Horizon Line - Edge-to-Edge Stage) -->
        <div class="projects-stage" id="projectsStage" aria-label="Selected Projects Showcase">
            <!-- Left Display Pane: Pitch Black Clickable Card -->
            <a 
                href="<?= htmlspecialchars($projects[0]['link']) ?>" 
                class="project-display-card" 
                id="projectDisplayCard" 
                aria-label="View case study for <?= htmlspecialchars($projects[0]['title']) ?>"
            >
                <div class="display-card-content" id="displayCardContent">
                    <div class="display-card-meta">
                        <span class="display-card-index" id="displayCardIndex">// 01</span>
                        <span class="display-card-divider" aria-hidden="true">&bull;</span>
                        <span class="display-card-tag" id="displayCardTag"><?= htmlspecialchars($projects[0]['tag']) ?></span>
                    </div>

                    <h3 class="display-card-title" id="displayCardTitle"><?= htmlspecialchars($projects[0]['title']) ?></h3>

                    <p class="display-card-desc" id="displayCardDesc">
                        <?= htmlspecialchars($projects[0]['description']) ?>
                    </p>
                </div>

                <div class="display-card-action" aria-hidden="true">
                    <span class="action-text">VIEW CASE STUDY</span>
                    <span class="action-arrow">&rarr;</span>
                </div>
            </a>

            <!-- Right Interactive Pane (6-Image Sliced Accordion) -->
            <div class="projects-accordion" id="projectsAccordion" role="region" aria-label="Interactive project image slices">
                <?php foreach ($projects as $index => $project): ?>
                    <a 
                        href="<?= htmlspecialchars($project['link']) ?>" 
                        class="accordion-slice <?= ($index === 0) ? 'is-expanded' : '' ?>"
                        data-index="<?= $index ?>"
                        data-num="<?= sprintf('%02d', $index + 1) ?>"
                        data-title="<?= htmlspecialchars($project['title']) ?>"
                        data-tag="<?= htmlspecialchars($project['tag']) ?>"
                        data-desc="<?= htmlspecialchars($project['description']) ?>"
                        data-link="<?= htmlspecialchars($project['link']) ?>"
                        aria-label="<?= htmlspecialchars($project['title']) ?> &mdash; <?= htmlspecialchars($project['tag']) ?>"
                    >
                        <img 
                            src="<?= htmlspecialchars($project['image']) ?>" 
                            alt="<?= htmlspecialchars($project['title']) ?> preview" 
                            class="slice-image" 
                            loading="<?= ($index < 2) ? 'eager' : 'lazy' ?>"
                            decoding="async"
                        />
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 3. Foundational Archive (Reused Previous Projects) -->
        <div class="projects-archive-container">
            <div class="archive-section" aria-label="Foundational Project Archive">
                <div class="archive-header">
                    <h3 class="archive-title">PREVIOUS WORKS &amp; SYSTEMS</h3>
                </div>

                <div class="archive-grid">
                    <?php foreach ($archivedProjects as $idx => $arch): ?>
                        <article class="archive-card">
                            <div class="archive-image-wrap">
                                <img 
                                    src="<?= htmlspecialchars($arch['image']) ?>" 
                                    alt="<?= htmlspecialchars($arch['title']) ?> screenshot" 
                                    class="archive-image" 
                                    loading="lazy" 
                                />
                                <span class="archive-badge"><?= htmlspecialchars($arch['year']) ?> // <?= sprintf('%02d', $idx + 1) ?></span>
                            </div>
                            <div class="archive-content">
                                <div>
                                    <span class="archive-tag"><?= htmlspecialchars($arch['tag']) ?></span>
                                    <h4 class="archive-card-title"><?= htmlspecialchars($arch['title']) ?></h4>
                                    <p class="archive-card-desc"><?= htmlspecialchars($arch['description']) ?></p>
                                </div>
                                <a 
                                    href="<?= htmlspecialchars($arch['link']) ?>" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="archive-link"
                                >
                                    VIEW DEPLOYMENT / REPO &rarr;
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION: GITHUB CONTRIBUTIONS & ACTIVITY (Brutalist Telemetry)
         ======================================================================== -->
    <?php require_once __DIR__ . '/includes/github-contributions.php'; ?>

    <!-- ========================================================================
         SECTION 3: EXPERIENCE (Bio + Verified Credentials + Demo Reel + Reviews)
         ======================================================================== -->
    <section class="page-wrapper section-target" id="experience" role="region" aria-label="Experience &amp; Record">
        <!-- Texture Overlay: High-contrast monochrome screen grain like home -->
        <div class="hero-grain-overlay" aria-hidden="true"></div>

        <div class="page-container">
            <!-- Page Header -->
            <div class="page-header">
                <h2 class="page-title morph-text" data-text="EXPERIENCE">EXPERIENCE</h2>
            </div>

            <!-- 1. Profile / Creative Architect Bio Block -->
            <article class="profile-card" aria-label="Adrian Santiago Background Dossier">
                <div class="profile-image-wrap">
                    <img 
                        src="assets/images/about/about-image.png" 
                        alt="Adrian Santiago — Creative Developer &amp; Video Editor" 
                        class="profile-image" 
                        loading="lazy"
                    />
                </div>

                <div class="profile-bio-content">
                    <div class="profile-meta-row">
                        <span class="profile-role">CREATIVE DEVELOPER &amp; VIDEO EDITOR</span>
                    </div>

                    <h3 class="profile-headline">Blending cinematic storytelling with functional, clean code.</h3>

                    <p class="profile-desc">
                        Creative developer and video editor specializing in responsive web layouts, front-end design, and video editing. Focused on delivering clean, pixel-perfect results that perform seamlessly across all devices.
                    </p>

                    <div class="metrics-grid">
                        <div class="metric-block">
                            <span class="metric-val">02+</span>
                            <span class="metric-label">YEARS DEV &amp; MOTION</span>
                        </div>
                        <div class="metric-block">
                            <span class="metric-val">100%</span>
                            <span class="metric-label">RESPONSIVE &amp; AUDITED</span>
                        </div>
                        <div class="metric-block">
                            <span class="metric-val">03</span>
                            <span class="metric-label">VERIFIED CREDENTIALS</span>
                        </div>
                        <div class="metric-block">
                            <span class="metric-val">UTC+8</span>
                            <span class="metric-label">TIMEZONE AVAILABILITY</span>
                        </div>
                    </div>
                </div>
            </article>

            <!-- 2. Verified Credentials & Certifications -->
            <div class="certifications-grid" aria-label="Verified Industry Certifications">
                <!-- Cert 1: CodeSignal -->
                <article class="cert-card">
                    <div class="cert-image-frame">
                        <img 
                            src="assets/images/certifications/CodeSignal_Cert.png" 
                            alt="CodeSignal General Coding Assessment Certification" 
                            class="cert-image" 
                            loading="lazy"
                        />
                    </div>
                    <div class="cert-info">
                        <h4 class="cert-title">CodeSignal General Coding Assessment</h4>
                        <p class="cert-desc">Achieved top-tier score demonstrating advanced algorithmic problem solving, computational complexity analysis, and data structure manipulation.</p>
                        <a 
                            href="https://codesignal.com/learn/profile/cmkqy6p360004k304m5n9ylts" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="cert-action-btn"
                        >
                            VERIFY CREDENTIAL &rarr;
                        </a>
                    </div>
                </article>

                <!-- Cert 2: Cisco Packet Tracer -->
                <article class="cert-card">
                    <div class="cert-image-frame">
                        <img 
                            src="assets/images/certifications/Packet_Tracer_Cert.png" 
                            alt="Cisco Packet Tracer Networking Essentials Certification" 
                            class="cert-image" 
                            loading="lazy"
                        />
                    </div>
                    <div class="cert-info">
                        <h4 class="cert-title">Networking Essentials &amp; Topology Design</h4>
                        <p class="cert-desc">Certified in enterprise topology configuration using Cisco Packet Tracer, including VLAN segmentation, subnetting, and router routing tables.</p>
                        <a 
                            href="https://www.credly.com/badges/9bbe28de-691f-4a62-980e-a7e7d68b1083" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="cert-action-btn"
                        >
                            VERIFY ON CREDLY &rarr;
                        </a>
                    </div>
                </article>

                <!-- Cert 3: Adobe Premiere Pro -->
                <article class="cert-card">
                    <div class="cert-image-frame">
                        <img 
                            src="assets/images/certifications/Premiere_Pro_Cert.png" 
                            alt="Adobe Premiere Pro Video Editing Expert Certification" 
                            class="cert-image" 
                            loading="lazy"
                        />
                    </div>
                    <div class="cert-info">
                        <h4 class="cert-title">Video Editing Expert // Premiere Pro</h4>
                        <p class="cert-desc">Certified in Adobe Premiere Pro advanced editing workflows, pacing, multi-track audio staging, color grading, and cinematic storytelling.</p>
                        <a 
                            href="https://www.facebook.com/GraphicsmediatrainingPH" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="cert-action-btn"
                        >
                            VIEW ISSUER &rarr;
                        </a>
                    </div>
                </article>
            </div>

            <!-- 3. Motion Production & Demo Reel -->
            <div class="video-showcase-card" aria-label="Demo Reel &amp; Motion Production">
                <div class="video-frame">
                    <video 
                        controls 
                        loop 
                        playsinline 
                        preload="metadata" 
                        class="brutalist-video"
                        poster="assets/images/demo-reel/demo-reel-thumbnail.jpg"
                    >
                        <source src="https://media.githubusercontent.com/media/adxprogram/Eydi_Portfolio_Website/main/images/Demo_Reel_Adrian.mp4" type="video/mp4">
                        Your browser does not support HTML5 video streaming.
                    </video>
                </div>
            </div>

            <!-- 4. Client Endorsements / Testimonials -->
            <div class="testimonials-grid" aria-label="Client Endorsements">
                <article class="testimonial-card">
                    <div class="testimonial-rating" aria-label="4 out of 5 stars"><span class="rating-star">✦</span><span class="rating-star">✦</span><span class="rating-star">✦</span><span class="rating-star">✦</span></div>
                    <blockquote class="testimonial-quote">
                        "High quality service, Adrian is very responsive and quick to implement features."
                    </blockquote>
                    <div class="testimonial-author">
                        <span class="author-mark">SP</span>
                        <div class="author-meta">
                            <span class="author-name">SP</span>
                            <span class="author-status">Verified Reviewer</span>
                        </div>
                    </div>
                </article>

                <article class="testimonial-card">
                    <div class="testimonial-rating" aria-label="4 out of 5 stars"><span class="rating-star">✦</span><span class="rating-star">✦</span><span class="rating-star">✦</span><span class="rating-star">✦</span></div>
                    <blockquote class="testimonial-quote">
                        "The video editing work is top-tier. Saved me hours of work!"
                    </blockquote>
                    <div class="testimonial-author">
                        <span class="author-mark">M</span>
                        <div class="author-meta">
                            <span class="author-name">MARC</span>
                            <span class="author-status">Verified Reviewer // Content Creator</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 4: TOOLS (Primary Specializations + Technical Ecosystem)
         ======================================================================== -->
    <section class="page-wrapper section-target" id="tools" role="region" aria-label="Arsenal &amp; Tools">
        <!-- Texture Overlay: High-contrast monochrome screen grain like home -->
        <div class="hero-grain-overlay" aria-hidden="true"></div>

        <div class="page-container">
            <!-- Page Header -->
            <div class="page-header">
                <h2 class="page-title morph-text" data-text="TOOLS">TOOLS</h2>
            </div>

            <!-- 1. Core Disciplines Grid (Using Reused Discipline Icons) -->
            <div class="disciplines-grid" aria-label="Core Engineering Disciplines">
                <!-- Discipline 1: Web Development -->
                <article class="discipline-card">
                    <div class="discipline-top">
                        <div class="discipline-icon-box" aria-hidden="true">
                            <img src="assets/images/tools/bars.png" alt="Web Development Icon" class="discipline-icon" />
                        </div>
                    </div>

                    <div class="discipline-info">
                        <h4 class="discipline-title">Web Development</h4>
                        <p class="discipline-desc">
                            Websites built to work across all devices with fast performance, clean semantic layouts, and responsive interaction models.
                        </p>
                    </div>

                    <div class="discipline-stack">
                        STACK: PHP 8.2 &bull; ES6+ JS &bull; Three.js &bull; CSS3 System &bull; MySQL
                    </div>
                </article>

                <!-- Discipline 2: Graphic Design -->
                <article class="discipline-card">
                    <div class="discipline-top">
                        <div class="discipline-icon-box" aria-hidden="true">
                            <img src="assets/images/tools/paint.png" alt="Graphic Design Icon" class="discipline-icon" />
                        </div>
                    </div>

                    <div class="discipline-info">
                        <h4 class="discipline-title">Graphic Design</h4>
                        <p class="discipline-desc">
                            Visually striking designs balancing creativity and functionality. Typography systems, branding, and assets crafted for digital platforms.
                        </p>
                    </div>

                    <div class="discipline-stack">
                        STACK: Figma &bull; Vector Systems &bull; Typography &bull; Color Science &bull; UI Kits
                    </div>
                </article>

                <!-- Discipline 3: Video Editing -->
                <article class="discipline-card">
                    <div class="discipline-top">
                        <div class="discipline-icon-box" aria-hidden="true">
                            <img src="assets/images/tools/scissor.png" alt="Video Editing Icon" class="discipline-icon" />
                        </div>
                    </div>

                    <div class="discipline-info">
                        <h4 class="discipline-title">Video Editing</h4>
                        <p class="discipline-desc">
                            Video editing for social media, marketing, and content creators with smooth transitions, color grading, audio sync, and storytelling.
                        </p>
                    </div>

                    <div class="discipline-stack">
                        STACK: Premiere Pro &bull; After Effects &bull; Color Grading &bull; Sound Staging
                    </div>
                </article>
            </div>

            <!-- 2. Applications Section: 300vh Scroll Runway for True Scroll-Pinning -->
            <div class="applications-runway" id="applicationsRunway" aria-label="Applications Timeline">
                <div class="applications-sticky-stage" id="applicationsStickyStage">
                    <div class="sub-section-header">
                        <h3 class="sub-section-title">Applications</h3>
                    </div>

                    <div class="applications-scroll-container" id="applicationsScrollContainer" tabindex="0" role="region" aria-label="Applications timeline horizontal scroll">
                    <div class="applications-track" id="applicationsTrack">
                        <!-- Horizontal Axis Line with Arrowhead -->
                        <div class="applications-axis" aria-hidden="true">
                            <div class="applications-arrow"></div>
                        </div>

                        <!-- 1. Visual Studio Code -->
                        <a href="https://code.visualstudio.com/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Visual Studio Code">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/vscode.png" alt="Visual Studio Code" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">VSCode</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 2. Google Antigravity -->
                        <a href="https://antigravity.google/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Google Antigravity">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/antigravity.webp" alt="Google Antigravity" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Antigravity</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 3. CapCut -->
                        <a href="https://www.capcut.com/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="CapCut">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/capcut.png" alt="CapCut" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">CapCut</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 4. ChatGPT -->
                        <a href="https://chatgpt.com/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="ChatGPT">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/chatgpt.webp" alt="ChatGPT" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">ChatGPT</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 5. Claude -->
                        <a href="https://claude.ai/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Claude">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/claude-ai.webp" alt="Claude" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Claude</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 6. Figma -->
                        <a href="https://www.figma.com/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Figma">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/figma.webp" alt="Figma" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Figma</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 7. Monday -->
                        <a href="http://monday.com/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Monday">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/monday.svg" alt="Monday" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Monday</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 8. n8n -->
                        <a href="https://n8n.io/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="n8n">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/n8n.webp" alt="n8n" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">n8n</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 9. Notion -->
                        <a href="https://www.notion.so/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Notion">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/notion.webp" alt="Notion" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Notion</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 10. Obsidian -->
                        <a href="https://obsidian.md/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Obsidian">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/obsidian.webp" alt="Obsidian" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Obsidian</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 11. Adobe Premiere Pro -->
                        <a href="https://www.adobe.com/products/premiere.html" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Adobe Premiere Pro">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/premiere-pro.webp" alt="Adobe Premiere Pro" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Premiere Pro</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 12. Slack -->
                        <a href="https://slack.com/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Slack">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/slack.webp" alt="Slack" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Slack</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 13. Spotify -->
                        <a href="https://open.spotify.com/" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Spotify">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/spotify.webp" alt="Spotify" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">Spotify</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>

                        <!-- 14. Adobe After Effects -->
                        <a href="https://www.adobe.com/products/aftereffects.html" target="_blank" rel="noopener noreferrer" class="app-item" aria-label="Adobe After Effects">
                            <div class="app-icon-wrap">
                                <img src="assets/images/tools-logo/after-effects.png" alt="Adobe After Effects" class="app-logo" loading="lazy" />
                            </div>
                            <span class="app-name">After Effects</span>
                            <div class="app-node" aria-hidden="true">
                                <svg class="app-star" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 0 C12 6.627 6.627 12 0 12 C6.627 12 12 17.373 12 24 C12 17.373 17.373 12 24 12 C17.373 12 12 6.627 12 0 Z"/></svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- ========================================================================
         SECTION 5: CONTACT (Dossier + Communication + Form)
         ======================================================================== -->
    <section class="page-wrapper section-target" id="contact" role="region" aria-label="Initiate Contact &amp; Dossier">
        <!-- Texture Overlay: High-contrast monochrome screen grain like home -->
        <div class="hero-grain-overlay" aria-hidden="true"></div>

        <div class="page-container">
            <!-- Page Header -->
            <div class="page-header">
                <h2 class="page-title morph-text" data-text="CONTACT">CONTACT</h2>
            </div>

            <div class="contact-grid">
                <!-- Left Column: Communication Coordinates & Dossier -->
                <div class="contact-left-col">
                    <!-- Channels Card -->
                    <article class="contact-channels-card">
                        <div class="contact-channel-item">
                            <span class="channel-label">EMAIL</span>
                            <a href="mailto:adriandc.santantiago22@email.com" class="channel-val">adriandc.santantiago22@email.com</a>
                        </div>

                        <div class="contact-channel-item">
                            <span class="channel-label">PHONE / WHATSAPP</span>
                            <a href="https://wa.me/639765764144" target="_blank" rel="noopener noreferrer" class="channel-val">(+63) 976 576 4144</a>
                        </div>

                        <div class="contact-channel-item">
                            <span class="channel-label">LOCATION</span>
                            <span class="channel-val" style="font-size: 1.1rem;">MANILA, PHILIPPINES &bull; UTC+8</span>
                        </div>

                        <!-- Social Channels Strip with Reused Social Assets -->
                        <div class="social-strip" aria-label="Social and Repository Links">
                            <a href="https://github.com/adxprogram" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="Adrian Santiago GitHub">
                                <img src="assets/images/social/github.png" alt="GitHub Logo" />
                                <span>GITHUB</span>
                            </a>

                            <a href="https://www.instagram.com/theeditoradrian/" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="Adrian Santiago Instagram">
                                <img src="assets/images/social/instagram.png" alt="Instagram Logo" />
                                <span>INSTAGRAM</span>
                            </a>

                            <a href="https://www.facebook.com/adriandc.santiago/" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="Adrian Santiago Facebook">
                                <img src="assets/images/social/facebook.png" alt="Facebook Logo" />
                                <span>FACEBOOK</span>
                            </a>

                            <a href="https://wa.me/639765764144" target="_blank" rel="noopener noreferrer" class="social-pill" aria-label="Adrian Santiago WhatsApp">
                                <img src="assets/images/social/whatsapp_logo.png" alt="WhatsApp Logo" />
                                <span>WHATSAPP</span>
                            </a>
                        </div>
                    </article>

                    <!-- Dossier / Resume Card with Reused Resume Asset -->
                    <article class="dossier-card" aria-label="Adrian Santiago Technical Resume">
                        <div class="dossier-header">
                            <h3 class="dossier-title">RESUME</h3>
                            <span class="dossier-code">PDF</span>
                        </div>

                        <div class="dossier-preview-frame">
                            <img 
                                src="assets/images/resume/Resume Download.png" 
                                alt="Adrian Santiago Official Resume Dossier Preview" 
                                class="dossier-img" 
                                loading="lazy"
                            />
                            <span class="dossier-overlay-badge">ADRIAN_SANTIAGO_RESUME.PDF</span>
                        </div>

                        <div class="dossier-actions">
                            <a 
                                href="https://media.githubusercontent.com/media/adxprogram/Eydi_Portfolio_Website/main/images/Adrian_Santiago_Resume.pdf" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="dossier-btn"
                            >
                                <span>DOWNLOAD RESUME (PDF) &darr;</span>
                            </a>
                        </div>
                    </article>
                </div>

                <!-- Right Column: Brutalist Inquiry Dispatch Form -->
                <div class="contact-right-col">
                    <article class="contact-form-card">
                        <div class="contact-form-card-header">
                            <h3 class="form-header-title">SEND A MESSAGE</h3>
                        </div>

                        <form id="contactForm" action="https://formspree.io/f/mrerpjoo" method="POST" class="contact-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName" class="form-label">FIRST NAME *</label>
                                    <input type="text" id="firstName" name="first-name" class="form-input" placeholder="e.g. Marc" required>
                                </div>

                                <div class="form-group">
                                    <label for="lastName" class="form-label">LAST NAME *</label>
                                    <input type="text" id="lastName" name="last-name" class="form-input" placeholder="e.g. Miller" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contactEmail" class="form-label">EMAIL ADDRESS *</label>
                                <input type="email" id="contactEmail" name="email" class="form-input" placeholder="name@email.com" required>
                            </div>

                            <div class="form-group">
                                <label for="projectScope" class="form-label">SUBJECT</label>
                                <input type="text" id="projectScope" name="subject" class="form-input" placeholder="Web Development / Video Editing / Project inquiry">
                            </div>

                            <div class="form-group">
                                <label for="messageBody" class="form-label">MESSAGE *</label>
                                <textarea id="messageBody" name="message" class="form-textarea" placeholder="Tell me about your project or inquiry..." required></textarea>
                            </div>

                            <button type="submit" id="contactSubmitBtn" class="submit-btn">
                                SEND MESSAGE &rarr;
                            </button>

                            <div id="contactFormStatus" class="form-status" role="status" aria-live="polite"></div>
                        </form>
                    </article>
                </div>
            </div>

            <div class="page-footer-nav" style="justify-content: flex-end;">
                <a href="#home" class="back-btn" id="backToTopBtn">
                    <img src="assets/images/social/up-arrows.png" alt="Up Arrow" style="width: 14px; height: 14px; filter: brightness(0) invert(1);" />
                    <span>TOP OF PAGE</span>
                </a>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
