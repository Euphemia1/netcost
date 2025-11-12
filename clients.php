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

    <div class="clients-logos-grid">
      <?php
      // Auto-list all logo files in the logos directory so adding a new file shows immediately
      $logosDir = __DIR__ . '/assets/images/logos';
      $relativeDir = 'assets/images/logos';
      $files = glob($logosDir . '/*.{png,jpg,jpeg,svg,gif}', GLOB_BRACE);
      if ($files === false) {
          $files = [];
      }
      // sort alphabetically for predictable ordering
      natcasesort($files);

      foreach ($files as $filePath) {
          $fileName = basename($filePath);
          // derive a friendly company name from filename
          $name = preg_replace('/\.(png|jpg|jpeg|svg|gif)$/i', '', $fileName);
          $name = preg_replace('/^(placeholder-|logo-|img-)/i', '', $name);
          $name = str_replace(['-', '_'], ' ', $name);
          $name = trim($name);
          $name = ucwords($name);
          $src = $relativeDir . '/' . $fileName;
      ?>
        <div class="circular-logo-container">
          <div class="circular-logo" role="img" aria-label="<?php echo htmlentities($name); ?> logo">
            <img src="<?php echo htmlentities($src); ?>" alt="<?php echo htmlentities($name); ?> logo">
          </div>
          <div class="client-caption"><?php echo htmlentities($name); ?></div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
