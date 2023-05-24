
@extends('themes.theme_2._layout.master')

@section('title')
    <title>Home | {{$shop->title}}</title>
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


@section('dhumketu_home_body_content')

    @include('themes.theme_2._partials.theme-header')

    @include('themes.theme_2._partials.shop-tab-menu')


    {{--Main Product COntainer--}}
    <div class="container categorized-product main-product-container">
        <div class="row">
            <div class="col-md-12">
            
                {{--Category Breadcrumb--}}
                <div class="category-breadcrumb-for-home-page">

                    <ul class="breadcrumb">
                        <li><h4 class="categorized-product-heading">{{ !empty($category)?$category:'Products' }} {{ (!empty($subCategory))?'> '.$subCategory:''}}</h4></li>
                    </ul>

                </div>

                {{--All Product Show Section--}}
                <div class="grid row">
                    @if($shop->products)
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 grid-item">
                                <div class="product-box">
                                    <div class="product-img" title="">
                                        <a href="{{GhooriURI::producturl($shop->subDomain, URL::route('products.view',array($shop->getSlug(),$product->id)), $product->id)  }}">
                                            @foreach($product->images as $key=>$image)
                                                <img class="image-key-{{$key}}" src="{{asset('/public_img/shop_'.$shop->id.'/products/thumb/'.$image->imageLink)}}" alt="Preview image">
                                            @endforeach
                                        </a>
                                    </div>

                                    <div class="product-info">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="product-title">{{ link_to_route('products.view',$product->name,array($shop->getSlug(),$product->id))}}</div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="product-description">{{$product->description}}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="shop-bar">
                                        <div class="simple-product">
                                            @if(!empty($product->getDiscountRate()))
                                                <strong class="cd-price">
                                                    <del class="small text-warning price-delete"><span class="pricewithcomma">{{$product->price}}</span> BDT</del>
                                                    <br>
                                                    <span class="pricewithcomma text-success">{{ number_format($product->price - ( $product->price * rtrim($product->getDiscountRate(),'%') / 100 ), 2) }}</span> <small class="text-success">BDT</small>
                                                </strong>
                                            @else
                                                <strong class="cd-price text-success"><span class="pricewithcomma">{{$product->price}}</span> <small>BDT</small></strong>
                                            @endif
                                        </div>

                                        <a href="{{GhooriURI::producturl($shop->subDomain, URL::route('products.view',array($shop->getSlug(),$product->id)), $product->id)  }}" class="product_type" title="View this product">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </div>

                                    @if ( $product->getActiveCampaign() && $product->getDiscountRate() )
                                        <div class="discount-tag discount-tag-lg">{{$product->getDiscountRate()}} off</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            
            </div>
        </div>
    </div>

@stop

@section('cart-js')
    @include('carts._partials.addToCart')
@stop