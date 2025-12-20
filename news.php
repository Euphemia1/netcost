<?php 
include 'includes/db.php';

// Pagination settings
$items_per_page = 6;
$current_page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($current_page - 1) * $items_per_page;

// Get total count of news items
$stmt = $pdo->prepare('SELECT COUNT(id) as total FROM news');
$stmt->execute();
$total_count = $stmt->fetch()['total'];
$total_pages = ceil($total_count / $items_per_page);

// Ensure current page doesn't exceed total pages
$current_page = min($current_page, max(1, $total_pages));
$offset = ($current_page - 1) * $items_per_page;

// Fetch news with pagination
$stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC LIMIT ? OFFSET ?');
$stmt->execute([$items_per_page, $offset]);
$news_items = $stmt->fetchAll();

// Fetch additional images for each news item
foreach ($news_items as &$news_item) {
    $stmt = $pdo->prepare('SELECT image_path FROM news_images WHERE news_id = ? ORDER BY sort_order');
    $stmt->execute([$news_item['id']]);
    $news_item['additional_images'] = $stmt->fetchAll();
    
    // Fetch videos for each news item
    $stmt = $pdo->prepare('SELECT video_path FROM news_videos WHERE news_id = ? ORDER BY sort_order');
    $stmt->execute([$news_item['id']]);
    $news_item['videos'] = $stmt->fetchAll();
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
                        <article class="news-article-card" data-news-id="<?php echo $news['id']; ?>" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
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
                
                <!-- Pagination Controls -->
                <?php if ($total_pages > 1): ?>
                <div class="pagination">
                    <?php if ($current_page > 1): ?>
                        <a href="news.php?page=1" class="pagination-btn">First</a>
                        <a href="news.php?page=<?php echo $current_page - 1; ?>" class="pagination-btn">← Previous</a>
                    <?php else: ?>
                        <button class="pagination-btn disabled">First</button>
                        <button class="pagination-btn disabled">← Previous</button>
                    <?php endif; ?>
                    
                    <span class="pagination-info">
                        Page <strong><?php echo $current_page; ?></strong> of <strong><?php echo $total_pages; ?></strong>
                    </span>
                    
                    <?php if ($current_page < $total_pages): ?>
                        <a href="news.php?page=<?php echo $current_page + 1; ?>" class="pagination-btn">Next →</a>
                        <a href="news.php?page=<?php echo $total_pages; ?>" class="pagination-btn">Last</a>
                    <?php else: ?>
                        <button class="pagination-btn disabled">Next →</button>
                        <button class="pagination-btn disabled">Last</button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-news-message">
                    <div class="no-news-icon">📰</div>
                    <h2>No News Yet</h2>
                    <p>We're busy working on exciting updates for you!</p>
                    <p class="no-news-subtext">Check back soon for the latest developments and announcements from LT Software</p>
                    <a href="index.php" class="btn btn-primary" style="margin-top: 24px;">Back to Home</a>
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
  try {
    // Fetch news content via AJAX
    fetch('get_news_modal.php?id=' + newsId)
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const news = data.data;
          
          // Update modal content
          const modalTitle = document.getElementById('modalTitle');
          const modalBody = document.getElementById('modalBody');
          
          if (modalTitle) {
            modalTitle.textContent = news.title;
          }
          
          let modalContent = '<p class="news-modal-date">' + news.created_at + '</p>';
          
          // Combine all images (featured + additional) for slideshow
          let allImages = [];
          if (news.featured_image) {
            allImages.push(news.featured_image);
          }
          if (news.additional_images && news.additional_images.length > 0) {
            news.additional_images.forEach(img => {
              allImages.push(img.image_path);
            });
          }
          
          // Get videos
          let allVideos = [];
          if (news.videos && news.videos.length > 0) {
            news.videos.forEach(video => {
              allVideos.push(video.video_path);
            });
          }
          
          // Create slideshow if there are images or videos
          if (allImages.length > 0 || allVideos.length > 0) {
            if (allImages.length + allVideos.length > 1) {
              // Create slideshow for multiple items (images and videos)
              modalContent += '<div class="news-modal-slideshow">';
              modalContent += '  <div class="slideshow-container">';
              
              // Add images to slideshow
              allImages.forEach((image, index) => {
                modalContent += '    <div class="slide fade" style="' + (index === 0 && allVideos.length === 0 ? 'display: block;' : 'display: none;') + '">';
                modalContent += '      <img src="' + image + '" alt="' + news.title + ' image ' + (index + 1) + '">';
                modalContent += '    </div>';
              });
              
              // Add videos to slideshow
              allVideos.forEach((video, index) => {
                const imageIndex = allImages.length + index;
                modalContent += '    <div class="slide fade" style="' + (imageIndex === 0 ? 'display: block;' : 'display: none;') + '">';
                modalContent += '      <video controls width="100%" height="auto">';
                modalContent += '        <source src="' + video + '" type="video/mp4">';
                modalContent += '        Your browser does not support the video tag.';
                modalContent += '      </video>';
                modalContent += '    </div>';
              });
              
              // Navigation dots
              modalContent += '    <div class="slideshow-dots">';
              for (let i = 0; i < allImages.length + allVideos.length; i++) {
                modalContent += '      <span class="dot ' + (i === 0 ? 'active' : '') + '" onclick="currentSlide(' + (i + 1) + ')"></span>';
              }
              modalContent += '    </div>';
              
              // Navigation arrows
              modalContent += '    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>';
              modalContent += '    <a class="next" onclick="plusSlides(1)">&#10095;</a>';
              
              modalContent += '  </div>';
              modalContent += '</div>';
            } else {
              // Single item display (either image or video)
              if (allImages.length > 0) {
                // Single image display
                modalContent += '<div class="news-modal-image">';
                modalContent += '  <img src="' + allImages[0] + '" alt="' + news.title + '">';
                modalContent += '</div>';
              } else if (allVideos.length > 0) {
                // Single video display
                modalContent += '<div class="news-modal-video">';
                modalContent += '  <video controls width="100%" height="auto">';
                modalContent += '    <source src="' + allVideos[0] + '" type="video/mp4">';
                modalContent += '    Your browser does not support the video tag.';
                modalContent += '  </video>';
                modalContent += '</div>';
              }
            }
          }
          
          modalContent += '<p>' + news.content.replace(/\n/g, '<br>') + '</p>';
          
          if (modalBody) {
            modalBody.innerHTML = modalContent;
          }
          
          // Show modal
          const modal = document.getElementById('newsModal');
          if (modal) {
            modal.classList.add('active');
          }
          
          // Prevent body scroll when modal is open
          document.body.style.overflow = 'hidden';
          
          // Initialize slideshow if needed
          if (allImages.length > 1) {
            slideIndex = 1;
            showSlides(slideIndex);
          } else {
            // Reset slideIndex for single images
            slideIndex = 1;
          }
        }
      })
      .catch(error => {
        console.error('Error fetching news:', error);
      });
  } catch (e) {
    console.error('Error opening news modal:', e);
  }
}

function closeNewsModal() {
  try {
    const modal = document.getElementById('newsModal');
    if (modal) {
      modal.classList.remove('active');
    }
    
    // Restore body scroll
    document.body.style.overflow = '';
  } catch (e) {
    console.error('Error closing modal:', e);
  }
}

// Close modal when clicking outside
const modalElement = document.getElementById('newsModal');
if (modalElement) {
  modalElement.addEventListener('click', function(e) {
    if (e.target === this) {
      closeNewsModal();
    }
  });
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeNewsModal();
  }
});

// Real-time news updates using Server-Sent Events
function initializeNewsUpdates() {
  try {
    // Check if EventSource is supported
    if (typeof(EventSource) !== "undefined") {
      // Create EventSource connection
      const eventSource = new EventSource("news_updates_sse.php");
      
      // Handle news updates
      eventSource.addEventListener('news_update', function(event) {
        try {
          const news = JSON.parse(event.data);
          
          // Check if this news item already exists to prevent duplicates
          const existingNewsItems = document.querySelectorAll('.news-article-card');
          let alreadyExists = false;
          
          for (let i = 0; i < existingNewsItems.length; i++) {
            const newsId = existingNewsItems[i].getAttribute('data-news-id');
            if (newsId && parseInt(newsId) === parseInt(news.id)) {
              alreadyExists = true;
              break;
            }
          }
          
          // Only add if it doesn't already exist
          if (!alreadyExists) {
            // Create news card HTML
            let newsCardHTML = '<article class="news-article-card" data-news-id="' + news.id + '" data-aos="fade-up" data-aos-delay="0">';
            
            // Image section
            newsCardHTML += '<div class="news-article-image">';
            if (news.featured_image) {
              newsCardHTML += '<img src="' + news.featured_image + '" alt="' + news.title + '">';
            }
            
            // Additional images
            if (news.additional_images && news.additional_images.length > 0) {
              newsCardHTML += '<div class="news-article-additional-images">';
              for (let i = 0; i < news.additional_images.length; i++) {
                newsCardHTML += '<img src="' + news.additional_images[i].image_path + '" alt="' + news.title + ' additional image">';
              }
              newsCardHTML += '</div>';
            }
            
            // Videos indicator
            if (news.videos && news.videos.length > 0) {
              newsCardHTML += '<div class="news-article-videos-indicator">';
              newsCardHTML += '<span class="video-icon">▶</span>';
              newsCardHTML += '<span class="video-count">' + news.videos.length + ' video(s)</span>';
              newsCardHTML += '</div>';
            }
            newsCardHTML += '</div>';
            
            // Header section
            newsCardHTML += '<div class="news-article-header">';
            newsCardHTML += '<h2 class="news-article-title">' + news.title + '</h2>';
            // Format date properly
            const newsDate = new Date(news.created_at);
            const formattedDate = newsDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            newsCardHTML += '<time class="news-article-date">' + formattedDate + '</time>';
            newsCardHTML += '</div>';
            
            // Content section
            newsCardHTML += '<div class="news-article-content">';
            // Truncate content for preview
            const content = news.content;
            const truncatedContent = content.length > 300 ? content.substring(0, 300) + '...' : content;
            newsCardHTML += truncatedContent.replace(/\n/g, '<br>');
            newsCardHTML += '<button class="read-more-link" onclick="openNewsModal(' + news.id + ')">Read More</button>';
            newsCardHTML += '</div>';
            
            // Footer section
            newsCardHTML += '<div class="news-article-footer">';
            newsCardHTML += '<span class="news-category">Press Release</span>';
            newsCardHTML += '</div>';
            
            newsCardHTML += '</article>';
            
            // Add new news item to the top of the grid
            const newsGrid = document.querySelector('.news-grid-page');
            if (newsGrid) {
              newsGrid.insertAdjacentHTML('afterbegin', newsCardHTML);
              
              // Reinitialize AOS animations
              if (typeof AOS !== 'undefined' && AOS.refresh) {
                AOS.refresh();
              }
            }
          }
        } catch (e) {
          console.error('Error processing news update:', e);
        }
      });
      
      // Handle errors
      eventSource.addEventListener('error', function(event) {
        console.error('SSE error occurred:', event);
      });
      
      // Handle connection opened
      eventSource.addEventListener('open', function(event) {
        console.log('SSE connection opened');
      });
      
      // Handle heartbeat
      eventSource.addEventListener('heartbeat', function(event) {
        console.log('SSE heartbeat received:', event.data);
      });
    } else {
      // Fallback to polling if SSE is not supported
      console.warn('Server-Sent Events not supported, falling back to polling');
      
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
                  // Process each new item
                  data.data.forEach((news, index) => {
                    // Check if this news item already exists to prevent duplicates
                    const existingNewsItems = document.querySelectorAll('.news-article-card');
                    let alreadyExists = false;
                    
                    for (let i = 0; i < existingNewsItems.length; i++) {
                      const newsId = existingNewsItems[i].getAttribute('data-news-id');
                      if (newsId && parseInt(newsId) === parseInt(news.id)) {
                        alreadyExists = true;
                        break;
                      }
                    }
                    
                    // Only add if it doesn't already exist
                    if (!alreadyExists) {
                      // Create news card HTML
                      let newsCardHTML = '<article class="news-article-card" data-news-id="' + news.id + '" data-aos="fade-up" data-aos-delay="' + (index * 100) + '">';
                      
                      // Image section
                      newsCardHTML += '<div class="news-article-image">';
                      if (news.featured_image) {
                        newsCardHTML += '<img src="' + news.featured_image + '" alt="' + news.title + '">';
                      }
                      
                      // Additional images
                      if (news.additional_images && news.additional_images.length > 0) {
                        newsCardHTML += '<div class="news-article-additional-images">';
                        for (let i = 0; i < news.additional_images.length; i++) {
                          newsCardHTML += '<img src="' + news.additional_images[i].image_path + '" alt="' + news.title + ' additional image">';
                        }
                        newsCardHTML += '</div>';
                      }
                      
                      // Videos indicator
                      if (news.videos && news.videos.length > 0) {
                        newsCardHTML += '<div class="news-article-videos-indicator">';
                        newsCardHTML += '<span class="video-icon">▶</span>';
                        newsCardHTML += '<span class="video-count">' + news.videos.length + ' video(s)</span>';
                        newsCardHTML += '</div>';
                      }
                      newsCardHTML += '</div>';
                      
                      // Header section
                      newsCardHTML += '<div class="news-article-header">';
                      newsCardHTML += '<h2 class="news-article-title">' + news.title + '</h2>';
                      // Format date properly
                      const newsDate = new Date(news.created_at);
                      const formattedDate = newsDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                      newsCardHTML += '<time class="news-article-date">' + formattedDate + '</time>';
                      newsCardHTML += '</div>';
                      
                      // Content section
                      newsCardHTML += '<div class="news-article-content">';
                      // Truncate content for preview
                      const content = news.content;
                      const truncatedContent = content.length > 300 ? content.substring(0, 300) + '...' : content;
                      newsCardHTML += truncatedContent.replace(/\n/g, '<br>');
                      newsCardHTML += '<button class="read-more-link" onclick="openNewsModal(' + news.id + ')">Read More</button>';
                      newsCardHTML += '</div>';
                      
                      // Footer section
                      newsCardHTML += '<div class="news-article-footer">';
                      newsCardHTML += '<span class="news-category">Press Release</span>';
                      newsCardHTML += '</div>';
                      
                      newsCardHTML += '</article>';
                      
                      newsGrid.insertAdjacentHTML('afterbegin', newsCardHTML);
                    }
                  });
                  
                  // Reinitialize AOS animations
                  if (typeof AOS !== 'undefined' && AOS.refresh) {
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
    }
  } catch (e) {
    console.error('Error initializing news updates:', e);
  }
}

// Slideshow functions
let slideIndex = 1;

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  const slides = document.querySelectorAll('#newsModal .slide');
  const dots = document.querySelectorAll('#newsModal .dot');
  
  // Check if slides exist
  if (slides.length === 0) return;
  
  // Handle slide index boundaries
  if (n > slides.length) { slideIndex = 1; }
  if (n < 1) { slideIndex = slides.length; }
  
  // Hide all slides
  for (let i = 0; i < slides.length; i++) {
    if (slides[i]) {
      slides[i].style.display = 'none';
    }
  }
  
  // Remove active class from all dots
  for (let i = 0; i < dots.length; i++) {
    if (dots[i]) {
      dots[i].className = dots[i].className.replace(' active', '');
    }
  }
  
  // Show current slide and mark dot as active
  const currentIndex = slideIndex - 1;
  if (slides[currentIndex]) {
    slides[currentIndex].style.display = 'block';
  }
  if (dots[currentIndex]) {
    dots[currentIndex].className += ' active';
  }
}

// Initialize real-time updates when page loads
initializeNewsUpdates();
</script>