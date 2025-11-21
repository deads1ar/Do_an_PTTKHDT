<?php
session_start();
//check if user is logged in
if(isset($_SESSION['IDKH']))
$id = $_SESSION['IDKH'];
else
header("location:./dangnhap.html");
//get order id from url
$iddh = $_GET['IDDH'];
//import nesessary files and establish database connection
require_once 'backend.php';
require_once 'donhang.php';
$db = new Database();
$dh = new donhang($db);
$conn = $db->conn;
//get order details
$result = $dh->getDonHangForctdh($iddh);
$row0 = $result[0];
//get ctdh details
$result = $dh->getctdhByIddh($iddh);
//calculate total of order
$total = 0;
foreach($result as $a)
    $total += $a['GIA']*$a['SL'];
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/chitietdh.css" type="text/css">



</head>

<body>
    <!-- Page Preloder
    <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index_logged_in.html"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Đăng Nhập</a>
            <a href="#">Đăng Kí</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php include 'header.php' ?>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index_logged_in.html"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="./lichsudonhang.html">Lịch sử mua hàng</a>
                        <span>Chi Tiết Đơn Hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chi Tiết Đơn Hàng</title>
    </head>
    <body>
        <div class="order-container">
            <header class="order-header">
                <h1>Chi Tiết Đơn Hàng</h1>
                <p class="order-id">Mã đơn hàng: <span id="order-id"><?php echo $iddh; ?></span></p>
                <p class="order-date">Ngày đặt hàng: <span id="order-date"><?php echo $row0['formatted_date']; ?></span></p>
            </header>
    
            <!-- Thông tin khách hàng -->
            <section class="customer-info">
                <h2>Thông Tin Khách Hàng</h2>
                <table>
                    <tr>
                        <td>Tên Khách Hàng:</td>
                        <td><span id="customer-name"><?php echo $row0['TEN']; ?></span></td>
                    </tr>
                    <tr>
                        <td>Địa Chỉ:</td>
                        <td><span id="customer-address"><?php echo $row0['DIACHI']; ?></span></td>
                    </tr>
                    <tr>
                        <td>Số Điện Thoại:</td>
                        <td><span id="customer-phone"><?php echo $row0['SDT']; ?></span></td>
                    </tr>
                </table>
            </section>
    
            <!-- Chi tiết sản phẩm -->
            <section class="order-items">
                <h2>Sản Phẩm Đặt Mua</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Hình Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody id="order-items-list">
                        <?php
                        if(sizeof($result) > 0)
                            foreach($result as $row){ ?>
                                <tr class="product-item">
                                    <td><img src="<?php echo $row['URL']; ?>" alt="IMG"></td>
                                    <td><?php echo $row['TEN'] . "(size: " . $row['TENSIZE'] . ")"?></td>
                                    <td><?php echo $row['SL']; ?></td>
                                    <td><?php echo number_format($row['GIA'],0,'','.') . "đ"; ?></td>
                                    <td><?php echo "<span>" . number_format(($row['GIA'] * $row['SL']),0,'','.') . "đ"; ?></span></td>
                                </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </section>
    
            <!-- Tóm tắt đơn hàng -->
            <section class="order-summary">
                <h2>Thông tin Đơn Hàng</h2>
                <table>
                    <tr class="total-row">
                        <td style="color: #27ae60; font-size: 18px; font-weight: bold;">Tổng Tiền Thanh Toán:</td>
                        <td style="color: #27ae60; font-size: 18px; font-weight: bold;"><span id="total-payment"><?php echo number_format(($total),0,'','.') . "đ"; ?></span></td>
                    </tr>
                    <tr>
                        <td>Trạng Thái Đơn Hàng:</td>
                        <td><span id="order-status"></span><?php echo $row0['TRANGTHAI']; ?></td>
                    </tr>
                </table>
            </section>
    
        </div>
    </body>
    </html>
    

    <!-- Instagram Begin -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/_hbaohuyy">@_hbaohuyy ig
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Instagram End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-7">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>Trang web bán giày chuyên cung cấp các mẫu giày thời trang, đa dạng từ thể thao đến công sở. Sản phẩm đảm bảo chất lượng cao, với nhiều lựa chọn về kiểu dáng và kích cỡ phù hợp cho mọi lứa tuổi.</p>
                        <div class="footer__payment">
                            <a href="#"><img src="img/payment/payment-1.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-2.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-3.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-4.png" alt=""></a>
                            <a href="#"><img src="img/payment/payment-5.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="footer__widget">
                        <h6>Đường dẫn</h6>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Thông tin liên lạc</a></li>
                            <li><a href="#">Hỏi đáp cùng Ashion</a></li>
                            <li><a href="#">Blogs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="footer__widget">
                        <h6>Tài khoản</h6>
                        <ul>
                            <li><a href="#">Tài khoản của tôi</a></li>
                            <li><a href="#">Theo dõi đơn hàng</a></li>
                            <li><a href="#">Thanh toán</a></li>
                            <li><a href="#">Danh sách yêu thích</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-sm-8">
                    <div class="footer__newslatter">
                        <h6>Tạp chí Ashion</h6>
                        <form action="#">
                            <input type="text" placeholder="Email">
                            <button type="submit" class="site-btn">Theo dõi</button>
                        </form>
                        <div class="footer__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <div class="footer__copyright__text">
                        <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                    </div>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
<!--done-->