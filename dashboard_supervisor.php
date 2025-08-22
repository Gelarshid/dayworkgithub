<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Supervisor') {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>داشبورد ناظر</title>
</head>
<body>
<h1>خوش آمدید ناظر: <?php echo htmlspecialchars($username); ?></h1>
<p>این نسخه پایه داشبورد ناظر است.</p>
</body>
</html>
