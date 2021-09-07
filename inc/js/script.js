
    $('#submit-form-btn').on('click',function(){ //reset form after submitting
         $.ajax({
            url: 'add_cart.php',
            type: 'post',
            dataType: 'json',
            data: $('form#product-form').serialize(),
            success: function(data) {

                Swal.fire({
                    title: 'Success!',
                    text: 'Product(s) has been added to the cart',
                    icon: 'success',
                    confirmButtonText: "OK",
                    }).then(function(result)
                    {
                        $('form#product-form').trigger("reset");;
                    });
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }  
        });
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

                    Swal.fire({
                    title: 'Success!',
                    text: 'Product(s) has been removed',
                    icon: 'success',
                    confirmButtonText: "OK",
                    }).then(function(result)
                    {
                        $("#product-row-"+productID).remove();
                
                        console.log(cartItemCount);
                        if(cartItemCount < 1){
                            $("#exampleModalCenter .modal-body").html("Cart is empty brotha");
                        }
                    });
                   
                });
            }
        });
    });
