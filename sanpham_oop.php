<?php
session_start();
require_once 'backend.php'; // OOP database connection class

class SanPham {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getProducts($productParam = null, $page = 1, $limit = 9) {
        $offset = ($page - 1) * $limit;

        if ($productParam) {
            $query = "SELECT * FROM sanpham WHERE TENSP LIKE ? LIMIT ?, ?";
            $params = ["%$productParam%", $offset, $limit];
            $types = "sii";
        } else {
            $query = "SELECT * FROM sanpham LIMIT ?, ?";
            $params = [$offset, $limit];
            $types = "ii";
        }

        return $this->db->query($query, $params, $types);
    }

    public function countProducts($productParam = null) {
        if ($productParam) {
            $query = "SELECT COUNT(*) AS total FROM sanpham WHERE TENSP LIKE ?";
            $params = ["%$productParam%"];
            $types = "s";
        } else {
            $query = "SELECT COUNT(*) AS total FROM sanpham";
            $params = [];
            $types = "";
        }

        $result = $this->db->query($query, $params, $types);
        return $result[0]['total'] ?? 0;
    }
}

// ===== MAIN LOGIC =====
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$productParam = $_GET['product'] ?? null;

$sp = new SanPham();
$products = $sp->getProducts($productParam, $page);
$totalProducts = $sp->countProducts($productParam);
$totalPages = ceil($totalProducts / 9);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Sản Phẩm</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Danh sách Sản Phẩm</h1>

    <div class="product-list">
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <img src="img/product/<?php echo htmlspecialchars($product['HINH']); ?>" alt="">
                <h3><?php echo htmlspecialchars($product['TENSP']); ?></h3>
                <p><?php echo number_format($product['GIA'], 0, ',', '.'); ?>₫</p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?><?php echo $productParam ? '&product=' . urlencode($productParam) : ''; ?>"
               class="<?php echo $i == $page ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
</body>
</html>
