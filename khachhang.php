<?php
require_once 'backend.php';
 
class khachhang {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function getKhachHangById($idkh){
        $query = "SELECT * FROM KHACHHANG WHERE IDKH = ?";
        $params = [$idkh];
        $types = "i";

        $result = $this->db->query($query, $params, $types);
        return $result ? $result[0] : null;
    }

    public function searchKhachHangByName($ten){
        $result = $this->db->query("SELECT * FROM KHACHHANG WHERE TEN = '$ten'");
        $result_row = 0;
        foreach($result as $row){
            $result_row ++;
        }
        return $result_row;
    }

    public function addKhachHang($ten, $pword, $diachi, $sdt){
        $query = "INSERT INTO KHACHHANG(TEN, PWORD, DIACHI, SDT) VALUES (?, ?, ?, ?)";
        $params = [$ten, $pword, $diachi, $sdt];
        $types = "ssss";

        $result = $this->db->query($query, $params, $types);
        return $result;
    }
    public function logInSearch($ten, $pword){
        $query = "SELECT IDKH, TRANGTHAI, TEN FROM khachhang WHERE TEN = ? AND PWORD = ?";
        $params = [$ten, $pword];
        $types = "ss";

        $result = $this->db->query($query, $params, $types);
        return $result ? $result[0] : null;
    }
}
?>