<?php
// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'includes/header.php'; 
?>

<section class="page-hero">
    <div class="container">
        <span class="page-badge">Our Team</span>
        <h1 class="page-title">Meet the People Behind LT Software</h1>
        <p class="page-description">
            A diverse team of engineers, designers, and construction experts dedicated to your success.
        </p>
    </div>
</section>

<section class="team-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Our Team</span>
            <h2 class="section-title">Organizational Chart</h2>
            <p class="section-description">
                A diverse team of engineers, designers, and construction experts dedicated to your success.
            </p>
        </div>

        <div class="org-chart">
            <div class="org-level org-level-1">
                <div class="org-card exec-card">
                    <div class="exec-photo">
                        <img src="assets/images/0O1A5966.jpg" alt="L.J Tembo" class="exec-image">
                    </div>
                    <h3 class="exec-name">L.J Tembo</h3>
                    <p class="exec-title">Managing Director</p>
                    <p class="exec-bio">Founder and leader with over 20 years' experience in construction and estimating. Passionate about digitising workflows.</p>
                </div>

                <div class="org-card exec-card">
                    <div class="exec-photo">
                        <img src="assets/images/@fern-media_--_11.jpg" alt="Dr Pegg" class="exec-image">
                    </div>
                    <h3 class="exec-name">Dr Pegg</h3>
                    <p class="exec-title">Head of Strategy</p>
                    <p class="exec-bio">Leads product strategy and partnerships, ensuring NetCost aligns with industry needs and compliance.</p>
                </div>
            </div>
            <div class="org-connector-line"></div>
            <div class="org-level org-level-2">
                <div class="org-card title-card">
                    <div class="title-card-content">Head of Finance</div>
                </div>

                <div class="org-card title-card">
                    <div class="title-card-content">Lead Civil Engineer</div>
                </div>

                <div class="org-card title-card">
                    <div class="title-card-content">IT</div>
                </div>
            </div>

            <div class="org-level org-level-3">
                <div class="org-group civil-group">
                    <div class="org-connector-vertical"></div>
                    <div class="org-cards-row">
                        <div class="org-card sub-card">
                            <div class="sub-card-content">Construction Engineers</div>
                        </div>
                        <div class="org-card sub-card">
                            <div class="sub-card-content">Road Works Engineers</div>
                        </div>
                        <div class="org-card sub-card">
                            <div class="sub-card-content">Building Engineers</div>
                        </div>
                    </div>
                </div>

                <!-- Under IT -->
                <div class="org-group it-group">
                    <div class="org-connector-vertical"></div>
                    <div class="org-cards-row">
                        <div class="org-card sub-card">
                            <div class="sub-card-content">Full Stack</div>
                        </div>
                        <div class="org-card sub-card">
                            <div class="sub-card-content">Frontend Devs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
