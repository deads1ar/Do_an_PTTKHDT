<?php
include 'db.php';
include 'ProductManager.php';

$db = new Database();
$pdo = $db->getConnection();
$productManager = new ProductManager($pdo);

$id = $_GET['id'] ?? 0;

if ($id) {
    $result = $productManager->delete($id);
    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Thiếu ID']);
}
