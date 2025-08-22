<?php
require_once "config.php";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ اتصال به دیتابیس موفق بود!";
} catch (PDOException $e) {
    echo "❌ خطا در اتصال: " . $e->getMessage();
}
