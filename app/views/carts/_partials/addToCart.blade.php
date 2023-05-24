<script>

    $(document).on('click', '#add-cart', function (e) {
            e.preventDefault();
            var info = $('.flash');
            var data = $("#add-to-cart").serialize();

            $.ajax({
                url: "{{ URL::route('carts.storecart') }}",
                data: data,
                dataType: "jsonp",
                type: "get",

                success: function (response) {
                    // console.log(response);
                    info.empty();
                    if (response.success) {
                        addCart(response);
                        // console.log(response);
                        setTimeout( function() {
                            var notification = new NotificationFx({

                                // element to which the notification will be appended
                                // defaults to the document.body
                                wrapper : document.body,

                                // the message
                                // message : '<p>The product "'+response.cart.name +'" added to cart.</p>',
                                message : '<p>The product is added to cart.</p>',

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

                        }, 250 );
                    }

                    else {
                        var msg = response.status;
                        // $('.error-cart-qty').html(msg).fadeIn(300);
                        // $('.error-cart-qty').delay(2500).fadeOut(300);
                        setTimeout( function() {
                            var notification = new NotificationFx({

                                // element to which the notification will be appended
                                // defaults to the document.body
                                wrapper : document.body,

                                // the message
                                // message : '<p>The product "'+response.cart.name +'" added to cart.</p>',
                                message : msg,

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
                                type : 'error', // notice, warning, error or success

                                // if the user doesn´t close the notification then we remove it 
                                // after the following time
                                ttl : 5000,

                                // callbacks
                                onClose : function() { return false; },
                                onOpen : function() { return false; }

                            });

                            // show the notification

                            notification.show();

                        }, 100 );
                    }
                },
                error: function (xhr, textStatus, thrownError) {
                    alert('Something went to wrong.Please Try again later...');

                }
            });
        });
        
    function addCart(response) {
        if(response.status == 'exists'){
            var cart = response.cart;
            $('.cart-'+cart.rowid+'.qty').text(response.cart.qty);
            $('.cart-'+cart.rowid+'.subtotal').text(addCommas(response.cart.subtotal));
            $('.checkout__number').text(response.count);
            $('.checkout__total--value').text(addCommas(response.total));
        }
        else if(response.status == 'new'){
            var cart = response.cart;
                var cartItem = '<div class="checkout-grid__item" data-id="'+cart.rowid+'"><img src="{{ asset( '/public_img') }}/shop_'+cart.options.shop_id+'/products/'+cart.options.image+'" alt="Product"><h4><span class="cartproductname ellipsis"><a href="{{URL::route('home')}}/shops/'+cart.options.shop.slug+'/products/'+cart.id+'">'+cart.name +'</a></span><small class="shopname ellipsis">Shop: <a href="{{URL::route('home')}}/shops/'+cart.options.shop.slug+'">'+cart.options.shop_title+'</a></small></h4><span class="price"><div>'+addCommas(cart.price)+' BDT &times;&nbsp;<span class="cart-'+cart.rowid+' qty">'+cart.qty+'</span></div><div><span class="visible-inline-xs">Subtotal: </span>';
                if (cart.options.discount === cart.subtotal) {
                    cartItem += '<span class="cart-'+cart.rowid+' subtotal">'+addCommas(cart.subtotal)+'</span> BDT';
                } else{
                    cartItem += '<del><span class="cart-'+cart.rowid+' subtotal">'+addCommas(cart.subtotal)+'</span></del> <span class="cart-'+cart.rowid+' subtotal">'+addCommas(cart.options.discount)+'</span> BDT';
                };
                cartItem += '</div></span><button class="checkout-grid__item-remove btn btn-danger btn-xs"><i class="icon fa fa-close"></i></button></div>';
                $('.checkout-grid').append(cartItem);
                $('.checkout__number').text(response.count);
                $('.checkout__total--value').text(addCommas(response.total));
        }
        if ( response.total > 0 ) {
            $('.checkout__option--loud').removeClass('hidden');
        }
        else {
            $('.checkout__option--loud').addClass('hidden');
        }

    }


</script>