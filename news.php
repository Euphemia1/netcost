<?php 
// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

include 'includes/header.php';
include 'includes/db.php';

$stmt = $pdo->prepare('SELECT DISTINCT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC');
$stmt->execute();
$news_items = $stmt->fetchAll();
?>

<!-- Page Hero Section -->
<section class="page-hero">
    <div class="page-hero-content">
        <span class="page-badge">Latest Updates</span>
        <h1 class="page-title">News & Updates</h1>
        <p class="page-description">Stay informed about the latest developments and updates from LT Software</p>
    </div>
</section>

<!-- Page Wrapper -->
<div class="news-page-wrapper">
    <!-- News Section -->
    <section class="news-page-section no-bottom-space">
        <div class="container">
            <?php if (count($news_items) > 0): ?>
                <div class="news-grid-page">
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

    <!-- Footer -->
    <footer class="site-footer news-footer">
        <?php include 'includes/footer.php'; ?>
    </footer>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main.js"></script>
