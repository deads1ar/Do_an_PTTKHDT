<?php
class UserManager {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lấy danh sách tài khoản
    public function listUsers() {
        $stmt = $this->pdo->prepare("SELECT IDKH, TEN, SDT, DIACHI, TRANGTHAI FROM khachhang");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm tài khoản
    public function addUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO khachhang (TEN, SDT, PWORD, DIACHI, TRANGTHAI) VALUES (?, ?, ?, ?, 1)");
        $stmt->execute([$data['name'], $data['phone'], $data['password'], $data['diachi']]);
        return ['message' => 'Thêm tài khoản thành công!'];
    }

    // Sửa tài khoản
    public function editUser($data) {
        if (!empty($data['password'])) {
            $stmt = $this->pdo->prepare("UPDATE khachhang SET TEN=?, SDT=?, PWORD=?, DIACHI=? WHERE IDKH=?");
            $stmt->execute([$data['name'], $data['phone'], $data['password'], $data['diachi'], $data['id']]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE khachhang SET TEN=?, SDT=?, DIACHI=? WHERE IDKH=?");
            $stmt->execute([$data['name'], $data['phone'], $data['diachi'], $data['id']]);
        }
        return ['message' => 'Cập nhật tài khoản thành công!'];
    }

    // Khóa / Mở tài khoản
    public function toggleUser($id) {
        $stmt = $this->pdo->prepare("SELECT TRANGTHAI FROM khachhang WHERE IDKH=?");
        $stmt->execute([$id]);
        $current = $stmt->fetchColumn();

        $newStatus = ($current == 1) ? 0 : 1;
        $stmt = $this->pdo->prepare("UPDATE khachhang SET TRANGTHAI=? WHERE IDKH=?");
        $stmt->execute([$newStatus, $id]);

        return ['message' => $newStatus ? 'Mở tài khoản thành công!' : 'Khóa tài khoản thành công!'];
    }
}
?>
