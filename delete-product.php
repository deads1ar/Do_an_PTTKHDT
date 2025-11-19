<?php
include 'db.php';
include 'ProductManager.php';

$db = new Database();
$pdo = $db->getConnection();
$productManager = new ProductManager($pdo);

$id = $_GET['id'] ?? null;
if (!$id) die("❌ Không có ID sản phẩm.");

// Gọi hàm cập nhật trạng thái
$stmt = $pdo->prepare("UPDATE ao SET TRANGTHAI = 'hidden' WHERE IDAO = ?");
$stmt->execute([$id]);

header("Location: Qlsp.php");
exit;
?>
