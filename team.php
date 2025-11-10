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

        <!-- Tree-style team layout: root -> manager -> group -->
        <div class="team-tree">
            <div class="tree-level tree-level-0">
                <div class="circular-team-card tree-node">
                    <div class="circular-team-container">
                        <img src="assets/images/0O1A5966.jpg" alt="L.J Tembo" class="circular-team-image">
                    </div>
                    <h3 class="team-member-name">L.J Tembo</h3>
                    <p class="team-member-role">Managing Director</p>
                </div>
            </div>

            <div class="tree-level tree-level-1">
                <div class="circular-team-card tree-node">
                    <div class="circular-team-container">
                        <img src="assets/images/@fern-media_--_11.jpg" alt="Dr Pegg" class="circular-team-image">
                    </div>
                    <h3 class="team-member-name">Dr Pegg</h3>
                    <p class="team-member-role">Head of Strategy</p>
                </div>
            </div>

            <div class="tree-level tree-level-2">
                <div class="circular-team-card tree-node">
                    <div class="circular-team-container">
                        <img src="assets/images/0O1A5966.jpg" alt="Director of Finance" class="circular-team-image">
                    </div>
                    <h3 class="team-member-name">Director of Finance</h3>
                    <p class="team-member-role">Head of Finance</p>
                </div>

                <div class="circular-team-card tree-node">
                    <div class="circular-team-container">
                        <img src="assets/images/@fern-media_--_11.jpg" alt="Civil Engineer" class="circular-team-image">
                    </div>
                    <h3 class="team-member-name">Civil Engineer</h3>
                    <p class="team-member-role">Lead Civil Engineer</p>
                </div>

                <div class="circular-team-card tree-node">
                    <div class="circular-team-container">
                        <img src="assets/images/0O1A5966.jpg" alt="Software Engineers" class="circular-team-image">
                    </div>
                    <h3 class="team-member-name">Software Engineers</h3>
                    <p class="team-member-role">Engineering Team</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
