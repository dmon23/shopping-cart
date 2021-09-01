<?php
include './inc/constants.php';
require "autoloader.php";

$_POST = array_filter($_POST);
$shop_cart = new ShoppingCart();

foreach($_POST as $productName => $orderQuantity){
    $productID = array_search($productName, array_column($PRODUCTS, 'name'));
    $cartItem = new CartItem($productID, $productName, $orderQuantity);
    $shop_cart->addCartItem($cartItem);
}

?>