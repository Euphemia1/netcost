<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
session_start();

if (empty($_SESSION['admin_logged_in'])) {
  header('Location: /admin/login.php');
  exit;
}

// handle add, delete actions with CSRF verification
$action = $_POST['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    // invalid request
    header('Location: /admin/dashboard.php');
    exit;
  }
  if ($action === 'add') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title !== '' && $content !== '') {
      $stmt = $pdo->prepare('INSERT INTO news (title, content, created_at) VALUES (?, ?, NOW())');
      $stmt->execute([$title, $content]);
    }
    header('Location: /admin/dashboard.php');
    exit;
  }
  if ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
      $stmt = $pdo->prepare('DELETE FROM news WHERE id = ?');
      $stmt->execute([$id]);
    }
    header('Location: /admin/dashboard.php');
    exit;
  }
}

// fetch all news
$stmt = $pdo->query('SELECT id, title, content, created_at FROM news ORDER BY created_at DESC');
$all_news = $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - LT Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">LT Software Admin</a>
    <div>
      <a class="btn btn-outline-light btn-sm" href="/">View Site</a>
      <a class="btn btn-outline-light btn-sm" href="/admin/logout.php">Logout</a>
    </div>
  </div>
</nav>
<div class="container my-4">
  <h1>News Flash - Manage</h1>

  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">Add News Item</h5>
      <form method="post">
        <?php echo csrf_input(); ?>
        <input type="hidden" name="action" value="add">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input name="title" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Content</label>
          <textarea name="content" class="form-control" rows="4" required></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Add</button>
      </form>
    </div>
  </div>

  <h2>Existing Items</h2>
  <?php if (empty($all_news)): ?>
    <p class="text-muted">No news items found.</p>
  <?php else: ?>
    <div class="list-group">
      <?php foreach ($all_news as $n): ?>
        <div class="list-group-item">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1"><?php echo htmlspecialchars($n['title']); ?></h5>
            <small><?php echo htmlspecialchars($n['created_at']); ?></small>
          </div>
          <p class="mb-1"><?php echo nl2br(htmlspecialchars($n['content'])); ?></p>
          <a class="btn btn-sm btn-secondary me-2" href="/admin/edit_news.php?id=<?php echo (int)$n['id']; ?>">Edit</a>
          <form method="post" class="d-inline">
            <?php echo csrf_input(); ?>
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo (int)$n['id']; ?>">
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</div>
</body>
</html>