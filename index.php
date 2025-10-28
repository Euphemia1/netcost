<?php
require_once __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';

// Fetch latest news (3 latest)
try {
    $stmt = $pdo->prepare('SELECT id, title, content, created_at FROM news ORDER BY created_at DESC LIMIT 3');
    $stmt->execute();
    $news = $stmt->fetchAll();
} catch (Exception $e) {
    $news = [];
}
?>

<header class="hero-animation">
  <div class="hero-bg">
    <!-- Animated gradient + subtle shapes -->
    <svg class="hero-shapes" viewBox="0 0 1200 600" preserveAspectRatio="none" aria-hidden="true">
      <defs>
        <linearGradient id="g1" x1="0" x2="1">
          <stop offset="0%" stop-color="#0d6efd" stop-opacity="0.95" />
          <stop offset="100%" stop-color="#20c997" stop-opacity="0.95" />
        </linearGradient>
      </defs>
      <rect width="1200" height="600" fill="url(#g1)"></rect>
      <g class="floating" fill="rgba(255,255,255,0.08)">
        <circle cx="120" cy="80" r="60"></circle>
        <rect x="980" y="40" width="220" height="120" rx="18"></rect>
        <ellipse cx="600" cy="520" rx="420" ry="60"></ellipse>
      </g>
    </svg>
  </div>

  <div class="hero-content container">
    <div class="hero-left">
      <h1 class="display-5">LT Software</h1>
      <p class="lead">Smarter estimating, smarter reporting, and seamless integrations for construction teams.</p>
      <p>
        <a class="btn btn-light btn-lg me-2" href="/services.php">See Features</a>
        <a class="btn btn-outline-light btn-lg" href="/contact.php">Get a Demo</a>
      </p>
    </div>

    <div class="hero-right" aria-hidden="false">
      <div class="feature-stage" id="featureStage">
        <div class="feature-card" data-title="Estimate Faster">
          <div class="mock-ui">
            <div class="mock-header">Net Cost Estimator</div>
            <ul>
              <li>Quick item entry</li>
              <li>Auto-cost suggestions</li>
              <li>Mobile-friendly</li>
            </ul>
          </div>
        </div>
        <div class="feature-card" data-title="Beautiful Reports">
          <div class="mock-ui">
            <div class="mock-header">Net Cost Reporter</div>
            <div class="report-preview">PDF · CSV · Dashboards</div>
          </div>
        </div>
        <div class="feature-card" data-title="Integrate Everything">
          <div class="mock-ui">
            <div class="mock-header">Integrations</div>
            <div class="integration-logos">ERP · Payroll · Mobile</div>
          </div>
        </div>
      </div>

      <div class="feature-controls">
        <button id="prevFeature" aria-label="Previous feature">◀</button>
        <div id="featureTitle" class="feature-title">Estimate Faster</div>
        <button id="nextFeature" aria-label="Next feature">▶</button>
      </div>
    </div>
  </div>

  <noscript class="container text-white mt-4">
    <p class="lead">Enable JavaScript for the animated preview. You can also view feature pages directly.</p>
  </noscript>
</header>

<script src="/assets/js/hero.js" defer></script>

<section class="my-5">
  <h2>Our Services</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Custom Software Development</h5>
          <p class="card-text">Tailored solutions to automate workflows and integrate systems.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Web & Mobile Integration</h5>
          <p class="card-text">Cross-platform applications connecting web and mobile users.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">Construction Industry Solutions</h5>
          <p class="card-text">Specialized tools for estimating, reporting and cost control.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="my-5">
  <h2>Featured Products</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3">
  <img data-src="/assets/images/net-cost-reporter.jpg" src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400'%3E%3Crect width='100%25' height='100%25' fill='%23e9eef5'/%3E%3C/svg%3E" class="card-img-top" alt="Net Cost Reporter">
        <div class="card-body">
          <h5 class="card-title">Net Cost Reporter</h5>
          <p class="card-text">Generate professional cost reports with accurate analytics.</p>
          <a href="#" data-product="ncr" data-title="Net Cost Reporter" data-desc="Generate professional cost reports with accurate analytics, export to PDF and CSV, and share with stakeholders." class="btn btn-primary product-learn">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
  <img data-src="/assets/images/net-cost-estimator.jpg" src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400'%3E%3Crect width='100%25' height='100%25' fill='%23e9eef5'/%3E%3C/svg%3E" class="card-img-top" alt="Net Cost Estimator">
        <div class="card-body">
          <h5 class="card-title">Net Cost Estimator Professional Express</h5>
          <p class="card-text">Quick and reliable estimating tools for professionals.</p>
          <a href="#" data-product="nce" data-title="Net Cost Estimator Professional Express" data-desc="A fast, reliable estimating workflow for professionals. Features mobile-friendly entry and cloud sync." class="btn btn-primary product-learn">Learn More</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-3">
  <img data-src="/assets/images/net-cost-elite.jpg" src="data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400'%3E%3Crect width='100%25' height='100%25' fill='%23e9eef5'/%3E%3C/svg%3E" class="card-img-top" alt="Net Cost Elite">
        <div class="card-body">
          <h5 class="card-title">Net Cost Elite</h5>
          <p class="card-text">Advanced suite for enterprise-level cost management.</p>
          <a href="#" data-product="nce-lite" data-title="Net Cost Elite" data-desc="Enterprise-grade suite with advanced integrations, role-based access, and reporting for large portfolios." class="btn btn-primary product-learn">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="my-5">
  <h2>News Flash</h2>
  <?php if (!empty($news)): ?>
    <div class="list-group">
      <?php foreach ($news as $n): ?>
        <a href="/" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1"><?php echo htmlspecialchars($n['title']); ?></h5>
            <small><?php echo htmlspecialchars(date('M j, Y', strtotime($n['created_at']))); ?></small>
          </div>
          <p class="mb-1"><?php echo nl2br(htmlspecialchars(substr($n['content'], 0, 200))); ?><?php echo (strlen($n['content'])>200) ? '...' : ''; ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-muted">No news available.</p>
  <?php endif; ?>
</section>

<section class="my-5">
  <h2>What our clients say</h2>
  <div class="testimonials bg-white p-4 rounded shadow-sm">
    <div class="slide fade-up">
      <p>“LT Software helped us reduce estimating time by 40% and improved reporting accuracy.”</p>
      <small class="text-muted">— Procurement Manager, BuildCo</small>
    </div>
    <div class="slide fade-up">
      <p>“Their integrations removed duplicate entry across teams and saved hours per project.”</p>
      <small class="text-muted">— Head of Operations, ConstructAll</small>
    </div>
    <div class="slide fade-up">
      <p>“We rely on Net Cost Elite for strategic reporting across our national portfolio.”</p>
      <small class="text-muted">— CFO, BigBuild Group</small>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>