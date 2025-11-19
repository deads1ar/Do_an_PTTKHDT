<?php
session_start();
include 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$db = new Database();  
$pdo = $db->pdo;  // ✅ KHÔNG gọi getPDO(), mà dùng trực tiếp $db->pdo

$stmt = $pdo->prepare("SELECT * FROM nhanvien WHERE TAIKHOAN = ? AND MATKHAU = ? LIMIT 1");
$stmt->execute([$username, $password]);
$admin = $stmt->fetch();

if ($username !="" && $password != "" && !$admin) {
    echo "<h2 style ='text-align:center'> Sai tài khoản mật khẩu</p><br>";
}
else if($admin) {
    setcookie('admin_id',$admin['IDNV']);
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_name'] = 'Admin'; // hiển thị tên tài khoản
    header('Location: indexadmin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Đăng nhập và Đăng ký</title>-->
    <link rel="stylesheet" href="css/dangnhap.css" >
</head>
<body>
    <div class="container" onload="clearForm()">
        <!-- Biểu mẫu Đăng nhập  -->
        <form id="login-form" class="form" action="login.php" method="post" autocomplete="off">
            <h2>Admin</h2>
            <input type="text" id="login-username" name="username" placeholder="Tên đăng nhập" autocomplete="on">
            <input type="password" name="password" placeholder="Mật khẩu" autocomplete="off">
            <button name="login" type="submit" >Đăng nhập</button>
        </form>

    </div>

   
</body>
</html>
