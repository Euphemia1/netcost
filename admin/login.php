<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
session_start();
$errors = [];

// Simple rate-limiting: check lock
$lockedFor = is_login_locked();
if ($lockedFor > 0) {
  $errors[] = 'Too many failed attempts. Try again in ' . ceil($lockedFor/60) . ' minute(s).';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check CSRF
  if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    $errors[] = 'Invalid request. Please try again.';
  } else {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
      $errors[] = 'Username and password are required.';
    } else {
      $stmt = $pdo->prepare('SELECT id, username, password_hash FROM admins WHERE username = ? LIMIT 1');
      $stmt->execute([$username]);
      $admin = $stmt->fetch();
      if ($admin && password_verify($password, $admin['password_hash'])) {
        login_attempts_reset();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: /admin/dashboard.php');
        exit;
      } else {
        login_attempt_failed();
        $errors[] = 'Invalid credentials.';
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login - LT Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title mb-3">Admin Login</h3>
            <?php if (!empty($errors)): ?>
              <div class="alert alert-danger"><?php echo htmlspecialchars(implode('<br>', $errors)); ?></div>
            <?php endif; ?>
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
              <button class="btn btn-primary" type="submit">Login</button>
              <a class="btn btn-link" href="/">Back to site</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>