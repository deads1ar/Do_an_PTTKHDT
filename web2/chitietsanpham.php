<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "qlch");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Truy vấn thông tin sản phẩm hiện tại
$sql = "SELECT * FROM AO WHERE IDAO = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

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

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- Custom CSS for Quantity Selector -->
    <style>
        .quantity-selector {
    display: flex;
    align-items: center;
    gap: 8px; /* Khoảng cách giữa các phần tử */
    background: #f8f8f8; /* Màu nền nhẹ */
    padding: 5px;
    border-radius: 8px; /* Bo góc */
    border: 1px solid #e0e0e0; /* Viền nhẹ */
    width: fit-content; /* Độ rộng tự động */
}

.quantity-selector button {
    width: 32px;
    height: 32px;
    border: none; /* Bỏ viền mặc định */
    background: #ffffff; /* Nền trắng cho nút */
    color: #333; /* Màu chữ/icon */
    font-size: 16px; /* Kích thước chữ */
    font-weight: bold; /* Độ đậm chữ */
    cursor: pointer;
    border-radius: 6px; /* Bo góc nút */
    transition: background 0.3s, transform 0.1s; /* Hiệu ứng chuyển màu và nhấn */
}

.quantity-selector button:hover {
    background: #e0e0e0; /* Màu nền khi hover */
}

.quantity-selector button:active {
    transform: scale(0.95); /* Hiệu ứng nhấn */
}

.quantity-selector input {
    width: 50px;
    height: 32px;
    text-align: center;
    border: 1px solid #e0e0e0; /* Viền nhẹ */
    border-radius: 6px; /* Bo góc */
    font-size: 14px; /* Kích thước chữ */
    color: #333; /* Màu chữ */
    background: #ffffff; /* Nền trắng */
    outline: none; /* Bỏ viền khi focus */
}

.quantity-selector input::-webkit-outer-spin-button,
.quantity-selector input::-webkit-inner-spin-button {
    -webkit-appearance: none; /* Ẩn nút tăng/giảm mặc định của input number */
    margin: 0;
}

.quantity-selector input[type="number"] {
    -moz-appearance: textfield; /* Tương tự cho Firefox */
}
    </style>
</head>

<body>
   

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
            <a href="#">Login</a>
            <a href="#">Register</a>
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
                        <a href="/index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="/web2/sanpham.php">Sản phẩm </a>
                        <span><?php echo $row['TEN']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
<?php
$tenSanPham = strtolower($row['TEN']);
$tenFile = 'default.jpg';

if (strpos($tenSanPham, 'polo') !== false) {
    $tenFile = 'aothun1.jpg';
} elseif (strpos($tenSanPham, 'caro') !== false) {
    $tenFile = 'aosomicaro1.jpg';
} elseif (strpos($tenSanPham, 'jean') !== false) {
    $tenFile = 'aokhoacjean1.jpg';
} elseif (strpos($tenSanPham, 'sơ mi') !== false) {
    $tenFile = 'aosomi1.jpg';
} elseif (strpos($tenSanPham, 'khoác') !== false) {
    $tenFile = 'aokhoac1.jpg';
} elseif (strpos($tenSanPham, 'hoodie') !== false) {
    $tenFile = 'aohoodie1.jpg';
} elseif (strpos($tenSanPham, 'len') !== false) {
    $tenFile = 'aolen1.jpg';
} elseif (strpos($tenSanPham, 'phông') !== false) {
    $tenFile = 'aophong1.jpg';
} elseif (strpos($tenSanPham, 'cổ trụ') !== false) {
    $tenFile = 'aocotru1.jpg';
} elseif (strpos($tenSanPham, 'thể thao') !== false) {
    $tenFile = 'aothethao1.jpg';
}
?>

    <!-- Product Details Section Begin -->
    <section class="chitietsanpham spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            <a class="pt_active" href="#product-1">
                             <?php echo '<img src="img/sanpham/' . $tenFile . '" alt="ảnh sản phẩm">'; ?>


                            </a>
                            <a class="pt" href="#product-2">
                                <img src="img/shop/Product Detail/shop-<?php echo $id; ?>/2.jpg" alt="">
                            </a>
                            <a class="pt" href="#product-3">
                                <img src="img/shop/Product Detail/shop-<?php echo $id; ?>/3.jpg" alt="">
                            </a>
                            <a class="pt" href="#product-4">
                                <img src="img/shop/Product Detail/shop-<?php echo $id; ?>/4.jpg" alt="">
                            </a>
                          
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <?php 
$imgPath = 'img/sanpham/' . $tenFile;

?>
<img data-hash="product-1" class="product__big__img" src="<?php echo htmlspecialchars($imgPath); ?>" alt="ảnh sản phẩm">

                                <img data-hash="product-2" class="product__big__img" src="img/shop/Product Detail/shop-<?php echo $id; ?>/2.jpg" alt="ảnh sản phẩm">
                                <img data-hash="product-3" class="product__big__img" src="img/shop/Product Detail/shop-<?php echo $id; ?>/3.jpg" alt="ảnh sản phẩm">
                                <img data-hash="product-4" class="product__big__img" src="img/shop/Product Detail/shop-<?php echo $id; ?>/4.jpg" alt="ảnh sản phẩm">
                                <img data-hash="product-5" class="product__big__img" src="img/shop/Product Detail/shop-<?php echo $id; ?>/5.jpg" alt="ảnh sản phẩm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3><?php echo $row['TEN']; ?></h3>
                      <div class="product__details__price"><?php echo number_format($row['GIA'], 0, "", "."); ?> đ</div>

                        <p><?php echo $row['MOTA']; ?></p>
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Số lượng:</span>
                                <div class="quantity-selector">
                                    <button onclick="decreaseQuantity()">-</button>
                                    <input type="number" id="quantity" value="1" min="1">
                                    <button onclick="increaseQuantity()">+</button>
                                </div>
                            </div>
                            <a href="#" onclick="addToCart(<?php echo $row['IDAO']; ?>)">Thêm vào giỏ hàng</a>
                            <script>
                                function increaseQuantity() {
                                    let quantityInput = document.getElementById('quantity');
                                    quantityInput.value = parseInt(quantityInput.value) + 1;
                                }

                                function decreaseQuantity() {
                                    let quantityInput = document.getElementById('quantity');
                                    if (parseInt(quantityInput.value) > 1) {
                                        quantityInput.value = parseInt(quantityInput.value) - 1;
                                    }
                                }

                                function addToCart(productId) {
                                    let quantity = document.getElementById("quantity").value || 1; // Get quantity
                                    fetch('cart_handler.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                        body: `id=${productId}&quantity=${quantity}`
                                    })
                                        .then(response => response.text())
                                        .then(data => alert("Thêm sản phẩm thành công!"))
                                        .catch(error => console.error("Error:", error));
                                }
                            </script>
                        </div>
                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Trạng thái:</span>
                                    <!-- Giả sử GIA > 0 là còn hàng, nếu có cột SOLUONG thì thay đổi -->
                                   <p><?php echo ($row['TRANGTHAI'] == 1) ? 'Còn hàng' : 'Hết hàng'; ?></p>

                                </li>
                                <li>
<span>Chọn size:</span>
<select name="IDSIZE" required>
    <?php
    // Chỉ lấy các size còn hàng của sản phẩm hiện tại
    $sql_sizes = "SELECT DISTINCT IDSIZE FROM AO WHERE TEN = ? AND TRANGTHAI = 1";
    $stmt_sizes = $conn->prepare($sql_sizes);
    $stmt_sizes->bind_param("s", $row['TEN']);
    $stmt_sizes->execute();
    $result_sizes = $stmt_sizes->get_result();

    // Hiển thị size tương ứng
    if ($result_sizes->num_rows > 0) {
        while ($size_row = $result_sizes->fetch_assoc()) {
            $size = $size_row['IDSIZE'];
            echo "<option value='$size' " . (($row['IDSIZE'] == $size) ? 'selected' : '') . ">$size</option>";
        }
    } else {
        echo "<option disabled>Hết hàng</option>";
    }
    ?>
</select>



                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<?php
// ===== LẤY SẢN PHẨM LIÊN QUAN =====

// Lấy ID sản phẩm hiện tại từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn loại áo của sản phẩm hiện tại
$sql_loai = "SELECT ao.IDLOAI, loaiao.TENLOAI 
             FROM ao 
             JOIN loaiao ON ao.IDLOAI = loaiao.IDLOAI 
             WHERE ao.IDAO = $id";
$result_loai = $conn->query($sql_loai);

$idloai = 0;
$tenloai = '';
if ($result_loai && $result_loai->num_rows > 0) {
    $row_loai = $result_loai->fetch_assoc();
    $idloai = $row_loai['IDLOAI'];
    $tenloai = $row_loai['TENLOAI'];
}
// Truy vấn sản phẩm liên quan (mỗi tên chỉ hiển thị 1 lần, chuẩn hóa tên)
$sql_related = "
    SELECT 
        MIN(a.IDAO) AS IDAO,
        a.TEN,
        MIN(a.GIA) AS GIA,
        MAX(a.TRANGTHAI) AS TRANGTHAI,
        MIN(a.URL) AS URL
    FROM ao a
    WHERE a.IDLOAI = ?
      AND a.IDAO != ?
      AND TRIM(LOWER(a.TEN)) != (
          SELECT TRIM(LOWER(TEN)) FROM ao WHERE IDAO = ?
      )
    GROUP BY TRIM(LOWER(a.TEN))
    ORDER BY MAX(a.TRANGTHAI) DESC
    LIMIT 8
";

$stmt_related = $conn->prepare($sql_related);
$stmt_related->bind_param('iii', $idloai, $id, $id);
$stmt_related->execute();
$result_related = $stmt_related->get_result();


?>

            <!-- Related Products Section -->
            <div class="row" style="width: 100%; margin-top: 60px;">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>SẢN PHẨM LIÊN QUAN</h5>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php if ($result_related->num_rows > 0) { ?>
                        <div class="related-products owl-carousel">
                            <?php
                            while ($related_row = $result_related->fetch_assoc()) {
                                // Kiểm tra trạng thái tồn kho (giả sử GIABANKM = 0 là hết hàng)
                              $stock_status = ($related_row['TRANGTHAI'] == 1) ? '' : 'stockout';
$stock_label = ($related_row['TRANGTHAI'] == 1) ? '' : '<div class="label stockout">Hết hàng</div>';

                            ?>
                                <div class="product__item">
                       <div class="product__item__pic set-bg" data-setbg="<?php echo $related_row['URL']; ?>">


                                        <?php echo $stock_label; ?>
                                        <ul class="product__hover">
                                            <li><a href="img/sanpham/<?php echo $tenFile; ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="chitietsanpham.php?id=<?php echo $related_row['IDAO']; ?>"><span class="icon_bag_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="chitietsanpham.php?id=<?php echo $related_row['IDAO']; ?>"><?php echo $related_row['TEN']; ?></a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                <div class="product__price"><?php echo number_format($related_row['GIA'], 0, "", "."); ?> đ</div>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-12 text-center"><p>Không có sản phẩm liên quan.</p></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

<!-- Instagram Begin -->
<div class="instagram">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/2.png">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/minhla.tu/" target="_blank">@nhom4</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/6.png">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/minhla.tu/" target="_blank">@nhom4</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/9.png">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/minhla.tu/" target="_blank">@nhom4</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/11.png">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/minhla.tu/" target="_blank">@nhom4</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/15.png">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/minhla.tu/" target="_blank">@nhom4</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                <div class="instagram__item set-bg" data-setbg="img/instagram/7.png">
                    <div class="instagram__text">
                        <i class="fa fa-instagram"></i>
                        <a href="https://www.instagram.com/minhla.tu/" target="_blank">@nhom4</a>
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
                        <p>Trang web bán áo chuyên cung cấp các mẫu áo thời trang, đa dạng từ áo thun, áo khoác đến áo sơ mi. Sản phẩm đảm bảo chất lượng cao, với nhiều lựa chọn về kiểu dáng và kích cỡ, phù hợp cho mọi lứa tuổi.</p>
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
                            <a href ><i class="fa fa-youtube-play"></i></a>
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

    <!-- Initialize Owl Carousel for Related Products -->
    <script>
        $(document).ready(function() {
            $('.related-products').owlCarousel({
                loop: false,
                margin: 20,
                nav: true,
                dots: true,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 4 }
                }
            });
        });
    </script>
</body>

</html>

<?php
// Đóng kết nối
$conn->close();
?>
