<?php
/**
 * Brutalist Portfolio - Projects Showcase
 * Adrian Santiago Portfolio // 2026 Archive
 */

// 1. Data Source (PHP Array)
require_once __DIR__ . '/data/projects.php';

// Header Include
require_once __DIR__ . '/includes/header.php';
?>

<main class="projects-page-wrapper" id="projectsPageWrapper" role="main">
    <!-- Screen Grain Texture Overlay matching Brutalist System -->
    <div class="projects-grain-overlay" aria-hidden="true"></div>

    <!-- 1. Top Header & Title Bar (Constrained) -->
    <div class="projects-header-container">
        <header class="projects-header">
            <h1 class="projects-title">PROJECTS</h1>
            <a href="contact.php" class="projects-cta-pill" aria-label="Wanna see more? Contact Adrian">
                wanna see more?
            </a>
        </header>
    </div>

    <!-- 2. Split Stage (Fixed Horizon Line - Edge-to-Edge Stage) -->
    <section class="projects-stage" id="projectsStage" aria-label="Selected Projects Showcase">
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

                    <h2 class="display-card-title" id="displayCardTitle"><?= htmlspecialchars($projects[0]['title']) ?></h2>

                    <p class="display-card-desc" id="displayCardDesc">
                        <?= htmlspecialchars($projects[0]['description']) ?>
                    </p>
                </div>

                <div class="display-card-action" aria-hidden="true">
                    <span class="action-bracket">[</span>
                    <span class="action-text">VIEW CASE STUDY</span>
                    <span class="action-arrow">&rarr;</span>
                    <span class="action-bracket">]</span>
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
        </section>

        <!-- 3. Foundational Archive (Reused Previous Projects) -->
    <div class="projects-archive-container">
        <section class="archive-section" aria-label="Foundational Project Archive">
            <div class="archive-header">
                <h2 class="archive-title">PREVIOUS WORKS &amp; SYSTEMS</h2>
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
                                <h3 class="archive-card-title"><?= htmlspecialchars($arch['title']) ?></h3>
                                <p class="archive-card-desc"><?= htmlspecialchars($arch['description']) ?></p>
                            </div>
                            <a 
                                href="<?= htmlspecialchars($arch['link']) ?>" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="archive-link"
                            >
                                [ VIEW DEPLOYMENT / REPO &rarr; ]
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
