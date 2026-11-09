<?php
/**
 * Brutalist Portfolio - Initiate Contact & Dossier
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
            <h1 class="page-title">CONTACT</h1>
        </div>

        <div class="contact-grid">
            <!-- Left Column: Communication Coordinates & Dossier -->
            <div class="contact-left-col">
                <!-- Channels Card -->
                <article class="contact-channels-card">
                    <div class="contact-channel-item">
                        <span class="channel-label">[ EMAIL ]</span>
                        <a href="mailto:adriandc.santantiago22@email.com" class="channel-val">adriandc.santantiago22@email.com</a>
                    </div>

                    <div class="contact-channel-item">
                        <span class="channel-label">[ PHONE / WHATSAPP ]</span>
                        <a href="https://wa.me/639765764144" target="_blank" rel="noopener noreferrer" class="channel-val">(+63) 976 576 4144</a>
                    </div>

                    <div class="contact-channel-item">
                        <span class="channel-label">[ LOCATION ]</span>
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
                        <h2 class="dossier-title">RESUME</h2>
                        <span class="dossier-code">[ PDF ]</span>
                    </div>

                    <div class="dossier-preview-frame">
                        <img 
                            src="assets/images/resume/Resume Download.png" 
                            alt="Adrian Santiago Official Resume Dossier Preview" 
                            class="dossier-img"
                            loading="lazy"
                        />
                        <span class="dossier-overlay-badge">[ ADRIAN_SANTIAGO_RESUME.PDF ]</span>
                    </div>

                    <div class="dossier-actions">
                        <a 
                            href="https://media.githubusercontent.com/media/adxprogram/Eydi_Portfolio_Website/main/images/Adrian_Santiago_Resume.pdf" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="dossier-btn"
                        >
                            <span>[ DOWNLOAD RESUME (PDF) &darr; ]</span>
                        </a>
                    </div>
                </article>
            </div>

            <!-- Right Column: Brutalist Inquiry Dispatch Form -->
            <div class="contact-right-col">
                <article class="contact-form-card">
                    <div class="contact-form-card-header">
                        <h2 class="form-header-title">SEND A MESSAGE</h2>
                    </div>

                    <form id="contactForm" action="https://formspree.io/f/mrerpjoo" method="POST" class="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName" class="form-label">FIRST NAME [REQ]</label>
                                <input type="text" id="firstName" name="first-name" class="form-input" placeholder="e.g. Marc" required>
                            </div>

                            <div class="form-group">
                                <label for="lastName" class="form-label">LAST NAME [REQ]</label>
                                <input type="text" id="lastName" name="last-name" class="form-input" placeholder="e.g. Miller" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactEmail" class="form-label">EMAIL ADDRESS [REQ]</label>
                            <input type="email" id="contactEmail" name="email" class="form-input" placeholder="name@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="projectScope" class="form-label">SUBJECT</label>
                            <input type="text" id="projectScope" name="subject" class="form-input" placeholder="Web Development / Video Editing / Project inquiry">
                        </div>

                        <div class="form-group">
                            <label for="messageBody" class="form-label">MESSAGE [REQ]</label>
                            <textarea id="messageBody" name="message" class="form-textarea" placeholder="Tell me about your project or inquiry..." required></textarea>
                        </div>

                        <button type="submit" id="contactSubmitBtn" class="submit-btn">
                            [ SEND MESSAGE &rarr; ]
                        </button>

                        <div id="contactFormStatus" class="form-status" role="status" aria-live="polite"></div>
                    </form>
                </article>
            </div>
        </div>

        <div class="page-footer-nav">
            <a href="index.php" class="back-btn">&larr; RETURN TO HERO</a>
            <a href="#siteHeader" class="back-btn" id="backToTopBtn">
                <img src="assets/images/social/up-arrows.png" alt="Up Arrow" style="width: 14px; height: 14px; filter: brightness(0) invert(1);" />
                <span>TOP OF PAGE</span>
            </a>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('contactSubmitBtn');
    const statusBox = document.getElementById('contactFormStatus');

    if (contactForm && submitBtn && statusBox) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            submitBtn.textContent = '[ SENDING... ]';
            submitBtn.style.opacity = '0.7';
            statusBox.textContent = '';
            statusBox.className = 'form-status';

            const formData = new FormData(contactForm);

            try {
                const response = await fetch(contactForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });

                if (response.ok) {
                    submitBtn.textContent = '[ SENT &bull; SUCCESS ]';
                    submitBtn.style.background = '#FFFFFF';
                    submitBtn.style.color = '#000000';
                    submitBtn.style.opacity = '1';
                    statusBox.textContent = '[ Thanks! Your message has been sent. ]';
                    statusBox.classList.add('success');
                    contactForm.reset();
                } else {
                    submitBtn.textContent = '[ FAILED TO SEND ]';
                    submitBtn.style.opacity = '1';
                    statusBox.textContent = '[ Oops! There was a problem sending your message. ]';
                    statusBox.classList.add('error');
                }
            } catch (err) {
                submitBtn.textContent = '[ TRY AGAIN ]';
                submitBtn.style.opacity = '1';
                statusBox.textContent = '[ Error: Could not connect to the server. ]';
                statusBox.classList.add('error');
            }
        });
    }
});
</script>

<?php require_once 'includes/footer.php'; ?>
