<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "qlch";
    private $port = 3307;
    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }

        // Set UTF-8 encoding for Vietnamese text
        $this->conn->set_charset("utf8mb4");
    }

    /**
     * General query method with optional parameters
     * - $query: SQL query string
     * - $params: array of values to bind (optional)
     * - $types: string representing parameter types (optional)
     */
    public function query($query, $params = [], $types = "") {
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Query preparation failed: " . $this->conn->error);
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return $this->conn->insert_id > 0 ? $this->conn->insert_id : true;  // For non-select queries (INSERT, UPDATE, DELETE)
    }

    public function close() {
        $this->conn->close();
    }
}


?>