<?php
require "autoloader.php";

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if(isset($_SESSION['shopping_cart']))
{
    echo"<section class='container'>";
    $cart_items = unserialize($_SESSION['shopping_cart']['items']);
    foreach($cart_items as $index => $item)
    {
        $productName = $item->getProductName();
        $productQuanity = $item->getQuantity();
        $productID = $item->getProductID();
        echo"<div id='product-row-$productID' class='row'>";
            echo"<div class=''>$productName</div>";
            echo"<div class='input-group'>";
                echo"<input class='cart-item-updatequantity' type='number' product-id='$productID' name='".$productName."' value='$productQuanity' initial-value='$productQuanity'  min='1'>";
                echo"<div class='input-group-append'>";
                    echo"<button class='btn btn-danger removeCartProduct' type'button' product-id='$productID'>X</button>";
                echo"</div>";
            echo"</div>";
        echo"</div>";
    }
    echo"</section>";
}
else
{
    echo "Cart is empty brotha";
}
?>
