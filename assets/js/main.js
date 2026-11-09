/**
 * Brutalist Portfolio - Core Interaction Controller
 * Adrian Santiago Portfolio // 2026 Archive
 * 
 * Features:
 * 1. Two-Part Custom Cursor (Equilateral Triangle + Centered Dot)
 *    - Instantaneous inner dot tracking
 *    - Smooth lerp outer triangle tracking via requestAnimationFrame (buttery lag)
 *    - "Smoke/Collapse" hover transition on interactive elements
 *    - mix-blend-mode: difference with crisp edges (no glow, no blur)
 * 2. Interactive 5-Layer Eye-Tracking Engine
 *    - Full-screen dynamic anchor tracking
 *    - Layered non-destructive crossfading (280ms)
 *    - Anti-flicker hysteresis and direct gaze locking
 * 3. Mobile / Reduced-Motion Accessibility
 * 4. Programmatic Testing API (window.AdrianEyeTracker & window.AdrianCursor)
 */

(function () {
    'use strict';

    /* ========================================================================
       1. ASSET CONFIGURATION & STATE
       ======================================================================== */
    const IMAGE_ASSETS = [
        { index: 0, src: 'assets/images/Man_base_looking_straight_0.png', name: 'DIRECT [0]' },
        { index: 1, src: 'assets/images/Man_looking_upward_and_left_1.png', name: 'UPPER-LEFT [1]' },
        { index: 2, src: 'assets/images/Man_looking_to_left_2.png', name: 'MID-LEFT [2]' },
        { index: 3, src: 'assets/images/Man_looking_down_left_3.png', name: 'LOWER-LEFT [3]' },
        { index: 4, src: 'assets/images/Man_looking_downward_left_4.png', name: 'BOTTOM-LEFT [4]' },
        { index: 5, src: 'assets/images/top.gif', name: 'TOP-EASTER-EGG [5]' }
    ];

    let currentGaze = 0;
    let targetGaze = 0;
    let transitionTimer = null;
    let isTrackingEnabled = true;
    let isTouchDevice = false;
    let prefersReducedMotion = false;

    // DOM References: Eye Tracker
    let heroWrapper = null;
    let portraitStage = null;
    let portraitTopGif = null;
    let layers = [];

    // DOM References: Custom Cursor
    let customCursor = null;
    let cursorDot = null;
    let cursorTriangleWrap = null;
    let cursorTriangle = null;

    // Cursor Coordinates & Lerp State
    let mouseX = -100;
    let mouseY = -100;
    let triangleX = -100;
    let triangleY = -100;
    let isCursorVisible = false;
    let isCursorHovering = false;

    /* ========================================================================
       2. DEVICE CAPABILITY & ACCESSIBILITY
       ======================================================================== */
    function checkDeviceCapabilities() {
        const isCoarse = window.matchMedia && window.matchMedia('(hover: none) and (pointer: coarse)').matches;
        const hasTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);
        isTouchDevice = isCoarse && hasTouch;

        prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) {
            isTrackingEnabled = false;
        }
    }

    /* ========================================================================
       3. CUSTOM BRUTALIST CURSOR ENGINE (SOLID INVERTED TRIANGLE)
       ======================================================================== */
    function initCustomCursor() {
        customCursor = document.getElementById('customCursor');
        cursorDot = document.getElementById('cursorDot');
        cursorTriangleWrap = document.getElementById('cursorTriangleWrap');
        cursorTriangle = document.getElementById('cursorTriangle');

        // Do not initialize custom cursor on touch devices
        if (!customCursor || !cursorTriangleWrap || isTouchDevice) {
            if (customCursor) customCursor.style.display = 'none';
            return;
        }

        // Check if an element is clickable/interactive
        function isInteractive(el) {
            if (!el || !el.closest) return false;
            return el.closest('a, button, [role="button"], input, textarea, select, label, .nav-link, .back-btn, [data-interactive], .btn, [tabindex]:not([tabindex="-1"])');
        }

        // Global mousemove for cursor
        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            // On first movement into screen, snap position to avoid fly-in artifact
            if (!isCursorVisible) {
                triangleX = mouseX;
                triangleY = mouseY;
                customCursor.classList.add('is-visible');
                customCursor.classList.remove('is-hidden');
                isCursorVisible = true;
            }

            if (cursorDot) {
                cursorDot.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0) translate(-50%, -50%)`;
            }
        }, { passive: true });

        // Smooth Lerp loop for solid outer triangle
        const lerpFactor = prefersReducedMotion ? 1.0 : 0.22;

        function renderCursorFrame() {
            if (isCursorVisible) {
                // Triangle fluidly glides with buttery lag following cursor
                triangleX += (mouseX - triangleX) * lerpFactor;
                triangleY += (mouseY - triangleY) * lerpFactor;

                cursorTriangleWrap.style.transform = `translate3d(${triangleX.toFixed(2)}px, ${triangleY.toFixed(2)}px, 0) translate(-50%, -50%)`;
            }

            requestAnimationFrame(renderCursorFrame);
        }

        requestAnimationFrame(renderCursorFrame);

        // Hover Effect: Triangle collapses down into compact state over clickable elements
        document.addEventListener('mouseover', (e) => {
            if (isInteractive(e.target)) {
                isCursorHovering = true;
                customCursor.classList.add('is-hovering');
            }
        }, { passive: true });

        document.addEventListener('mouseout', (e) => {
            if (isInteractive(e.target)) {
                const nextEl = isInteractive(e.relatedTarget);
                if (!nextEl) {
                    isCursorHovering = false;
                    customCursor.classList.remove('is-hovering');
                }
            }
        }, { passive: true });

        // Focus / Blur support for interactive accessibility
        document.addEventListener('focusin', (e) => {
            if (isInteractive(e.target)) {
                isCursorHovering = true;
                customCursor.classList.add('is-hovering');
            }
        });

        document.addEventListener('focusout', (e) => {
            if (isInteractive(e.target)) {
                isCursorHovering = false;
                customCursor.classList.remove('is-hovering');
            }
        });

        // Mousedown / Mouseup tactile click feedback
        window.addEventListener('mousedown', () => {
            customCursor.classList.add('is-active');
        }, { passive: true });

        window.addEventListener('mouseup', () => {
            customCursor.classList.remove('is-active');
        }, { passive: true });

        // Window leave / enter
        document.addEventListener('mouseleave', () => {
            customCursor.classList.add('is-hidden');
        });

        document.addEventListener('mouseenter', () => {
            customCursor.classList.remove('is-hidden');
        });

        // Public testing API for cursor
        window.AdrianCursor = {
            setHover: function (hovering) {
                isCursorHovering = !!hovering;
                if (hovering) {
                    customCursor.classList.add('is-hovering');
                } else {
                    customCursor.classList.remove('is-hovering');
                }
            },
            setPosition: function (x, y) {
                mouseX = x;
                mouseY = y;
                triangleX = x;
                triangleY = y;
                isCursorVisible = true;
                if (customCursor) {
                    customCursor.classList.add('is-visible');
                    customCursor.classList.remove('is-hidden');
                }
                if (cursorTriangleWrap) {
                    cursorTriangleWrap.style.transform = `translate3d(${x}px, ${y}px, 0) translate(-50%, -50%)`;
                }
            },
            getState: function () {
                return {
                    isHovering: isCursorHovering,
                    mouseX,
                    mouseY,
                    triangleX,
                    triangleY
                };
            }
        };
    }

    /* ========================================================================
       4. INTERACTIVE EYE-TRACKING ENGINE
       ======================================================================== */
    function primeImageCache() {
        IMAGE_ASSETS.forEach(asset => {
            const img = new Image();
            img.src = asset.src;
        });
    }

    /**
     * Internal: crossfade base portrait layers (0-4)
     */
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

        // Previous layer stays solid underneath
        if (prevLayer && prevLayerIndex !== layerIndex) {
            prevLayer.classList.remove('is-active');
            prevLayer.classList.add('is-previous');
            prevLayer.style.zIndex = '2';
            prevLayer.style.opacity = '1';
            prevLayer.style.visibility = 'visible';
        }

        // Clean hidden layers
        layers.forEach((layer, idx) => {
            if (idx !== prevLayerIndex && idx !== layerIndex) {
                layer.classList.remove('is-active', 'is-previous');
                layer.style.zIndex = '1';
                layer.style.opacity = '0';
                layer.style.visibility = 'hidden';
            }
        });

        // Elevate and fade in next layer
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

    /**
     * Layered crossfade transition (280ms) + Top Screen Easter Egg
     */
    function transitionToGaze(newIndex, isInstant) {
        if (newIndex === currentGaze && !isInstant) {
            return;
        }

        // State 5: Top Screen Easter Egg (top.gif cat shown in right pane replacing man portrait)
        if (newIndex === 5) {
            if (portraitTopGif) {
                portraitTopGif.classList.add('is-active');
            }
            if (transitionTimer) {
                clearTimeout(transitionTimer);
                transitionTimer = null;
            }
            // Hide all man portrait layers so only the cat is displayed
            layers.forEach(layer => {
                layer.classList.remove('is-active', 'is-previous');
                layer.style.opacity = '0';
                layer.style.visibility = 'hidden';
                layer.style.zIndex = '1';
            });
            currentGaze = 5;
            return;
        }

        // When leaving state 5, hide Easter Egg
        if (portraitTopGif) {
            portraitTopGif.classList.remove('is-active');
        }

        transitionToPortraitLayer(newIndex, isInstant);
        currentGaze = newIndex;
    }

    /**
     * Calculate gaze state from cursor coordinates
     */
    function calculateGazeState(clientX, clientY) {
        const width = window.innerWidth;
        const height = window.innerHeight;
        const normY = Math.max(0, Math.min(1, clientY / height));

        // 1. Most top screen: hover on top triggers top.gif cat (even on navbar/contact)
        const topThreshold = Math.max(85, height * 0.16);
        if (clientY < topThreshold || normY < 0.16) {
            return 5;
        }

        // Eye anchor in half-face cut (around 86.5% width, 39% height)
        const eyeX = width * 0.865;
        const eyeY = height * 0.39;

        const dx = clientX - eyeX;
        const dy = clientY - eyeY;

        // Direct gaze dead zone (over eye/face or past face to the right)
        const isCurrentlyDirect = (targetGaze === 0);
        const directRadiusX = isCurrentlyDirect ? 85 : 65;
        const directRadiusY = isCurrentlyDirect ? 100 : 80;

        if ((Math.abs(dx) < directRadiusX && Math.abs(dy) < directRadiusY) || clientX >= (eyeX - (isCurrentlyDirect ? 20 : 35))) {
            return 0; // Direct eye contact
        }

        // Fluid tracking across the screen
        const hBuffer = 0.025; // 2.5% boundary hysteresis

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
        heroWrapper = document.getElementById('heroWrapper');
        portraitStage = document.getElementById('portraitStage');
        portraitTopGif = document.getElementById('portraitTopGif');

        if (!portraitStage) {
            return;
        }

        layers = Array.from(portraitStage.querySelectorAll('.portrait-layer'));
        primeImageCache();

        // Initial state: Layer 0 active
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

        // Public testing API for eye tracker
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
                    currentGaze: currentGaze,
                    targetGaze: targetGaze,
                    isTopGifActive: portraitTopGif ? portraitTopGif.classList.contains('is-active') : false,
                    layerName: IMAGE_ASSETS[currentGaze] ? IMAGE_ASSETS[currentGaze].name : 'UNKNOWN'
                };
            }
        };

        // Query param verification
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('testGaze')) {
            const requested = parseInt(urlParams.get('testGaze'), 10);
            if (!isNaN(requested) && requested >= 0 && requested <= 5) {
                window.AdrianEyeTracker.setGaze(requested, true);
            }
        } else if (urlParams.has('simulateMouse')) {
            const parts = urlParams.get('simulateMouse').split(',').map(Number);
            if (parts.length === 2) {
                window.AdrianEyeTracker.simulateCursor(parts[0], parts[1]);
            }
        }
    }

    /* ========================================================================
       5. BRUTALIST PROJECTS SPLIT ACCORDION SHOWCASE
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

        if (!displayCard || slices.length === 0) {
            return;
        }

        let currentIndex = 0;
        let fadeTimeout = null;

        function activateProject(index, instant) {
            if (index === currentIndex && !instant) {
                return;
            }

            currentIndex = index;

            // 1. Update slices expanded state
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

            // 2. Update display card link immediately
            displayCard.href = link;
            displayCard.setAttribute('aria-label', `View case study for ${title}`);

            // 3. Smooth tactile crossfade text update (~180ms total)
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

        // Attach event listeners to each slice
        slices.forEach((slice, index) => {
            // Mouse hover expands slice and updates display card
            slice.addEventListener('mouseenter', () => {
                activateProject(index, false);
            });

            // Keyboard tab focus
            slice.addEventListener('focus', () => {
                activateProject(index, false);
            });

            // Touch support for mobile/tablet
            slice.addEventListener('touchstart', () => {
                activateProject(index, false);
            }, { passive: true });
        });

        // Keyboard arrow navigation
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

        // Public testing API for projects accordion
        window.AdrianProjectsAccordion = {
            setActive: function (idx, instant) {
                if (idx >= 0 && idx < slices.length) {
                    activateProject(idx, !!instant);
                }
            },
            getActiveIndex: function () {
                return currentIndex;
            },
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

        // Query param verification for test automation
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('testProject')) {
            const requested = parseInt(urlParams.get('testProject'), 10);
            if (!isNaN(requested) && requested >= 0 && requested < slices.length) {
                activateProject(requested, true);
            }
        }
    }

    /* ========================================================================
       6. INITIALIZATION
       ======================================================================== */
    function init() {
        checkDeviceCapabilities();
        initCustomCursor();
        initEyeTracker();
        initProjectAccordion();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
