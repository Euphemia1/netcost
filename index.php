<?php 
// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'includes/header.php'; 
?>

<section class="hero-section">
    <div class="video-background">
        <video autoplay muted loop playsinline id="heroVideo">
            <source src="https://videos.pexels.com/video-files/3209826/3209826-sd_640_360_30fps.mp4" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
    </div>
    
    <div class="hero-content">
        <div class="hero-badge animate-fade-in">
            <span class="badge-dot"></span>
            <span>Trusted by 10,000+ Construction Professionals</span>
        </div>
        
        <h1 class="hero-title animate-slide-up">
            Building the Future of<br>
            <span class="gradient-text">Construction Software</span>
        </h1>
        
        <p class="hero-description animate-slide-up delay-1">
            Streamline your construction projects with intelligent cost estimation,
            real-time reporting, and seamless integration. Built for contractors who demand precision.
        </p>
        
        <div class="hero-cta animate-slide-up delay-2">
            <a href="#products" class="btn btn-primary">
                Explore Our Products
                <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="#demo" class="btn btn-secondary">
                <svg class="play-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="2"/>
                    <path d="M8 6L14 10L8 14V6Z" fill="currentColor"/>
                </svg>
                Watch Demo
            </a>
        </div>
        
        <div class="hero-stats animate-fade-in delay-3">
            <div class="stat-item" data-count="50">
                <div class="stat-number">0%</div>
                <div class="stat-label">Faster Estimates</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item" data-count="99.8">
                <div class="stat-number">0%</div>
                <div class="stat-label">Accuracy Rate</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support Available</div>
            </div>
        </div>
    </div>
    
    <div class="scroll-indicator">
        <span>Scroll to explore</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M12 5V19M12 19L5 12M12 19L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
</section>

<section class="features-showcase">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Why Choose Us</span>
            <h2 class="section-title">Built for Modern Construction</h2>
            <p class="section-description">
                Experience the difference with features designed by construction professionals, for construction professionals
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path d="M24 4L4 14L24 24L44 14L24 4Z" stroke="#1E3A8A" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M4 34L24 44L44 34M4 24L24 34L44 24" stroke="#1E3A8A" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3>Lightning Fast</h3>
                <p>Generate detailed cost estimates in minutes with our netcost estimator calculation engine</p>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <circle cx="24" cy="24" r="20" stroke="#1E3A8A" stroke-width="2"/>
                        <path d="M24 12V24L32 28" stroke="#1E3A8A" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Real-Time Updates</h3>
                <p>Stay synchronized across all devices with instant data updates and cloud backup</p>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <rect x="8" y="12" width="32" height="28" rx="2" stroke="#1E3A8A" stroke-width="2"/>
                        <path d="M16 20H32M16 26H32M16 32H24" stroke="#1E3A8A" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3>Smart Reports</h3>
                <p>Professional reports generated automatically with customizable templates and branding</p>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path d="M24 4V44M4 24H44" stroke="#1E3A8A" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="24" cy="24" r="8" stroke="#1E3A8A" stroke-width="2"/>
                    </svg>
                </div>
                <h3>Precision Accuracy</h3>
                <p>Industry leading 99.8% accuracy rate backed by comprehensive material databases</p>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path d="M12 24C12 17.373 17.373 12 24 12C30.627 12 36 17.373 36 24C36 30.627 30.627 36 24 36" stroke="#1E3A8A" stroke-width="2" stroke-linecap="round"/>
                        <path d="M24 36C17.373 36 12 30.627 12 24" stroke="#1E3A8A" stroke-width="2" stroke-linecap="round" stroke-dasharray="4 4"/>
                    </svg>
                </div>
                <h3>Seamless Integration</h3>
                <p>Connect with your existing tools and workflows through our robust API</p>
            </div>
            
           
    </div>
</section>

<!-- Products Section -->
<section id="products" class="products-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Our Products</span>
            <h2 class="section-title">Powerful Tools for Every Project</h2>
            <p class="section-description">
                Industry-leading software solutions designed specifically for construction professionals
            </p>
        </div>

        <div class="products-grid">
            <div class="product-card featured" data-aos="zoom-in">
            
                <div class="product-icon">
                    <img src="assets/media/NETCOST PRO.svg" alt="NetCost Pro">
                </div>
                <h3 class="product-title">Netcost Estimator Pro</h3>
                <p class="product-description">
                    Lightning-fast cost estimation with AI-powered accuracy. Generate detailed estimates in minutes, not hours.
                </p>
                <ul class="product-features">
                    <li>
                        <svg width="40" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Real-time cost calculations
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Material database integration
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Custom report generation
                    </li>
                </ul>
                <a href="#contact" class="product-cta">Learn More</a>
                
                <div class="product-video-preview">
                    <a href="https://youtu.be/22Ji58kR1ZI" target="_blank" class="video-thumbnail">
                        <img src="https://img.youtube.com/vi/22Ji58kR1ZI/maxresdefault.jpg" alt="NetCost Estimator Demo Video">
                        <div class="play-button">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="23" stroke="white" stroke-width="2"/>
                                <path d="M32 24L20 31.464V16.536L32 24Z" fill="white"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="product-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="product-icon">
                    <img src="assets/media/NETCOST ELITE.svg" alt="NetCost Elite">
                </div>
                <h3 class="product-title">Net Cost Elite</h3>
                <p class="product-description">
                    Comprehensive project reporting and analytics. Track costs, progress, and performance in real-time.
                </p>
                <ul class="product-features">
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Interactive dashboards
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Automated reporting
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Export to Excel/PDF
                    </li>
                </ul>
                <a href="#contact" class="product-cta">Learn More</a>
                
                <div class="product-video-preview">
                    <a href="https://youtu.be/YldvOD-o0uY" target="_blank" class="video-thumbnail">
                        <img src="https://img.youtube.com/vi/YldvOD-o0uY/maxresdefault.jpg" alt="NetCost Elite Demo Video">
                        <div class="play-button">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="23" stroke="white" stroke-width="2"/>
                                <path d="M32 24L20 31.464V16.536L32 24Z" fill="white"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="product-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="product-icon">
                    <img src="assets/media/NETCOST EXPRESS.svg" alt="NetCost Express">
                </div>
                <h3 class="product-title">Net Cost Estimator Elite</h3>
                <p class="product-description">
                    Enterprise-grade solution for large-scale projects. Advanced features for complex construction management with comprehensive rate build-ups and material pricing.
                </p>
                <ul class="product-features">
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        3000+ rate build-ups database
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Custom rate creation & editing
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Material, labour & plant calculations
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Project budget calculations
                    </li>
                    <li>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Export to Excel & supplier quotations
                    </li>
                </ul>
                <a href="#contact" class="product-cta">Learn More</a>
                
                <div class="product-video-preview">
                    <a href="https://youtu.be/-LAmVZx-HsA" target="_blank" class="video-thumbnail">
                        <img src="https://img.youtube.com/vi/-LAmVZx-HsA/maxresdefault.jpg" alt="NetCost Estimator Elite Demo Video">
                        <div class="play-button">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                                <circle cx="24" cy="24" r="23" stroke="white" stroke-width="2"/>
                                <path d="M32 24L20 31.464V16.536L32 24Z" fill="white"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>     

<section id="demo" class="demo-section">
    <div class="container">
        <div class="demo-content">
            <div class="demo-text" data-aos="fade-right">
                <span class="section-badge">See It In Action</span>
                <h2 class="section-title">Experience the Power</h2>
                <p class="demo-description">
                    Watch how Net Cost Estimator transforms complex construction estimates into simple, accurate reports in real-time.
                </p>
                
                <div class="demo-features">
                    <div class="demo-feature">
                        <div class="demo-feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="#1E3A8A" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M2 17L12 22L22 17M2 12L12 17L22 12" stroke="#1E3A8A" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <h4>Instant Calculations</h4>
                            <p>See costs update in real-time as you input data</p>
                        </div>
                    </div>
                    
                    <div class="demo-feature">
                        <div class="demo-feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="18" height="18" rx="2" stroke="#1E3A8A" stroke-width="2"/>
                                <path d="M8 10H16M8 14H12" stroke="#1E3A8A" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <h4>Professional Reports</h4>
                            <p>Generate client-ready documents instantly</p>
                        </div>
                    </div>
                    
                    <div class="demo-feature">
                        <div class="demo-feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#1E3A8A" stroke-width="2"/>
                                <path d="M12 6V12L16 14" stroke="#1E3A8A" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <h4>Save Hours Daily</h4>
                            <p>Automate repetitive tasks and focus on what matters</p>
                        </div>
                    </div>
                </div>
                
                <a href="#contact" class="btn btn-primary btn-large">Request a Demo</a>
            </div>
            
            <div class="demo-visual" data-aos="fade-left">
                <div class="demo-window">
                    <div class="demo-window-header">
                        <div class="window-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="window-title">Net Cost Estimator Pro</div>
                    </div>
                    <div class="demo-window-content">
                        <div class="demo-interface">
                            <div class="demo-sidebar">
                                <div class="demo-menu-item active">Dashboard</div>
                                <div class="demo-menu-item">Projects</div>
                                <div class="demo-menu-item">Estimates</div>
                                <div class="demo-menu-item">Reports</div>
                            </div>
                            <div class="demo-main">
                                <div class="demo-stat-card">
                                    <div class="demo-stat-label">Total Projects</div>
                                    <div class="demo-stat-value">247</div>
                                    <div class="demo-stat-change">+12% this month</div>
                                </div>
                                <div class="demo-stat-card">
                                    <div class="demo-stat-label">Active Estimates</div>
                                    <div class="demo-stat-value">89</div>
                                    <div class="demo-stat-change">+8% this week</div>
                                </div>
                                <div class="demo-chart">
                                    <div class="chart-bar" style="height: 60%"></div>
                                    <div class="chart-bar" style="height: 80%"></div>
                                    <div class="chart-bar" style="height: 45%"></div>
                                    <div class="chart-bar" style="height: 90%"></div>
                                    <div class="chart-bar" style="height: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Testimonials</span>
            <h2 class="section-title">Loved by Construction Professionals</h2>
            <p class="section-description">
                Don't just take our word for it—hear from the contractors who use our software every day
            </p>
        </div>
        
        <div class="testimonials-grid">
            <div class="testimonial-card" data-aos="fade-up">
                <div class="testimonial-rating">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                </div>
                <p class="testimonial-text">
                    "For public infrastructure, compliance is everything. This tool aligns with ZPPA thresholds, includes VAT automatically, and flags inconsistencies. It's now part of our internal checks & balance before approving any supplier quote."
                </p>
                <div class="testimonial-author">
                    <div class="author-avatar">BM</div>
                    <div class="author-info">
                        <div class="author-name">Brian Mwamba</div>
                        <div class="author-title">Public Infrastructure Compliance Officer</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-rating">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                </div>
                <p class="testimonial-text">
                    "The Net Cost Estimator replaced our messy spreadsheets with clean, localized cost breakdowns. It's fast, accurate, and reflects real Zambian pricing. We've used it on multiple builds and it's helped us stay within budget and justify every quote."
                </p>
                <div class="testimonial-author">
                    <div class="author-avatar">EM</div>
                    <div class="author-info">
                        <div class="author-name">Ernest Mulenga</div>
                        <div class="author-title">General Contractor, Multi-Build Projects</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-rating">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="#FF6B00">
                        <path d="M10 1L12.5 6.5L18.5 7.5L14.25 11.5L15.5 17.5L10 14.5L4.5 17.5L5.75 11.5L1.5 7.5L7.5 6.5L10 1Z"/>
                    </svg>
                </div>
                <p class="testimonial-text">
                    "I used the Home Builder module to quote a 3-bedroom house. The breakdown was so clear, the client approved it instantly. It's perfect for small contractors who want to look professional without hiring a full Quantity Surveyors team."
                </p>
                <div class="testimonial-author">
                    <div class="author-avatar">MN</div>
                    <div class="author-info">
                        <div class="author-name">Mercy Nambule</div>
                        <div class="author-title">Independent Home Builder</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <div class="services-content">
            <div class="services-text" data-aos="fade-right">
                <span class="section-badge">Our Services</span>
                <h2 class="section-title">Complete Software Solutions</h2>
                <p class="services-intro">
                    We don't just build software—we build partnerships. Our comprehensive services ensure your success from day one.
                </p>
                
                <div class="services-list">
                    <div class="service-item">
                        <div class="service-number">01</div>
                        <div class="service-content">
                            <h3>Custom Software Development</h3>
                            <p>Tailored solutions designed specifically for your construction workflow and business needs.</p>
                        </div>
                    </div>
                    
                    <div class="service-item">
                        <div class="service-number">02</div>
                        <div class="service-content">
                            <h3>Mobile & Web Integration</h3>
                            <p>Seamless integration across all devices. Access your data anywhere, anytime.</p>
                        </div>
                    </div>
                    
                    <div class="service-item">
                        <div class="service-number">03</div>
                        <div class="service-content">
                            <h3>Industry-Specific Solutions</h3>
                            <p>Deep expertise in construction industry requirements, regulations, and best practices.</p>
                        </div>
                    </div>
                </div>
                
                <a href="services.php" class="btn btn-secondary">View All Services</a>
            </div>
            
            <div class="services-visual" data-aos="fade-left">
                <div class="visual-card card-1">
                    <div class="card-icon">📊</div>
                    <div class="card-stat">10,000+</div>
                    <div class="card-label">Active Users</div>
                </div>
                <div class="visual-card card-2">
                    <div class="card-icon">⚡</div>
                    <div class="card-stat">50%</div>
                    <div class="card-label">Time Saved</div>
                </div>
                <div class="visual-card card-3">
                    <div class="card-icon">🎯</div>
                    <div class="card-stat">99.8%</div>
                    <div class="card-label">Accuracy</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content" data-aos="zoom-in">
            <h2 class="cta-title">Ready to Transform Your Construction Projects?</h2>
            <p class="cta-description">
                Join thousands of construction professionals who trust LT Software for their estimation and reporting needs.
            </p>
            <div class="cta-buttons">
                <a href="contact.php" class="btn btn-primary btn-large">Get Started Today</a>
                <a href="#demo" class="btn btn-secondary btn-large">Schedule a Demo</a>
            </div>
            <p class="cta-note">No credit card required • Free 14-day trial • Cancel anytime</p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main.js"></script>
