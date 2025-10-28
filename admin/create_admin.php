<?php
// One-time admin creation helper. Delete this file after creating an admin for security.
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';


$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    $message = 'Invalid request.';
  } else {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') {
      $message = 'Username and password are required.';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('INSERT INTO admin_users (username, password) VALUES (?, ?)');
      $stmt->execute([$username, $hash]);
      $message = 'Admin created. Please delete this file (admin/create_admin.php) after use.';
    }
  }
}
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Create Admin - LT Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h1>Create Admin (one-time)</h1>
    <?php if ($message): ?><div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
    <form method="post">
      <?php echo csrf_input(); ?>
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="password" type="password" class="form-control" required>
      </div>
      <button class="btn btn-primary" type="submit">Create Admin</button>
    </form>
  </div>
</body>
</html>