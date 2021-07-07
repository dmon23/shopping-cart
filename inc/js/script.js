$(document).off('click','#addToCart').on('click', '#addToCart', function() {
    var post_data = {};
    $(".product-quantity").each(function() {
        var quanity_value = parseInt($(this).val());

        if(quanity_value > 0)
        {
            post_data[$(this).attr('product_id')] = quanity_value;
        }
    });

    if (!$.isEmptyObject(post_data)) {
        $.ajax({
        type: "POST",
        url: "add_cart.php",
        data: { "add_to_cart" : post_data }
        }).done(function() {
            location.reload();
        });
    }
    else
    {
        alert("empty");
    }
});

$(document).off('click','#updateCart').on('click', '#updateCart', function() {
        var post_data = {};
        $(".shopping-cart-quantity").each(function() {
                var product_id = $(this).attr('product_id');
                post_data[product_id] = $(this).val();
        });
    
        $.ajax({
        type: "POST",
        url: "update_cart.php",
        data: { "update_cart" : post_data }
        }).done(function() {
            location.reload();
        });
      
});

$(document).off('click','.removeFromCart').on('click', '.removeFromCart', function() {
        var product_id = $(this).attr('product_id');

        $.ajax({
        type: "POST",
        url: "delete_item.php",
        data: { "product_id" : product_id }
        }).done(function() {
            location.reload();
        });
  
});


