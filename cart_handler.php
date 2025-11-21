<?php
session_start();
if (empty($_SESSION["IDKH"])) {
    echo "NOT_LOGGED_IN";
    exit;
}
$userCartCookie = "cart_" . $_SESSION["IDKH"];

if(isset($_POST['id']) && isset($_POST['quantity'])) {
    $productId = $_POST['id'];
    $quantity = $_POST['quantity'];
    $sizeText = $_POST['size'] ?? "S"; // default S

    // convert size string → size ID
    switch ($sizeText) {
        case "S":  $size = "1"; break;
        case "M":  $size = "2"; break;
        case "L":  $size = "3"; break;
        case "XL": $size = "4"; break;
        default:   $size = "1"; // fallback
    }
    // Retrieve or create cart
    $cartItems = isset($_COOKIE[$userCartCookie]) ? json_decode($_COOKIE[$userCartCookie], true) : [];

    // Update quantity or add new product
    if (isset($cartItems[$productId][$size])) {
            $cartItems[$productId][$size] += $quantity;
        } else {
            $cartItems[$productId][$size] = $quantity;
        }
    //$cartItems[$productId] = isset($cartItems[$productId]) ? $cartItems[$productId] + $quantity : $quantity;

    // Store updated cart in cookies
    setcookie($userCartCookie, json_encode($cartItems), time() + (86400 * 30), "/");
    echo "SUCCESS";
    exit;
    
}
?>
