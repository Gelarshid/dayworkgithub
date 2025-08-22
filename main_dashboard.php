<?php
session_start();

// اگر کاربر لاگین نکرده بود بره صفحه ورود
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>داشبورد</title>
    <style>
        body {
            font-family: tahoma, sans-serif;
            background: #f5f5f5;
            text-align: center;
            padding: 50px;
        }
        .card {
            display: inline-block;
            background: #fff;
            padding: 20px;
            margin: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
            min-width: 200px;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <h2>🎉 خوش آمدید <?php echo htmlspecialchars($username); ?> (<?php echo htmlspecialchars($role); ?>)</h2>

    <div class="card">
        <h3>تعداد پروژه‌ها</h3>
        <p>0</p>
    </div>

    <div class="card">
        <h3>پیام‌های جدید</h3>
        <p>0</p>
    </div>

    <div style="margin-top:30px;">
        <a href="logout.php">خروج</a>
    </div>
</body>
</html>
