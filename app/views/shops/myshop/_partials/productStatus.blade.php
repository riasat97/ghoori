<script>

    $(document).on('click','.product-status',function(e){
        e.preventDefault();
        var productId = $(this).data('id');
        console.log(productId);
        var data = $(this).text();

       /* var hiddenProductIdField = '<input type="hidden" name="product_id" value="'+productId+'" />';
        $('.product_id_container_productStatus').append(hiddenProductIdField);
        */
        $.ajax({
            url: "{{ URL::route('products.status') }}",
            data: { productId :productId } ,
            type: "GET",
            success: function(productStatus) {
                console.log(productStatus)
                changeProductStatus(productStatus);

            },
            error: function(){

            }
        });


    });

    function changeProductStatus(productStatus){
        if (productStatus.msg === 'Published'){
            var productId = productStatus.product;
            var data = $('.product-status-change-'+productId).text("Unpublish");
            var message = "Published!!";
            $('.product-'+productStatus.product).removeClass("unpublished").addClass('published');
            setTimeout( function() {
                var notification = new NotificationFx({

                    // element to which the notification will be appended
                    // defaults to the document.body
                    wrapper : document.body,

                    // the message
                    message : '<p>Product successfully published.</p>',

                    // layout type: growl|attached|bar|other
                    layout : 'growl',

                    // effects for the specified layout:
                    // for growl layout: scale|slide|genie|jelly
                    // for attached layout: flip|bouncyflip
                    // for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
                    // ...
                    effect : 'slide',

                    // notice, warning, error, success
                    // will add class ns-type-warning, ns-type-error or ns-type-success
                    type : 'success', // notice, warning, error or success

                    // if the user doesn´t close the notification then we remove it 
                    // after the following time
                    ttl : 5000,

                    // callbacks
                    onClose : function() { return false; },
                    onOpen : function() { return false; }

                });

                // show the notification

                notification.show();

            }, 500 );

            // if (message){
            //     $('.flash').html(message).fadeIn(300).delay(2500).fadeOut(300);
            // }
        }

        else{
            var productId = productStatus.product;
            var data =  $('.product-status-change-'+productId).text("Publish");
            var message = "UnPublished!!";
            $('.product-'+productStatus.product).addClass("unpublished").removeClass('published');
            setTimeout( function() {
                var notification = new NotificationFx({

                    // element to which the notification will be appended
                    // defaults to the document.body
                    wrapper : document.body,

                    // the message
                    message : '<p>Product successfully unpublished.</p>',

                    // layout type: growl|attached|bar|other
                    layout : 'growl',

                    // effects for the specified layout:
                    // for growl layout: scale|slide|genie|jelly
                    // for attached layout: flip|bouncyflip
                    // for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
                    // ...
                    effect : 'slide',

                    // notice, warning, error, success
                    // will add class ns-type-warning, ns-type-error or ns-type-success
                    type : 'success', // notice, warning, error or success

                    // if the user doesn´t close the notification then we remove it 
                    // after the following time
                    ttl : 5000,

                    // callbacks
                    onClose : function() { return false; },
                    onOpen : function() { return false; }

                });

                // show the notification

                notification.show();

            }, 500 );

            // if (message){
            //     $('.flash').html(message).fadeIn(300).delay(2500).fadeOut(300);
            // }

        }


    }
</script>