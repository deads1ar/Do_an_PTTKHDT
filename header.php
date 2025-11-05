<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}

if (!isset($_SESSION['timeout'])) {
    $_SESSION['timeout'] = time(); // Store current time
}

$session_duration = 1800;

if (time() - $_SESSION['timeout'] > $session_duration) {
    session_unset(); // Clear session variables
    session_destroy(); // Destroy the session
    echo "<script>alert('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại!'); window.location.href='dangnhap.html';</script>";
    exit;
} else {
    $_SESSION['timeout'] = time(); // Reset session timer on activity
}
$current_page = basename($_SERVER['SCRIPT_NAME']);
$product = isset($_GET['product']) ? $_GET['product'] : "";
?>
    <link rel="stylesheet" href="./web2/css/style.css" type="text/css">
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="/index.php"><img src="../web2/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">
                            <a href="./index.php">Trang chủ</a>
                        </li>
                        <li class="<?= ($product == 'áo thun') ? 'active' : '' ?>">
                            <a href="./sanpham.php?product=áo thun">Áo thun</a>
                        </li>
                        <li class="<?= ($product == 'Áo sơ mi') ? 'active' : '' ?>">
                            <a href="./sanpham.php?product=Áo sơ mi">Áo sơ mi</a>
                        </li>
                        <li class="<?= ($product == 'Áo khoác') ? 'active' : '' ?>">
                            <a href="./sanpham.php?product=Áo khoác">Áo khoác</a>
                        </li>
                        <li class="<?= ($current_page == 'checkout.php') ? 'active' : '' ?>">
                            <a href="./checkout.php">Giỏ hàng</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        <ul class="header__right__widget">
                            <li class="search-container">
                                <form action="./ketquatimkiem.php?" method="GET">
                                    <input type="text" class="search-input" name="keyword" value="<?php echo isset($_GET['keywork']) ? htmlspecialchars($_GET['keyworkk']) : ''; ?>" placeholder="Nhập tên sản phẩm" required>
                                    <button type="submit" class="search-button">
                                        <span class="icon_search"></span>
                                    </button>
                                </form>
                            </li>
                            <?php
if (isset($_SESSION['IDKH'])) {
    // User is logged in
    echo '<li class="dropdown">
        <div>
            <a href="#" class="user-link"><img src="/web2/img/user-profile.png" width="45px"></img></a>        
            <div class="dropdown-menu" >                                  
                <strong>Tài khoản: <span>' . htmlspecialchars($_SESSION["username"]) . '</span></strong>  
                <button class="action-button" onclick=location.href="/web2/lichsudonhang.php">Lịch sử mua hàng</button>
                <button class="action-button" onclick=location.href="/web2/chinhsuatt.php">Chỉnh sửa thông tin</button>
                <button class="action-button logout" id="asa" onclick=showNotification()>Đăng Xuất</button>    
                    <script>
    // Wait for the DOM to load before attaching event listeners
    document.addEventListener("DOMContentLoaded", function () {
        const logoutButton = document.getElementById("asa");

        if (logoutButton) {
            logoutButton.addEventListener("click", function () {
                if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
                    window.location.href = "/web2/dangxuat.php"; // Adjust this URL to your logout processing page
                }
            });
        }
    });
</script>                           
            </div>
        </div>
    </li> ' ;
} else {
    // User is not logged in
    echo'<a href="./dangnhap.html">Đăng Nhập</a>';
}
?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
