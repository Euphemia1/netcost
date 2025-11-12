<?php 

header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'includes/header.php';
include 'includes/db.php';

$stmt = $pdo->prepare('SELECT DISTINCT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC');
$stmt->execute();
$news_items = $stmt->fetchAll();
?>

<section class="page-hero">
    <div class="page-hero-content">
        <span class="page-badge">Latest Updates</span>
        <h1 class="page-title">News & Updates</h1>
        <p class="page-description">Stay informed about the latest developments and updates from LT Software</p>
    </div>
</section>

<div class="news-page-wrapper">
    
    <section class="news-page-section no-bottom-space">
        <div class="container">
            <?php if (count($news_items) > 0): ?>
                <div class="news-grid-page">
                    <!-- Social links: Facebook posts highlighting LT Construction -->
                    <div class="news-social-grid">
                        <a class="social-card" href="https://www.facebook.com/share/p/1bYPLhnoGa/" target="_blank" rel="noopener noreferrer">
                            <div class="social-thumb">
                                <img src="assets/media/news/WhatsApp%20Image%202025-11-10%20at%2011.45.47_c6ca47d7.jpg" alt="LT Construction Facebook share">
                            </div>
                            <div class="social-title">LT Construction — Facebook Share</div>
                            <div class="social-meta">Facebook • Share</div>
                        </a>

                        <a class="social-card" href="https://www.facebook.com/100076064542369/posts/802324678979676/?mibextid=rS40aB7S9Ucbxw6v" target="_blank" rel="noopener noreferrer">
                            <div class="social-thumb">
                                <img src="assets/media/news/WhatsApp%20Image%202025-11-10%20at%2011.45.47_c6ca47d7.jpg" alt="LT Construction Facebook post">
                            </div>
                            <div class="social-title">LT Construction — Facebook Post</div>
                            <div class="social-meta">Facebook • Post</div>
                        </a>

                        <a class="social-card" href="https://www.facebook.com/share/v/1FQfL5bnrB/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer">
                            <div class="social-thumb">
                                <img src="assets/media/news/WhatsApp%20Image%202025-11-10%20at%2011.45.47_c6ca47d7.jpg" alt="LT Construction Facebook video share">
                            </div>
                            <div class="social-title">LT Construction — Facebook Video</div>
                            <div class="social-meta">Facebook • Video</div>
                        </a>
                    </div>

                    <!-- Static featured article card: LT Construction feature -->
                    <article class="news-article-card" data-aos="fade-up" data-aos-delay="0">
                        <div class="news-article-image" style="position: relative;">
                            <a href="news/lt-construction-feature.php">
                                <img src="assets/media/news/WhatsApp%20Image%202025-11-10%20at%2011.45.47_c6ca47d7.jpg" alt="LT Construction featured">
                            </a>
                            <!-- LT Construction Logo Overlay -->
                            <div style="position: absolute; top: 12px; right: 12px; background: white; padding: 8px 12px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                <img src="assets/media/LT.svg" alt="LT Construction" style="height: 32px; width: auto; display: block;">
                            </div>
                        </div>
                        <div class="news-article-header">
                            <h2 class="news-article-title"><a href="news/lt-construction-feature.php">LT Construction Featured in National Press</a></h2>
                            <time class="news-article-date">November 10, 2025</time>
                        </div>
                        <div class="news-article-content">
                            <p>LT Construction was recently featured for its adoption of NetCost Estimator to streamline BOQs, tendering and resource planning — <a href="news/lt-construction-feature.php">read more</a>.</p>
                        </div>
                        <div class="news-article-footer">
                            <span class="news-category">Press</span>
                        </div>
                    </article>

                    <?php foreach ($news_items as $index => $news): ?>
                        <article class="news-article-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                            <?php if ($news['featured_image']): ?>
                                <div class="news-article-image">
                                    <img src="<?php echo htmlspecialchars($news['featured_image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                                </div>
                            <?php endif; ?>
                            
                            <div class="news-article-header">
                                <h2 class="news-article-title"><?php echo htmlspecialchars($news['title']); ?></h2>
                                <time class="news-article-date"><?php echo date('F j, Y', strtotime($news['created_at'])); ?></time>
                            </div>
                            
                            <div class="news-article-content">
                                <?php echo nl2br(htmlspecialchars($news['content'])); ?>
                            </div>
                            
                            <div class="news-article-footer">
                                <span class="news-category">Press Release</span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-news-message">
                    <h2>No news items yet</h2>
                    <p>Check back soon for the latest updates from LT Software</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer class="site-footer news-footer">
        <?php include 'includes/footer.php'; ?>
    </footer>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main.js"></script>
