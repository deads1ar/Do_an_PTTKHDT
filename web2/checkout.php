<?php 
session_start();
if(isset($_SESSION['IDKH']))
$idkh = $_SESSION['IDKH'];
else 
 $idkh = 0; 
$conn = mysqli_connect('localhost','root','','qlch');
$sql0 = "SELECT * FROM khachhang WHERE IDKH = '$idkh'";

$result0 = $conn->query($sql0);
$row0 = $result0->fetch_assoc(); 
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
    <link rel="stylesheet" href="css/test1.css" type="text/css">

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

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
                        <a href="/index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!--123-->
    
    <div style="width:90%;margin-left:80px;" class="cart-container">
        <table>
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Thong tin Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng(Tạm tính )</th>
                    <th>Chỉnh sửa đơn hàng</th>
                </tr>
            </thead>
            <?php
            $userCartCookie = "cart_" . $idkh;
            if (isset($_COOKIE[$userCartCookie])) {
                $usercart = json_decode($_COOKIE[$userCartCookie],true);
            }
            else            
            $usercart = null;
            //print_r($_COOKIE);
            if(empty($usercart)){
            echo '<td colspan="6" style="padding: 50px;"><h4>Bạn chưa thêm sản phẩm nào.</h4></td>';
            echo "<script>console.log('PHP says:empty');</script>";

            }
            else{
                echo "<script>console.log('PHP says:not-empty');</script>";
            foreach($usercart as $productid=>$quantity) { 
                $sql = "SELECT * FROM ao WHERE IDAO = $productid";

            $result = $conn->query($sql);    
            $row = $result->fetch_assoc();
            ?>
            <tbody>
                <tr>
                    <td>
                        <div class="product__item__pic1 set-bg" data-setbg="<?php echo $row['URL']; ?>"></div>
                    </td>
                    <td><?php echo $row['TEN']; ?></td>
                    <td><?php echo number_format($row['GIA'],0,"",".") ."đ"; ?></td>
                    <td>
                    <input type="number" value="<?php echo $quantity; ?>" min="1" class="quantity-input"
                        data-productid="<?php echo $productid; ?>"
                        data-price="<?php echo $row['GIA']; ?>"
                        oninput="updateRowTotal(this)">
                    </td>
                    <td class="total-price"><?php echo number_format(($row['GIA'] * $quantity),0,"",".") ."đ"; ?></td>
                    <td> 
                    <button onclick="removeItem('<?php echo $productid; ?>', this)">Xóa</button>
                        <script>
                        function removeItem(productId, button) {
                        let row = button.closest("tr"); // Find the row of the item
                        row.remove(); // Remove the row from the table

                        alert("Sản phẩm đã xóa khỏi giỏ hàng.");

                        // Remove from cookie using AJAX
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "remove_from_cart.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("productId=" + productId);

                        }
                    </script>
                    </td>
                </tr>
            </tbody>
            <?php }
            }
            echo "<script>console.log('PHP says:1');</script>";
            ?>
        </table>
        <script>
        function updateRowTotal(input) {
    let price = parseFloat(input.dataset.price);  // Get price
    let quantity = parseInt(input.value);         // Get updated quantity
    let productId = input.dataset.productid;      // Get product ID
    let row = input.closest("tr");                // Locate the row
    let totalCell = row.querySelector(".total-price"); // Locate total price cell

    if (totalCell) {
        let total = price * quantity;
        totalCell.textContent = formatNumber(total) + "đ"; // Format total price
    }


    // Send update request to server
    updateCookieQuantity(productId, quantity);
}

// Format number with thousand separators
function formatNumber(num) {
    return num.toLocaleString('vi-VN'); // Formats number with dots (Vietnamese locale)
}

// Send request to update cookie in PHP
function updateCookieQuantity(productId, quantity) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "update_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("productId=" + productId + "&quantity=" + quantity);
}
        </script>
        <div id="notification" class="notification">Đã xóa sản phẩm</div>
        <div class="cart-total">
            <a href="sanpham.php">
                <button id="return">Tiếp tục mua sắm</button>
            </a>
        </div>
    <!--123-->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click
                    here to enter your code.</h6>-->
                </div>
            </div>
            <form action="#" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Chi tiết hóa đơn</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Họ Tên<span>*</span></p>
                                    <input type="text" value="<?php echo $row0['TEN'];?>" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Số Điện Thoại  <span>*</span></p>
                                    <input type="text" value="<?php echo $row0['SDT'];?>" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Địa chỉ <span>*</span></p>
                                    <input id="addressInput" name="address" type="text" value="<?php echo $row0['DIACHI'];?>" placeholder="Địa chỉ nhà " >
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Ghi chú đặt hàng <span>*</span></p>
                                    <input type="text"
                                    placeholder="Lưu ý về đơn đặt hàng của bạn, ví dụ: thông báo đặc biệt khi giao hàng">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Đơn của bạn </h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>
                                            <span class="top__text">Sản phẩm</span>
                                            <span class="top__text__right">Đơn giá</span>
                                        </li>
                                        <?php
                                        echo "<script>console.log('PHP says:1');</script>";
                                        $count = 1;
                                        $tong_gio_hang = 0;
                                        if (isset($_COOKIE[$userCartCookie])) {
                                            $usercart = json_decode($_COOKIE[$userCartCookie],true);
                                        
                                        foreach ($usercart as $product => $quantity) {
                                            $sql = "SELECT * FROM ao WHERE IDAO = '$product'";

                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                          echo "<li>" . $count . ". " . $row['TEN'] . "<span>" . number_format($row['GIA'],0,"",".") . "đ" . "</span></li>";
                                           $tong_gio_hang += $quantity * $row['GIA'];

                                            $count++;
                                        }
                                    }
                                        ?>
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                        <li id="tong_gio_hang">Tổng <span><?php echo number_format($tong_gio_hang,0,"",".");?>VND</span></li>
                                    </ul>
                                </div>
                                <div class="checkout__order__widget">
                                    <label for="check-payment">
                                        Thanh toán khi nhận hàng 
                                        <input type="checkbox" id="check-payment" name="payment" onclick="selectOnly(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="paypal">
                                        Chuyển khoản
                                        <input type="checkbox" id="paypal" name="payment" onclick="selectOnly(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="card">
                                        Thanh toán bằng thẻ 
                                        <input type="checkbox" id="card" name="payment" onclick="selectOnly(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                    
                                    <script>
                                        function selectOnly(selectedCheckbox) {
                                            const checkboxes = document.querySelectorAll('input[name="payment"]');
                                            checkboxes.forEach(checkbox => {
                                                if (checkbox !== selectedCheckbox) {
                                                    checkbox.checked = false;
                                                }
                                            });
                                        }
                                    </script>
                                    
                                    <div class="card-info" id="card-info">
                                        <div class="form-group">
                                            <label for="card-name">Tên trên thẻ:</label>
                                            <input type="text" id="card-name" placeholder="Nhập tên trên thẻ" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="card-number">Số thẻ:</label>
                                            <input type="text" id="card-number" placeholder="Nhập số thẻ" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="card-expiry">Ngày hết hạn (MM/YY):</label>
                                            <input type="text" id="card-expiry" placeholder="MM/YY" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="card-cvv">CVV:</label>
                                            <input type="text" id="card-cvv" placeholder="Nhập CVV" required>
                                        </div>
                                    </div>
                                </div>
                                <td> 
                                    <button  class="site-btn" onclick='dathang()'>Đặt hàng</button>
                                    <script>
                                    function dathang() {
    const paymentMethods = document.querySelectorAll('input[name="payment"]');
    let paymentSelected = false;
    let selectedMethod = "";

    // Check if any payment method is selected
    paymentMethods.forEach(method => {
        if (method.checked) {
            paymentSelected = true;
            selectedMethod = method.id; // Store the selected payment method
        }
    });

    if (!paymentSelected) {
        alert("Vui lòng chọn phương thức thanh toán trước khi đặt hàng!");
        return;
    }

    // If "Thanh toán bằng thẻ" is selected, validate card fields
    if (selectedMethod === "card") {
        const cardFields = ["card-name", "card-number", "card-expiry", "card-cvv"];
        let allFilled = true;

        cardFields.forEach(field => {
            let input = document.getElementById(field);
            if (!input.value.trim()) {
                allFilled = false;
                input.style.border = "2px solid red"; // Highlight empty fields
            } else {
                input.style.border = ""; // Reset border if filled
            }
        });

        if (!allFilled) {
            alert("Vui lòng điền đầy đủ thông tin thẻ trước khi đặt hàng!");
            return;
        }
    }
    
    // Send AJAX request to backend
    let address = document.getElementById("addressInput").value;
    fetch("process_order.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body:  JSON.stringify({ address: address })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                alert(data.message);
            } else if (data.status === "success") {
                //SET TONG DON HANG TO 0
                document.getElementById('tong_gio_hang').innerHTML = 'Tổng <span>0 VND</span>';
                //DELETE ALL PRODUCT FROM CART
                let table = document.querySelector("table"); // Find the table
                if (table) {
                    let rows = table.querySelectorAll("tr"); // Select all rows
                    rows.forEach((row, index) => {
                        if (index !== 0) { 
                            // If you want to keep the header (first row), skip index 0
                            row.remove();
                        }
                    });
                }
                //DELETE ALL PRODUCT FROM FROM ABOVE TONG
                document.querySelector('.checkout__order__product ul').innerHTML = `
                <li>
                    <span class="top__text">Sản phẩm</span>
                    <span class="top__text__right">Đơn giá</span>
                </li>
                `;
                alert(data.message);
                // Optionally redirect user to an order confirmation page
            }
        })
        .catch(error => {
            console.error("Error placing order:", error);
            alert("Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại sau!");
        });
}
                                </script>
                                </td>
                                <!---->
                                <script>
                                    // Hiển thị/Ẩn bảng thông tin thẻ khi checkbox được chọn/bỏ chọn
                                    const cardCheckbox = document.getElementById('card');
                                    const cardInfo = document.getElementById('card-info');
                            
                                    cardCheckbox.addEventListener('change', function () {
                                        if (this.checked) {
                                            cardInfo.style.display = 'block';
                                        } else {
                                            cardInfo.style.display = 'none';
                                        }
                                    });
                            
                                    
                                </script>
                            </div>
                        </div>
                    </div>
                </form>
        </section>
        <!-- Checkout Section End -->

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
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#">@ ashion_shop</a>
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
