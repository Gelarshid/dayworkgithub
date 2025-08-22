<?php
// config_collab.php - برای دسترسی امن همکار
error_reporting(0); // غیرفعال کردن نمایش خطاها برای امنیت بیشتر

$db_host = "localhost";
$db_name = "gzrkir12_daywork";
$db_user = "gzrkir12_daywork_collaborator";
$db_pass = "JJJrrrggg@1212005";

// ایجاد ارتباط امن با PDO و تنظیمات امنیتی
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false
    ]);
} catch (PDOException $e) {
    // لاگ کردن خطا به جای نمایش آن (برای امنیت بیشتر)
    error_log("Database connection failed: " . $e->getMessage());
    die("خطایی در اتصال به پایگاه داده رخ داده است. لطفاً بعداً تلاش کنید.");
}
?>