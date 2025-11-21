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
try{
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

foreach ($cartItems as $productId => $sizes){
    foreach( $sizes as $sizeId => $quantity){
        $rowSP = $ao->getAoById($productId);
        $tongTien += $rowSP['GIA'] * $quantity;
    }
}
// Insert order into DONHANG
$insert_id = $dh->AddDonHang($_SESSION["IDKH"], $tongTien, $diachi);

// Insert order items into CTDH
foreach ($cartItems as $productId => $sizes)
    foreach( $sizes as $sizeId => $quantity){
        $result = $dh->AddCTDH($insert_id, $productId, $sizeId, $quantity);
    }
 
if ($result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Đơn hàng đã được tạo thành công!'
        ]);
    }
else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Không thể tạo đơn hàng!'
        ]);
    }

}  catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
// Clear the cart cookie after successful purchase
setcookie($userCartCookie, '', time() - 3600, '/');
unset($_COOKIE[$userCartCookie]);
?>