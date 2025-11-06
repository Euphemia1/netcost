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
            <h2 class="section-title">Meet the People Behind LT Software</h2>
            <p class="section-description">
                A diverse team of engineers, designers, and construction experts dedicated to your success.
            </p>
        </div>

        <div class="circular-team-grid">
            <div class="circular-team-card">
                <div class="circular-team-container">
                    <img src="assets/images/0O1A5966.jpg" alt="L.J Tembo" class="circular-team-image">
                </div>
                <h3 class="team-member-name">L.J Tembo</h3>
                <p class="team-member-role">Managing Director</p>
                <p class="team-member-bio">
                    Strategic leader with extensive experience in construction and technology sectors. Drives company vision and growth initiatives.
                </p>
            </div>
            
            <div class="circular-team-card">
                <div class="circular-team-container">
                    <img src="assets/images/@fern-media_--_11.jpg" alt="Dr P N Nsama" class="circular-team-image">
                </div>
                <h3 class="team-member-name">Dr P N Nsama</h3>
                <p class="team-member-role">Director Operations</p>
                <p class="team-member-bio">
                    Operations expert ensuring efficient project execution and delivery. Oversees all operational and infrastructure management.
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
