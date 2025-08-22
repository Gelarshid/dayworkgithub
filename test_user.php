<?php
include 'includes/db.php'; // فایل اتصال دیتابیس

$result = $conn->query("SELECT id, username, password, role FROM users WHERE username='admin'");
$user = $result->fetch_assoc();

echo '<pre>';
var_dump($user);
echo '</pre>';
