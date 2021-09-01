<?php
require "autoloader.php";

$shop_cart = new ShoppingCart();
$shop_cart->removeCartItem($_POST['productID']);
?>