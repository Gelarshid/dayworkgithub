<?php
// includes/db.php
$DB_HOST = "localhost";            // معمولاً localhost است
$DB_USER = 'gzrkir12_jlkuser';     // یوزرنیم دیتابیس واقعی
$DB_PASS = "Jr2g@1212005";        
$DB_NAME = "gzrkir12_daywork";     // نام دیتابیس

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die('DB connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
