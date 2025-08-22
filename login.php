<?php
session_start();

// دریافت پیام خطا از session و پاک کردن آن بعد از نمایش
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به سامانه مدیریت پروژه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f5f5; font-family: Tahoma, sans-serif; }
        .login-container { margin-top: 100px; }
        .card { padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        .btn-primary { width: 100%; }
    </style>
</head>
<body>
<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="text-center mb-4">ورود به سامانه</h3>
                <?php if(!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="POST" action="login_process.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">نام کاربری</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">رمز عبور</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">ورود</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
