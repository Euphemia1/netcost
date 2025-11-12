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

        <!-- Redesigned team layout: executive spotlight + role grid -->
        <div class="team-executives">
            <div class="exec-grid">
                <div class="circular-team-card">
                    <div class="circular-team-container">
                        <img src="assets/images/0O1A5966.jpg" alt="L.J Tembo" class="circular-team-image">
                    </div>
                    <h3 class="team-member-name">L.J Tembo</h3>
                    <p class="team-member-role">Managing Director</p>
                    <p class="team-member-bio">Founder and leader with over 20 years' experience in construction and estimating. Passionate about digitising workflows.</p>
                </div>

                <div class="circular-team-card">
                    <div class="circular-team-container">
                        <img src="assets/images/@fern-media_--_11.jpg" alt="Dr Pegg" class="circular-team-image">
                    </div>
                    <h3 class="team-member-name">Dr Pegg</h3>
                    <p class="team-member-role">Head of Strategy</p>
                    <p class="team-member-bio">Leads product strategy and partnerships, ensuring NetCost aligns with industry needs and compliance.</p>
                </div>
            </div>

            <div class="section-note text-center" style="margin-top:18px;color:var(--text-secondary);">Other roles are shown below — click any role to learn more about responsibilities.</div>
        </div>

        <div class="role-grid" style="margin-top:32px;">
            <div class="role-card">
                <div class="role-box">Head of Finance</div>
            </div>
            <div class="role-card">
                <div class="role-box">Lead Civil Engineer</div>
            </div>
            <div class="role-card">
                <div class="role-box">Engineering Team</div>
            </div>
            <div class="role-card">
                <div class="role-box">Construction Engineers</div>
            </div>
            <div class="role-card">
                <div class="role-box">Road Works Engineers</div>
            </div>
            <div class="role-card">
                <div class="role-box">Building Engineers</div>
            </div>
            <div class="role-card">
                <div class="role-box">Full Stack</div>
            </div>
            <div class="role-card">
                <div class="role-box">Frontend Devs</div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
