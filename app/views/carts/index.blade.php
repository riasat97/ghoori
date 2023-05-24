@extends('public.shop._layouts.shop')
@section('title')
     @if(Session::get('order')) Your Order @else All Carts @endif
@stop
@section('sidebar')
@stop

@section('content')
@if(!Session::get('order'))
<div>{{ HTML::image('img/checkout_page_bannar.jpg', null, array('class' => 'page-header-img img-responsive')) }}</div>
@endif
    <div id="shopping-cart">
        @if($order=Session::get('order'))
        <div id="order-details-container">
        @include('orders._partials.orderDetails',['orderDetails'=>$order])
         <div class="text-center">
             {{ HTML::decode(link_to_route('carts.index', 'Back To All Carts', array(), ['class' => 'btn btn-success']))}} &nbsp;
             {{ HTML::decode(link_to_route('home', 'Continue Shopping', array(), ['class' => 'btn btn-info'])) }}
         </div>
         <div></div>
        </div>
        @elseif($carts)
            <h3>Checkout</h3>
                @foreach($carts as $key => $cart)
                {{ Form::open(array('route'=>'carts.updateCart','id'=>'update-cart')) }}
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- This block is for iteration -->
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">    
                                        {{ $shopTitles[$key] }}
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                
                                
                                    
                                    
                                        @foreach($cart as $cartItem)
                                        <div class="panel-body cart-item">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4>{{ $cartItem->name }}</h4>
                                                </div>
                                                <div class="col-xs-4 col-sm-2">

                                                {{ HTML::decode(link_to_route('products.view',HTML::image( asset( '/public_img/shop_'.$cartItem->options->shop_id.'/products/thumb/'.$cartItem->options->product->images[0]->imageLink  ),"",array( 'class' => 'cart-product-image img-responsive') ),array($cartItem->options->shop->slug,$cartItem->id))) }}
                                                
                                                </div>
                                                <div class="col-xs-4 col-sm-5">
                                                    <dl class="dl-horizontal">
                                                        <dt>id</dt>
                                                        <dd>{{ $cartItem->id }}</dd>
                                                        <dt>Color</dt>
                                                        <dd> @if($cartItem->options->color){{ $cartItem->options->color->value }}@else N/A @endif</dd>
                                                        <dt>Size</dt>
                                                        <dd>@if($cartItem->options->size) {{ $cartItem->options->size->value }} @else N/A @endif</dd>
                                                        <dt>Discount</dt>
                                                        <dd>@if(\Chorki\products\Models\Product::find($cartItem->id)->getDiscountRate()){{\Chorki\products\Models\Product::find($cartItem->id)->getDiscountRate()}} @else N/A @endif</dd>
                                                        <dt>Price</dt>
                                                        <dd><span class="pricewithcomma">{{ $cartItem->price }}</span> BDT</dd>
                                                    </dl>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <h5>Quantity</h5>
                                                            <div>
                                                                {{ Form::number('qty[]',$cartItem->qty ,array('class'=>'qty form-control', 'data-shopid'=> $key,'data-qty'=>$cartItem->qty,
                                                                'min'=>1,'max'=>$cartItem->options->product->stock)) }}
                                                                {{ Form::hidden('rowid[]',$cartItem->rowid) }}
                                                                {{ Form::hidden('stock[]',$cartItem->options->product->stock) }}
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6">
                                                            <h5>Subtotal</h5>
                                                            <div>
                                                                @if($cartItem->options->discount * $cartItem->qty == $cartItem->subtotal)
                                                                <span class="pricewithcomma">{{ $cartItem->subtotal }}</span> BDT
                                                                @else
                                                                <del class="text-danger"><span class="pricewithcomma">{{ $cartItem->subtotal }}</span> BDT</del>
                                                                <span class="pricewithcomma">{{ $cartItem->options->discount * $cartItem->qty }}</span> BDT
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                                                                
                                            </div>
                                            <a class="btn btn-danger btn-sm cart-item-close" type="button" aria-hidden="true" href="{{URL::route('carts.delete',$cartItem->rowid)}}"><i class="fa fa-times"></i> <span class="visible-inline-lg">remove</span></a>
                                        </div>
                                        @endforeach
                                
                                <div class="panel-body">
                                    <div class="total text-right">
                                       <h5>Total</h5>
                                       <div class="big-total">
                                            @if($shopTotalWithDiscount[$key] == $shopTotal[$key])
                                            <span class="pricewithcomma">{{ $shopTotal[$key] }}</span> <small>BDT</small>
                                            @else
                                            <del class="text-danger"><span class="pricewithcomma">{{ $shopTotal[$key] }}</span> <small>BDT</small></del>
                                            <span class="pricewithcomma">{{ $shopTotalWithDiscount[$key] }}</span> <small>BDT</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                        {{-- <p><small>* Please Check Out to see if discount is applicable</small></p> --}}
                                    
                                    <a class="btn btn-info" href="{{URL::route('store.shops',array($cartItem->options->shop->subDomain))}}"><i class="fa fa-angle-left"></i> Buy More</a>
                                    {{ Form::submit('Update Cart',array('class'=>'btn btn-info hidden update-cart-'.$key)) }}
                                    <a href="{{URL::route('orders.addOrder',$key)}}" type="submit" value="" class="check-out-{{$key}} secondary-cart-btn btn btn-success loginButton pull-right" disabled>Check Out <i class="fa fa-angle-right"></i></a>
                                    

                                </div>

                            </div>
                        </div>


                    </div>
                {{ Form::close() }}
                @endforeach
        @else
            <div class="text-center">
            <h3>Your shopping cart is empty. Why don't you go and get some goodies? </h3>
            {{ HTML::decode(link_to_route('home', 'Continue Shopping', array(), ['class' => 'btn btn-info'])) }}

            </div>
            
        @endif
    </div><!-- end shopping-cart -->

    <?php /*view*/ ?>
@stop
@section('cart-remove')
    <script>
        $(document).on('click','.cart-item-close',function(e) {
            if(!confirm("Are you sure you want to delete this product from cart?")) return false;
        });
        $(document).ready(function(){
            $("a.secondary-cart-btn").prop('disabled', false);
        })
        $('input.qty').on('change', function() {
            var presQty=$(this).val();
            var prevQty = $(this).data('qty');
            var shopID = $(this).data('shopid');
            if(presQty == prevQty){
                $('.update-cart-'+shopID).addClass('hidden');
                $("a.check-out-"+shopID).show();
            }
            else{
            $('.update-cart-'+shopID).removeClass('hidden');
            $("a.check-out-"+shopID).hide();
            }


        })


    </script>
@stop