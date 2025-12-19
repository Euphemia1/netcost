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
        
        // Create slideshow if there are images
        if (allImages.length > 0) {
          if (allImages.length > 1) {
            // Create slideshow for multiple images
            modalContent += '<div class="news-modal-slideshow">';
            modalContent += '  <div class="slideshow-container">';
            
            allImages.forEach((image, index) => {
              modalContent += '    <div class="slide fade" style="' + (index === 0 ? 'display: block;' : 'display: none;') + '">';
              modalContent += '      <img src="' + image + '" alt="' + news.title + ' image ' + (index + 1) + '">';
              modalContent += '    </div>';
            });
            
            // Navigation dots
            modalContent += '    <div class="slideshow-dots">';
            allImages.forEach((_, index) => {
              modalContent += '      <span class="dot ' + (index === 0 ? 'active' : '') + '" onclick="currentSlide(' + (index + 1) + ')"></span>';
            });
            modalContent += '    </div>';
            
            // Navigation arrows
            modalContent += '    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>';
            modalContent += '    <a class="next" onclick="plusSlides(1)">&#10095;</a>';
            
            modalContent += '  </div>';
            modalContent += '</div>';
          } else {
            // Single image display
            modalContent += '<div class="news-modal-image">';
            modalContent += '  <img src="' + allImages[0] + '" alt="' + news.title + '">';
            modalContent += '</div>';
          }
        }
        
        modalContent += '<p>' + news.content.replace(/\n/g, '<br>') + '</p>';
        
        document.getElementById('modalBody').innerHTML = modalContent;
        
        // Show modal
        const modal = document.getElementById('newsModal');
        modal.classList.add('active');
        
        // Prevent body scroll when modal is open
        document.body.style.overflow = 'hidden';
        
        // Initialize slideshow if needed
        if (allImages.length > 1) {
          initSlideshow();
        }
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

// Real-time news updates using Server-Sent Events
function initializeNewsUpdates() {
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
          const newsCard = `
            <article class="news-article-card" data-news-id="${news.id}" data-aos="fade-up" data-aos-delay="0">
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
          
          // Add new news item to the top of the grid
          const newsGrid = document.querySelector('.news-grid-page');
          if (newsGrid) {
            newsGrid.insertAdjacentHTML('afterbegin', newsCard);
            
            // Reinitialize AOS animations
            if (typeof AOS !== 'undefined') {
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
  }
}

// Slideshow functions
let slideIndex = 1;

function initSlideshow() {
  showSlides(slideIndex);
}

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  const slides = document.querySelectorAll('#newsModal .slide');
  const dots = document.querySelectorAll('#newsModal .dot');
  
  if (slides.length === 0) return;
  
  if (n > slides.length) { slideIndex = 1; }
  if (n < 1) { slideIndex = slides.length; }
  
  // Hide all slides
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none';
  }
  
  // Remove active class from all dots
  for (let i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(' active', '');
  }
  
  // Show current slide and mark dot as active
  slides[slideIndex - 1].style.display = 'block';
  if (dots[slideIndex - 1]) {
    dots[slideIndex - 1].className += ' active';
  }
}

// Initialize real-time updates when page loads
initializeNewsUpdates();
</script>
