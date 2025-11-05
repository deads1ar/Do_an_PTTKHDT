<?php
// Connect to database
require_once "backend.php";
require_once "ao.php";
$db = new Database();
$ao = new ao($db);
$conn = $db->conn;
// Get search parameters
$keyword = isset($_GET['keyword']) ? $conn->real_escape_string(trim($_GET['keyword'])) : '';
$brands = isset($_GET['brand']) && is_array($_GET['brand']) ? array_map([$conn, 'real_escape_string'], $_GET['brand']) : [];
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 1;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 9000000;
$current_page = basename($_SERVER['SCRIPT_NAME']);
$limit = 9;
if (!isset($_GET['page'])) {
    // Convert the $brands array into a query-friendly string
    $brands_query = !empty($brands) ? '&brand[]=' . implode('&brand[]=', array_map('urlencode', $brands)) : '';
    // Redirect with all parameters properly formatted
    header('Location: ' . $_SERVER['PHP_SELF'] . '?page=1'
        . (!empty($keyword) ? '&keyword=' . urlencode($keyword) : '')
        . $brands_query
        . '&min_price=' . $min_price
        . '&max_price=' . $max_price);
    exit();
} else {
    $page = intval($_GET['page']);
}
//search products
$result = $ao->searchProducts($keyword, $brands, $min_price, $max_price, $page, $limit);
// Pagination setup
$totalProducts = $ao->countSearchProducts($keyword, $brands, $min_price, $max_price)[0]['total'];
$totalPages = ceil($totalProducts / 9);
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kết Quả Tìm Kiếm | Ashion</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        .product__item__pic .owl-carousel .owl-item img {
            width: 100%;
            height: 300px;
            object-fit: contain;
        }
        .product__item__pic {
            height: 300px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
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
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="dangnhap.html">Đăng Nhập</a>
            <a href="dangnhap.html">Đăng Kí</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->
    <!-- Header Section Begin -->
    <?php include 'header.php'; ?>
    <!-- Header Section End -->
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Kết Quả Tìm Kiếm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>TÌM KIẾM SẢN PHẨM</h4>
                            </div>
                            <form action="ketquatimkiem.php" method="GET">
                                <input type="text" name="keyword" class="search-input" placeholder="Nhập tên sản phẩm" value="<?php echo htmlspecialchars($keyword); ?>" style="margin-bottom: 20px;">
                                <div class="section-title">
                                    <h4>TÌM THEO THƯƠNG HIỆU</h4>
                                </div>
                                <div class="size__list">
                                    <label for="nike">
                                        Nike
                                        <input type="checkbox" id="nike" name="brand[]" value="Nike" <?php echo in_array('Nike', $brands) ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="adidas">
                                        Adidas
                                        <input type="checkbox" id="adidas" name="brand[]" value="Adidas" <?php echo in_array('Adidas', $brands) ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="newbalance">
                                        New Balance
                                        <input type="checkbox" id="newbalance" name="brand[]" value="New Balance" <?php echo in_array('New Balance', $brands) ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="sidebar__filter">
                                    <div class="section-title">
                                        <h4>TÌM THEO GIÁ</h4>
                                    </div>
                                    <div class="filter-range-wrap">
                                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="1" data-max="9000000"></div>
                                        <div class="range-slider">
                                            <div class="price-input">
                                                <p>Giá:</p>
                                                <input style="text-align: center;" type="text" id="minamount" name="min_price" value="<?php echo htmlspecialchars($min_price); ?>" readonly>
                                                <input style="text-align: center;" type="text" id="maxamount" name="max_price" value="<?php echo htmlspecialchars($max_price); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <?php include 'display_header.php'; ?>
                    <div class="row">
                        <?php
                        // Build SQL query
                        if($result){
                            foreach ($result as $row) {
                                $image_url = htmlspecialchars($row['URL']);
                        ?>                  
                                 <div class="col-lg-4 col-md-6">
                                     <div class="product__item">
                                         <div class="product__item__pic">
                                             <div class="product__carousel owl-carousel">     
                                                <img src="<?php echo $image_url; ?>" alt="<?php echo htmlspecialchars($row['TEN']); ?>">                         
                                            </div>
                                            <ul class="product__hover"> 
                                                <li><a href="<?php echo $image_url ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="#" onclick="addToCart(<?php echo $row['IDAO']; ?>,1)"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="chitietsanpham.php?id=<?php echo $row['IDAO']; ?>"><?php echo htmlspecialchars($row['TEN']); ?></a></h6>
                                            <br>
                                            <div ><span><?php echo number_format($row['GIA'], 0, '', '.'); ?>đ</span></div>
                                        </div>
                                    </div>
                            </div>
                            <?php
                            }
                            } else {
                                echo '<div style="margin-bottom:45px;margin-top:45px" class="col-lg-12 text-center">Không tìm thấy sản phẩm nào.</div>';
                            }
                        ?>
                        <?php
                        // Pagination variables
                        // $sql_count = "SELECT COUNT(*) AS total 
                        //               FROM sp 
                        //               JOIN loaisp ON sp.IDLSP = loaisp.IDLSP 
                        //               WHERE sp.STATUS = 'active'";
                        // if (!empty($keyword)) {
                        //     $sql_count .= " AND sp.TEN LIKE '%$keyword%'";
                        // }
                        // if (!empty($brands)) {
                        //     $brands_str = "'" . implode("','", $brands) . "'";
                        //     $sql_count .= " AND loaisp.TENLOAI IN ($brands_str)";
                        // }
                        // $sql_count .= " AND sp.GIABANKM BETWEEN $min_price AND $max_price";
                        // $result_count = $conn->query($sql_count);
                        // $totalproduct = ($result_count && $result_count->num_rows > 0) ? $result_count->fetch_assoc()['total'] : 0;
                        // $totalpage = ceil($totalproduct / $limit);
                        ?>
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <?php include 'page_navigation.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
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
                            <a href="#"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="https://www.instagram.com/_hbaohuyy/">@_hbaohuyy ig</a>
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
                    <div class="footer__copyright__text">
                        <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                    </div>
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
    <script>
    $(document).ready(function() {
        // Format number
        function formatNumber(number) {
            return number + " đ";
        }
        // Get min_price and max_price
        var minPrice = <?php echo $min_price; ?>;
        var maxPrice = <?php echo $max_price; ?>;
        minPrice = Math.max(1, Math.min(minPrice, 9000000));
        maxPrice = Math.max(minPrice, Math.min(maxPrice, 9000000));
        $("#minamount").val(formatNumber(minPrice));
        $("#maxamount").val(formatNumber(maxPrice));
        // Initialize price slider
        $(".price-range").slider({
            range: true,
            min: 1,
            max: 9000000,
            values: [minPrice, maxPrice],
            slide: function(event, ui) {
                $("#minamount").val(formatNumber(ui.values[0]));
                $("#maxamount").val(formatNumber(ui.values[1]));
            }
        });
        // Initialize Owl Carousel for each product
        $('.product__carousel').each(function() {
            $(this).owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: true,
                autoplay: false,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
            });
        });
        // Initialize Magnific Popup for image zoom
        $('.image-popup').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
    </script>
    <script>
        function addToCart(productId, quantity) {
            fetch('cart_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${productId}&quantity=${quantity}`
            })
            .then(response => response.text())
            .then(data => {
                if (data === "NOT_LOGGED_IN") {
                    alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!");
                    window.location.href = '/web2/dangnhap.html';
                } else if (data === "SUCCESS") {
                    alert("Thêm sản phẩm thành công!");
                } else {
                    alert("Có lỗi xảy ra!");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>
