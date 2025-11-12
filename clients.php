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
    <div class="section-header text-center" style="margin-bottom: 60px;">
      <span class="section-badge">Trusted by</span>
      <h2 class="section-title">Our Clients & Partners</h2>
      <p class="section-description">Trusted by leading organisations across construction, government, and infrastructure.</p>
    </div>

    <div class="clients-logos-grid">
      <?php
      $mediaDir = __DIR__ . '/assets/media';
      $relativeDir = 'assets/media';
      $files = glob($mediaDir . '/*.{png,jpg,jpeg,svg,gif}', GLOB_BRACE);
      if ($files === false) {
          $files = [];
      }
      $excluded = ['NETCOST ELITE.svg', 'NETCOST EXPRESS.svg', 'NETCOST PRO.svg', 'dart-mission-goal-success.svg', 'WhatsApp Image 2025-11-10 at 11.45.47_cd785f93.jpg', 'housing-logo.png', 'housing.jpeg', 'water-dev-logo.png', 'zppa-logo.png'];
      $files = array_filter($files, function($f) use ($excluded) {
          return !in_array(basename($f), $excluded);
      });
      natcasesort($files);

      foreach ($files as $filePath) {
          $fileName = basename($filePath);

          $name = preg_replace('/\.(png|jpg|jpeg|svg|gif)$/i', '', $fileName);
          $name = str_replace(['-', '_'], ' ', $name);
          $name = trim($name);
          $name = ucwords($name);
          $src = $relativeDir . '/' . $fileName;
      ?>
        <div class="client-item">
          <img src="<?php echo htmlentities($src); ?>" alt="<?php echo htmlentities($name); ?>" class="client-logo-image">
          <div class="client-name-text"><?php echo htmlentities($name); ?></div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
