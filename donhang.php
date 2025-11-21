<?php
require_once 'backend.php';

class donhang{
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function getAllDonHang() {
        $result = $this->db->query("SELECT * FROM donhang");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDonHangById($id) {
        $query = "SELECT *, DATE_FORMAT(TIME, '%Y-%m-%d') AS formatted_date FROM donhang WHERE IDDH = ?";
        $params = [$id];
        $types = "i";

        $result = $this->db->query($query, $params, $types);
        return $result ? $result[0] : null;
    }

    public function getDonHangByUserId($idkh){
        $query = "SELECT *, DATE_FORMAT(TIME, '%Y-%m-%d') AS formatted_date FROM DONHANG WHERE IDKH = ?";
        $params = [$idkh];
        $types = "i";

        $result = $this->db->query($query, $params, $types);
        return $result ? $result : null;
    }

    // public function AddDonHang($idkh, $tong, $diachi){
    //     $query = "INSERT INTO DONHANG(IDKH, TONG, DIACHI, IDNV) VALUES (?, ?, ?, NULL)";
    //     $params = [$idkh, $tong, $diachi];
    //     $types = "iis";

    //     $result = $db->query($query, $params, $types);
    //     return $result;
    // }

    public function AddDonHang($idkh, $tong, $diachi){
        $query = "INSERT INTO DONHANG(IDKH, TONG, DIACHI, IDNV) VALUES (?, ?, ?, NULL)";
        $params = [$idkh, $tong, $diachi];
        $types = "iis";
        $stmt = $this->db->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->db->conn->error);
        }

        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        $insert_id = $this->db->conn->insert_id;

        return $insert_id;
    }

    public function getInsertId() {
        return $this->conn->insert_id;
    }

    //ctdh

    public function AddCTDH($iddh, $idao, $idsize, $sl){
        $query = "INSERT INTO CTDH(IDDH, IDAO, IDSIZE, SL) VALUES (?, ?, ?, ?)";
        $params = [$iddh, $idao, $idsize, $sl];
        $types = "iiii";
        $stmt = $this->db->conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->db->conn->error);
        }
        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function getDonHangForctdh($iddh){
        $query = "SELECT DISTINCT dh.DIACHI,SDT,TEN,TONG,dh.TRANGTHAI,TIME, DATE_FORMAT(TIME, '%Y-%m-%d') AS formatted_date FROM donhang as dh JOIN ctdh on dh.IDDH = ctdh.IDDH JOIN khachhang kh on kh.IDKH = dh.IDKH where ctdh.IDDH = ?";
        $params = [$iddh];
        $types = "i";

        $result = $this->db->query($query, $params, $types);
        return $result ? $result : null;
    }

    public function getctdhByIddh($iddh){
        $query =   "SELECT SL, URL, TEN, GIA, TENSIZE 
                    FROM ao     
                    JOIN ctdh on ctdh.IDAO = ao.IDAO 
                    JOIN ao_size on ao_size.IDAO = ctdh.IDAO 
                    JOIN size on size.IDSIZE = ao_size.IDSIZE WHERE IDDH = ?";
        $params = [$iddh];
        $types = "i";

        $result = $this->db->query($query, $params, $types);
        return $result ? $result : null;
    }
    public function closeConnection() {
        $this->db->close();
    }

}
?>