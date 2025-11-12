<?php
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <span class="page-badge">Clients</span>
    <h1 class="page-title">Our Clients</h1>
    <p class="page-description">We partner with public and private sector organisations across the region.</p>
  </div>
</section>

<section class="clients-section">
  <div class="container">
    <div class="section-header text-center">
      <span class="section-badge">Trusted by</span>
      <h2 class="section-title">Our Clients</h2>
      <p class="section-description">We partner with public and private sector organisations across the region.</p>
    </div>

    <div class="clients-logos-grid" aria-hidden="false">
      <div class="circular-logo-container">
        <div class="circular-logo">
          <img src="assets/images/logos/placeholder-acea.svg" alt="ACEA">
        </div>
      </div>

      <div class="circular-logo-container">
        <div class="circular-logo">
          <img src="assets/images/logos/placeholder-eiz.svg" alt="EIZ">
        </div>
      </div>

      <div class="circular-logo-container">
        <div class="circular-logo">
          <img src="assets/images/logos/placeholder-ministry.svg" alt="Ministry of Works">
        </div>
      </div>

      <div class="circular-logo-container">
        <div class="circular-logo">
          <img src="assets/images/logos/placeholder-unza.svg" alt="UNZA">
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
