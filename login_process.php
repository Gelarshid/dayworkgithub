<?php
session_start();
include 'includes/db.php'; // فایل mysqli

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // گرفتن کاربر از دیتابیس
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password === $user['password']) { // الان بدون هش
        // ست کردن session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // هدایت بر اساس نقش
        switch($user['role']) {
            case 'Admin':
                header("Location: dashboard_admin.php");
                break;
            case 'Supervisor':
                header("Location: dashboard_supervisor.php");
                break;
            case 'Contractor':
                header("Location: dashboard_contractor.php");
                break;
            case 'Employer':
                header("Location: dashboard_employer.php");
                break;
            default:
                $_SESSION['login_error'] = "نقش شما تعریف نشده است.";
                header("Location: login.php");
        }
        exit();
    } else {
        // ورود ناموفق
        $_SESSION['login_error'] = "نام کاربری یا رمز عبور اشتباه است.";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
