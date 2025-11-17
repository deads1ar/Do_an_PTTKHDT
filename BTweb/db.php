<?php
class Database {
    private $host = '127.0.0.1';
    private $dbname = 'qlch';
    private $username = 'root';     // Default XAMPP
    private $password = '';         // Default XAMPP
    public $pdo;                   // Biến chứa PDO

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    // ✅ Hàm public để lấy PDO
    public function getConnection() {
        return $this->pdo;
    }
}
?>
