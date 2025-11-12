</main>
    <?php
        if (!isset($base_path)) {
            $base_path = '/';
            if (strpos($_SERVER['REQUEST_URI'], '/netcost/') !== false) {
                $base_path = '/netcost/';
            }
        }
    ?>
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="footer-logo">
                        <img src="<?php echo $base_path; ?>assets/media/LT.svg" alt="LT Construction" class="logo-image footer-logo-img" style="height: 40px; width: auto; filter: brightness(0) invert(1);">
                    </div>
                    <p class="footer-description">
                        Building the future of construction software with intelligent solutions for cost estimation and project management.
                    </p>
                </div>
                
                <div class="footer-col">
                    <h3>Products</h3>
                    <ul class="footer-links">
                        <li><a href="#products">NetCost Estimator Express</a></li>
                        <li><a href="#products">Netost Estimator Elite</a></li>
                        <li><a href="#products">NetCost Estimator Pro</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Company</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo $base_path; ?>about.php">About Us</a></li>
                        <li><a href="<?php echo $base_path; ?>team.php">Our Team</a></li>
                        <li><a href="<?php echo $base_path; ?>careers.php">Careers</a></li>
                        <li><a href="<?php echo $base_path; ?>clients.php">Clients</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Support</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo $base_path; ?>contact.php">Contact Us</a></li>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> LT Software. All rights reserved.</p>
                <div class="footer-social">
                    <a href="#" aria-label="LinkedIn">LinkedIn</a>
                    <a href="#" aria-label="Twitter">Twitter</a>
                    <a href="#" aria-label="Facebook">Facebook</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
        });
    </script>
</body>
</html>
