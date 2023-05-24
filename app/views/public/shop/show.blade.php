@extends('public.shop._layouts.shop')
@section('title')
    {{$shop->title}}
@stop

@section('content')

    {{--show products according to the category of the present shop--}}
    <div class="col-sm-9">
        <div class="row">
        @if($shop->products)
            @foreach($shop->products as $product)
                <!-- Collection -->
                 <div class="tab-content sideline">
                    <article>
                        <div class="view view-thumb">
                            @if($product->images)
                            {{ HTML::image($product->images->toArray()[0]['imageLink']) }}
                            @endif
                            <div class="mask">
                                <h2>{{$product->price}} Tk</h2>
                                <p>{{str_limit($product->description)}}</p>
                                {{link_to_route('products.show','View',array($product->id),array('class'=>'info'))}} <a href="checkout.html" class="info">Buy</a>
                            </div>
                        </div>
                        <p class="product-title"><a href="product.html">{{$product->name}}</a></p>
                    </article>

                </div>
                <!-- Collections end -->
            @endforeach
        @endif
        </div>
    </div>
@stop

