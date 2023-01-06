$(document).ajaxStop(function(){
    window.location.reload();
});


$(document).ready(function() {
    $('.remove').on('click', function () {
        var button = $(this);
        let variantId=button.attr("data-variant");


        $.ajax({
            url: '/cart/removeFromCart',   // sending ajax request to this url
            type: 'post',
            dataType: "JSON",

            data: {
                'variantId':variantId,
            },
            success: function (data) {

            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });
    });
    // Product Quantity
    $('.quantitybutton').on('click', function () {
        var button = $(this);
        let variantId = button.attr("data-variant");
        console.log(variantId);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0 && oldValue !==1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
        let quantity = newVal;
        if (variantId != undefined)
        {
            $.ajax({
                url: '/cart/addToCart',   // sending ajax request to this url
                type: 'post',
                dataType: "JSON",

                data: {
                    'variantId': variantId,
                    'quantity': quantity,
                    'page': "cart",
                },
                success: function (data) {
                    setTimeout(function () {// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 5000);
                },
                error: function (e) {
                    $("#result").html("Some error encountered.");
                }
            });
    }
    });

    $("#addToCart").click(function () {
        let productName=$("#productName").html();
        let variantcombination="";
        $('input:radio:checked').each(function() {
       variantcombination += $(this).val();

        });
        let variantId=$('#'+variantcombination).val();
        let quantity=$('#quantity').val();
        console.log(quantity);

        $.ajax({
            url: '/cart/addToCart',   // sending ajax request to this url
            type: 'post',
            dataType: "JSON",

            data: {
                'variantId':variantId,
                'quantity':quantity,
                'page':"details",
            },
            success: function (data) {
                $("#cartcount").html(data);
                },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });

    });
   /* $(".quantitybutton").click(function () {

        let variantId=$('#variantId').val();
        let quantity=$('#quantity').val();
        console.log(variantId);

        console.log(quantity);

        $.ajax({
            url: '/cart/addToCart',   // sending ajax request to this url
            type: 'post',
            dataType: "JSON",

            data: {
                'variantId':variantId,
                'quantity':quantity,
                'page':"cart",
            },
            success: function (data) {

            },
            error: function (e) {
                $("#result").html("Some error encountered.");
            }
        });

    });*/

});