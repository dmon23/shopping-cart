<?php
declare(strict_types = 1);

require_once './inc/constants.php';
require_once "./inc/classes/ShoppingCart.php";

echo"<html lang='en'>";

echo
'<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>';

    echo"<body>";

    echo"<main class='container'>";

        echo"<div id='product-list' style='margin: 15px; padding: 10px; border: 1px solid black;'>";
            echo"<h3>Products</h3>";

            echo"<div style='display:flex; justify-content: space-evenly; flex-wrap: wrap; flex-direction: row; text-align:left; margin: 5px 0px; font-weight: bold;'>";
                echo"<div class='col-md-1'>Name</div>";
                echo"<div class='col-md-1'>Price</div>";
                echo"<div class='col-md-1'>Quantity</div>";
            echo"</div>";

            foreach($PRODUCTS as $product_id => $product_details)
            {
                echo"<div style='display:flex; justify-content: space-evenly; flex-wrap: wrap; flex-direction: row; text-align:left; margin: 5px 0px;'>";
                    echo"<div class='col-md-1'>".$product_details['name']."</div>";
                    echo"<div class='col-md-1'>".number_format($product_details['price'], 2)."</div>";
                    echo"<div class='col-md-1'><input type='number' class='product-quantity' product_id='".$product_id."' min='".$MIN_PRODUCT."' max='".$MAX_PRODUCT."'></div>";
                echo"</div>";
            }
            echo"<button class='btn btn-primary' id='addToCart'>ADD TO CART</button>";
        echo"</div>";


        $shop_cart = new Cart();
        $shop_cart_array = $shop_cart->get_cart();
        $cart_total = $shop_cart->get_cart_total();

        echo"<div id='shopping-cart' style='margin: 15px; padding: 10px; border: 1px solid black;'>";
            echo"<h3>Shopping Cart</h3>";
            if(!empty($shop_cart_array))
            {
                echo"<div style='display:flex; justify-content: space-evenly; flex-wrap: wrap; flex-direction: row; text-align:left; margin: 5px 0px; font-weight: bold;'>";
                    echo"<div class='col-md-1'>Name</div>";
                    echo"<div class='col-md-1'>Price</div>";
                    echo"<div class='col-md-1'>Quantity</div>";
                    echo"<div class='col-md-1'>Subtotal</div>";
                    echo"<div class='col-md-1'></div>";
                echo"</div>";

                foreach($shop_cart_array as $product_id => $item_details)
                    {
                        echo"<div style='display:flex; justify-content: space-evenly; flex-wrap: wrap; flex-direction: row; text-align:left; margin: 5px 0px;'>";
                            echo"<div class='col-md-1'>".$item_details['name']."</div>";
                            echo"<div class='col-md-1'>".$item_details['price']."</div>";
                            echo"<div class='col-md-1'><input type='number' class='shopping-cart-quantity' product_id='".$product_id."' min='".$MIN_PRODUCT."' max='".$MAX_PRODUCT."' value=".$item_details['quantity']."></div>";
                            echo"<div class='col-md-1'>".$item_details['product_total']."</div>";
                            echo"<div class='col-md-1'><button class='btn btn-danger removeFromCart'  product_id='".$product_id."' >Delete</button></div>";
                        echo"</div>";
                    }

                    echo"<div style='display:flex; justify-content: space-evenly; margin: 15px 10px;'>";
                        echo"<div><h5>Total: ".$cart_total."</h5></div>";
                    echo"</div>";

                echo"<button class='btn btn-primary' id='updateCart'>UPDATE CART</button>";
            }
            else
            {
                echo"<h5>Cart is empty!</h5>";
            }
        echo"</div>";

        echo"</main>";

        echo"<script src='https://code.jquery.com/jquery-3.6.0.min.js' integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=' crossorigin='anonymous'></script>";
        echo"<script src='./inc/js/script.js'></script>";
    echo"</body>";

echo"</html>";


?>