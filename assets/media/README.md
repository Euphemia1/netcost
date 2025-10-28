Hero media (generated animation)
=================================

This project ships an HTML/CSS/JS "generated" hero animation instead of an embedded MP4. The animated hero is designed to look polished and high-quality while remaining lightweight and responsive.

What it includes
- An animated SVG gradient and subtle floating shapes (in `index.php`).
- A rotating feature-stage with mock UI cards (`assets/js/hero.js` + styles in `assets/css/styles.css`).

How to replace with a real video
1. If you prefer to use a real video, copy your MP4 to `assets/media/lt-demo.mp4`.
2. Replace the hero markup in `index.php` with a `<video>` element (the previous video-based implementation is still in commits/PR history if needed).
3. For best results convert video to H.264 MP4 and provide a small poster image in `assets/images/hero-poster.jpg`.

Quick ffmpeg example (PowerShell):
```
ffmpeg -i "input.mp4" -c:v libx264 -crf 20 -preset medium -c:a aac -b:a 128k "assets/media/lt-demo.mp4"
```

Notes
- The generated hero is accessible and respects `prefers-reduced-motion` (it will stop auto-rotation).
- The mock UI cards are placeholders — edit the content in `index.php` to match real screenshots or copy real images into `assets/images/` and update the markup.
