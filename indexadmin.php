<?php
session_start();
include 'db.php';
include 'headerad.php';
include 'CustomerStatistics.php';

// Khởi tạo kết nối
$db = new Database();  
$stats = new CustomerStatistics($db);

// Lấy dữ liệu
$top_stats = $stats->getTopCustomers();
$filtered_stats = [];

if (!empty($_POST['stats_start']) && !empty($_POST['stats_end'])) {
    $filtered_stats = $stats->getFilteredCustomers($_POST['stats_start'], $_POST['stats_end']);
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <title>Thống Kê Khách Hàng</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Thống Kê Khách Hàng</h1>

    <!-- Form lọc -->
    <form method="post" class="row g-3 mb-4">
        <div class="col-md-5">
            <label>Từ ngày:</label>
            <input type="date" name="stats_start" class="form-control" required>
        </div>
        <div class="col-md-5">
            <label>Đến ngày:</label>
            <input type="date" name="stats_end" class="form-control" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Thống kê</button>
        </div>
    </form>

    <?php if ($filtered_stats): ?>
        <h3>Kết quả thống kê từ <?= htmlspecialchars($_POST['stats_start']) ?> đến <?= htmlspecialchars($_POST['stats_end']) ?></h3>
        <table class="table table-bordered">
            <thead>
                <tr><th>Khách hàng</th><th>Đơn hàng</th><th>Tổng tiền</th></tr>
            </thead>
            <tbody>
                <?php foreach ($filtered_stats as $stat): ?>
                    <tr>
                        <td><?= htmlspecialchars($stat['TEN']) ?></td>
                        <td>
                            <?php
                            $orders = $stats->getOrdersByCustomer($stat['IDKH']);
                            foreach ($orders as $o) {
                                echo "<a href='detailbill.php?id={$o['IDDH']}'>Đơn {$o['IDDH']}</a> (" . number_format($o['total_order'], 0, ',', '.') . " đ)<br>";
                            }
                            ?>
                        </td>
                        <td><?= $stat['TIME']?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h2 class="mt-5">Top 5 Khách Hàng Mua Nhiều Nhất</h2>
    <table class="table table-striped table-bordered">
        <thead><tr><th>Khách hàng</th><th>Đơn hàng</th><th>Tổng tiền</th></tr></thead>
        <tbody>
            <?php foreach ($top_stats as $stat): ?>
                <tr>
                    <td><?= htmlspecialchars($stat['TEN']) ?></td>
                    <td>
                        <?php
                        $orders = $stats->getOrdersByCustomer($stat['IDKH']);
                        foreach ($orders as $o) {
                            echo "<a href='detailbill.php?id={$o['IDDH']}'>Đơn {$o['IDDH']}</a> (" . number_format($o['total_order'], 0, ',', '.') . " đ)<br>";
                        }
                        ?>
                    </td>
                    <td><?= $stat['TIME'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="Ql.php" class="btn btn-secondary mt-4">Quản lý đơn hàng</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
