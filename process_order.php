<?php
session_start();
$userCartCookie = "cart_" . $_SESSION["IDKH"];
$cartItems = json_decode($_COOKIE[$userCartCookie] ?? "{}", true);
// Include necessary files
require_once 'backend.php';
require_once 'ao.php';
require_once 'donhang.php';
$db = new Database();
$ao = new ao($db);
$dh = new donhang($db);
$conn = $db->conn;
// Read the raw POST body
$rawData = file_get_contents("php://input");

// Decode the JSON into a PHP array
$data = json_decode($rawData, true); // `true` makes it an associative array

// Now you can access the 'address'
$diachi = $data['address'];

if (empty($cartItems)) {
    echo json_encode(["status" => "error", "message" => "Giỏ hàng trống, không thể tạo đơn hàng."]);
    exit;
}
// Calculate total amount
$tongTien = 0;

foreach ($cartItems as $productId => $quantity) {
    $rowSP = $ao->getAoById($productId);
    $tongTien += $rowSP['GIA'] * $quantity;
}
// Insert order into DONHANG
$insert_id = $dh->AddDonHang($_SESSION["IDKH"], $tongTien, $diachi);

// Insert order items into CTDH
foreach ($cartItems as $productId => $quantity) {
    $dh->AddCTDH($insert_id, $productId, $quantity);
}
 
echo json_encode(["status" => "success", "message" => "Đã đặt hàng thành công!"]);
// Clear the cart cookie after successful purchase
setcookie($userCartCookie, '', time() - 3600, '/');
unset($_COOKIE[$userCartCookie]);
?>