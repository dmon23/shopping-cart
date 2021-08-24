<?php
declare(strict_types = 1);

require_once './inc/constants.php';
require_once "./inc/classes/ShoppingCart.php";

$add_these = $_POST['add_to_cart'];

$shop_cart = new Cart();
$shop_cart_array = $shop_cart->get_cart();

foreach($add_these as $product_id => $quantity)
{
    $product_name = $PRODUCTS[$product_id]["name"];
    $product_price = floatval($PRODUCTS[$product_id]["price"]);

    $initial_quantity = isset($shop_cart_array[$product_id]) ? $shop_cart_array[$product_id]['quantity'] : 0;
    $product_total = number_format($product_price * ($quantity + $initial_quantity), 2);

    if(isset($shop_cart_array[$product_id])) 
    {
        $shop_cart_array[$product_id]["quantity"] = $initial_quantity + $quantity;                
        $shop_cart_array[$product_id]["product_total"] = $product_total;                
    }
    else
    {
        $shop_cart_array[$product_id] =
        [
            "product_id" => $product_id,
            "name" => $product_name,
            "price" => number_format($product_price, 2),
            "quantity" => $quantity,
            "product_total" => $product_total,
        ];
    }
}


$shop_cart->update_cart($shop_cart_array);

?>