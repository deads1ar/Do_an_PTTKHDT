<?php
session_start();

include 'db.php';
include 'ProductManager.php';

$db = new Database();
$pdo = $db->getConnection();
$productManager = new ProductManager($pdo);
$productManager->unhide($id);

$id = $_GET['id'] ?? null;
if (!$id) die("❌ Không có ID sản phẩm.");

// Hiện lại sản phẩm
$stmt = $pdo->prepare("UPDATE ao SET TRANGTHAI = 'active' WHERE IDAO = ?");
$stmt->execute([$id]);

header("Location: Qlsp.php");
exit;
?>
