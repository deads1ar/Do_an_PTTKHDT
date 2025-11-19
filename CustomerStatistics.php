<?php
class CustomerStatistics {
    private $pdo;

    public function __construct(Database $db) {
    $this->pdo = $db->getConnection();
}


    // Lấy top 5 khách hàng mua nhiều nhất
    public function getTopCustomers($limit = 5) {
        $stmt = $this->pdo->prepare("
            SELECT khachhang.IDKH, khachhang.TEN, TIME, SUM(ctdh.SL * ao.GIA) as total 
            FROM donhang 
            JOIN ctdh ON donhang.IDDH = ctdh.IDDH
            JOIN khachhang ON donhang.IDKH = khachhang.IDKH 
            JOIN ao ON ctdh.IDAO = ao.IDAO
            GROUP BY khachhang.IDKH, khachhang.TEN 
            ORDER BY total DESC 
            LIMIT ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lọc thống kê theo khoảng thời gian
    public function getFilteredCustomers($start, $end) {
        $stmt = $this->pdo->prepare("
            SELECT khachhang.IDKH, khachhang.TEN, TIME, SUM(ctdh.SL * ao.GIA) as total 
            FROM donhang 
            JOIN ctdh ON donhang.IDDH = ctdh.IDDH 
            JOIN khachhang ON donhang.IDKH = khachhang.IDKH 
            JOIN ao ON ctdh.IDAO = ao.IDAO 
            WHERE donhang.TIME BETWEEN ? AND ? 
            GROUP BY khachhang.IDKH, khachhang.TEN 
            ORDER BY total DESC
        ");
        $stmt->execute([$start . ' 00:00:00', $end . ' 23:59:59']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách đơn hàng của một khách
    public function getOrdersByCustomer($idkh) {
        $stmt = $this->pdo->prepare("
            SELECT donhang.IDDH,TIME, SUM(ctdh.SL * ao.GIA) as total_order 
            FROM donhang 
            INNER JOIN ctdh ON ctdh.IDDH = donhang.IDDH
            INNER JOIN ao   ON ao.IDAO   = ctdh.IDAO
            WHERE donhang.IDKH = ?
            GROUP BY donhang.IDDH
            ORDER BY donhang.IDDH DESC
        ");
        $stmt->execute([$idkh]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
