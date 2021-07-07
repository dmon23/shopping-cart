<?php
declare(strict_types = 1);

require_once './inc/constants.php';
require_once "./inc/classes/ShoppingCart.php";

$product_id = $_POST['product_id'];

$shop_cart = new Cart();
$shop_cart_array = $shop_cart->get_cart();

$shop_cart->remove_cart($product_id);
?>