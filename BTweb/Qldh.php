<?php
session_start();

include 'db.php';
include 'OrderManager.php';
include 'headerad.php';

$db = new Database();
$pdo = $db->getConnection();
$orderManager = new OrderManager($pdo);

$status_labels = [
  'CHUA XAC NHAN' => 'Chưa xác nhận',
  'DA XAC NHAN'   => 'Đã xác nhận',
  'DANG GIAO'     => 'Đang giao',
  'THANH CONG'    => 'Thành công',
  'DA HUY'        => 'Đã hủy'
];


if (isset($_POST['update_status'])) {
    $orderManager->updateStatus((int)$_POST['iddh'], strtoupper(trim($_POST['new_status'])));
}

// Lấy danh sách đơn
$orders = $orderManager->filterOrders([
    'status'     => $_GET['status'] ?? '',
    'start_date' => $_GET['start_date'] ?? '',
    'end_date'   => $_GET['end_date'] ?? '',
    'location'   => $_GET['location'] ?? ''
]);

?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Quản lý đơn hàng</h1>

    <!-- Form lọc đơn hàng -->
    <form method="get" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Tình trạng:</label>
                <select name="status" class="form-select">
                  <option value="">Tất cả</option>
                  <?php foreach ($status_labels as $code => $label): ?>
                    <option value="<?= $code ?>" <?= (($_GET['status'] ?? '') === $code ? 'selected' : '') ?>>
                      <?= $label ?>
                    </option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Từ ngày:</label>
                <input type="date" name="start_date" class="form-control" value="<?= $_GET['start_date'] ?? '' ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Đến ngày:</label>
                <input type="date" name="end_date" class="form-control" value="<?= $_GET['end_date'] ?? '' ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Địa điểm:</label>
                <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($_GET['location'] ?? '') ?>" placeholder="Nhập địa chỉ">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Lọc</button>
    </form>

    <!-- Danh sách đơn hàng -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID Đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Địa chỉ</th>
                    <!--     -->
                    <th>Tổng tiền</th>
                    <th>Chi tiết đơn hàng</th>
                    <th>Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['IDDH'] ?></td>
                        <td><?= htmlspecialchars($order['TEN']) ?></td>
                        <td><?= htmlspecialchars($order['DIACHI']) ?></td>
                        <!-- <td><?= $order['TIME'] ?></td> -->
                        <td><?= number_format($order['TONG'], 0, ',', '.') . ' đ' ?></td>
                        <td>
                            <a href="detailbill.php?iddh=<?= $order['IDDH'] ?>" class="btn btn-sm btn-info">Xem chi tiết</a>
                        </td>
                        <td>
                            <form method="post" class="d-flex flex-column">
                                <input type="hidden" name="iddh" value="<?= $order['IDDH'] ?>">
                                <select name="new_status" class="form-select mb-1" required>
                                  <?php foreach ($status_labels as $code => $label): ?>
                                    <option value="<?= $code ?>" <?= ($order['TRANGTHAI'] === $code ? 'selected' : '') ?>>
                                      <?= $label ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-sm btn-success">Cập nhật</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="indexadmin.php" class="btn btn-secondary mt-4">Quay lại</a>
</div>
