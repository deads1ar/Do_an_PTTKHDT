        <?php
        session_start();
        if(!isset($_SESSION['username'])){
            header('location:dangnhap.html');
        }
        else{
            ?><script>alert("thêm sản phẩm vào giỏ hàng thành công!")</script>;<?php
        }
        ?>