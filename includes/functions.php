<?php

if (session_status() == PHP_SESSION_NONE) session_start();

function generate_csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token(?string $token): bool
{
    if (empty($token)) return false;
    if (empty($_SESSION['csrf_token'])) return false;
    return hash_equals($_SESSION['csrf_token'], $token);
}

function csrf_input(): string
{
    $t = htmlspecialchars(generate_csrf_token(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    return "<input type=\"hidden\" name=\"csrf_token\" value=\"$t\">";
}

// Simple rate limiter helpers (session-based)
function login_attempt_failed(int $maxAttempts = 5, int $lockSeconds = 300)
{
    $now = time();
    if (empty($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['first_attempt_time'] = $now;
    }
    $_SESSION['login_attempts']++;
    if ($_SESSION['login_attempts'] >= $maxAttempts) {
        $_SESSION['lock_until'] = $now + $lockSeconds;
    }
}

function login_attempts_reset()
{
    unset($_SESSION['login_attempts'], $_SESSION['first_attempt_time'], $_SESSION['lock_until']);
}

function is_login_locked(): int
{
    if (!empty($_SESSION['lock_until']) && time() < (int)$_SESSION['lock_until']) {
        return (int)$_SESSION['lock_until'] - time();
    }
    return 0;
}
