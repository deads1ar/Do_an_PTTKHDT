<?php
class ProductManager {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Lấy toàn bộ sản phẩm + loại
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT * FROM ao 
            JOIN loaiao ON ao.IDLOAI = loaiao.IDLOAI
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm theo tên, loại, giá
    public function search($keyword = '', $brands = [], $min = 0, $max = 999999999) {
        $sql = "SELECT ao.*, loaiao.TENLOAI FROM ao JOIN loaiao ON ao.IDLOAI = loaiao.IDLOAI WHERE 1=1";
        $params = [];

        if ($keyword) {
            $sql .= " AND ao.TEN LIKE ?";
            $params[] = '%' . $keyword . '%';
        }

        if (!empty($brands)) {
            $in = implode(',', array_fill(0, count($brands), '?'));
            $sql .= " AND loaiao.TENLOAI IN ($in)";
            $params = array_merge($params, $brands);
        }

        $sql .= " AND ao.GIA BETWEEN ? AND ?";
        $params[] = $min;
        $params[] = $max;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Kiểm tra đã bán chưa
    public function isSold($id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM ctdh WHERE IDAO = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    // Xóa sản phẩm
    public function delete($id) {
        // Ẩn sản phẩm thay vì xóa
        $stmt = $this->pdo->prepare("UPDATE ao SET TRANGTHAI = 'hidden' WHERE IDAO = ?");
        $stmt->execute([$id]);
        return ['status' => 'success', 'message' => 'Sản phẩm đã được ẩn.'];
    }

    public function add($idlsp, $ten, $mota, $gia, $idsize, $image_url) {
        $query = "INSERT INTO ao (IDLOAI, URL, TEN, MOTA, GIA, IDSIZE)
        VALUES (?, ?, ?, ?, ?, ?);
        ";
        foreach($idsize as $ids) {
        $query .= "INSERT INTO ao_size (IDSIZE,IDAO) VALUES($ids,)";
        };
        $stmt = $this->pdo->prepare($query);    
    $stmt->execute([$idlsp, $image_url, $ten, $mota, $gia, $idsize]);
    return ['status' => 'success', 'message' => 'Thêm sản phẩm thành công!'];
    }

    public function getById($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM ao WHERE IDAO = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $url = $data['image_source'] === 'file' && !empty($data['image']['name']) 
            ? $this->uploadImage($data['image']) 
            : ($data['image_source'] === 'url' ? $data['image_url'] : $this->getById($id)['URL']);

        $stmt = $this->pdo->prepare("
            UPDATE ao 
            SET IDLOAI = ?, URL = ?, TEN = ?, MOTA = ?, GIA = ?, IDSIZE = ? 
            WHERE IDAO = ?
        ");
        $stmt->execute([
            $data['idlsp'], $url, $data['ten'], $data['mota'],
            $data['giaban'], $data['idsize'], $id
        ]);
    }

    private function uploadImage($file) {
        $target_dir = "img/shop/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
        $image_name = basename($file["name"]);
        $target_file = $target_dir . $image_name;
        move_uploaded_file($file["tmp_name"], $target_file);
        return $target_file;
    }

    public function unhide($id) {
    $stmt = $this->pdo->prepare("UPDATE ao SET TRANGTHAI = 'active' WHERE IDAO = ?");
    return $stmt->execute([$id]);
    }

}
