<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
session_start();

if (empty($_SESSION['admin_logged_in'])) {
    header('Location: /admin/login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: /admin/dashboard.php');
    exit;
}

// fetch item
$stmt = $pdo->prepare('SELECT id, title, content, created_at FROM news WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();
if (!$item) {
    header('Location: /admin/dashboard.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Invalid request.';
    } else {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        if ($title === '' || $content === '') {
            $errors[] = 'Title and content are required.';
        } else {
            $stmt = $pdo->prepare('UPDATE news SET title = ?, content = ? WHERE id = ?');
            $stmt->execute([$title, $content, $id]);
            header('Location: /admin/dashboard.php');
            exit;
        }
    }
}


?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit News - LT Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">LT Software Admin</a>
    <div>
      <a class="btn btn-outline-light btn-sm" href="/admin/dashboard.php">Back</a>
      <a class="btn btn-outline-light btn-sm" href="/admin/logout.php">Logout</a>
    </div>
  </div>
</nav>
<div class="container my-4">
  <h1>Edit News</h1>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars(implode(' ', $errors)); ?></div>
  <?php endif; ?>

  <form method="post">
    <?php echo csrf_input(); ?>
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input name="title" class="form-control" value="<?php echo htmlspecialchars($item['title']); ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Content</label>
      <textarea name="content" class="form-control" rows="6" required><?php echo htmlspecialchars($item['content']); ?></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Save Changes</button>
    <a class="btn btn-secondary ms-2" href="/admin/dashboard.php">Cancel</a>
  </form>

</div>
</body>
</html>
