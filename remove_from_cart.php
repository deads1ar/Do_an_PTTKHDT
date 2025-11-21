<?php
session_start();
$userCartCookie = "cart_" . $_SESSION["IDKH"];

if (isset($_POST["productId"], $_POST["size"])) {
    $productId = $_POST["productId"];
    $sizeId = $_POST["size"];

    $cartItems = isset($_COOKIE[$userCartCookie]) ? json_decode($_COOKIE[$userCartCookie], true) : [];

    if (isset($cartItems[$productId][$sizeId])) {
        unset($cartItems[$productId][$sizeId]);
        if (empty($cartItems[$productId])) 
            unset($cartItems[$productId]);
    }

    setcookie($userCartCookie, json_encode($cartItems), time() + (86400 * 30), "/");
    echo "Item removed"; // Optional response
    exit;
};
?>