<?php
class OrderManager {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function updateStatus($iddh, $new_status) {
        $valid = ['CHUA XAC NHAN','DA XAC NHAN','DANG GIAO','THANH CONG', 'DA HUY'];
        if (in_array($new_status, $valid, true)) {
            $stmt = $this->pdo->prepare("UPDATE donhang SET TRANGTHAI = ? WHERE IDDH = ?");
            return $stmt->execute([$new_status, $iddh]);
        }
        return false;
    }

    public function filterOrders($filters) {
        $where = "WHERE 1=1";
        $params = [];

        if (!empty($filters['status'])) {
            $where .= " AND donhang.TRANGTHAI = ?";
            $params[] = $filters['status'];
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $where .= " AND donhang.TIME BETWEEN ? AND ?";
            $params[] = $filters['start_date'] . ' 00:00:00';
            $params[] = $filters['end_date'] . ' 23:59:59';
        }

        if (!empty($filters['location'])) {
            $where .= " AND khachhang.DIACHI LIKE ?";
            $params[] = "%" . $filters['location'] . "%";
        }

        $stmt = $this->pdo->prepare("
            SELECT donhang.IDDH, khachhang.TEN, khachhang.DIACHI, donhang.TRANGTHAI, donhang.TONG
            FROM donhang
            JOIN khachhang ON donhang.IDKH = khachhang.IDKH
            $where
        ");
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderWithCustomer($iddh) {
        $stmt = $this->pdo->prepare("
            SELECT donhang.IDDH, donhang.TRANGTHAI, donhang.TONG, khachhang.TEN, khachhang.DIACHI, khachhang.SDT 
            FROM donhang 
            JOIN khachhang ON donhang.IDKH = khachhang.IDKH 
            WHERE donhang.IDDH = ?
        ");
        $stmt->execute([$iddh]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($iddh) {
        $stmt = $this->pdo->prepare("
            SELECT ao.TEN, ao.GIA, ctdh.SL, ao.URL 
            FROM ctdh 
            JOIN ao ON ctdh.IDAO = ao.IDAO 
            WHERE ctdh.IDDH = ?
        ");
        $stmt->execute([$iddh]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatusMap() {
        return [
            'CHUA XAC NHAN' => 'Chưa xác nhận',
            'DA XAC NHAN' => 'Đã xác nhận',
            'DANG GIAO' => 'Đang giao',
            'THANH CONG' => 'Đã giao - Thành công',
            'DA HUY' => 'Đã giao - Hủy đơn'
        ];
    }
}
