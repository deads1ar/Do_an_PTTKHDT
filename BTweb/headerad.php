<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chặn truy cập nếu chưa đăng nhập (trừ khi đang ở login.php)
$currentFile = basename($_SERVER['PHP_SELF']);
$allowWithoutLogin = ['login.php', 'logout.php'];
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // or wherever your login page is
    exit;
}
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion with Fashion</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
</head>
<body>
    <header class="header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="./index_logged_in.php"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="<?= ($current_page == 'indexadmin.php') ? 'active' : '' ?>">
                            <a href="./indexadmin.php">Tổng quan</a>
                        </li>
                        <li class="<?= ($current_page == 'Qltk.php') ? 'active' : '' ?>">
                            <a href="./Qltk.php">Quản lý tài khoản</a>
                        </li>
                        <li class="<?= ($current_page == 'Qlsp.php') ? 'active' : '' ?>">
                            <a href="./Qlsp.php">Quản lý sản phẩm</a>
                        </li>
                        <li class="<?= ($current_page == 'Qldh.php') ? 'active' : '' ?>">
                            <a href="./Qldh.php">Quản lý đơn hàng</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right d-flex justify-content-end">
                    <ul class="header__right__widget d-flex align-items-center">
                        <li class="search-container me-3">
                            <form action="search-results.php" method="POST" class="d-flex">
                                <input type="text" name="keyword" class="form-control" placeholder="Nhập tên sản phẩm" required>
                                <button type="submit" class="btn btn-outline-secondary ms-1">
                                    <span class="icon_search"></span>
                                </button>
                            </form>
                        </li>
                        <li class="dropdown position-relative">
                            <a href="#" class="user-link d-block">
                                <img src="img/user-profile.png" width="45px">
                            </a>
                            <div class="dropdown-menu position-absolute end-0 mt-2 p-3 border bg-white" style="min-width: 220px;">
                                <?php if (isset($_SESSION['admin_logged_in'])): ?>
                                    <strong class="d-block mb-2">Tài khoản: <?= $_SESSION['admin_name'] ?? 'Admin' ?></strong>
                                    <a href="logout.php" class="btn btn-sm btn-danger w-100">Đăng Xuất</a>
                                <?php else: ?>
                                    <strong class="d-block mb-2">Chưa đăng nhập</strong>
                                    <a href="login.php" class="btn btn-sm btn-success w-100">Đăng nhập</a>
                                <?php endif; ?>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
</body>
</html>