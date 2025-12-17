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
                                <?php 
                                // Truncate content for preview
                                $content = $news['content'];
                                $truncated = strlen($content) > 300 ? substr($content, 0, 300) . '...' : $content;
                                echo nl2br(htmlspecialchars($truncated));
                                ?>
                                <button class="read-more-link" onclick="openNewsModal(<?php echo $news['id']; ?>)">Read More</button>
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

<!-- News Modal -->
<div id="newsModal" class="news-modal">
  <div class="news-modal-content">
    <div class="news-modal-header">
      <h2 id="modalTitle">News Title</h2>
      <button class="news-modal-close" onclick="closeNewsModal()">&times;</button>
    </div>
    <div class="news-modal-body" id="modalBody">
      <!-- Modal content will be loaded here -->
    </div>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main.js"></script>
<script>
// News Modal Functions
function openNewsModal(newsId) {
  // Fetch news content via AJAX
  fetch('get_news_modal.php?id=' + newsId)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const news = data.data;
        
        // Update modal content
        document.getElementById('modalTitle').textContent = news.title;
        
        let modalContent = '<p class="news-modal-date">' + news.created_at + '</p>';
        
        if (news.featured_image) {
          modalContent += '<div class="news-modal-image">';
          modalContent += '<img src="' + news.featured_image + '" alt="' + news.title + '">';
          modalContent += '</div>';
        }
        
        modalContent += '<p>' + news.content.replace(/\n/g, '<br>') + '</p>';
        
        if (news.additional_images && news.additional_images.length > 0) {
          modalContent += '<div class="news-modal-additional-images">';
          news.additional_images.forEach(image => {
            modalContent += '<img src="' + image.image_path + '" alt="' + news.title + ' additional image">';
          });
          modalContent += '</div>';
        }
        
        document.getElementById('modalBody').innerHTML = modalContent;
        
        // Show modal
        const modal = document.getElementById('newsModal');
        modal.classList.add('active');
        
        // Prevent body scroll when modal is open
        document.body.style.overflow = 'hidden';
      }
    })
    .catch(error => {
      console.error('Error fetching news:', error);
    });
}

function closeNewsModal() {
  const modal = document.getElementById('newsModal');
  modal.classList.remove('active');
  
  // Restore body scroll
  document.body.style.overflow = '';
}

// Close modal when clicking outside
document.getElementById('newsModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeNewsModal();
  }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeNewsModal();
  }
});

    // Real-time news updates
    let latestTimestamp = null;
    
    function updateNews() {
      fetch('get_latest_news.php' + (latestTimestamp ? '?last_timestamp=' + encodeURIComponent(latestTimestamp) : ''))
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update the latest timestamp
            if (data.latest_timestamp) {
              latestTimestamp = data.latest_timestamp;
            }
            
            // Update the news grid if there are new items
            if (data.data.length > 0) {
              const newsGrid = document.querySelector('.news-grid-page');
              if (newsGrid) {
                // Clear existing content
                newsGrid.innerHTML = '';
                
                // Add new content
                data.data.forEach((news, index) => {
                  const newsCard = `
                    <article class="news-article-card" data-aos="fade-up" data-aos-delay="${index * 100}">
                      <div class="news-article-image">
                        ${news.featured_image ? `<img src="${news.featured_image}" alt="${news.title}">` : ''}
                        
                        ${news.additional_images && news.additional_images.length > 0 ? 
                          `<div class="news-article-additional-images">
                            ${news.additional_images.map(img => `<img src="${img.image_path}" alt="${news.title} additional image">`).join('')}
                          </div>` : ''}
                      </div>
                      
                      <div class="news-article-header">
                        <h2 class="news-article-title">${news.title}</h2>
                        <time class="news-article-date">${news.formatted_date}</time>
                      </div>
                      
                      <div class="news-article-content">
                        ${news.truncated_content.replace(/\n/g, '<br>')}
                        <button class="read-more-link" onclick="openNewsModal(${news.id})">Read More</button>
                      </div>
                      
                      <div class="news-article-footer">
                        <span class="news-category">Press Release</span>
                      </div>
                    </article>
                  `;
                  newsGrid.innerHTML += newsCard;
                });
                
                // Reinitialize AOS animations
                if (typeof AOS !== 'undefined') {
                  AOS.refresh();
                }
              }
            }
          }
        })
        .catch(error => {
          console.error('Error fetching latest news:', error);
        });
    }
    
    // Start polling for updates every 30 seconds
    setInterval(updateNews, 30000);
  </script>
