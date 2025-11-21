<?php 
    session_start();
    $phone_number = $_POST['phone_number'];
    $re_password = $_POST['re_password'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    require_once 'backend.php';
    require_once 'khachhang.php';
    //check if register password and re_password match
    if($password != $re_password){
        echo'<script>alert("mật khẩu chưa trùng khớp."); window.location.href="dangki.html"; </script>';
        exit();
    }
    else{
        $conn = new database();
        $kh = new khachhang($conn);
    }
    //check if database connection succesfull
    if(!$conn || !$kh){
        die("Connection failed: " . mysqli_connect_error());
    }
    // Check if username is already in use
    $result = $kh->searchKhachhangByName($username);
    if ($result > 0) {
        // Username already exists
        echo '<script>alert("Tên tài khoản đã được sử dụng. Vui lòng chọn tên khác."); window.location.href="dangki.html"; </script>';
        exit(); // Stop further script execution
    }
    else{    
        // Insert new user into the database
        $stmt = $kh->addKhachHang($username, $password, $address, $phone_number);
        if ($stmt) {
            echo'<script>alert("đăng kí thành công."); window.location.href="dangnhap.html"; </script>';
        } else {
            echo $stmt->error;
            echo'<script>alert("đăng kí thất bại."); window.location.href="dangki.html"; </script>';
        }
        exit(); // Stop further script execution
    }
    ?>


