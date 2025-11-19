<?php
class CategoryManager {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM loaiao");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exists($id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM loaiao WHERE IDLOAI = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }
}
