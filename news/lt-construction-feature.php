<?php
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include __DIR__ . '/../includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <span class="page-badge">In the News</span>
    <h1 class="page-title">LT Construction Featured in National Press</h1>
    <p class="page-description">Read about LT Construction's recent feature highlighting local innovation in construction estimating.</p>
  </div>
</section>

<section class="news-article-single" style="padding:80px 0; background:white;">
  <div class="container">
    <article style="max-width:900px; margin:0 auto;">
      <div style="border-radius:12px; overflow:hidden; box-shadow:var(--shadow-md); position:relative;">
        <img src="assets/media/news/WhatsApp%20Image%202025-11-10%20at%2011.45.47_c6ca47d7.jpg" alt="LT Construction in the news" style="width:100%; height:auto; display:block;">
        <div style="position: absolute; top: 16px; right: 16px; background: white; padding: 10px 14px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
          <img src="assets/media/LT.svg" alt="LT Construction" style="height: 40px; width: auto; display: block;">
        </div>
      </div>

      <div style="padding:28px 12px;">
        <p style="color:var(--text-tertiary); margin-bottom:8px;">Published: November 10, 2025</p>
        <h2 style="font-size:28px; margin-bottom:12px;">LT Construction showcases local innovation with NetCost Estimator</h2>
        <p style="color:var(--text-secondary); line-height:1.8;">LT Construction was recently featured for its adoption of modern estimating tools that streamline the tendering and BOQ process. Using NetCost Estimator, the team was able to reduce estimate preparation time significantly while improving accuracy for supplier pricing and resource scheduling.</p>

        <h3 style="margin-top:18px;">Highlights</h3>
        <ul style="color:var(--text-secondary); line-height:1.7;">
          <li>Faster estimate turnarounds and clearer priced BOQs for tenders.</li>
          <li>Improved resource summaries that help plan labour and plant allocation.</li>
          <li>Better reconciliation and variance analysis during project handover.</li>
        </ul>

        <p style="margin-top:18px; color:var(--text-secondary);">To learn more about how NetCost Estimator helps construction teams, <a href="/contact.php" class="product-cta">request a demo</a> or explore our products on the homepage.</p>

        <p style="margin-top:28px; color:var(--text-tertiary); font-size:14px;">We thank the press for featuring the efforts of local teams embracing digital tools to modernize construction delivery.</p>
      </div>

      <p style="text-align:center; margin-top:24px;"><a href="/news.php" class="btn btn-secondary">Back to News</a></p>
    </article>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
