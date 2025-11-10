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
            <!-- 1. Mr Tembo (top) -->
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

            <!-- 2. Dr Pegg (second) -->
            <div class="circular-team-card">
                <div class="circular-team-container">
                    <img src="assets/images/@fern-media_--_11.jpg" alt="Dr Pegg" class="circular-team-image">
                </div>
                <h3 class="team-member-name">Dr Pegg</h3>
                <p class="team-member-role">Head of Strategy</p>
                <p class="team-member-bio">
                    Research and strategy lead with a strong academic background and experience in large-scale construction projects.
                </p>
            </div>

            <!-- Group: Director of Finance, Civil Engineer, Software Engineers -->
            <!-- 3. Director of Finance (group - first) -->
            <div class="circular-team-card">
                <div class="circular-team-container">
                    <img src="assets/images/0O1A5966.jpg" alt="Director of Finance" class="circular-team-image">
                </div>
                <h3 class="team-member-name">Director of Finance</h3>
                <p class="team-member-role">Head of Finance</p>
                <p class="team-member-bio">
                    Responsible for budgeting, financial planning and reporting, ensuring healthy cash flow and compliance.
                </p>
            </div>

            <!-- 4. Civil Engineer (group - second) -->
            <div class="circular-team-card">
                <div class="circular-team-container">
                    <img src="assets/images/@fern-media_--_11.jpg" alt="Civil Engineer" class="circular-team-image">
                </div>
                <h3 class="team-member-name">Civil Engineer</h3>
                <p class="team-member-role">Lead Civil Engineer</p>
                <p class="team-member-bio">
                    Expert in structural calculations and on-site coordination, ensuring designs meet safety and cost requirements.
                </p>
            </div>

            <!-- 5. Software Engineers (group - third) -->
            <div class="circular-team-card">
                <div class="circular-team-container">
                    <img src="assets/images/0O1A5966.jpg" alt="Software Engineers" class="circular-team-image">
                </div>
                <h3 class="team-member-name">Software Engineers</h3>
                <p class="team-member-role">Engineering Team</p>
                <p class="team-member-bio">
                    Full-stack developers, QA and DevOps engineers building and maintaining the NetCost platform.
                </p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
