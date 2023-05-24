
@extends('themes.theme_2._layout.master')

@section('title')
    <title>Terms & Conditions | {{$shop->title}}</title>
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



@section('tab-content')
    {{HTML::style('themes/theme_2/css/term.css')}}

    @include('themes.theme_2._partials.theme-header')
    @include('themes.theme_2._partials.shop-tab-menu')

    <header class="container bottom-spacing">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 term-heading">
                            <p>Terms & Conditions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row no-left-right-margin">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 terms-tab">
                {{--<h3>Terms & Conditions</h3>--}}
                <article class="shop-page-article">@if($shop->shopTerm){{ $shop->shopTerm->content }}  @else Nothing to Display @endif</article>
            </div>
        </div>
    </div>
@stop

@section('cart-js')
    @include('carts._partials.addToCart')
@stop