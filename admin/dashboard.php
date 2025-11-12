<?php
session_start();

// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/db.php';

// Create upload directory if it doesn't exist
$upload_dir = '../assets/media/news/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle news operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $featured_image = '';
            
            // Handle image upload
            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['featured_image']['tmp_name'];
                $file_name = basename($_FILES['featured_image']['name']);
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // Allowed extensions
                $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                
                if (in_array($file_ext, $allowed_ext)) {
                    // Generate unique filename
                    $new_filename = uniqid('news_') . '.' . $file_ext;
                    $file_path = $upload_dir . $new_filename;
                    
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        $featured_image = 'assets/media/news/' . $new_filename;
                    }
                }
            }
            
            if ($title && $content) {
                $stmt = $pdo->prepare('INSERT INTO news (title, content, featured_image, created_at) VALUES (?, ?, ?, NOW())');
                $stmt->execute([$title, $content, $featured_image]);
                // Redirect to dashboard after successful insert
                header('Location: dashboard.php');
                exit;
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                // Fetch image to delete
                $stmt = $pdo->prepare('SELECT featured_image FROM news WHERE id = ?');
                $stmt->execute([$id]);
                $news = $stmt->fetch();
                
                if ($news && $news['featured_image']) {
                    $file_path = str_replace('assets/media/news/', '../assets/media/news/', $news['featured_image']);
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
                
                $stmt = $pdo->prepare('DELETE FROM news WHERE id = ?');
                $stmt->execute([$id]);
                // Redirect to dashboard after successful delete
                header('Location: dashboard.php');
                exit;
            }
        } elseif ($_POST['action'] === 'edit') {
            $id = (int)($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            
            if ($id > 0 && $title && $content) {
                $featured_image = $_POST['current_image'] ?? '';
                
                // Handle new image upload
                if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                    $file_tmp = $_FILES['featured_image']['tmp_name'];
                    $file_name = basename($_FILES['featured_image']['name']);
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    
                    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    
                    if (in_array($file_ext, $allowed_ext)) {
                        // Delete old image
                        if ($featured_image) {
                            $old_file = str_replace('assets/media/news/', '../assets/media/news/', $featured_image);
                            if (file_exists($old_file)) {
                                unlink($old_file);
                            }
                        }
                        
                        // Upload new image
                        $new_filename = uniqid('news_') . '.' . $file_ext;
                        $file_path = $upload_dir . $new_filename;
                        
                        if (move_uploaded_file($file_tmp, $file_path)) {
                            $featured_image = 'assets/media/news/' . $new_filename;
                        }
                    }
                }
                
                $stmt = $pdo->prepare('UPDATE news SET title = ?, content = ?, featured_image = ? WHERE id = ?');
                $stmt->execute([$title, $content, $featured_image, $id]);
                // Redirect to dashboard after successful update
                header('Location: dashboard.php?status=updated');
                exit;
            }
        }
    }
}

// Pagination settings
$items_per_page = 6;
$current_page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($current_page - 1) * $items_per_page;

// Get total count of news items
$stmt = $pdo->prepare('SELECT COUNT(DISTINCT id) as total FROM news');
$stmt->execute();
$total_count = $stmt->fetch()['total'];
$total_pages = ceil($total_count / $items_per_page);

// Ensure current page doesn't exceed total pages
$current_page = min($current_page, max(1, $total_pages));
$offset = ($current_page - 1) * $items_per_page;

// Fetch news with pagination (with DISTINCT to prevent duplicates)
$stmt = $pdo->prepare('SELECT DISTINCT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC LIMIT ? OFFSET ?');
$stmt->execute([$items_per_page, $offset]);
$news_result = $stmt->fetchAll();

// Fetch contacts
$stmt = $pdo->prepare('SELECT id, name, email, phone, company, message, created_at FROM contacts ORDER BY created_at DESC LIMIT 10');
$stmt->execute();
$contacts_result = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - LT Software</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <h2>LT Software</h2>
                <p>Admin Panel</p>
            </div>

            <nav class="admin-nav">
                <a href="#news" class="admin-nav-item active">News Flash</a>
                <!-- <a href="#contacts" class="admin-nav-item">Contact Messages</a> -->
                <a href="logout.php" class="admin-nav-item">Logout</a>
            </nav>

        </aside>
        
        <main class="admin-main">
            <header class="admin-header">
                <h1>Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></p>
            </header>
            
            <?php 
            // Display success messages (only for updated status)
            if (isset($_GET['status']) && $_GET['status'] === 'updated'):
            ?>
            <div class="alert alert-success">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 10L9 13L14 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Article updated successfully!
            </div>
            <?php endif; ?>
            
            <section id="news" class="admin-section">
                <div class="section-header">
                    <h2>News Flash Management</h2>
                    <button class="btn btn-primary" onclick="showAddNewsModal()">Add News</button>
                </div>
                
                <div class="news-grid">
                    <?php foreach ($news_result as $news): ?>
                        <div class="news-card">
                            <?php if ($news['featured_image']): ?>
                                <div class="news-card-image">
                                    <img src="<?php echo htmlspecialchars($news['featured_image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                                </div>
                            <?php endif; ?>
                            <h3><?php echo htmlspecialchars($news['title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($news['content'], 0, 100)) . (strlen($news['content']) > 100 ? '...' : ''); ?></p>
                            <div class="news-meta">
                                <span><?php echo date('M d, Y', strtotime($news['created_at'])); ?></span>
                                <div class="news-actions">
                                    <button onclick="editNews(<?php echo $news['id']; ?>, '<?php echo addslashes($news['title']); ?>', '<?php echo addslashes($news['content']); ?>', '<?php echo htmlspecialchars($news['featured_image']); ?>')" class="btn-icon">Edit</button>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
                                        <button type="submit" class="btn-icon" onclick="return confirm('Delete this news item?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination Controls -->
                <div class="pagination">
                    <?php if ($current_page > 1): ?>
                        <a href="dashboard.php?page=1" class="pagination-btn">First</a>
                        <a href="dashboard.php?page=<?php echo $current_page - 1; ?>" class="pagination-btn">← Previous</a>
                    <?php else: ?>
                        <button class="pagination-btn disabled">First</button>
                        <button class="pagination-btn disabled">← Previous</button>
                    <?php endif; ?>
                    
                    <span class="pagination-info">
                        Page <strong><?php echo $current_page; ?></strong> of <strong><?php echo $total_pages; ?></strong>
                    </span>
                    
                    <?php if ($current_page < $total_pages): ?>
                        <a href="dashboard.php?page=<?php echo $current_page + 1; ?>" class="pagination-btn">Next →</a>
                        <a href="dashboard.php?page=<?php echo $total_pages; ?>" class="pagination-btn">Last</a>
                    <?php else: ?>
                        <button class="pagination-btn disabled">Next →</button>
                        <button class="pagination-btn disabled">Last</button>
                    <?php endif; ?>
                </div>
            </section>
            
            <!-- <section id="contacts" class="admin-section">
                <h2>Recent Contact Messages</h2>
                
                <div class="table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody> -->
                            <?php foreach ($contacts_result as $contact): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                    <td><?php echo htmlspecialchars($contact['company']); ?></td>
                                    <td><?php echo htmlspecialchars(substr($contact['message'], 0, 50)) . '...'; ?></td>
                                    <td><?php echo date('M d, Y', strtotime($contact['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    

    <!-- Add/Edit News Modal -->
    <div id="newsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add News</h2>
                <button class="modal-close" onclick="closeNewsModal()">&times;</button>
            </div>
            <form method="POST" id="newsForm" enctype="multipart/form-data">
                <input type="hidden" name="action" id="newsAction" value="add">
                <input type="hidden" name="id" id="newsId">
                <input type="hidden" name="current_image" id="currentImage">
                
                <div class="form-group">
                    <label for="newsTitle">Title *</label>
                    <input type="text" id="newsTitle" name="title" required>
                    <small>Make it bold and engaging!</small>
                </div>
                
                <div class="form-group">
                    <label for="newsContent">Content *</label>
                    <textarea id="newsContent" name="content" rows="6" required placeholder="Write your article here..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="featuredImage">Featured Image (JPG, PNG, GIF, WebP)</label>
                    <div class="image-upload-wrapper">
                        <input type="file" id="featuredImage" name="featured_image" accept=".jpg,.jpeg,.png,.gif,.webp" onchange="previewImage(event)">
                        <div id="imagePreview" class="image-preview"></div>
                    </div>
                    <small>Recommended size: 600x400px</small>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeNewsModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="../assets/js/admin.js"></script>
</body>
</html>
