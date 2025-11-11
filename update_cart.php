<?php
session_start();
$userCartCookie = "cart_" . $_SESSION["IDKH"];

if (isset($_POST["productId"]) && isset($_POST["quantity"])) {
    $cartItems = json_decode($_COOKIE[$userCartCookie], true);

    $cartItems[$_POST["productId"]] = $_POST["quantity"]; // Update quantity

    // Update the cookie
    setcookie($userCartCookie, json_encode($cartItems), time() + (86400 * 30), "/");
    echo "Quantity updated"; // Optional response for debugging
}
?>

<?php
/*
session_start();
$cartCookieName = "user_cart";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["productId"]) && isset($_POST["quantity"])) {
    $productId = $_POST["productId"];
    $quantity = intval($_POST["quantity"]);

    // Load existing cart from cookies
    $cartItems = json_decode($_COOKIE[$cartCookieName] ?? "{}", true);

    // Update quantity
    $cartItems[$productId] = ($cartItems[$productId] ?? 0) + $quantity;

    // Store updated cart in cookies (valid for 30 days)
    setcookie($cartCookieName, json_encode($cartItems), time() + (86400 * 30), "/");

    echo "Item added to cart";
}
*/
?>