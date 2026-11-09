# Adrian Santiago // Brutalist Portfolio & Interactive Eye-Tracking Hero

An interactive, brutalist portfolio hero section built for **Adrian Santiago**, featuring custom eye-tracking where the photographic portrait follows the visitor's cursor across 5 distinct gaze states, accompanied by a custom inverted brutalist cursor component.

Inspired by the moodboard design system and visual arrangement reference.

---

## 1. Visual & Architectural Alignment

- **Design Aesthetic:** High-contrast sculptural brutalism.
- **Color Palette:**
  - Background: Mid Concrete Gray (`#A6A6A6`)
  - Primary Typography: Pure Black (`#000000`) for `ADRIAN`
  - Secondary Typography: Stark Clinical White (`#FFFFFF`) for `SANTIAGO`
- **Typography:**
  - Headings: `Syncopate` (Google Fonts, 700 Bold, Uppercase, wide tracking)
  - Navigation & Body: `Inter` (Google Fonts, 700/800 Bold, clean sans-serif utilitarian)
- **Texture Overlay:** High-contrast monochrome screen grain exclusively applied to the primary hero showcase grid wrapper via inline SVG filter (`.hero-grain-overlay`).
- **Right Pane Component:** Full-bleed, high-contrast black-and-white portrait cut slicing the right edge of the layout grid (half-face composition matching `assets/references/website_reference.jpg`).

---

## 2. Custom Brutalist Cursor Component

Replaces the default cursor on desktop with a high-performance two-part custom cursor:

1. **Structure & Shape:**
   - **Center Dot:** Tiny, precise 5px circular focal point tracking mouse coordinates instantaneously.
   - **Outer Shape:** Crisp equilateral triangle outline (pointing upward) with centroid alignment around the center dot.
   - Both elements have `pointer-events: none` so they never block clicks or hover states.
2. **Color & Inversion (No Glow):**
   - Uses `mix-blend-mode: difference` for dynamic pixel-by-pixel color inversion across all background tones, portraits, and typography.
   - Strictly zero glow, zero blur, zero drop-shadows — maintaining sharp brutalist edges.
3. **The "Smoke / Collapse" Hover Effect:**
   - On entering any clickable or interactive element (`<a>`, `<button>`, nav items, interactive badge):
     * The triangle outline rapidly collapses inward into the center dot (`scale(0.04)` and slight twist) like smoke pulling into a point.
     * The center dot scales up to meet the collapsed energy (`scale(2.4)`).
   - On leaving, the triangle springs back open to full size with an elastic spring easing curve (`cubic-bezier(0.34, 1.56, 0.64, 1)`).
4. **Animation & Smoothness:**
   - Built on `requestAnimationFrame` with smooth interpolation (`lerp = 0.18`) for a buttery fluid lag on the outer triangle.
   - Disabled automatically on mobile and touchscreen devices; respects `prefers-reduced-motion: reduce`.

---

## 3. Interactive Eye-Tracking System

The portrait smoothly tracks visitor cursor movements across five gaze states using 280ms layered CSS opacity crossfades:

| State | Image Asset | Trigger Region |
| :---: | :--- | :--- |
| **0** | `Man_base_looking_straight_0.png` | **Direct Contact / Over Face / Far Right Edge / Default** |
| **1** | `Man_looking_upward_and_left_1.png` | **Upper-Left Area** (Top nav / upper quadrant) |
| **2** | `Man_looking_to_left_2.png` | **Middle-Left Area** (Across "ADRIAN" / mid quadrant) |
| **3** | `Man_looking_down_left_3.png` | **Lower-Left Area** (Across "SANTIAGO" / lower quadrant) |
| **4** | `Man_looking_downward_left_4.png` | **Bottom-Left Area** (Intro / status metadata) |

---

## 4. Project Structure

```
Adrian_S_Brutalist_Portfolio/
├── index.php                     # Hero Showcase with 5-layer interactive portrait
├── projects.php                  # Companion section: Selected Works
├── experience.php                # Companion section: Experience & Record
├── tools.php                     # Companion section: Arsenal & Toolchain
├── contact.php                   # Companion section: Contact Channel
├── includes/
│   ├── header.php                # Head preloads, typography, nav, and custom cursor component
│   └── footer.php                # Script loading and HTML closing
├── assets/
│   ├── css/
│   │   └── style.css             # Brutalist design tokens, custom cursor, and crossfade CSS
│   ├── js/
│   │   └── main.js               # Eye-tracking RAF engine, custom cursor lerp, and testing API
│   ├── images/
│   │   ├── Man_base_looking_straight_0.png
│   │   ├── Man_looking_upward_and_left_1.png
│   │   ├── Man_looking_to_left_2.png
│   │   ├── Man_looking_down_left_3.png
│   │   └── Man_looking_downward_left_4.png
│   └── references/
│       ├── moodboard description.txt
│       └── website_reference.jpg
└── README.md
```

---

## 5. Local Execution & Testing

Served via XAMPP Apache:
```
http://localhost/pf102/Adrian_S_Brutalist_Portfolio/
```

### DevTools Inspection API:
```javascript
// Test cursor hover collapse
window.AdrianCursor.setHover(true);  // Collapse inward
window.AdrianCursor.setHover(false); // Spring back open

// Test gaze states (0 to 4)
window.AdrianEyeTracker.setGaze(1); // Upper-left
window.AdrianEyeTracker.setGaze(0); // Direct
```
