<?php
require_once 'backend.php';

class ao {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function getAllLoaiAo() {
        $result = $this->db->query("SELECT * FROM loaiao");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAoById($id) {
        $query = "SELECT * FROM ao,loaiao WHERE loaiao.idloai = ao.idloai AND IDAO = ?";
        $params = [$id];
        $types = "i";

        $result = $this->db->query($query, $params, $types);
        return $result ? $result[0] : null;
    }

    public function getAoByLoai($idlao,$idao) {
        $query = "SELECT * FROM ao WHERE idloai = ? and IDAO != ?";
        $params = [$idlao, $idao];
        $types = "ii";

        return $this->db->query($query, $params, $types);
    }

    public function getAvailableSizes($id) {
        $query = "SELECT distinct TENSIZE FROM ao_size, size WHERE ao_size.idsize = size.idsize AND IDAO = ?";
        $params = [$id];
        $types = "i";

        $result = $this->db->query($query, $params, $types);
        $sizes = [];
        if ($result) {
            foreach ($result as $row) {
                $sizes[] = $row['TENSIZE'];
            }
        }
        return $sizes;
    }
        // Get all products or filter by category
    public function getProducts($productParam = null, $page = 1, $limit = 9) {
        $offset = ($page - 1) * $limit;

        if ($productParam) {
            $query = "SELECT * FROM ao, loaiao WHERE loaiao.idloai = ao.idloai AND TRANGTHAI <> 0 AND TENLOAI LIKE ? LIMIT ?, ?";
            $params = ["%$productParam%", $offset, $limit];
            $types = "sii";
        } else {
            $query = "SELECT * FROM AO WHERE TRANGTHAI <> 0 LIMIT ?, ?";
            $params = [$offset, $limit];
            $types = "ii";
        }

        return $this->db->query($query, $params, $types);
    }

    public function countProducts($productParam) {
        if ($productParam) {
            $query = "SELECT COUNT(*) AS total FROM ao, loaiao WHERE ao.idloai = loaiao.idloai AND TRANGTHAI <> 0 AND TENLOAI LIKE ?";
            $params = ["%$productParam%"];
            $types = "s";
        } else {
            $query = "SELECT COUNT(*) AS total FROM ao WHERE TRANGTHAI <> 0";
            $params = [];
            $types = "";
        }

        $result = $this->db->query($query, $params, $types);
        return $result[0]['total'] ?? 0;
    }
    
    public function searchProducts($keyword, $brands, $minPrice, $maxPrice, $page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM ao, loaiao WHERE ao.idloai = loaiao.idloai AND TRANGTHAI <> 0 AND TEN LIKE ? ";
        $params = ["%$keyword%"];
        $types = "s";

        if (!empty($brands)) {
            $brandPlaceholders = implode(',', array_fill(0, count($brands), '?'));
            $query .= " AND loaiao.TENLOAI IN ($brandPlaceholders)";
            foreach ($brands as $brand) {
                $params[] = $brand;
                $types .= "s";
            }
        }

        if ($minPrice !== null) {
            $query .= " AND GIA >= ?";
            $params[] = $minPrice;
            $types .= "d";
        }

        if ($maxPrice !== null) {
            $query .= " AND GIA <= ?";
            $params[] = $maxPrice;
            $types .= "d";
        }

        $query .= " LIMIT ?, ?";
        $params[] = $offset;
        $params[] = $limit;
        $types .= "ii";

        return $this->db->query($query, $params, $types);   
    }

    public function countSearchProducts($keyword, $brands, $minPrice, $maxPrice) {
        $query = "SELECT count(*) as total FROM ao, loaiao WHERE ao.idloai = loaiao.idloai AND TEN LIKE ? ";
        $params = ["%$keyword%"];
        $types = "s";

        if (!empty($brands)) {
            $brandPlaceholders = implode(',', array_fill(0, count($brands), '?'));
            $query .= " AND loaiao.TENLoai IN ($brandPlaceholders)";
            foreach ($brands as $brand) {
                $params[] = $brand;
                $types .= "s";
            }
        }

        if ($minPrice !== null) {
            $query .= " AND GIA >= ?";
            $params[] = $minPrice;
            $types .= "d";
        }

        if ($maxPrice !== null) {
            $query .= " AND GIA <= ?";
            $params[] = $maxPrice;
            $types .= "d";
        }
        return $this->db->query($query, $params, $types);   
    }
}
?>
