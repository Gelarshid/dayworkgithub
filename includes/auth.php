<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * بررسی اینکه کاربر وارد شده باشد
 */
function require_login() {
    if (empty($_SESSION['user_id'])) {
        header('Location: /login.php');
        exit;
    }
}

/**
 * بررسی نقش کاربر
 * @param array $roles آرایه نقش‌های مجاز
 */
function require_role(array $roles) {
    $role = $_SESSION['role'] ?? '';
    // همه نقش‌ها را به lowercase تبدیل می‌کنیم
    $roles_lower = array_map('strtolower', $roles);
    if (!in_array(strtolower($role), $roles_lower, true)) {
        header('Location: /login.php');
        exit;
    }
}
?>
