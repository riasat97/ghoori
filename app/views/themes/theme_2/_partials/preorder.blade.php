@extends('themes.theme_2._layout.master')

@section('title')
    <title>Preorders | {{$shop->title}} @ ghoori.com.bd</title>
@stop

@section('metatags')
    <meta property="og:title" content="{{ $shop->title }}" />
    <meta property="og:site_name" content="{{ $shop->title }} @ Ghoori"/>
    <meta property="og:url" content="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}" />
    <meta property="og:description" content="{{ substr(strip_tags($shop->description), 0, 200) }}" />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />

    @if($shop->banner)
        <meta property="og:image" content="{{ asset('public_img/shop_'.$shop->id.'/banners/'.$shop->banner->path) }}" />
    @else
        <meta property="og:image" content="{{asset('img/shopbanner-default.jpg')}}" />
    @endif
    <meta property="article:author" content="{{URL::route('store.shops',$shop->getSlug())}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop


@section('dhumketu_homePage_css_files')
    {{HTML::style('themes/theme_2/css/home.css')}}
    {{HTML::style('themes/theme_2/css/_partials/bannerSlider.css')}}
    {{HTML::style('themes/theme_2/css/shop-tab.css')}}
@stop

@section('homePage_bannerSlider_js_files')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jssor-slider/20.0.0/jssor.slider.min.js"></script>
    {{ HTML::script('themes/theme_2/js/_partials/bannerSlider.js') }}
@stop


@section('preorder-content')
    {{HTML::style('themes/theme_2/css/preorder.css')}}

    @include('themes.theme_2._partials.theme-header')
    @include('themes.theme_2._partials.shop-tab-menu')

    <header class="container bottom-spacing">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 preorder-heading">
                            <p>Pre-orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="grid row">
                    @if($shop->preorder_status)
                        @foreach($all_packages as $v_packages)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 grid-item">
                                <div class="product-box">
                                    <div class="product-img" title="">
                                        <a href="{{ route('preorder.details',array($shop->getSlug(),$v_packages->preorder_id)) }}"><img src="{{asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_packages->image)}}" alt="" /></a>
                                    </div>

                                    <div class="product-info">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="product-title">{{ link_to_route('preorder.details',$v_packages->name,array($shop->getSlug(),$v_packages->preorder_id))}}</div>
                                            </div>
                                            {{--<div class="col-xs-12">--}}
                                                {{--<div class="product-description">{{$product->description}}</div>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>

                                    <div class="shop-bar">
                                        <div class="simple-product">
                                            <span class="amount text-success pricewithcomma">{{$v_packages->price}} BDT</span>
                                        </div>

                                        <a href="{{ route('preorder.details',array($shop->getSlug(),$v_packages->preorder_id)) }}" class="product_type preorder-buy-button" title="View this product">
                                            View
                                        </a>
                                        {{--<div class="buy-now-row">--}}
                                            {{--<a href="{{ route('preorder.details',array($shop->getSlug(),$v_packages->preorder_id)) }}" class="btn btn-info btn-lg btn-buy">--}}
                                                {{--View--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>






    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-xs-12">--}}
                {{--<ul class="cd-gallery">--}}
                    {{--show products according to the category of the present shop--}}
                    {{--@foreach($all_packages as $v_packages)--}}
                        {{--<li class="package package-{{$v_packages->preorder_package_id}}">--}}
                            {{--<div class="flexslider product-list-thumb-flexslider" style="">--}}
                                {{--<ul class="slides">--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ route('preorder.details',array($shop->getSlug(),$v_packages->preorder_id)) }}"><img src="{{asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_packages->image)}}" width="100" height="160" alt="" /></a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="row cd-item-info">--}}
                                {{--<b class="col-xs-7">{{ link_to_route('preorder.details',$v_packages->name,array($shop->getSlug(),$v_packages->preorder_id))}}</b>--}}
                                {{--<strong class="col-xs-5 cd-price"><span class="pricewithcomma">{{$v_packages->price}}</span> <small>BDT</small></strong>--}}
                            {{--</div>--}}
                            {{--<div class="buy-now-row">--}}
                                {{--<a href="{{ route('preorder.details',array($shop->getSlug(),$v_packages->preorder_id)) }}" class="btn btn-info btn-lg btn-buy">--}}
                                    {{--View--}}
                                {{--</a>--}}
                            {{--</div>--}}

                        {{--</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@stop
