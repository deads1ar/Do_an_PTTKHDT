<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];

// Include database connection
require_once 'backend.php';
require_once 'khachhang.php';

if (isset($_POST['login'])) {
    // Create a connection
    $conn = new Database();
    $kh = new khachhang($conn);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Prepare the SQL query with prepared statement
    $result = $kh->logInSearch($username, $password);
    if ($result) {
        $row = $result;
        
       // Check if account is locked
        if ($row['TRANGTHAI'] === '0') {
            echo "<script type='text/javascript'>alert('Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'); window.location.href='dangnhap.html';</script>";
            exit();
        }
        
        // Account is not locked, proceed with login
        setcookie("user_id", $row['IDKH'], time() + (86400 * 30), "/"); // Store user ID in cookie
        $_SESSION['IDKH'] = $row['IDKH'];
        $_SESSION['username'] = $row['TEN'];
        
        echo "<script type='text/javascript'>alert('Đăng nhập thành công.'); window.location.href='./index.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Tài khoản hoặc mật khẩu chưa chính xác.'); window.location.href='./dangnhap.html';</script>";
    }
    
    exit();
}
?>
