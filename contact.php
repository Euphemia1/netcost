a<?php
include 'includes/db.php';

$success = false;
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
    $company = mysqli_real_escape_string($conn, $_POST['company'] ?? '');
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    $sql = "INSERT INTO contacts (name, email, phone, company, message, created_at) 
            VALUES ('$name', '$email', '$phone', '$company', '$message', NOW())";
    
    if (mysqli_query($conn, $sql)) {
        $success = true;
    } else {
        $error = true;
    }
}

include 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <span class="page-badge">Contact Us</span>
        <h1 class="page-title">Let's Build Something Great Together</h1>
        <p class="page-description">
            Have questions? Want to see a demo? We're here to help.
        </p>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <p>
                    Whether you're interested in our products, need support, or want to explore partnership opportunities,
                    we'd love to hear from you.
                </p>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M3 8L10.89 13.26C11.54 13.67 12.46 13.67 13.11 13.26L21 8M5 19H19C20.1 19 21 18.1 21 17V7C21 5.9 20.1 5 19 5H5C3.9 5 3 5.9 3 7V17C3 18.1 3.9 19 5 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <h3>Email</h3>
                            <p>info@ltsoftware.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M22 16.92V19.92C22 20.51 21.54 21 20.97 21C10.05 21 2 13.95 2 3.03C2 2.46 2.49 2 3.08 2H6.08C6.64 2 7.11 2.44 7.15 3C7.23 4.11 7.43 5.19 7.76 6.22C7.89 6.62 7.78 7.06 7.47 7.37L5.9 8.94C7.51 12.11 10.89 15.49 14.06 17.1L15.63 15.53C15.94 15.22 16.38 15.11 16.78 15.24C17.81 15.57 18.89 15.77 20 15.85C20.56 15.89 21 16.36 21 16.92H22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div>
                            <h3>Phone</h3>
                            <p>+1 (555) 123-4567</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61 3.95 5.32 5.64 3.64C7.32 1.95 9.61 1 12 1C14.39 1 16.68 1.95 18.36 3.64C20.05 5.32 21 7.61 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div>
                            <h3>Office</h3>
                            <p>123 Construction Ave<br>Suite 100<br>San Francisco, CA 94105</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-wrapper">
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.667 5L7.5 14.167L3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Thank you! We'll get back to you soon.
                    </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 10V6M10 14H10.01M18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Something went wrong. Please try again.
                    </div>
                <?php endif; ?>
                
                <form method="POST" class="contact-form" id="contactForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" id="company" name="company">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-large">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
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