<?php
require_once __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';

$errors = [];
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') $errors[] = 'Name is required.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
    if ($message === '') $errors[] = 'Please enter a message.';

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare('INSERT INTO contacts (name, email, message, created_at) VALUES (?, ?, ?, NOW())');
            $stmt->execute([$name, $email, $message]);
            $success = true;
            // clear fields
            $name = $email = $message = '';
        } catch (Exception $e) {
            $errors[] = 'Failed to save message. Please try again later.';
        }
    }
}
?>

<h1>Contact Us</h1>
<p>Reach out for demos, quotes, or partnerships.</p>

<?php if ($success): ?>
  <div class="alert alert-success">Thank you — your message has been received.</div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger"><ul>
    <?php foreach ($errors as $e): ?><li><?php echo htmlspecialchars($e); ?></li><?php endforeach; ?>
  </ul></div>
<?php endif; ?>

<form method="post" action="/contact.php">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name ?? ''); ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Message</label>
    <textarea name="message" class="form-control" rows="5"><?php echo htmlspecialchars($message ?? ''); ?></textarea>
  </div>
  <button class="btn btn-primary" type="submit">Send Message</button>
</form>

<?php include __DIR__ . '/includes/footer.php'; ?>