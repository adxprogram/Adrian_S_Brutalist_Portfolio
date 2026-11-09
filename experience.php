<?php
/**
 * Brutalist Portfolio - Experience & Record
 * Adrian Santiago Portfolio // 2026 Archive
 */
$basePath = '';
require_once 'includes/header.php';
?>

<main class="page-wrapper" role="main">
    <!-- Screen Grain Texture Overlay matching Brutalist System -->
    <div class="page-grain-overlay" aria-hidden="true"></div>

    <section class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">EXPERIENCE</h1>
        </div>

        <!-- 1. Profile / Creative Architect Bio Block -->
        <article class="profile-card" aria-label="Adrian Santiago Background Dossier">
            <div class="profile-image-wrap">
                <img 
                    src="assets/images/about/about-image.png" 
                    alt="Adrian Santiago — Creative Developer &amp; Video Editor" 
                    class="profile-image"
                    loading="eager"
                />
                <span class="profile-frame-badge">[ WORKSPACE // ADRIAN SANTIAGO ]</span>
            </div>

            <div class="profile-bio-content">
                <div class="profile-meta-row">
                    <span class="profile-role">CREATIVE DEVELOPER &amp; VIDEO EDITOR</span>
                    <span class="profile-status">[ ACTIVE // MANILA ]</span>
                </div>

                <h2 class="profile-headline">Blending cinematic storytelling with functional, clean code.</h2>

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
        <section class="sub-section" aria-label="Verified Industry Certifications">
            <div class="sub-section-header">
                <h2 class="sub-section-title">VERIFIED CERTIFICATIONS</h2>
            </div>

            <div class="certifications-grid">
                <!-- Cert 1: CodeSignal -->
                <article class="cert-card">
                    <div class="cert-image-frame">
                        <img 
                            src="assets/images/certifications/CodeSignal_Cert.png" 
                            alt="CodeSignal General Coding Assessment Certification" 
                            class="cert-image"
                            loading="lazy"
                        />
                        <span class="cert-tag">[ CODESIGNAL // DSA ]</span>
                    </div>
                    <div class="cert-info">
                        <h3 class="cert-title">CodeSignal General Coding Assessment</h3>
                        <p class="cert-desc">Achieved top-tier score demonstrating advanced algorithmic problem solving, computational complexity analysis, and data structure manipulation.</p>
                        <a 
                            href="https://codesignal.com/learn/profile/cmkqy6p360004k304m5n9ylts" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="cert-action-btn"
                        >
                            [ VERIFY CREDENTIAL &rarr; ]
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
                        <span class="cert-tag">[ CISCO // NETWORKING ]</span>
                    </div>
                    <div class="cert-info">
                        <h3 class="cert-title">Networking Essentials &amp; Topology Design</h3>
                        <p class="cert-desc">Certified in enterprise topology configuration using Cisco Packet Tracer, including VLAN segmentation, subnetting, and router routing tables.</p>
                        <a 
                            href="https://www.credly.com/badges/9bbe28de-691f-4a62-980e-a7e7d68b1083" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="cert-action-btn"
                        >
                            [ VERIFY ON CREDLY &rarr; ]
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
                        <span class="cert-tag">[ ADOBE // PREMIERE PRO ]</span>
                    </div>
                    <div class="cert-info">
                        <h3 class="cert-title">Video Editing Expert // Premiere Pro</h3>
                        <p class="cert-desc">Certified in Adobe Premiere Pro advanced editing workflows, pacing, multi-track audio staging, color grading, and cinematic storytelling.</p>
                        <a 
                            href="https://www.facebook.com/GraphicsmediatrainingPH" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="cert-action-btn"
                        >
                            [ VIEW ISSUER &rarr; ]
                        </a>
                    </div>
                </article>
            </div>
        </section>

        <!-- 3. Motion Production & Demo Reel -->
        <section class="sub-section" aria-label="Demo Reel &amp; Motion Production">
            <div class="sub-section-header">
                <h2 class="sub-section-title">DEMO REEL</h2>
            </div>

            <div class="video-showcase-card">
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
        </section>

        <!-- 4. Client Endorsements / Testimonials -->
        <section class="sub-section" aria-label="Client Endorsements">
            <div class="sub-section-header">
                <h2 class="sub-section-title">CLIENT ENDORSEMENTS</h2>
            </div>

            <div class="testimonials-grid">
                <article class="testimonial-card">
                    <div class="testimonial-rating">[ 5.0 / 5.0 &bull; EXCELLENT ]</div>
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
                    <div class="testimonial-rating">[ 5.0 / 5.0 &bull; EXCELLENT ]</div>
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
        </section>

        <div class="page-footer-nav">
            <a href="index.php" class="back-btn">&larr; RETURN TO HERO</a>
            <a href="tools.php" class="back-btn">EXPLORE TOOLS &rarr;</a>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>
