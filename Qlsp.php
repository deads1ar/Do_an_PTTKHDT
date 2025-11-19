<?php
session_start();

include 'db.php';
include 'ProductManager.php';
include 'headerad.php';

$db = new Database();
$pdo = $db->getConnection();
$productManager = new ProductManager($pdo);

// Nếu có tìm kiếm
$products = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keyword = $_POST['keyword'] ?? '';
    $brands = $_POST['brand'] ?? [];
    $min_price = intval($_POST['min_price'] ?? 1);
    $max_price = intval($_POST['max_price'] ?? 2000000);
    $products = $productManager->search($keyword, $brands, $min_price, $max_price);
} else {
    $products = $productManager->getAll();
}
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

.pagination {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 40px;
    margin-bottom: 60px;
}

.pagination a {
    display: inline-block !important;
    padding: 8px 14px;
    border: 1px solid #ddd;
    color: #333;
    border-radius: 4px;
    background-color: #fff;
    transition: background-color 0.3s, color 0.3s;
    text-decoration: none;
    font-size: 16px;
}

.pagination a:hover {
    background-color: #f1f1f1;
    color: #000;
}

.pagination a.active {
    background-color: #111;
    color: #fff;
    border-color: #111;
}

</style>

</head>
<body>
 
     <!-- Shop Section Begin -->
     <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <form id="filter-form" method="POST" action="search-results.php">
                                <input type="text" name="keyword" class="search-input" placeholder="Nhập tên sản phẩm" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>" style="margin-bottom: 20px;">
                                </div>
                            </div>
                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>TÌM THEO THƯƠNG HIỆU</h4>
                                </div>
                                <div class="size__list">
                                    <label for="nike">
                                        Áo thun
                                        <input type="checkbox" id="nike" name="brand[]" value="Áo thun" <?php echo (isset($_GET['brand']) && in_array('Áo thun', $_GET['brand'])) ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="adidas">
                                        Áo sơ mi
                                        <input type="checkbox" id="adidas" name="brand[]" value="Áo sơ mi" <?php echo (isset($_GET['brand']) && in_array('Áo sơ mi', $_GET['brand'])) ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="jordan">
                                        Áo khoác
                                        <input type="checkbox" id="jordan" name="brand[]" value="Áo khoác" <?php echo (isset($_GET['brand']) && in_array('Áo khoác', $_GET['brand'])) ? 'checked' : ''; ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="sidebar__filter">
                                    <div class="section-title">
                                        <h4>TÌM THEO GIÁ</h4>
                                    </div>
                                    <div class="filter-range-wrap">
                                        <div class="price-range" id="price-range" data-min="1" data-max="2000000"></div>
                                        <div class="range-slider">
                                            <div class="price-input">
                                                <p>Giá:</p>
                                                <input style="text-align: center;" type="text" id="minamount" name="min_price" value="1" readonly>
                                                <input style="text-align: center;" type="text" id="maxamount" name="max_price" value="2000000" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <button type="submit" id="apply-filter">Tìm Kiếm</button>
                        </form>
                    </div>
                </div>
            <!-- Shop Section End -->
            <!-- detail product start -->
                <div class="col-lg-9 col-md-9">
                    <!--add product -->
                <div class="col-lg-12 text-center" style="margin-bottom: 30px;">
                <a href="add-product.php"><button class="add-product">&#43; Thêm sản phẩm</button></a>
                </div>
                    <div class="row">
                        <?php foreach ($products as $product): ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                            <div class="product__item__pic" style="<?= $product['TRANGTHAI'] === 'hidden' ? 'filter: grayscale(100%); opacity: 0.4;' : '' ?>">
                                <img src="<?= htmlspecialchars($product['URL']) ?>" alt="<?= htmlspecialchars($product['TEN']) ?>">
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#"><?= htmlspecialchars($product['TEN']); ?></a></h6>
                                <div class="product__price"><?= number_format($product['GIA'], 0, ',', '.') ?> đ</div>
                                <div class="product__actions">
                                    <a href="edit-product.php?id=<?= $product['IDAO']; ?>"><button class="edit-product">✎ Sửa</button></a>
                                    <?php if ($product['TRANGTHAI'] === 'hidden'): ?>
                                        <a href="unhide-product.php?id=<?= $product['IDAO']; ?>"><button class="delete-product" style="background:gray;">👁 Hiện lại</button></a>
                                    <?php else: ?>
                                        <a href="delete-product.php?id=<?= $product['IDAO']; ?>"><button class="delete-product">Ẩn</button></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                                    
                        </div>
                        <?php endforeach; ?>
                            <div class="col-lg-12">
                            <div id="pagination-controls" class="pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
    
    <?php include 'footer.php'; ?>
    <!-- JS Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        function confirmDelete(id) {
            <?php
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM ctdh WHERE IDAO = ?");
            foreach ($products as $product) {
                $stmt->execute([$product['IDAO']]);
                $sold = $stmt->fetchColumn();
                echo "if (id == {$product['IDAO']} && $sold > 0) { return confirm('Sản phẩm đã được bán. Bạn có muốn ẩn nó không?'); }";
            }
            ?>
            return confirm('Bạn có chắc muốn xóa sản phẩm này không?');
        }
    </script>
    <script>
        function confirmDelete(id) {
            <?php
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM ctdh WHERE IDAO = ?");
            foreach ($products as $product) {
                $stmt->execute([$product['IDAO']]);
                $sold = $stmt->fetchColumn();
                echo "if (id == {$product['IDAO']} && $sold > 0) { return confirm('Sản phẩm đã được bán. Bạn có muốn ẩn nó không?'); }";
            }
            ?>
            return confirm('Bạn có chắc muốn xóa sản phẩm này không?');
        }

      $(document).ready(function() {
    // Format number function
    function formatNumber(number) {
        return number + " đ";
    }

    // Get min_price and max_price from URL or default
    var minPrice = <?php echo isset($_GET['min_price']) ? (int)$_GET['min_price'] : 1; ?>;
    var maxPrice = <?php echo isset($_GET['max_price']) ? (int)$_GET['max_price'] : 2000000; ?>;
    minPrice = Math.max(1, Math.min(minPrice, 2000000));
    maxPrice = Math.max(minPrice, Math.min(maxPrice, 2000000));

    // Set the initial values for the input fields
    $("#minamount").val(formatNumber(minPrice));
    $("#maxamount").val(formatNumber(maxPrice));

    // Initialize the price slider
    $("#price-range").slider({
        range: true,
        min: 1,
        max: 2000000,
        values: [minPrice, maxPrice],
        slide: function(event, ui) {
            $("#minamount").val(formatNumber(ui.values[0]));
            $("#maxamount").val(formatNumber(ui.values[1]));
        }
    });
});



    // Pagination for product items
    $(document).ready(function() {
    // Phân trang cho sản phẩm
    const products = document.querySelectorAll(".product__item");
    const productsPerPage = 6;
    const totalProducts = products.length;
    const totalPages = Math.ceil(totalProducts / productsPerPage);
    let currentPage = 1;

    function showPage(page) {
        products.forEach((product, index) => {
            product.style.display = (index >= (page - 1) * productsPerPage && index < page * productsPerPage) ? "block" : "none";
        });
        updatePagination(page);
    }

    function updatePagination(activePage) {
        const paginationContainer = document.getElementById("pagination-controls");
        paginationContainer.innerHTML = "";

        if (totalPages > 1) {
            if (activePage > 1) {
                paginationContainer.innerHTML += `<a href="#" data-page="${activePage - 1}">« Trước</a>`;
            }

            for (let i = 1; i <= totalPages; i++) {
                paginationContainer.innerHTML += `<a href="#" data-page="${i}" class="${i === activePage ? 'active' : ''}">${i}</a>`;
            }

            if (activePage < totalPages) {
                paginationContainer.innerHTML += `<a href="#" data-page="${activePage + 1}">Tiếp »</a>`;
            }
        }

        document.querySelectorAll("#pagination-controls a").forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault();
                currentPage = parseInt(this.getAttribute("data-page"));
                showPage(currentPage);
            });
        });
    }

    // Hiển thị trang đầu tiên
    showPage(currentPage);
});

    </script>


</body>
</html> 
