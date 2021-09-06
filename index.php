<?php
declare(strict_types = 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "./inc/constants.php";
// require_once "./inc/classes/CartItem.php";

require "autoloader.php";

?>

<html lang='en'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./inc/mystyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/0cd2b63422.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class='wrapper'>
        <div style='display:flex; justify-content:flex-end;'>
            <button type="button" class="btn btn-info openBtn">
                <span><i class="fas fa-shopping-cart"></i><span id='hidden-cart-text'> Show Cart</span></span>
            </button>
        </div>

        <section class="form product-list">
            <h3>PRODUCTS</h3>

            <form id='product-form'>
                <div id='product-content' style='display:flex; flex-wrap:wrap; justify-content: center; margin-bottom: 15px;'>
                <?php
                // var_dump($_SESSION);
                foreach($PRODUCTS as $productId => $productInfo)
                {   
                    echo"<div class='product-wrapper'>";
                        echo"<div class='product-item'>";
                            echo"<h4>".$productInfo['name']."</h4>";
                            echo"<h5>$".$productInfo['price']."</h5>";
                            echo"<div>";
                                echo"<input type='number' name='".$productInfo['name']."' min=0>";
                            echo"</div>";
                        echo"</div>";
                    echo"</div>";
                }
                ?>
                </div>
                <div class='button'>
                    <input id='submit-form-btn' class='btn btn-primary' type="submit" value="Submit">
                </div>
            </form>

        </section>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">My Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" id='checkoutButton' class="btn btn-primary">Checkout</button>
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            </div>
            </div>
        </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js' integrity='sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=' crossorigin='anonymous'></script>
    <script src='./inc/js/script.js'></script>
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
    $('#submit-form-btn').on('click',function(){ //reset form after submitting
        document.getElementById('product-form').reset();
    });

    $('.openBtn').on('click',function(){
        $('.modal-body').load('cartData.php',function(){
            $('#exampleModalCenter').modal({show:true});
        });
    });


    $(document.body).on('focusout', 'input.cart-item-updatequantity', function(){
        let inputVal = $(this).val();
        let minVal = $(this).prop('min');
        let initialVal = $(this).attr('initial-value');

        if(inputVal < minVal){
            $(this).val(minVal);
        } else if(inputVal === initialVal){
            console.log("SAME!!"); 
            exit;           
        }
        
        let productID = $(this).attr('product-id');
        //post to update cart + update cart total
        $.post("update_cart_item_quantity.php", 
        {
            productID: productID,
            quantity: $(this).val()
        }, 
        function(result){
            // $("span").html(result);
        });
    });

    $(document.body).on('click', '.removeCartProduct', function(){
        let productID = $(this).attr('product-id');
        
        Swal.fire({
        title: 'Remove Product?',
        text: 'Are you sure you want to remove the following product from the cart?',
        icon: 'warning',
        confirmButtonText: "YES",
        showCancelButton: true,
        cancelButtonText: "CANCEL"
        }).then(function(result)
        {
            if(result.isConfirmed)
            {
                $.post("deleteCartItem.php", 
                {
                    productID: productID
                }, 
                function(data){
                    let parsedData = JSON.parse(data);
                    let cartItemCount = parsedData['cart_products'];
                    $("#product-row-"+productID).remove();

                    if(cartItemCount < 1){
                        $("#exampleModalCenter .modal-body").html("Cart is empty brotha");
                    }
                });
            }
        });
    });
    </script>

  </body>
</body>

</html>
