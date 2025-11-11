<?php
// Start the session, check if user is logged in
session_start();
if(!isset($_SESSION['IDKH']))
    header('location: ./dangnhap.html');
$idkh = $_SESSION['IDKH'];
//import nesessary files and establish database connection
//$conn = new mysqli('localhost','root','','web_db');
require_once 'backend.php';
require_once 'khachhang.php';
$db = new Database();
$kh = new khachhang($db);
$conn = $db->conn;
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE khachhang SET TEN='$fullname', DIACHI='$address', SDT='$phone_number'";
    if(!$password && $confirm_password){
        echo "<script type='text/javascript'>alert('Vui lòng nhập mật khẩu mới'); window.location.href='chinhsuatt.php';</script>";
    }
    if($password && !$confirm_password){
        echo "<script type='text/javascript'>alert('Vui lòng xác nhận mật khẩu mới'); window.location.href='chinhsuatt.php';</script>";
    }
    else if($password && $confirm_password && $password !== $confirm_password){
        echo "<script type='text/javascript'>alert('Xác nhận mật khẩu chưa trùng khớp'); window.location.href='chinhsuatt.php';</script>";
    }
    else if($password && $confirm_password && $password === $confirm_password){ 
        $sql.=",PWORD='$password'";
    }
    $sql.="WHERE IDKH = '$idkh'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thông tin đã được cập nhật!'); window.location.href = './index.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra!');</script>";
    }
}

// Fetch user data to pre-fill the form
$userData = $conn->query("SELECT * FROM khachhang WHERE IDKH = '$idkh'")->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin</title>
    <link rel="stylesheet" href="css/chinhsuatt.css">
</head>
<div style="position: absolute; top: 10px;left: 10px;background-color: none;">
    <button class="quaylai" onclick="history.back()" title="Quay lại">
        <img src="\web2\img\return.svg"></img>
    </button>
</div>
<body>
    <div class="container">
        <h2>Chỉnh sửa thông tin cá nhân</h2>
        <form id="edit-profile-form" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
           
            <div class="form-group">
                <label for="fullname">Tên tài khoản:</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo $userData['TEN']; ?>" >
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu mới:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu mới" >
            </div>

            <div class="form-group">
                <label for="confirm_password">Nhập lại mật khẩu mới:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu mới" >
            </div>

            <div class="form-group">
                <label for="phone_number">Số điện thoại:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo $userData['SDT']; ?>" >
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <textarea id="address" name="address" rows="3" ><?php echo $userData['DIACHI']; ?></textarea>
            </div>

            <button type="submit">Lưu thông tin</button>
        </form>
    </div>
</body>
</html>
