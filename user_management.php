<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

require_once "config.php";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("خطا در اتصال به دیتابیس: " . $e->getMessage());
}

// افزودن کاربر جدید
if (isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role, fullname, phone, department, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $password, $role, $fullname, $phone, $department, $status]);
    header("Location: user_management.php");
    exit();
}

// بروزرسانی تمام فیلدهای کاربران
if (isset($_POST['update_users'])) {
    $ids = $_POST['user_id'];
    foreach ($ids as $id) {
        $stmt = $pdo->prepare("UPDATE users SET username=?, role=?, fullname=?, phone=?, department=?, status=? WHERE id=?");
        $stmt->execute([
            $_POST['username'][$id],
            $_POST['roles'][$id],
            $_POST['fullname'][$id],
            $_POST['phone'][$id],
            $_POST['department'][$id],
            $_POST['status'][$id],
            $id
        ]);
    }
    header("Location: user_management.php");
    exit();
}

// حذف گروهی کاربران
if (isset($_POST['delete_selected']) && isset($_POST['delete_ids'])) {
    foreach ($_POST['delete_ids'] as $id) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
    header("Location: user_management.php");
    exit();
}

// دریافت کاربران
$stmt = $pdo->query("SELECT id, username, role, fullname, phone, department, status FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>مدیریت کاربران</title>
<style>
body { font-family: Tahoma, sans-serif; background: #f5f5f5; text-align: center; }
table { margin: 20px auto; border-collapse: collapse; width: 95%; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);}
th, td { padding: 10px; border-bottom: 1px solid #ddd; }
th { background: #1976d2; color: white; }
tr:hover { background: #f1f1f1; }
.btn { padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer; margin: 3px;}
.btn-update { background: #43a047; color: white; }
.btn-delete { background: #e53935; color: white; }
.btn-add { background: #1976d2; color: white; margin-bottom: 10px;}
input[type=text], select { padding:5px; width: 100%; }
</style>
<script>
function confirmDelete() {
    if (!confirm("آیا مطمئن هستید که می‌خواهید کاربران انتخاب شده را حذف کنید؟")) return false;
    return confirm("این عملیات غیرقابل بازگشت است. مطمئن هستید؟");
}
</script>
</head>
<body>
<h1>👤 مدیریت کاربران</h1>
<a href="dashboard_admin.php" class="btn btn-add">⬅ بازگشت به داشبورد</a>

<!-- فرم افزودن کاربر جدید -->
<h2>➕ افزودن کاربر جدید</h2>
<form method="post">
<table style="width: 60%;">
<tr>
    <td>نام کاربری:</td><td><input type="text" name="username" required></td>
</tr>
<tr>
    <td>رمز عبور:</td><td><input type="password" name="password" required></td>
</tr>
<tr>
    <td>نقش:</td>
    <td>
        <select name="role">
            <option value="Admin">ادمین</option>
            <option value="Supervisor">ناظر</option>
            <option value="Contractor">پیمانکار</option>
        </select>
    </td>
</tr>
<tr>
    <td>نام کامل:</td><td><input type="text" name="fullname"></td>
</tr>
<tr>
    <td>شماره تلفن:</td><td><input type="text" name="phone"></td>
</tr>
<tr>
    <td>دپارتمان:</td><td><input type="text" name="department"></td>
</tr>
<tr>
    <td>وضعیت:</td>
    <td>
        <select name="status">
            <option value="active">فعال</option>
            <option value="inactive">غیرفعال</option>
        </select>
    </td>
</tr>
<tr><td colspan="2"><button type="submit" name="add_user" class="btn btn-add">افزودن کاربر</button></td></tr>
</table>
</form>

<!-- جدول کاربران -->
<h2>📋 لیست کاربران</h2>
<form method="post" onsubmit="return confirmDelete();">
<table>
<tr>
    <th>انتخاب</th>
    <th>ردیف</th>
    <th>نام کاربری</th>
    <th>نام کامل</th>
    <th>شماره تلفن</th>
    <th>حوزه</th>
    <th>وضعیت</th>
    <th>نقش</th>
</tr>
<?php foreach ($users as $user): ?>
<tr>
    <td><input type="checkbox" name="delete_ids[]" value="<?= $user['id'] ?>"></td>
    <td><?= $user['id'] ?><input type="hidden" name="user_id[]" value="<?= $user['id'] ?>"></td>
    <td><input type="text" name="username[<?= $user['id'] ?>]" value="<?= htmlspecialchars($user['username']) ?>"></td>
    <td><input type="text" name="fullname[<?= $user['id'] ?>]" value="<?= htmlspecialchars($user['fullname']) ?>"></td>
    <td><input type="text" name="phone[<?= $user['id'] ?>]" value="<?= htmlspecialchars($user['phone']) ?>"></td>
    <td><input type="text" name="department[<?= $user['id'] ?>]" value="<?= htmlspecialchars($user['department']) ?>"></td>
    <td>
        <select name="status[<?= $user['id'] ?>]">
            <option value="active" <?= $user['status']=='active'?'selected':'' ?>>فعال</option>
            <option value="inactive" <?= $user['status']=='inactive'?'selected':'' ?>>غیرفعال</option>
        </select>
    </td>
    <td>
        <select name="roles[<?= $user['id'] ?>]">
            <option value="Admin" <?= $user['role']=='Admin'?'selected':'' ?>>ادمین</option>
            <option value="Supervisor" <?= $user['role']=='Supervisor'?'selected':'' ?>>ناظر</option>
            <option value="Contractor" <?= $user['role']=='Contractor'?'selected':'' ?>>پیمانکار</option>
        </select>
    </td>
</tr>
<?php endforeach; ?>
</table>
<br>
<button type="submit" name="update_users" class="btn btn-update">بروزرسانی اطلاعات کاربران</button>
<button type="submit" name="delete_selected" class="btn btn-delete">حذف کاربران انتخاب شده</button>
</form>
</body>
</html>
