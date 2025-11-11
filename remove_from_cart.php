<?php
session_start();
$userCartCookie = "cart_" . $_SESSION["IDKH"];

if (isset($_POST["productId"]) && isset($_COOKIE[$userCartCookie])) {
    $cartItems = json_decode($_COOKIE[$userCartCookie], true);
    
    unset($cartItems[$_POST["productId"]]); // Remove item from array

    // Update cookie with new cart data
    setcookie($userCartCookie, json_encode($cartItems), time() + (86400 * 30), "/");
    echo "Item removed"; // Optional response
}
?>