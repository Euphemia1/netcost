<?php 
include 'includes/db.php';

// Fetch all news items ordered by creation date (newest first)
$stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC');
$stmt->execute();
$news_items = $stmt->fetchAll();

// Fetch additional images for each news item
foreach ($news_items as &$news_item) {
    $stmt = $pdo->prepare('SELECT image_path FROM news_images WHERE news_id = ? ORDER BY sort_order');
    $stmt->execute([$news_item['id']]);
    $news_item['additional_images'] = $stmt->fetchAll();
}
unset($news_item); // Break the reference

include 'includes/header.php';
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
                    <?php foreach ($news_items as $index => $news): ?>
                        <article class="news-article-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                            <div class="news-article-image">
                                <?php if ($news['featured_image']): ?>
                                    <img src="<?php echo htmlspecialchars($news['featured_image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                                <?php endif; ?>
                                
                                <?php if (!empty($news['additional_images'])): ?>
                                    <div class="news-article-additional-images">
                                        <?php foreach ($news['additional_images'] as $image): ?>
                                            <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?> additional image">
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
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
                    <div class="no-news-icon">📰</div>
                    <h2>No News Yet</h2>
                    <p>We're busy working on exciting updates for you!</p>
                    <p class="no-news-subtext">Check back soon for the latest developments and announcements from LT Software</p>
                    <a href="<?php echo $base_path; ?>index.php" class="btn btn-primary" style="margin-top: 24px;">Back to Home</a>
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
