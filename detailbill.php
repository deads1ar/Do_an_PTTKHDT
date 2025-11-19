<?php


// detailbill.php - Hiển thị chi tiết đơn hàng (OOP)

include 'db.php';
include 'OrderManager.php';
include 'headerad.php';

$db = new Database();
$pdo = $db->getConnection();
$orderManager = new OrderManager($pdo);

$iddh = $_GET['iddh'] ?? null;
if (!$iddh) {
    header("Location: Qldh.php");
    exit;
}

// Cập nhật trạng thái đơn hàng nếu có POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'], $_POST['iddh'], $_POST['new_status'])) {
    $orderManager->updateStatus($_POST['iddh'], $_POST['new_status']);
}

$order = $orderManager->getOrderWithCustomer($iddh);
$order_details = $orderManager->getOrderDetails($iddh);
$status_map = $orderManager->getStatusMap();

if (!$order) {
    header("Location: Qldh.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng #<?= $iddh ?></title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Chi tiết đơn hàng #<?= $iddh ?></h1>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Thông tin đơn hàng</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID Đơn hàng:</strong> <?= $order['IDDH'] ?></p>
                    <p><strong>Khách hàng:</strong> <?= htmlspecialchars($order['TEN']) ?></p>
                    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['SDT']) ?></p>
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['DIACHI']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tổng tiền:</strong> <?= number_format($order['TONG'], 0, ',', '.') ?> đ</p>
                    <span><strong>Trạng thái:</strong> <?= $status_map[$order['TRANGTHAI']] ?? $order['TRANGTHAI'] ?></span>
                    <form method="post" class="d-flex flex-column">
                        <label class="form-label">Cập nhật trạng thái:</label>
                        <input type="hidden" name="iddh" value="<?= $iddh ?>">
                        <select name="new_status" class="form-select mb-2">
                            <?php foreach ($status_map as $enum => $label): ?>
                                <option value="<?= $enum ?>" <?= ($order['TRANGTHAI'] === $enum ? 'selected' : '') ?>>
                                    <?= $label ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="update_status" class="btn btn-sm btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-3">Sản phẩm trong đơn hàng</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $item): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($item['URL']) ?>" alt="IMG" style="max-width: 100px;"></td>
                        <td><?= htmlspecialchars($item['TEN']) ?></td>
                        <td><?= $item['SL'] ?></td>
                        <td><?= number_format($item['GIA'], 0, ',', '.') ?>đ</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="Qldh.php" class="btn btn-secondary mt-4">Quay lại quản lý đơn hàng</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
