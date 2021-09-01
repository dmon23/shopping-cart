<?php
require "autoloader.php";

$shop_cart = new ShoppingCart();
$shop_cart->updateCartItem($_POST['productID'], $_POST['quantity']);

?>