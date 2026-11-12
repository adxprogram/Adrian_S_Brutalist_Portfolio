/**
 * Brutalist GitHub Contribution Graph Client Engine
 * Adrian Santiago Portfolio // 2026 Archive
 *
 * Implements:
 * 1. Zero-latency dynamic year switching
 * 2. Crisp brutalist floating hover tooltip
 * 3. Kinetic counter transition
 * 4. Custom cursor integration & mobile touch support
 */

(function () {
    'use strict';

    function initGitHubContributions() {
        const section = document.getElementById('contributions');
        if (!section) return;

        const graphContainer = document.getElementById('githubGraphContainer');
        const scrollWrap = document.getElementById('githubGraphScrollWrap');
        const totalCountEl = document.getElementById('githubTotalCount');
        const yearLabelEl = document.getElementById('githubActiveYearLabel');
        const tooltip = document.getElementById('githubTooltip');
        const yearButtons = Array.from(document.querySelectorAll('.brutalist-year-btn'));
        const datasetScript = document.getElementById('github-contributions-dataset');
        const customCursor = document.getElementById('customCursor');

        // Parse preloaded dataset if available
        let allYearsData = null;
        if (datasetScript) {
            try {
                allYearsData = JSON.parse(datasetScript.textContent);
            } catch (err) {
                console.warn('[GitHub Graph] Failed to parse embedded dataset:', err);
            }
        }

        // --- 1. TOOLTIP ENGINE -------------------------------------------------
        let activeCell = null;

        function showTooltip(cell) {
            if (!tooltip || !cell) return;
            activeCell = cell;

            const count = parseInt(cell.getAttribute('data-count') || '0', 10);
            const dateStr = cell.getAttribute('data-date') || '';
            const formattedDate = cell.getAttribute('data-date-formatted') || formatDate(dateStr);

            const countText = count === 0 ? 'No contributions' : `${count} contribution${count === 1 ? '' : 's'}`;
            tooltip.innerHTML = `<span class="tooltip-count">${countText}</span><span class="tooltip-date">on ${formattedDate}</span>`;

            positionTooltip(cell);
            tooltip.classList.add('is-active');

            if (customCursor) {
                customCursor.classList.add('is-hovering');
            }
        }

        function hideTooltip() {
            if (!tooltip) return;
            activeCell = null;
            tooltip.classList.remove('is-active');

            if (customCursor) {
                customCursor.classList.remove('is-hovering');
            }
        }

        function positionTooltip(cell) {
            if (!tooltip || !cell) return;
            const rect = cell.getBoundingClientRect();
            const tooltipRect = tooltip.getBoundingClientRect();

            let targetX = rect.left + (rect.width / 2);
            let targetY = rect.top;

            // Horizontal bounds check
            const pad = 12;
            const halfW = tooltipRect.width / 2;
            if (targetX - halfW < pad) {
                targetX = pad + halfW;
            } else if (targetX + halfW > window.innerWidth - pad) {
                targetX = window.innerWidth - pad - halfW;
            }

            // Vertical bounds check: if too close to top, show below cell
            if (targetY - tooltipRect.height - 12 < pad) {
                tooltip.style.transform = 'translate(-50%, 0) translateY(10px)';
                targetY = rect.bottom;
            } else {
                tooltip.style.transform = 'translate(-50%, -100%) translateY(-6px)';
            }

            tooltip.style.left = `${Math.round(targetX)}px`;
            tooltip.style.top = `${Math.round(targetY)}px`;
        }

        function formatDate(isoStr) {
            if (!isoStr) return '';
            const parts = isoStr.split('-');
            if (parts.length < 3) return isoStr;
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const m = parseInt(parts[1], 10) - 1;
            const d = parseInt(parts[2], 10);
            const y = parts[0];
            return `${months[m] || ''} ${d}, ${y}`;
        }

        // Delegate mouse/focus events on graph container
        if (graphContainer) {
            graphContainer.addEventListener('mouseover', function (e) {
                const cell = e.target.closest('.contrib-cell');
                if (cell) {
                    showTooltip(cell);
                }
            });

            graphContainer.addEventListener('mouseout', function (e) {
                const cell = e.target.closest('.contrib-cell');
                if (cell) {
                    hideTooltip();
                }
            });

            graphContainer.addEventListener('focusin', function (e) {
                const cell = e.target.closest('.contrib-cell');
                if (cell) {
                    showTooltip(cell);
                }
            });

            graphContainer.addEventListener('focusout', function (e) {
                const cell = e.target.closest('.contrib-cell');
                if (cell) {
                    hideTooltip();
                }
            });
        }

        // Hide tooltip on scroll or window resize
        if (scrollWrap) {
            scrollWrap.addEventListener('scroll', function () {
                if (activeCell) {
                    positionTooltip(activeCell);
                }
            }, { passive: true });
        }

        window.addEventListener('scroll', function () {
            if (activeCell) {
                hideTooltip();
            }
        }, { passive: true });

        window.addEventListener('resize', function () {
            if (activeCell) {
                hideTooltip();
            }
        }, { passive: true });

        // --- 2. DYNAMIC YEAR SWITCHER -------------------------------------------
        yearButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const selectedYear = parseInt(this.getAttribute('data-year'), 10);
                if (!selectedYear || this.classList.contains('is-active')) return;

                switchYear(selectedYear, this);
            });
        });

        async function switchYear(year, clickedBtn) {
            // Update active states
            yearButtons.forEach(b => {
                b.classList.remove('is-active');
                b.setAttribute('aria-selected', 'false');
            });
            clickedBtn.classList.add('is-active');
            clickedBtn.setAttribute('aria-selected', 'true');

            // Visual feedback on container
            if (graphContainer) {
                graphContainer.classList.add('is-updating');
            }

            try {
                let calendar = null;

                // Check in-memory preloaded dataset
                if (allYearsData && allYearsData.calendars && allYearsData.calendars[year]) {
                    calendar = allYearsData.calendars[year];
                } else {
                    // Fallback to fetch from endpoint
                    const res = await fetch(`includes/github-api.php?year=${year}`);
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    calendar = await res.json();
                }

                if (calendar) {
                    updateCalendarView(calendar, year);
                }
            } catch (err) {
                console.error('[GitHub Graph] Failed to switch year:', err);
            } finally {
                if (graphContainer) {
                    graphContainer.classList.remove('is-updating');
                }
            }
        }

        function updateCalendarView(calendar, year) {
            // 1. Animate total contributions counter
            const newTotal = parseInt(calendar.totalContributions || 0, 10);
            animateCounter(totalCountEl, newTotal);

            // 2. Update active year label
            if (yearLabelEl) {
                yearLabelEl.textContent = `IN ${year}`;
            }

            // 3. Render new SVG calendar
            if (graphContainer) {
                graphContainer.innerHTML = buildCalendarSvg(calendar);
            }

            // 5. Auto scroll to recent weeks on smaller viewports
            autoScrollToLatest();
        }

        // SVG Calendar Builder mirroring PHP renderContributionSvg
        function buildCalendarSvg(calendar) {
            if (!calendar || !calendar.weeks || calendar.weeks.length === 0) {
                return '<div class="github-empty-notice">// NO ACTIVITY DATA AVAILABLE FOR THIS TIMEFRAME</div>';
            }

            const cellSize = 12;
            const cellGap = 3;
            const step = cellSize + cellGap; // 15px
            const leftOffset = 36;
            const topOffset = 24;

            const weeks = calendar.weeks;
            const numWeeks = weeks.length;
            const svgWidth = leftOffset + (numWeeks * step) + 8;
            const svgHeight = topOffset + (7 * step) + 8;

            let svg = `<svg class="github-calendar-svg" viewBox="0 0 ${svgWidth} ${svgHeight}" width="${svgWidth}" height="${svgHeight}" role="grid" aria-label="Contribution Activity Grid">`;

            // Month Labels
            svg += '<g class="graph-month-labels" aria-hidden="true">';
            if (calendar.months && calendar.months.length) {
                calendar.months.forEach(m => {
                    const mX = leftOffset + (m.weekIndex * step);
                    svg += `<text x="${mX}" y="16" class="graph-month-text">${escapeHtml(m.name)}</text>`;
                });
            }
            svg += '</g>';

            // Day Labels
            svg += '<g class="graph-day-labels" aria-hidden="true">';
            const dayLabels = { 1: 'Mon', 3: 'Wed', 5: 'Fri' };
            for (const [wDay, label] of Object.entries(dayLabels)) {
                const dY = topOffset + (parseInt(wDay, 10) * step) + 10;
                svg += `<text x="0" y="${dY}" class="graph-day-text">${label}</text>`;
            }
            svg += '</g>';

            // Cells Group
            svg += '<g class="graph-cells-group" role="rowgroup">';
            weeks.forEach((week, wIdx) => {
                const colX = leftOffset + (wIdx * step);
                svg += `<g class="graph-week-column" transform="translate(${colX}, 0)">`;

                const days = week.days || [];
                days.forEach((day, wDay) => {
                    if (!day) return;
                    const rowY = topOffset + (wDay * step);
                    const count = parseInt(day.count || 0, 10);
                    const level = parseInt(day.level || 0, 10);
                    const date = escapeHtml(day.date || '');
                    const dateFormatted = escapeHtml(formatDate(day.date));
                    const label = `${count === 0 ? 'No contributions' : count + (count === 1 ? ' contribution' : ' contributions')} on ${dateFormatted}`;

                    svg += `<rect class="contrib-cell contrib-lvl-${level}" `
                        + `data-date="${date}" `
                        + `data-count="${count}" `
                        + `data-level="${level}" `
                        + `data-date-formatted="${dateFormatted}" `
                        + `x="0" y="${rowY}" `
                        + `width="${cellSize}" height="${cellSize}" `
                        + `rx="0" ry="0" `
                        + `tabindex="0" `
                        + `role="gridcell" `
                        + `aria-label="${label}" />`;
                });

                svg += '</g>';
            });
            svg += '</g>';

            svg += '</svg>';
            return svg;
        }

        // Fast kinetic number animation
        function animateCounter(el, target) {
            if (!el) return;
            const start = parseInt(el.textContent.replace(/,/g, ''), 10) || 0;
            const diff = target - start;
            if (diff === 0) return;

            const duration = 400; // ms
            const startTime = performance.now();

            function update(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // Ease out cubic
                const ease = 1 - Math.pow(1 - progress, 3);
                const current = Math.round(start + (diff * ease));
                el.textContent = current.toLocaleString();

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    el.textContent = target.toLocaleString();
                }
            }

            requestAnimationFrame(update);
        }

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        // Initial horizontal scroll setup for mobile
        function autoScrollToLatest() {
            if (!scrollWrap) return;
            // On mobile or narrow containers, scroll towards the current date (right)
            if (scrollWrap.scrollWidth > scrollWrap.clientWidth) {
                // If it's the current year (2026), scroll right to see latest commits
                const activeBtn = document.querySelector('.brutalist-year-btn.is-active');
                const isCurrentYear = activeBtn && activeBtn.getAttribute('data-year') === '2026';
                if (isCurrentYear) {
                    scrollWrap.scrollTo({
                        left: scrollWrap.scrollWidth - scrollWrap.clientWidth,
                        behavior: 'smooth'
                    });
                } else {
                    scrollWrap.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                }
            }
        }

        // Trigger on load after brief layout stabilization
        setTimeout(autoScrollToLatest, 300);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGitHubContributions);
    } else {
        initGitHubContributions();
    }
})();
