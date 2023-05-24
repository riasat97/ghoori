
<div class="checkout">

    <div class="checkout-grid">
        <div class="checkout-grid__item checkout-grid__item--halfbox checkout-grid__item--adbox">
            <a href="https://ghoori.com.bd" target="_blank"><img src="{{ asset( '/img/cart_ad_1.jpg' ) }}" alt="Chorki"></a>
        </div>
        <div class="checkout-grid__item checkout-grid__item--halfbox checkout-grid__item--adbox">
            <a href="https://ghoori.com.bd" target="_blank"><img src="{{ asset( '/img/cart_ad_2.jpg' ) }}" alt="Chorki"></a>
        </div>
        <div class="checkout-grid__item checkout-grid__item--halfbox checkout-grid__item--adbox">
            <a href="https://ghoori.com.bd" target="_blank"><img src="{{ asset( '/img/cart_ad_3.jpg' ) }}" alt="Chorki"></a>
        </div>
        <div class="checkout-grid__item checkout-grid__item--summary checkout-grid__item--halfbox">
            <button class="checkout__close checkout__cancel"><i class="icon fa fa-close"></i></button>

            <div class="checkout__total">
            <small class="checkout__total--label">Total</small><div class=""><span class="checkout__total--value pricewithcomma">@if(!empty($cartTotal)) {{ $cartTotal }}  @else 0 @endif</span> <small class="checkout__total--label">BDT</small></div></div>
            <a href="{{URL::route('carts.index')}}" type="button" class="checkout__option checkout__option--loud @if(!$cartTotal) hidden @endif">Buy</a>
            <span class="checkout__option checkout__option--silent">* Excluding additional charges.</span>

            <a class="checkout__button" href="#"><!-- Fallback location -->
                <span class="checkout__text">
                    <svg class="checkout__icon" width="25px" height="25px" viewBox="0 0 35 35">
                        <path d="M33.623,8.004c-0.185-0.268-0.486-0.434-0.812-0.447L12.573,6.685c-0.581-0.025-1.066,0.423-1.091,1.001 c-0.025,0.578,0.423,1.065,1.001,1.091L31.35,9.589l-3.709,11.575H11.131L8.149,4.924c-0.065-0.355-0.31-0.652-0.646-0.785 L2.618,2.22C2.079,2.01,1.472,2.274,1.26,2.812s0.053,1.146 0.591,1.357l4.343,1.706L9.23,22.4c0.092,0.497,0.524,0.857,1.03,0.857 h0.504l-1.15,3.193c-0.096,0.268-0.057,0.565,0.108,0.798c0.163,0.232,0.429,0.37,0.713,0.37h0.807 c-0.5,0.556-0.807,1.288-0.807,2.093c0,1.732,1.409,3.141,3.14,3.141c1.732,0,3.141-1.408,3.141-3.141c0-0.805-0.307-1.537-0.807-2.093h6.847c-0.5,0.556-0.806,1.288-0.806,2.093c0,1.732,1.407,3.141,3.14,3.141 c1.731,0,3.14-1.408,3.14-3.141c0-0.805-0.307-1.537-0.806-2.093h0.98c0.482,0,0.872-0.391,0.872-0.872s-0.39-0.873-0.872-0.873 H11.675l0.942-2.617h15.786c0.455,0,0.857-0.294,0.996-0.727l4.362-13.608C33.862,8.612,33.811,8.272,33.623,8.004z M13.574,31.108c-0.769,0-1.395-0.626-1.395-1.396s0.626-1.396,1.395-1.396c0.77,0,1.396,0.626,1.396,1.396S14.344,31.108,13.574,31.108z M25.089,31.108c-0.771,0-1.396 0.626-1.396-1.396s0.626-1.396,1.396-1.396c0.77,0,1.396,0.626,1.396,1.396 S25.858,31.108,25.089,31.108z"></path>
                    </svg>
                </span>
                 <span class="checkout__number"> @if($cartCount) {{ $cartCount }} @else 0 @endif
                </span>
            </a>
        </div>

        @foreach($cartContents as $key =>$cartContent)

            <div class="checkout-grid__item checkout-grid__item--product" data-id="{{ $cartContent->rowid }}">
                @if($cartContent->options)
                    <img src="{{ asset( '/public_img/shop_'.$cartContent->product->shop_id.'/products/'.$cartContent->options->image ) }}" alt="Shirt">
                @endif
                <h4>
                    <span class="cartproductname ellipsis"><a class="" href=" {{ GhooriURI::producturl($cartContent->options->shop->subDomain, URL::route('products.view',array($cartContent->options->shop->getSlug(),$cartContent->id)), $cartContent->id)  }}">{{$cartContent->name}}</a></span>
                
                    <small class="shopname ellipsis">From 
                        <a href="{{GhooriURI::shopurl($cartContent->options->shop->subDomain, URL::route('store.shops', $cartContent->options->shop->slug ))}}">{{$cartContent->options->shop_title}}</a>
                    </small>
                </h4>
                <span class="price">
                    <div>
                        <span class="pricewithcomma">{{ $cartContent->price }}</span> BDT &times; <span class="cart-{{$cartContent->rowid}} qty">{{ $cartContent->qty }}</span>
                    </div>
                    <div>
                        <span class="visible-inline-xs">Subtotal: </span>
                        @if($cartContent->subtotal == $cartContent->options->discount)
                        <span class="cart-{{$cartContent->rowid}} subtotal pricewithcomma">{{ $cartContent->subtotal }}</span> BDT
                        @else
                        <del><span class="cart-{{$cartContent->rowid}} subtotal pricewithcomma">{{ $cartContent->subtotal }}</span></del>
                        <span class="cart-{{$cartContent->rowid}} subtotal pricewithcomma">{{ $cartContent->options->discount }}</span> BDT
                        @endif
                    </div>
                    
                    
                </span>
                <button class="checkout-grid__item-remove btn btn-danger btn-xs"><i class="icon fa fa-close"></i></button>
            </div>

        @endforeach
    </div>
    <div class="cart-background"></div>
</div>

@section('cart-remove')
    <script>
        $(document).on('click','.checkout-grid__item-remove',function(e) {
            if(!confirm("Are you sure you want to delete this product from cart?")) return false;
            var rowId = $(this).parent().data('id');
            var url = '{{ URL::route('carts.remove') }}';

            $.ajax({
                url: url,
                data: { 'rowid' :rowId} ,
                type: "GET",
                dataType:'jsonp',
                success: function(response) {
                    console.log(response);
                    if(response.success) {
                        setTimeout( function() {
                            var notification = new NotificationFx({

                                wrapper : document.body,

                                message : '<p>That product is removed from cart.</p>',

                                layout : 'growl',

                                effect : 'slide',

                                type : 'success',

                                ttl : 5000,

                                onClose : function() { return false; },
                                onOpen : function() { return false; }

                            });

                            notification.show();

                        }, 250 );
                        removeCart(response);
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert('Something went to wrong.Please Try again later...');
                }
            });
        });
        function removeCart(response){
            $( ".checkout-grid__item[data-id='"+response.rowid+"']" ).remove();
            $('.checkout__number').text(response.count);
            $('.checkout__total--value').text(response.total);

        }
    </script>
@stop