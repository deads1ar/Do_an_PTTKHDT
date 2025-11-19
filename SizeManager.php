<?php
class SizeManager {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM size");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
