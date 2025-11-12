<?php
session_start();
include '../includes/db.php';

// Ensure admin_login_logs table exists (safe create)
function ensure_admin_login_logs_table($pdo)
{
    try {
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS admin_login_logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NULL,
                ip_address VARCHAR(45) NOT NULL,
                status VARCHAR(20) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );
    } catch (PDOException $e) {
        // If creation fails, write to error log and continue - logging is best-effort
        error_log('Failed to ensure admin_login_logs table: ' . $e->getMessage());
    }
}

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Initialize variables
$error = false;
$error_message = '';
$login_attempts = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] : 0;
$last_attempt = isset($_SESSION['last_attempt']) ? $_SESSION['last_attempt'] : 0;

// Check if user is temporarily locked out
$lockout_duration = 900; // 15 minutes
if ($login_attempts >= 5 && (time() - $last_attempt) < $lockout_duration) {
    $wait_time = $lockout_duration - (time() - $last_attempt);
    $error = true;
    $error_message = "Too many failed attempts. Please try again in " . ceil($wait_time / 60) . " minutes.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Reset attempts if lockout period has passed
    if ($login_attempts >= 5 && (time() - $last_attempt) >= $lockout_duration) {
        $_SESSION['login_attempts'] = 0;
        $login_attempts = 0;
    }

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = true;
        $error_message = "Please enter both username and password.";
    } else {
        // Add delay to prevent brute force attacks
        usleep(random_int(100000, 500000)); // 0.1 to 0.5 seconds

    // select status as well; remove stray comma
    $stmt = $pdo->prepare('SELECT id, username, password, status FROM admin_users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && $user['status'] === 'active' && password_verify($password, $user['password'])) {
            // Reset login attempts on successful login
            $_SESSION['login_attempts'] = 0;
            
            // Set session variables
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            
            // Set session expiry
            $_SESSION['last_activity'] = time();
            $_SESSION['expire_time'] = 3600; // 1 hour
            
            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);
            
            // Log successful login (best-effort)
            $ip = $_SERVER['REMOTE_ADDR'];
            try {
                $stmt = $pdo->prepare('INSERT INTO admin_login_logs (user_id, ip_address, status) VALUES (?, ?, "success")');
                $stmt->execute([$user['id'], $ip]);
            } catch (PDOException $e) {
                // If table doesn't exist, try to create it then retry once
                if ($e->getCode() === '42S02' || stripos($e->getMessage(), '1146') !== false) {
                    ensure_admin_login_logs_table($pdo);
                    try {
                        $stmt = $pdo->prepare('INSERT INTO admin_login_logs (user_id, ip_address, status) VALUES (?, ?, "success")');
                        $stmt->execute([$user['id'], $ip]);
                    } catch (Exception $e2) {
                        error_log('admin_login_logs insert failed after create: ' . $e2->getMessage());
                    }
                } else {
                    error_log('admin_login_logs insert failed: ' . $e->getMessage());
                }
            }
            
            header('Location: dashboard.php');
            exit;
        } else {
            // Increment failed login attempts
            $_SESSION['login_attempts'] = ++$login_attempts;
            $_SESSION['last_attempt'] = time();
            
            // Log failed attempt
            if ($user) {
                try {
                    $stmt = $pdo->prepare('INSERT INTO admin_login_logs (user_id, ip_address, status) VALUES (?, ?, "failed")');
                    $stmt->execute([$user['id'], $_SERVER['REMOTE_ADDR']]);
                } catch (PDOException $e) {
                    if ($e->getCode() === '42S02' || stripos($e->getMessage(), '1146') !== false) {
                        ensure_admin_login_logs_table($pdo);
                        try {
                            $stmt = $pdo->prepare('INSERT INTO admin_login_logs (user_id, ip_address, status) VALUES (?, ?, "failed")');
                            $stmt->execute([$user['id'], $_SERVER['REMOTE_ADDR']]);
                        } catch (Exception $e2) {
                            error_log('admin_login_logs insert failed after create: ' . $e2->getMessage());
                        }
                    } else {
                        error_log('admin_login_logs insert failed: ' . $e->getMessage());
                    }
                }
            }
            
            $error = true;
            $error_message = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;">
    <title>Admin Login - LT Software</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="admin-login-body">
    <div class="admin-login-container">
        <div class="admin-login-card">
            <div class="admin-logo">
                <div class="logo-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h1>LT Software</h1>
                <p>Admin Portal</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="admin-login-form" autocomplete="off">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required 
                            autofocus
                            pattern="[a-zA-Z0-9_-]{3,20}"
                            title="Username must be between 3 and 20 characters and can only contain letters, numbers, underscores, and hyphens"
                            <?php echo isset($_POST['username']) ? 'value="' . htmlspecialchars($_POST['username']) . '"' : ''; ?>
                        >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            minlength="8"
                            autocomplete="new-password"
                        >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                </div>

                <!-- Hidden honeypot field to catch bots -->
                <div class="hidden-field">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>
                
                <button type="submit" class="btn btn-primary btn-large">
                    <span>Login</span>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </form>

            <div class="login-footer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                <p>Secure login • Protected by SSL</p>
            </div>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <script>
        // Disable form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        // Add touch ripple effect to button
        document.querySelector('.btn-primary').addEventListener('touchstart', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.touches[0].clientX - rect.left;
            const y = e.touches[0].clientY - rect.top;
            
            const circle = document.createElement('span');
            circle.classList.add('ripple');
            circle.style.left = x + 'px';
            circle.style.top = y + 'px';
            
            this.appendChild(circle);
            
            setTimeout(() => circle.remove(), 500);
        });
    </script>
</body>
</html>
</body>
</html>
