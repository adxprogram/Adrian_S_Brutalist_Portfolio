/**
 * Brutalist Portfolio - Core Interaction & Kinetic Morph Controller
 * Adrian Santiago Portfolio // 2026 Archive
 * 
 * Features:
 * 1. Contextual Cursor Vertex Morph Engine (8-node continuous lerp)
 * 2. 5-Layer Interactive Eye-Tracking Engine with Viewport Optimization
 * 3. Brutalist Split Accordion Project Showcase
 * 4. Single-Page Smooth Scroll Controller & Scrollspy
 * 5. Architectural Kinetic Morph Monolith & Synchronized Floating HUD
 * 6. Brutalist Character Scramble-Morph Engine
 * 7. Formspree Contact Dispatch Pipeline
 * 8. Comprehensive Testing & DevTools APIs
 */

(function () {
    'use strict';

    /* ========================================================================
       1. GLOBAL STATE & CAPABILITIES
       ======================================================================== */
    const IMAGE_ASSETS = [
        { index: 0, src: 'assets/images/Man_base_looking_straight_0.png', name: 'DIRECT [0]' },
        { index: 1, src: 'assets/images/Man_looking_upward_and_left_1.png', name: 'UPPER-LEFT [1]' },
        { index: 2, src: 'assets/images/Man_looking_to_left_2.png', name: 'MID-LEFT [2]' },
        { index: 3, src: 'assets/images/Man_looking_down_left_3.png', name: 'LOWER-LEFT [3]' },
        { index: 4, src: 'assets/images/Man_looking_downward_left_4.png', name: 'BOTTOM-LEFT [4]' },
        { index: 5, src: 'assets/images/top.gif', name: 'TOP-EASTER-EGG [5]' }
    ];

    let isTouchDevice = false;
    let prefersReducedMotion = false;

    function checkDeviceCapabilities() {
        const isCoarse = window.matchMedia && window.matchMedia('(hover: none) and (pointer: coarse)').matches;
        const hasTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);
        isTouchDevice = isCoarse && hasTouch;

        prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    }

    /* ========================================================================
       2. CONTEXTUAL CURSOR VERTEX MORPH ENGINE
       ======================================================================== */
    function initCustomCursor() {
        const customCursor = document.getElementById('customCursor');
        const cursorTriangleWrap = document.getElementById('cursorTriangleWrap');
        const cursorMorphPoly = document.getElementById('cursorMorphPoly');

        if (!customCursor || !cursorTriangleWrap || !cursorMorphPoly || isTouchDevice) {
            if (customCursor) customCursor.style.display = 'none';
            return;
        }

        let mouseX = -100;
        let mouseY = -100;
        let triangleX = -100;
        let triangleY = -100;
        let isCursorVisible = false;
        let isMouseDown = false;

        // 8-Node Canonical Geometry Presets
        const CURSOR_SHAPES = {
            // Mode 0: Default Upward Triangle
            TRIANGLE: [
                { x: 0, y: -26 }, { x: 6, y: -13 }, { x: 12, y: 0 }, { x: 24, y: 15 },
                { x: 0, y: 15 }, { x: -24, y: 15 }, { x: -12, y: 0 }, { x: -6, y: -13 }
            ],
            // Mode 1: Precision Viewfinder Box (over projects/media)
            VIEWFINDER: [
                { x: -18, y: -18 }, { x: 0, y: -18 }, { x: 18, y: -18 }, { x: 18, y: 0 },
                { x: 18, y: 18 }, { x: 0, y: 18 }, { x: -18, y: 18 }, { x: -18, y: 0 }
            ],
            // Mode 2: Inverted Faceted Diamond (over interactive links & buttons)
            DIAMOND: [
                { x: 0, y: -24 }, { x: 12, y: -12 }, { x: 24, y: 0 }, { x: 12, y: 12 },
                { x: 0, y: 24 }, { x: -12, y: 12 }, { x: -24, y: 0 }, { x: -12, y: -12 }
            ],
            // Mode 3: Vertical Brutalist Chisel / Beam (over typography)
            CHISEL: [
                { x: -3, y: -26 }, { x: 0, y: -28 }, { x: 3, y: -26 }, { x: 3, y: 26 },
                { x: 0, y: 28 }, { x: -3, y: 26 }, { x: -3, y: 0 }, { x: -3, y: -14 }
            ],
            // Mode 4: Dense Cross Reticle (on mousedown click)
            RETICLE: [
                { x: 0, y: -14 }, { x: 4, y: -4 }, { x: 14, y: 0 }, { x: 4, y: 4 },
                { x: 0, y: 14 }, { x: -4, y: 4 }, { x: -14, y: 0 }, { x: -4, y: -4 }
            ]
        };

        // Live point coordinates
        let currentPoints = CURSOR_SHAPES.TRIANGLE.map(p => ({ x: p.x, y: p.y }));
        let targetPoints = CURSOR_SHAPES.TRIANGLE;

        function setCursorTargetShape(shapeName) {
            if (isMouseDown) {
                targetPoints = CURSOR_SHAPES.RETICLE;
                return;
            }
            targetPoints = CURSOR_SHAPES[shapeName] || CURSOR_SHAPES.TRIANGLE;
        }

        // Mouse coordinates
        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            if (!isCursorVisible) {
                triangleX = mouseX;
                triangleY = mouseY;
                customCursor.classList.add('is-visible');
                customCursor.classList.remove('is-hidden');
                isCursorVisible = true;
            }
        }, { passive: true });

        // Contextual Element Inspector
        document.addEventListener('mouseover', (e) => {
            const target = e.target;
            if (!target || !target.closest) return;

            if (target.closest('.project-display-card, .accordion-slice, .archive-card, .video-frame, .profile-image-wrap, .cert-image-frame, .dossier-preview-frame, .morph-canvas, .hud-canvas-wrap')) {
                setCursorTargetShape('VIEWFINDER');
                customCursor.classList.add('is-hovering');
            } else if (target.closest('a, button, .nav-link, .back-btn, .projects-cta-pill, .submit-btn, [role="button"], .morph-pill-item')) {
                setCursorTargetShape('DIAMOND');
                customCursor.classList.add('is-hovering');
            } else if (target.closest('h1, h2, h3, h4, .hero-name, .hero-description, .profile-headline, blockquote, input, textarea')) {
                setCursorTargetShape('CHISEL');
                customCursor.classList.remove('is-hovering');
            } else {
                setCursorTargetShape('TRIANGLE');
                customCursor.classList.remove('is-hovering');
            }
        }, { passive: true });

        // Mousedown tactile morph
        window.addEventListener('mousedown', () => {
            isMouseDown = true;
            targetPoints = CURSOR_SHAPES.RETICLE;
            customCursor.classList.add('is-active');
        }, { passive: true });

        window.addEventListener('mouseup', () => {
            isMouseDown = false;
            customCursor.classList.remove('is-active');
            // Re-trigger hover evaluation
            const hovered = document.elementFromPoint(mouseX, mouseY);
            if (hovered && hovered.closest) {
                if (hovered.closest('.project-display-card, .accordion-slice, .archive-card, .video-frame')) {
                    setCursorTargetShape('VIEWFINDER');
                } else if (hovered.closest('a, button, .nav-link, .back-btn, .projects-cta-pill')) {
                    setCursorTargetShape('DIAMOND');
                } else {
                    setCursorTargetShape('TRIANGLE');
                }
            } else {
                setCursorTargetShape('TRIANGLE');
            }
        }, { passive: true });

        // Window leave / enter
        document.addEventListener('mouseleave', () => customCursor.classList.add('is-hidden'));
        document.addEventListener('mouseenter', () => customCursor.classList.remove('is-hidden'));

        // Frame rendering loop
        const posLerp = prefersReducedMotion ? 1.0 : 0.22;
        const morphLerp = prefersReducedMotion ? 1.0 : 0.26;

        function renderCursor() {
            if (isCursorVisible) {
                triangleX += (mouseX - triangleX) * posLerp;
                triangleY += (mouseY - triangleY) * posLerp;
                cursorTriangleWrap.style.transform = `translate3d(${triangleX.toFixed(2)}px, ${triangleY.toFixed(2)}px, 0) translate(-50%, -50%)`;

                // Morph 8 vertices smoothly
                let pointsStr = '';
                for (let i = 0; i < 8; i++) {
                    currentPoints[i].x += (targetPoints[i].x - currentPoints[i].x) * morphLerp;
                    currentPoints[i].y += (targetPoints[i].y - currentPoints[i].y) * morphLerp;
                    pointsStr += `${currentPoints[i].x.toFixed(2)},${currentPoints[i].y.toFixed(2)} `;
                }
                cursorMorphPoly.setAttribute('points', pointsStr.trim());
            }

            requestAnimationFrame(renderCursor);
        }

        requestAnimationFrame(renderCursor);

        // Public testing API
        window.AdrianCursor = {
            setShape: function (shapeName) {
                if (CURSOR_SHAPES[shapeName]) {
                    targetPoints = CURSOR_SHAPES[shapeName];
                }
            },
            getState: function () {
                return { mouseX, mouseY, triangleX, triangleY, targetPoints };
            }
        };
    }

    /* ========================================================================
       3. INTERACTIVE 5-LAYER EYE-TRACKING ENGINE
       ======================================================================== */
    let currentGaze = 0;
    let targetGaze = 0;
    let transitionTimer = null;
    let isTrackingEnabled = true;

    let heroWrapper = null;
    let portraitStage = null;
    let portraitTopGif = null;
    let layers = [];

    function primeImageCache() {
        IMAGE_ASSETS.forEach(asset => {
            const img = new Image();
            img.src = asset.src;
        });
    }

    function transitionToPortraitLayer(layerIndex, isInstant) {
        const prevLayerIndex = (currentGaze === 5) ? 1 : currentGaze;
        const prevLayer = layers[prevLayerIndex];
        const nextLayer = layers[layerIndex];

        if (!nextLayer) return;

        if (transitionTimer) {
            clearTimeout(transitionTimer);
            transitionTimer = null;
        }

        if (isInstant) {
            layers.forEach((layer, idx) => {
                if (idx === layerIndex) {
                    layer.classList.add('is-active');
                    layer.classList.remove('is-previous');
                    layer.style.opacity = '1';
                    layer.style.visibility = 'visible';
                    layer.style.zIndex = '3';
                } else {
                    layer.classList.remove('is-active', 'is-previous');
                    layer.style.opacity = '0';
                    layer.style.visibility = 'hidden';
                    layer.style.zIndex = '1';
                }
            });
            return;
        }

        if (prevLayer && prevLayerIndex !== layerIndex) {
            prevLayer.classList.remove('is-active');
            prevLayer.classList.add('is-previous');
            prevLayer.style.zIndex = '2';
            prevLayer.style.opacity = '1';
            prevLayer.style.visibility = 'visible';
        }

        layers.forEach((layer, idx) => {
            if (idx !== prevLayerIndex && idx !== layerIndex) {
                layer.classList.remove('is-active', 'is-previous');
                layer.style.zIndex = '1';
                layer.style.opacity = '0';
                layer.style.visibility = 'hidden';
            }
        });

        nextLayer.classList.remove('is-previous');
        nextLayer.classList.add('is-active');
        nextLayer.style.zIndex = '3';
        nextLayer.style.visibility = 'visible';

        requestAnimationFrame(() => {
            nextLayer.style.opacity = '1';
        });

        transitionTimer = setTimeout(() => {
            if (prevLayer && prevLayerIndex !== layerIndex) {
                prevLayer.classList.remove('is-previous');
                prevLayer.style.opacity = '0';
                prevLayer.style.visibility = 'hidden';
                prevLayer.style.zIndex = '1';
            }
            if (nextLayer) {
                nextLayer.style.zIndex = '2';
            }
            transitionTimer = null;
        }, 290);
    }

    function transitionToGaze(newIndex, isInstant) {
        if (newIndex === currentGaze && !isInstant) return;

        if (newIndex === 5) {
            if (portraitTopGif) portraitTopGif.classList.add('is-active');
            if (transitionTimer) {
                clearTimeout(transitionTimer);
                transitionTimer = null;
            }
            layers.forEach(layer => {
                layer.classList.remove('is-active', 'is-previous');
                layer.style.opacity = '0';
                layer.style.visibility = 'hidden';
                layer.style.zIndex = '1';
            });
            currentGaze = 5;
            return;
        }

        if (portraitTopGif) {
            portraitTopGif.classList.remove('is-active');
        }

        transitionToPortraitLayer(newIndex, isInstant);
        currentGaze = newIndex;
    }

    function calculateGazeState(clientX, clientY) {
        const width = window.innerWidth;
        const height = window.innerHeight;
        const normY = Math.max(0, Math.min(1, clientY / height));

        const topThreshold = Math.max(85, height * 0.16);
        if (clientY < topThreshold || normY < 0.16) {
            return 5;
        }

        const eyeX = width * 0.865;
        const eyeY = height * 0.39;

        const dx = clientX - eyeX;
        const dy = clientY - eyeY;

        const isCurrentlyDirect = (targetGaze === 0);
        const directRadiusX = isCurrentlyDirect ? 85 : 65;
        const directRadiusY = isCurrentlyDirect ? 100 : 80;

        if ((Math.abs(dx) < directRadiusX && Math.abs(dy) < directRadiusY) || clientX >= (eyeX - (isCurrentlyDirect ? 20 : 35))) {
            return 0;
        }

        const hBuffer = 0.025;

        if (targetGaze === 5) {
            if (normY > (0.16 + hBuffer)) {
                return (normY > 0.32) ? ((normY > 0.54) ? (normY > 0.74 ? 4 : 3) : 2) : 1;
            }
            return 5;
        }

        if (targetGaze === 1) {
            if (normY < (0.16 - hBuffer)) return 5;
            if (normY > (0.32 + hBuffer)) {
                return (normY > 0.54) ? (normY > 0.74 ? 4 : 3) : 2;
            }
            return 1;
        }

        if (targetGaze === 2) {
            if (normY < (0.16 - hBuffer)) return 5;
            if (normY < (0.32 - hBuffer)) return 1;
            if (normY > (0.54 + hBuffer)) return (normY > 0.74 ? 4 : 3);
            return 2;
        }

        if (targetGaze === 3) {
            if (normY < (0.16 - hBuffer)) return 5;
            if (normY < (0.54 - hBuffer)) return (normY < 0.32 ? 1 : 2);
            if (normY > (0.74 + hBuffer)) return 4;
            return 3;
        }

        if (targetGaze === 4) {
            if (normY < (0.16 - hBuffer)) return 5;
            if (normY < (0.74 - hBuffer)) {
                return (normY < 0.32) ? 1 : (normY < 0.54 ? 2 : 3);
            }
            return 4;
        }

        if (normY < 0.16) return 5;
        if (normY < 0.32) return 1;
        if (normY < 0.54) return 2;
        if (normY < 0.74) return 3;
        return 4;
    }

    let eyeRafScheduled = false;

    function handleEyeMouseMove(e) {
        if (!isTrackingEnabled) return;

        // Viewport optimization for one-page layout
        if (heroWrapper) {
            const rect = heroWrapper.getBoundingClientRect();
            if (rect.bottom <= 0 || rect.top >= window.innerHeight) {
                if (currentGaze === 5 && portraitTopGif) {
                    portraitTopGif.classList.remove('is-active');
                    transitionToPortraitLayer(0, true);
                    currentGaze = 0;
                    targetGaze = 0;
                }
                return;
            }
        }

        if (!eyeRafScheduled) {
            eyeRafScheduled = true;
            requestAnimationFrame(() => {
                eyeRafScheduled = false;
                const newTarget = calculateGazeState(e.clientX, e.clientY);
                if (newTarget !== targetGaze) {
                    targetGaze = newTarget;
                    transitionToGaze(targetGaze, false);
                }
            });
        }
    }

    function handleEyeMouseLeave() {
        targetGaze = 0;
        transitionToGaze(0, false);
    }

    function handleTouchMove(e) {
        if (heroWrapper) {
            const rect = heroWrapper.getBoundingClientRect();
            if (rect.bottom <= 0 || rect.top >= window.innerHeight) return;
        }
        if (e.touches && e.touches.length > 0) {
            const touch = e.touches[0];
            const newTarget = calculateGazeState(touch.clientX, touch.clientY);
            if (newTarget !== targetGaze) {
                targetGaze = newTarget;
                transitionToGaze(targetGaze, false);
            }
        }
    }

    function handleTouchEnd() {
        targetGaze = 0;
        transitionToGaze(0, false);
    }

    function initEyeTracker() {
        heroWrapper = document.getElementById('home') || document.getElementById('heroWrapper');
        portraitStage = document.getElementById('portraitStage');
        portraitTopGif = document.getElementById('portraitTopGif');

        if (!portraitStage) return;

        layers = Array.from(portraitStage.querySelectorAll('.portrait-layer'));
        primeImageCache();

        layers.forEach((layer, idx) => {
            if (idx === 0) {
                layer.classList.add('is-active', 'is-base');
                layer.style.opacity = '1';
                layer.style.visibility = 'visible';
                layer.style.zIndex = '2';
            } else {
                layer.classList.remove('is-active', 'is-previous');
                layer.style.opacity = '0';
                layer.style.visibility = 'hidden';
                layer.style.zIndex = '1';
            }
        });

        if (isTrackingEnabled) {
            window.addEventListener('mousemove', handleEyeMouseMove, { passive: true });
            document.addEventListener('mouseleave', handleEyeMouseLeave, { passive: true });
            window.addEventListener('touchmove', handleTouchMove, { passive: true });
            window.addEventListener('touchend', handleTouchEnd, { passive: true });
            window.addEventListener('touchcancel', handleTouchEnd, { passive: true });
        }

        window.AdrianEyeTracker = {
            setGaze: function (idx, instant) {
                targetGaze = idx;
                transitionToGaze(idx, instant || false);
            },
            simulateCursor: function (clientX, clientY) {
                const newTarget = calculateGazeState(clientX, clientY);
                if (newTarget !== targetGaze) {
                    targetGaze = newTarget;
                    transitionToGaze(targetGaze, false);
                }
            },
            getState: function () {
                return {
                    currentGaze,
                    targetGaze,
                    isTopGifActive: portraitTopGif ? portraitTopGif.classList.contains('is-active') : false,
                    layerName: IMAGE_ASSETS[currentGaze] ? IMAGE_ASSETS[currentGaze].name : 'UNKNOWN'
                };
            }
        };
    }

    /* ========================================================================
       4. BRUTALIST PROJECTS SPLIT ACCORDION SHOWCASE
       ======================================================================== */
    function initProjectAccordion() {
        const stage = document.getElementById('projectsStage');
        const displayCard = document.getElementById('projectDisplayCard');
        const displayContent = document.getElementById('displayCardContent');
        const displayIndex = document.getElementById('displayCardIndex');
        const displayTag = document.getElementById('displayCardTag');
        const displayTitle = document.getElementById('displayCardTitle');
        const displayDesc = document.getElementById('displayCardDesc');
        const slices = Array.from(document.querySelectorAll('.accordion-slice'));

        if (!displayCard || slices.length === 0) return;

        let currentIndex = 0;
        let fadeTimeout = null;

        function activateProject(index, instant) {
            if (index === currentIndex && !instant) return;
            currentIndex = index;

            slices.forEach((slice, idx) => {
                if (idx === index) {
                    slice.classList.add('is-expanded');
                    slice.setAttribute('aria-expanded', 'true');
                } else {
                    slice.classList.remove('is-expanded');
                    slice.setAttribute('aria-expanded', 'false');
                }
            });

            const activeSlice = slices[index];
            if (!activeSlice) return;

            const title = activeSlice.dataset.title || '';
            const tag = activeSlice.dataset.tag || '';
            const desc = activeSlice.dataset.desc || '';
            const link = activeSlice.dataset.link || '#';
            const num = activeSlice.dataset.num || String(index + 1).padStart(2, '0');

            displayCard.href = link;
            displayCard.setAttribute('aria-label', `View case study for ${title}`);

            if (fadeTimeout) {
                clearTimeout(fadeTimeout);
                fadeTimeout = null;
            }

            if (displayContent) {
                if (instant || prefersReducedMotion) {
                    if (displayIndex) displayIndex.textContent = `// ${num}`;
                    if (displayTag) displayTag.textContent = tag;
                    if (displayTitle) displayTitle.textContent = title;
                    if (displayDesc) displayDesc.textContent = desc;
                    displayContent.style.opacity = '1';
                    displayContent.style.transform = 'translateY(0)';
                } else {
                    displayContent.style.transition = 'opacity 90ms ease, transform 90ms ease';
                    displayContent.style.opacity = '0';
                    displayContent.style.transform = 'translateY(4px)';

                    fadeTimeout = setTimeout(() => {
                        if (displayIndex) displayIndex.textContent = `// ${num}`;
                        if (displayTag) displayTag.textContent = tag;
                        if (displayTitle) displayTitle.textContent = title;
                        if (displayDesc) displayDesc.textContent = desc;

                        displayContent.style.opacity = '1';
                        displayContent.style.transform = 'translateY(0)';
                        fadeTimeout = null;
                    }, 90);
                }
            }
        }

        slices.forEach((slice, index) => {
            slice.addEventListener('mouseenter', () => activateProject(index, false));
            slice.addEventListener('focus', () => activateProject(index, false));
            slice.addEventListener('touchstart', () => activateProject(index, false), { passive: true });
        });

        if (stage) {
            stage.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                    const nextIdx = (currentIndex + 1) % slices.length;
                    activateProject(nextIdx, false);
                    slices[nextIdx].focus();
                    e.preventDefault();
                } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                    const prevIdx = (currentIndex - 1 + slices.length) % slices.length;
                    activateProject(prevIdx, false);
                    slices[prevIdx].focus();
                    e.preventDefault();
                }
            });
        }

        window.AdrianProjectsAccordion = {
            setActive: function (idx, instant) {
                if (idx >= 0 && idx < slices.length) activateProject(idx, !!instant);
            },
            getActiveIndex: function () { return currentIndex; },
            getProjectData: function (idx) {
                const s = slices[idx !== undefined ? idx : currentIndex];
                if (!s) return null;
                return {
                    index: parseInt(s.dataset.index, 10),
                    num: s.dataset.num,
                    title: s.dataset.title,
                    tag: s.dataset.tag,
                    desc: s.dataset.desc,
                    link: s.dataset.link
                };
            }
        };
    }

    /* ========================================================================
       5. ARCHITECTURAL KINETIC MORPH MONOLITH & HUD CONTROLLER
       ======================================================================== */
    function initKineticMorphEngine() {
        const morphWidgetStage = document.getElementById('morphWidgetStage');
        const morphBasePoly = document.getElementById('morphBasePoly');
        const morphFacetA = document.getElementById('morphFacetA');
        const morphFacetB = document.getElementById('morphFacetB');
        const morphFacetC = document.getElementById('morphFacetC');
        const morphModeBadge = document.getElementById('morphModeBadge');
        const morphTopologyVal = document.getElementById('morphTopologyVal');
        const morphVerticesVal = document.getElementById('morphVerticesVal');
        const morphScrollSyncVal = document.getElementById('morphScrollSyncVal');
        const morphCycleBtn = document.getElementById('morphCycleBtn');
        const morphPills = Array.from(document.querySelectorAll('.morph-pill-item'));

        // Floating HUD elements
        const hudCanvasWrap = document.getElementById('hudCanvasWrap');
        const hudPolyBase = document.getElementById('hudPolyBase');
        const hudFacetA = document.getElementById('hudFacetA');
        const hudFacetB = document.getElementById('hudFacetB');
        const hudShapeName = document.getElementById('hudShapeName');
        const hudSectionName = document.getElementById('hudSectionName');
        const hudCycleBtn = document.getElementById('hudCycleBtn');

        if (!morphBasePoly) return;

        // 5 Architectural States: Shared 8-Node Topology
        const FORMS = [
            {
                id: 0,
                name: '01 // TETRAHEDRON',
                short: '01: TETRA',
                topology: 'EUCLIDEAN PRISM',
                nodesDesc: '8 VERTICES • 3 FACETS',
                zone: 'HOME [01/05]',
                base: [
                    { x: 0, y: -48 }, { x: 22, y: -12 }, { x: 42, y: 24 }, { x: 21, y: 21 },
                    { x: 0, y: 18 }, { x: -21, y: 21 }, { x: -42, y: 24 }, { x: -21, y: -12 }
                ],
                facetA: [{ x: 0, y: -48 }, { x: 42, y: 24 }, { x: 0, y: 18 }, { x: 0, y: -15 }],
                facetB: [{ x: 0, y: -48 }, { x: -42, y: 24 }, { x: 0, y: 18 }, { x: 0, y: -15 }],
                facetC: [{ x: -42, y: 24 }, { x: 0, y: 18 }, { x: 42, y: 24 }, { x: 0, y: 26 }]
            },
            {
                id: 1,
                name: '02 // APERTURE',
                short: '02: APERTURE',
                topology: 'CHAMFERED VIEWPORT',
                nodesDesc: '8 VERTICES • 3 SHUTTERS',
                zone: 'PROJECTS [02/05]',
                base: [
                    { x: -36, y: -36 }, { x: 0, y: -46 }, { x: 36, y: -36 }, { x: 46, y: 0 },
                    { x: 36, y: 36 }, { x: 0, y: 46 }, { x: -36, y: 36 }, { x: -46, y: 0 }
                ],
                facetA: [{ x: -36, y: -36 }, { x: 36, y: -36 }, { x: 0, y: 0 }, { x: -18, y: -18 }],
                facetB: [{ x: 36, y: 36 }, { x: -36, y: 36 }, { x: 0, y: 0 }, { x: 18, y: 18 }],
                facetC: [{ x: -46, y: 0 }, { x: 0, y: 0 }, { x: 46, y: 0 }, { x: 0, y: 0 }]
            },
            {
                id: 2,
                name: '03 // OBELISK',
                short: '03: OBELISK',
                topology: 'BRUTALIST STELE',
                nodesDesc: '8 VERTICES • FACETED SPINE',
                zone: 'EXPERIENCE [03/05]',
                base: [
                    { x: 0, y: -50 }, { x: 26, y: -34 }, { x: 26, y: 38 }, { x: 13, y: 44 },
                    { x: 0, y: 48 }, { x: -13, y: 44 }, { x: -26, y: 38 }, { x: -26, y: -34 }
                ],
                facetA: [{ x: 0, y: -50 }, { x: 26, y: -34 }, { x: 26, y: 38 }, { x: 0, y: 48 }],
                facetB: [{ x: 0, y: -50 }, { x: -26, y: -34 }, { x: -26, y: 38 }, { x: 0, y: 48 }],
                facetC: [{ x: 0, y: -50 }, { x: 13, y: -10 }, { x: 0, y: 48 }, { x: -13, y: -10 }]
            },
            {
                id: 3,
                name: '04 // MATRIX CUBE',
                short: '04: MATRIX',
                topology: 'ISOMETRIC LATTICE',
                nodesDesc: '8 VERTICES • 3 PLANES',
                zone: 'TOOLS [04/05]',
                base: [
                    { x: 0, y: -46 }, { x: 20, y: -34 }, { x: 40, y: -23 }, { x: 40, y: 23 },
                    { x: 0, y: 46 }, { x: -20, y: 34 }, { x: -40, y: 23 }, { x: -40, y: -23 }
                ],
                facetA: [{ x: 0, y: -46 }, { x: 40, y: -23 }, { x: 0, y: 0 }, { x: -40, y: -23 }],
                facetB: [{ x: -40, y: -23 }, { x: 0, y: 0 }, { x: 0, y: 46 }, { x: -40, y: 23 }],
                facetC: [{ x: 0, y: 0 }, { x: 40, y: -23 }, { x: 40, y: 23 }, { x: 0, y: 46 }]
            },
            {
                id: 4,
                name: '05 // RADAR RHOMBUS',
                short: '05: RADAR',
                topology: 'SIGNAL DIAMOND',
                nodesDesc: '8 VERTICES • 4 QUADRANTS',
                zone: 'CONTACT [05/05]',
                base: [
                    { x: 0, y: -48 }, { x: 24, y: -24 }, { x: 48, y: 0 }, { x: 24, y: 24 },
                    { x: 0, y: 48 }, { x: -24, y: 24 }, { x: -48, y: 0 }, { x: -24, y: -24 }
                ],
                facetA: [{ x: 0, y: -48 }, { x: 48, y: 0 }, { x: 0, y: 0 }, { x: -24, y: -24 }],
                facetB: [{ x: 0, y: 48 }, { x: -48, y: 0 }, { x: 0, y: 0 }, { x: 24, y: 24 }],
                facetC: [{ x: -48, y: 0 }, { x: 0, y: -48 }, { x: 48, y: 0 }, { x: 0, y: 48 }]
            }
        ];

        let currentShapeIdx = 0;
        let targetShapeIdx = 0;

        // Deep copy starting points
        let liveBase = FORMS[0].base.map(p => ({ x: p.x, y: p.y }));
        let liveFacetA = FORMS[0].facetA.map(p => ({ x: p.x, y: p.y }));
        let liveFacetB = FORMS[0].facetB.map(p => ({ x: p.x, y: p.y }));
        let liveFacetC = FORMS[0].facetC.map(p => ({ x: p.x, y: p.y }));

        function setShape(idx, triggerScroll) {
            targetShapeIdx = Math.max(0, Math.min(FORMS.length - 1, idx));
            const targetForm = FORMS[targetShapeIdx];

            if (morphModeBadge) morphModeBadge.textContent = targetForm.name;
            if (morphTopologyVal) morphTopologyVal.textContent = targetForm.topology;
            if (morphVerticesVal) morphVerticesVal.textContent = targetForm.nodesDesc;
            if (morphScrollSyncVal) morphScrollSyncVal.textContent = targetForm.zone;

            if (hudShapeName) hudShapeName.textContent = targetForm.short;
            if (hudSectionName) hudSectionName.textContent = `ZONE: ${['HOME', 'PROJECTS', 'EXPERIENCE', 'TOOLS', 'CONTACT'][targetShapeIdx]}`;

            morphPills.forEach(p => {
                const pIdx = parseInt(p.dataset.shape, 10);
                if (pIdx === targetShapeIdx) p.classList.add('is-active');
                else p.classList.remove('is-active');
            });

            if (triggerScroll) {
                const sectionIds = ['home', 'projects', 'experience', 'tools', 'contact'];
                const targetSec = document.getElementById(sectionIds[targetShapeIdx]);
                if (targetSec) {
                    targetSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        }

        // Cycle through shapes
        function cycleShape(triggerScroll) {
            const nextIdx = (targetShapeIdx + 1) % FORMS.length;
            setShape(nextIdx, triggerScroll);
        }

        if (morphCycleBtn) morphCycleBtn.addEventListener('click', () => cycleShape(false));
        if (morphWidgetStage) morphWidgetStage.addEventListener('click', () => cycleShape(false));
        if (hudCycleBtn) hudCycleBtn.addEventListener('click', () => cycleShape(true));
        if (hudCanvasWrap) hudCanvasWrap.addEventListener('click', () => cycleShape(true));

        morphPills.forEach(pill => {
            pill.addEventListener('click', () => {
                const sIdx = parseInt(pill.dataset.shape, 10);
                setShape(sIdx, false);
            });
        });

        // 3D Parallax Tilt on Hover over widget
        if (morphWidgetStage) {
            morphWidgetStage.addEventListener('mousemove', (e) => {
                const rect = morphWidgetStage.getBoundingClientRect();
                const normX = ((e.clientX - rect.left) / rect.width) - 0.5;
                const normY = ((e.clientY - rect.top) / rect.height) - 0.5;
                const canvas = document.getElementById('morphCanvas');
                if (canvas) {
                    canvas.style.transform = `perspective(500px) rotateX(${(-normY * 24).toFixed(1)}deg) rotateY(${(normX * 24).toFixed(1)}deg)`;
                }
            });

            morphWidgetStage.addEventListener('mouseleave', () => {
                const canvas = document.getElementById('morphCanvas');
                if (canvas) canvas.style.transform = 'perspective(500px) rotateX(0deg) rotateY(0deg)';
            });
        }

        // Render Loop for continuous vertex morphing
        const morphSpeed = prefersReducedMotion ? 1.0 : 0.18;

        function ptsToString(arr) {
            return arr.map(p => `${p.x.toFixed(2)},${p.y.toFixed(2)}`).join(' ');
        }

        function renderMorphFrame() {
            const dest = FORMS[targetShapeIdx];

            // Interpolate base
            for (let i = 0; i < liveBase.length; i++) {
                liveBase[i].x += (dest.base[i].x - liveBase[i].x) * morphSpeed;
                liveBase[i].y += (dest.base[i].y - liveBase[i].y) * morphSpeed;
            }

            // Interpolate facets
            for (let i = 0; i < liveFacetA.length; i++) {
                liveFacetA[i].x += (dest.facetA[i].x - liveFacetA[i].x) * morphSpeed;
                liveFacetA[i].y += (dest.facetA[i].y - liveFacetA[i].y) * morphSpeed;
            }
            for (let i = 0; i < liveFacetB.length; i++) {
                liveFacetB[i].x += (dest.facetB[i].x - liveFacetB[i].x) * morphSpeed;
                liveFacetB[i].y += (dest.facetB[i].y - liveFacetB[i].y) * morphSpeed;
            }
            for (let i = 0; i < liveFacetC.length; i++) {
                liveFacetC[i].x += (dest.facetC[i].x - liveFacetC[i].x) * morphSpeed;
                liveFacetC[i].y += (dest.facetC[i].y - liveFacetC[i].y) * morphSpeed;
            }

            const baseStr = ptsToString(liveBase);
            const aStr = ptsToString(liveFacetA);
            const bStr = ptsToString(liveFacetB);
            const cStr = ptsToString(liveFacetC);

            // Update Hero Widget
            if (morphBasePoly) morphBasePoly.setAttribute('points', baseStr);
            if (morphFacetA) morphFacetA.setAttribute('points', aStr);
            if (morphFacetB) morphFacetB.setAttribute('points', bStr);
            if (morphFacetC) morphFacetC.setAttribute('points', cStr);

            // Update Floating HUD
            if (hudPolyBase) hudPolyBase.setAttribute('points', baseStr);
            if (hudFacetA) hudFacetA.setAttribute('points', aStr);
            if (hudFacetB) hudFacetB.setAttribute('points', bStr);

            requestAnimationFrame(renderMorphFrame);
        }

        requestAnimationFrame(renderMorphFrame);

        // Synchronize with scroll position
        const sectionIds = ['home', 'projects', 'experience', 'tools', 'contact'];
        const sections = sectionIds.map(id => document.getElementById(id)).filter(Boolean);

        function syncMorphWithScroll() {
            if (sections.length === 0) return;
            const scrollPos = window.scrollY + (window.innerHeight * 0.38);

            let sIdx = 0;
            if ((window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 70)) {
                sIdx = sections.length - 1;
            } else {
                for (let i = 0; i < sections.length; i++) {
                    if (scrollPos >= sections[i].offsetTop) {
                        sIdx = i;
                    }
                }
            }

            if (sIdx !== targetShapeIdx) {
                setShape(sIdx, false);
            }
        }

        window.addEventListener('scroll', () => {
            requestAnimationFrame(syncMorphWithScroll);
        }, { passive: true });

        // Expose API
        window.AdrianKineticMorph = {
            setShape: function (idx) { setShape(idx, false); },
            cycle: function () { cycleShape(false); },
            getState: function () { return FORMS[targetShapeIdx]; }
        };
    }

    /* ========================================================================
       6. ONE-PAGE NAVIGATION & SMOOTH SCROLL CONTROLLER
       ======================================================================== */
    function initSmoothScrollAndNavSpy() {
        const navLinks = Array.from(document.querySelectorAll('.site-nav .nav-link'));
        const sectionIds = ['home', 'projects', 'experience', 'tools', 'contact'];
        const sections = sectionIds.map(id => document.getElementById(id)).filter(Boolean);

        let isManualScrolling = false;
        let manualScrollTimer = null;

        function setActiveNav(targetId) {
            navLinks.forEach(link => {
                const href = link.getAttribute('href') || '';
                const navData = link.dataset.nav;
                if (navData === targetId || href === '#' + targetId || href.endsWith('#' + targetId)) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[href*="#"]');
            if (!link) return;

            const href = link.getAttribute('href');
            if (!href) return;

            if (href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('http')) {
                try {
                    const url = new URL(href, window.location.href);
                    if (url.origin !== window.location.origin || url.pathname !== window.location.pathname) {
                        return;
                    }
                } catch (_) {
                    return;
                }
            }

            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;
            const targetId = href.substring(hashIndex + 1);
            if (!targetId) return;

            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                e.preventDefault();

                isManualScrolling = true;
                clearTimeout(manualScrollTimer);
                setActiveNav(targetId);

                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                if (window.history && window.history.pushState) {
                    window.history.pushState(null, '', '#' + targetId);
                }

                manualScrollTimer = setTimeout(() => {
                    isManualScrolling = false;
                }, 900);
            }
        });

        let scrollSpyScheduled = false;

        function handleScrollSpy() {
            if (isManualScrolling || sections.length === 0) return;

            const scrollPosition = window.scrollY + (window.innerHeight * 0.38);
            let currentId = sections[0].id;

            if ((window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 70)) {
                currentId = sections[sections.length - 1].id;
            } else {
                for (let i = 0; i < sections.length; i++) {
                    const section = sections[i];
                    if (scrollPosition >= section.offsetTop) {
                        currentId = section.id;
                    }
                }
            }

            setActiveNav(currentId);
        }

        window.addEventListener('scroll', () => {
            if (!scrollSpyScheduled) {
                scrollSpyScheduled = true;
                requestAnimationFrame(() => {
                    scrollSpyScheduled = false;
                    handleScrollSpy();
                });
            }
        }, { passive: true });

        if (window.location.hash) {
            const initialId = window.location.hash.substring(1);
            const initialTarget = document.getElementById(initialId);
            if (initialTarget) {
                setTimeout(() => {
                    initialTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    setActiveNav(initialId);
                }, 120);
            }
        } else {
            handleScrollSpy();
        }

        window.AdrianNavigation = {
            scrollTo: function (id) {
                const target = document.getElementById(id);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    setActiveNav(id);
                }
            },
            getActiveNav: function () {
                const active = document.querySelector('.site-nav .nav-link.active');
                return active ? (active.dataset.nav || active.getAttribute('href')) : null;
            }
        };
    }

    /* ========================================================================
       7. BRUTALIST CHARACTER SCRAMBLE-MORPH ENGINE
       ======================================================================== */
    function initTextScrambleMorph() {
        const morphElements = Array.from(document.querySelectorAll('.morph-text'));
        if (morphElements.length === 0 || prefersReducedMotion) return;

        const GLYPHS = '0123456789_/\\[]{}<>=-+*#%&!?ABCDEFGHJKLMNOPQRSTUVWXYZ';

        function scrambleElement(el) {
            if (el.dataset.scrambling === 'true') return;
            el.dataset.scrambling = 'true';

            const originalText = el.dataset.text || el.textContent;
            const length = originalText.length;
            const duration = 380;
            const frameRate = 30;
            const totalFrames = Math.round(duration / frameRate);
            let frame = 0;

            const interval = setInterval(() => {
                frame++;
                const progress = frame / totalFrames;
                let output = '';

                for (let i = 0; i < length; i++) {
                    if (originalText[i] === ' ' || originalText[i] === '&') {
                        output += originalText[i];
                    } else if (i < length * progress) {
                        output += originalText[i];
                    } else {
                        output += GLYPHS[Math.floor(Math.random() * GLYPHS.length)];
                    }
                }

                el.textContent = output;

                if (frame >= totalFrames) {
                    clearInterval(interval);
                    el.textContent = originalText;
                    el.dataset.scrambling = 'false';
                }
            }, frameRate);
        }

        morphElements.forEach(el => {
            el.addEventListener('mouseenter', () => scrambleElement(el));
        });

        // Trigger scramble when headings enter viewport
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        scrambleElement(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            morphElements.forEach(el => observer.observe(el));
        }
    }

    /* ========================================================================
       8. BRUTALIST CONTACT FORM DISPATCH
       ======================================================================== */
    function initContactForm() {
        const contactForm = document.getElementById('contactForm');
        const submitBtn = document.getElementById('contactSubmitBtn');
        const statusBox = document.getElementById('contactFormStatus');

        if (!contactForm || !submitBtn || !statusBox) return;

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
                    submitBtn.textContent = '[ SENT • SUCCESS ]';
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

    /* ========================================================================
       9. INITIALIZATION
       ======================================================================== */
    function init() {
        checkDeviceCapabilities();
        initCustomCursor();
        initEyeTracker();
        initProjectAccordion();
        initKineticMorphEngine();
        initSmoothScrollAndNavSpy();
        initTextScrambleMorph();
        initContactForm();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
