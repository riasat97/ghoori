{{-- Home page --}}

@extends('public.shop._layouts.index')
@section('title')
    Ghoori.com.bd
@stop
@section('homeCss')
    <link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    
    {{HTML::style('homepage/css/slide.css')}}
    {{HTML::style('homepage/slick/slick.css')}}
    {{HTML::style('homepage/slick/slick-theme.css')}}

    {{HTML::style('homepage/css/home.css')}}
@endsection
@section('metatags')
    <meta property="og:title" content="Open #eShop at Ghoori" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('home')}}" />
    <meta property="og:description" content="Ghoori is an ecommerce platform where you can start your business any day and effortlessly. Email us at info@ghoori.com.bd for details." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/ghoori_post_og.jpg')}}" />

    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop
@section('jquery')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@stop
@section('home-js')
    {{ HTML::script('homepage/js/jssor.js') }}
    {{ HTML::script('homepage/js/jssor.slider.js') }}

    {{ HTML::script('homepage/slick/slick.min.js')}}

    {{ HTML::script('homepage/script4jssor.js') }}

@endsection
@section('content')


    <!-- ********************************************Head Slide Show Block Slider:1****************************************************** -->
    <div class="container-fluid slide-show-container">
        <div class="row">
            <!-- Jssor Slider Begin -->
            <!-- To move inline styles to css file/block, please specify a class name for each element. -->
            <div class="">
                <div id="slider1_container" class="home-content-box" style="position: relative; margin: 0 auto;
                    top: 0px; left: 0px; width: 1366px; height: 341px; overflow: hidden;">
                    <!-- Loading Screen -->
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;width: 100%; height: 100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px; width: 100%; height: 100%;">
                        </div>
                    </div>
                    <!-- Slides Container -->
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1366px;
                        height: 341px; overflow: hidden;">


                        <div>
                            <img u="image" src2="{{ URL::asset('img/home/slider/nishchinte_delivery_banner_rank_2.jpg') }}" alt="" style="width:100%">

                        </div>
                        <div>
                            <img u="image" src2="{{ URL::asset('img/home/slider/order_er_khobor_banner_rank_3.jpg') }}" alt="" style="width:100%">

                        </div>
                        <div>
                            <img u="image" src2="{{ URL::asset('img/home/slider/success_banner_rank_4.jpg') }}" alt="" style="width:100%">

                        </div>
                        <div>
                            <img u="image" src2="{{ URL::asset('img/home/slider/banner_4.jpg') }}" alt="" style="width:100%">

                        </div>
                        
                    </div>


                    <!-- Arrow Left -->
                    <span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;">
                    </span>
                    <!-- Arrow Right -->
                    <span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;">
                    </span>
                    <!--#endregion Arrow Navigator Skin End -->

                </div>
            </div>
                
            <!-- Jssor Slider End -->
        </div>
    </div>



    <!-- *********************************Product box***************************************************** -->
    <div class="featured-product-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- **************************Products Box:1 Slider:2**************************** -->
                    <div class="home-content-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="section-title padding-right">Featured Shops</h3>
                                <div class="slick-class-shops">
                                    @foreach($featuredShops as $key=>$featuredShop)
                                        <div class="shop-slide">
                                            <a class="shop-slide-link" href="{{GhooriURI::shopurl($featuredShop->subDomain, URL::route('store.shops',$featuredShop->slug))}}">
                                                <img class="shop-logo" alt="" data-lazy="{{ URL::asset('public_img/shop_'.$featuredShop->shopId.'/logos/'.$featuredShop->logo) }}">
                                                <div class="shop-name">{{ $featuredShop->title }}</div>
                                                @if ( shopHasGpCampaign( $featuredShop->shopId ) )
                                                    <div class="discount-badge-small">
                                                        <img src="{{asset('img/discount_small.png')}}">
                                                    </div>
                                                @endif
                                            </a>
                                            
                                        </div>

                                    @endforeach
                                
                                </div>
                                
                            
                                    
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="section-title padding-right">Featured Products</h3>

                                <!-- To move inline styles to css file/block, please specify a class name for each element. -->
                                <div id="popular_car">

                                    <!-- Slides Container -->
                                    <div class="slick-class">

                                        @foreach($featuredProducts as $key=>$featuredProduct)
                                            <div class="product-slide">
                                                <a class="product-slide-link" href="{{GhooriURI::producturl($featuredProduct->subDomain, URL::route('products.view',array($featuredProduct->slug,$featuredProduct->productId)), $featuredProduct->productId)  }}">
                                                    <img class="product-slide-img" alt="{{ $featuredProduct->name }}"  data-lazy="{{asset('/public_img/shop_'.$featuredProduct->shopId.'/products/thumb/'.$featuredProduct->imageLink)}}">
                                                    
                                                    <div class="product-name">{{ $featuredProduct->name }}</div>
                                                    
                                                    <div class="price pricewithcomma">
                                                        {{ $featuredProduct->price }}&nbsp;BDT
                                                    </div>
                                                    @if ( productHasGpCampaign( $featuredProduct->productId ) )
                                                        <div class="discount-badge-small">
                                                            <img src="{{asset('img/discount_small.png')}}">
                                                        </div>
                                                    @endif
                                                </a>
                                                
                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                                <!-- Jssor Slider End -->
                            </div>
                        </div><!-- end row -->
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="home-content-box no-padding">
                                <div class="sidebar">
                                    @include('public.shop._partials.adbarmid')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="home-content-box">
                        <!-- **************************Products Box:1 Slider:2**************************** -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="section-title padding-right">New Shops</h3>
                                <div class="slick-class-shops">
                                    @foreach($newestShops as $key=>$newestShop)
                                        <div class="shop-slide">
                                            <a class="shop-slide-link" href="{{GhooriURI::shopurl($newestShop->subDomain, URL::route('store.shops',$newestShop->slug))}}">
                                                <img class="shop-logo" alt="" data-lazy="{{ URL::asset('public_img/shop_'.$newestShop->shopId.'/logos/'.$newestShop->logo) }}">
                                                <div class="shop-name">{{ $newestShop->title }}</div>
                                                @if ( shopHasGpCampaign( $newestShop->shopId ) )
                                                    <div class="discount-badge-small">
                                                        <img src="{{asset('img/discount_small.png')}}">
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                
                                </div>
                            </div>
                        </div>

                    

                        {{-- Slick test --}}
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="section-title padding-right">Popular Products</h3>

                                <!-- To move inline styles to css file/block, please specify a class name for each element. -->
                                <div id="popular_car">

                                    <!-- Slides Container -->
                                    <div class="slick-class slick-class-popular">

                                        @foreach($highestViewedProducts as $key=>$highestViewedProduct)

                                            <div class="product-slide">
                                                <a class="product-slide-link" href="{{GhooriURI::producturl($highestViewedProduct->subDomain, URL::route('products.view',array($highestViewedProduct->slug,$highestViewedProduct->productId)), $highestViewedProduct->productId)  }}">
                                                    <img class="product-slide-img" alt="{{ $highestViewedProduct->name }}"  data-lazy="{{asset('/public_img/shop_'.$highestViewedProduct->shopId.'/products/thumb/'.$highestViewedProduct->imageLink)}}">
                                                    
                                                    <div class="product-name">{{ $highestViewedProduct->name }}</div>
                                                    
                                                    <div class="price pricewithcomma">
                                                        {{ $highestViewedProduct->price }}&nbsp;BDT
                                                    </div>
                                                    @if ( productHasGpCampaign( $highestViewedProduct->productId ) )
                                                        <div class="discount-badge-small">
                                                            <img src="{{asset('img/discount_small.png')}}">
                                                        </div>
                                                    @endif
                                                </a>
                                                
                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                                <!-- Jssor Slider End -->
                            </div>
                        </div><!-- end row -->


                        <!-- **************************Optional Box:1**************************** -->
                            <?php /* <div class="row">
                            <h3 class="section-title padding-right"></h3>
                            <div class="col-md-6 vertical-devider">
                                <div>
                                    <a href=""><img class="optional-box-1" alt="For any image" src="{{ URL::asset('homepage/home/dummy-img/8983580c647b9bc0fdde5352f2980975f33552ea.png') }}" width="180px" height="200px"></a>
                                </div>
                                <a href=""><h4 class="product-name">Product 1</h4></a>
                                <div class="price pricewithcomma">
                                    100 BDT
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <a href=""><img class="optional-box" alt="For any image" src="{{ URL::asset('homepage/home/dummy-img/gdn-brand-solutions_products_sm.jpg')}}" width="180px" height="200px"></a>
                                </div>
                                <a href=""><h4 class="product-name">Product 2</h4></a>
                                <div class="price pricewithcomma">
                                    200 BDT
                                </div>
                            </div>
                        </div><!-- end row --> */ ?>




                        <!-- **************************Optional Box:2**************************** -->
                        <?php /*<div class="row">
                        <h3 class="section-title padding-right"></h3>
                        <div class="col-md-6 vertical-devider">
                            <div>
                                <a href=""><img class="optional-box" alt="For any image" src="{{ URL::asset('homepage/home/images/24114_HealthPersonal_Tablet_BB_HD._UX440_SX440_V315223679_.jpg') }}"></a>
                            </div>
                            <a href=""><h4 class="product-name">Product 1</h4></a>
                            <div class="price pricewithcomma">
                                100 BDT
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <a href=""><img class="optional-box" alt="For any image" src="{{ URL::asset('homepage/home/images/18534_BR_add_1320X600_HD._UX440_SX440_V310001658_.png') }}"></a>
                            </div>
                            <a href=""><h4 class="product-name">Product 2</h4></a>
                            <div class="price pricewithcomma">
                                200 BDT
                            </div>
                        </div>
                        </div><!-- end row --> */ ?>
                    </div>
                </div>


                <!-- ********************************Sidebar******************************** -->
                
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="home-content-box no-padding">
                        <div class="sidebar">
                            @include('public.shop._partials.sidebar')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="home-content-box no-padding callforadbar">
                        <a href="mailto:info@ghoori.com.bd"><img class="callforadbarimg" src="{{ URL::asset('img/home/biggapon-banner.png') }}" alt=""></a>
                    </div>
                </div>
            </div>

        </div>
    </div>



@stop
