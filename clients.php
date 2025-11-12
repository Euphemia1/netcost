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
    <div class="clients-grid">
      <div class="client-card">
        <div class="client-logo">
          <img src="assets/images/logos/placeholder-acea.svg" alt="ACEA">
        </div>
        <div class="client-name">ACEA</div>
        <div class="client-info">Infrastructure partner</div>
      </div>

      <div class="client-card">
        <div class="client-logo">
          <img src="assets/images/logos/placeholder-eiz.svg" alt="EIZ">
        </div>
        <div class="client-name">EIZ</div>
        <div class="client-info">Construction consortium</div>
      </div>

      <div class="client-card">
        <div class="client-logo">
          <img src="assets/images/logos/placeholder-ministry.svg" alt="Ministry">
        </div>
        <div class="client-name">Ministry of Works</div>
        <div class="client-info">Government partner</div>
      </div>

      <div class="client-card">
        <div class="client-logo">
          <img src="assets/images/logos/placeholder-unza.svg" alt="UNZA">
        </div>
        <div class="client-name">UNZA</div>
        <div class="client-info">Academic collaboration</div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
