<?php 
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    //check if register password and re_password match
    if($password != $re_password){
        echo'<scrip;>alert("mật khẩu chưa trùng khớp."); window.location.href="dangki.html"; </script>';
        exit();
    }
    else{
        $conn = mysqli_connect("localhost","root","","qlch");
    }
    //check if database connection succesfull
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    // Check if username is already in use
    $checkQuery = "SELECT IDKH FROM khachhang WHERE TEN = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username already exists
        echo '<script>alert("Tên tài khoản đã được sử dụng. Vui lòng chọn tên khác."); window.location.href="dangki.html"; </scripmessage.textContent>';
        $stmt->close();
        $conn->close();
        exit(); // Stop further script execution
    }
    else{    
 
    $sql = "INSERT INTO khachhang (TEN, PWORD, DIACHI, SDT) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $password, $address, $phone_number);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            echo'<script>alert("đăng kí thành công."); window.location.href="dangnhap.html"; </script>';
        } else {
            echo $stmt->error;
            $stmt->close();
            $conn->close();
        }
        exit(); // Stop further script execution
    }
    ?>


