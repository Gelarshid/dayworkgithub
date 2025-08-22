<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>داشبورد ادمین</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            text-align: center;
            background: #f5f5f5;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 100px;
        }

        .card {
            width: 200px;
            height: 120px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            background: #e3f2fd;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>

</head>

<body>
    <h1>👨‍💼 داشبورد مدیریت</h1>
    <div class="container">
        <a
            href="user_management.php">
            <div class="card">مدیریت کاربران</div>
        </a>
</body>

</html>