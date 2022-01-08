$(document).ready(function () {

    countCart();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function countCart()
    {
        $.ajax({
            method: "GET",
            url: "/shop/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    $('.addToCartBtn').click(function(e) {

        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/shop/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response){
                alert(response.status);
                countCart();
            }
        });
    });

    $('.increment-btn').click(function (e)
    {
        e.preventDefault();

        //var inc_value = $('.qty-input').val();
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10)
        {
            value ++;
            //$('.qty-input').val(value);
            $(this).closest('.product_data').find('.qty-input').val(value);
            //countCart();
        }
    });

    $('.decrement-btn').click(function (e){
        e.preventDefault();

        //var dec_value = $('.qty-input').val();
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value --;
            //$('.qty-input').val(value);
            $(this).closest('.product_data').find('.qty-input').val(value);
            //countCart();
        }
    });

    $('.remove-cart-item').click(function (e){
       e.preventDefault();

       var prod_id = $(this).closest('.product_data').find('.prod_id').val();
       $.ajax({
           method: "POST",
           url: "/shop/remove-cart-item",
           data: {
               'prod_id':prod_id,
           },
           success: function(response) {
               window.location.reload();
               alert(response.status);
               //countCart();
           }
       });
    });


    $('.order-cart-item').click(function (e){
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        $.ajax({
            method: "POST",
            url: "/shop/order-item",
            data: "",
            success: function(response) {
                window.location.reload();
                alert(response.status);
                //countCart();
            }
        });
    });


    $('.changeQuantity').click(function (e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'prod_id' : prod_id,
            'prod_qty' : qty,
        }
        $.ajax({
            method: "POST",
            url: "/shop/update-cart-item",
            data: data,
            success: function (response) {
                window.location.reload();
                //countCart();
            }
        });

    });

});
