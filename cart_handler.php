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

    // Retrieve or create cart
    $cartItems = isset($_COOKIE[$userCartCookie]) ? json_decode($_COOKIE[$userCartCookie], true) : [];

    // Update quantity or add new product
    $cartItems[$productId] = isset($cartItems[$productId]) ? $cartItems[$productId] + $quantity : $quantity;

    // Store updated cart in cookies
    setcookie($userCartCookie, json_encode($cartItems), time() + (86400 * 30), "/");

    echo "SUCCESS";
    exit;
}
?>
