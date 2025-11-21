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
    <link rel="stylesheet" href="css/style.css" type="text/css">
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="/index.php"><img src="./img/logo.png" alt=""></a>
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

    echo '
    <li class="dropdown">
        <div class="user-dropdown">
            <a href="#" class="user-link">
                <img src="./img/user-profile.png" width="45px">
            </a>

            <div class="dropdown-menu" style="text-align:left;">                                  
                <strong><span>' . htmlspecialchars($_SESSION["username"]) . '</span></strong>  

                <button class="action-button"
                    onclick="location.href=\'./lichsudonhang.php\'">
                    Lịch sử mua hàng
                </button>

                <button class="action-button"
                    onclick="location.href=\'./chinhsuatt.php\'">
                    Chỉnh sửa thông tin
                </button>

                <button class="action-button logout" id="btnLogout">
                    Đăng Xuất
                </button>    
            </div>
        </div>
    </li>';
} 
else {
    echo '<a href="./dangnhap.html">Đăng Nhập</a>';
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const logoutButton = document.getElementById("btnLogout");

    if (logoutButton) {
        logoutButton.addEventListener("click", function () {
            if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
                window.location.href = "./dangxuat.php";
            }
        });
    }
});
</script>
    <style>
    /* Vị trí và style của dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Icon user */
.user-link img {
    width: 45px;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.2s;
}

.user-link img:hover {
    opacity: 0.8;
}

/* Menu chính */
.dropdown-menu {
    position: absolute;
    top: 55px;
    right: 0;
    width: 220px;
    background: #ffffff;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    display: none;
    animation: fadeIn 0.2s ease;
    z-index: 50;
}

/* Hiệu ứng fade */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Khi hover vào icon */
.dropdown:hover .dropdown-menu {
    display: block;
}

/* Username */
.dropdown-menu strong span {
    font-size: 16px;
    display: block;
    margin-bottom: 12px;
    color: #1c0625ff;
}

/* Button trong dropdown */
.action-button {
    width: 100%;
    padding: 10px 12px;
    text-align: left;
    border: none;
    background: #c9e8ceff;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: 0.2s;
    color: #092708ff;
}

.action-button:hover {
    background: #60c115ff;
    color: white;
    transform: translateX(3px);
}

/* Logout button */
.action-button.logout {
    background: #ffeaea;
    color: #d63031;
}

.action-button.logout:hover {
    background: #aa4444ff;
    color: white;
}
</style>
