<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include '../includes/db.php';

// Handle news operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            if ($title && $content) {
                $stmt = $pdo->prepare('INSERT INTO news (title, content, created_at) VALUES (?, ?, NOW())');
                $stmt->execute([$title, $content]);
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $stmt = $pdo->prepare('DELETE FROM news WHERE id = ?');
                $stmt->execute([$id]);
            }
        } elseif ($_POST['action'] === 'edit') {
            $id = (int)($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            if ($id > 0 && $title && $content) {
                $stmt = $pdo->prepare('UPDATE news SET title = ?, content = ? WHERE id = ?');
                $stmt->execute([$title, $content, $id]);
            }
        }
    }
}

// Fetch news
$stmt = $pdo->prepare('SELECT id, title, content, created_at FROM news ORDER BY created_at DESC');
$stmt->execute();
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
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="admin-body">
    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <h2>LT Software</h2>
                <p>Admin Panel</p>
            </div>
            
            <!-- <nav class="admin-nav">
                <a href="#news" class="admin-nav-item active">News Flash</a>
                <a href="#contacts" class="admin-nav-item">Contact Messages</a>
                <a href="logout.php" class="admin-nav-item">Logout</a>
            </nav> -->
        </aside>
        
        <main class="admin-main">
            <header class="admin-header">
                <h1>Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></p>
            </header>
            
            <section id="news" class="admin-section">
                <div class="section-header">
                    <h2>News Flash Management</h2>
                    <button class="btn btn-primary" onclick="showAddNewsModal()">Add News</button>
                </div>
                
                <div class="news-grid">
                    <?php foreach ($news_result as $news): ?>
                        <div class="news-card">
                            <h3><?php echo htmlspecialchars($news['title']); ?></h3>
                            <p><?php echo htmlspecialchars($news['content']); ?></p>
                            <div class="news-meta">
                                <span><?php echo date('M d, Y', strtotime($news['created_at'])); ?></span>
                                <div class="news-actions">
                                    <button onclick="editNews(<?php echo $news['id']; ?>, '<?php echo addslashes($news['title']); ?>', '<?php echo addslashes($news['content']); ?>')" class="btn-icon">Edit</button>
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
            </section>
            
            <section id="contacts" class="admin-section">
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
                        <tbody>
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
            <form method="POST" id="newsForm">
                <input type="hidden" name="action" id="newsAction" value="add">
                <input type="hidden" name="id" id="newsId">
                
                <div class="form-group">
                    <label for="newsTitle">Title</label>
                    <input type="text" id="newsTitle" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="newsContent">Content</label>
                    <textarea id="newsContent" name="content" rows="4" required></textarea>
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
