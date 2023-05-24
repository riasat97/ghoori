@extends('themes.theme_2._layout.master')

@section('title')
    <title>Preorder {{$preorder->name}} | Ghoori</title>
@stop

@section('metatags')
    <meta property="og:title" content="Preorders | {{$shop->title}} @ ghoori.com.bd" />
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


@section('dhumketu_productPage_css_files')
    <!-- Product Slider -->
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.5/css/lightslider.min.css">

    {{--{{HTML::style('themes/theme_2/css/category-breadcrumb.css')}}--}}
    {{--{{HTML::style('themes/theme_2/css/product.css')}}--}}
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
                        <div class="col-md-12 preorder-details-heading">
                            <p>{{$preorder->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="single">
        <div class="container">
            <!-- Single Product Section -->
            <div style="color: #0033DD; font-size: 20px;"><?php echo Session::get('message');?></div>
            {{--<div class="row">--}}
                {{--<header class="col-sm-12 prime">--}}
                    {{--<h3 id="ptitle" data-type="text" data-pk="1" data-url="post.php" data-title="Enter title">{{$preorder->name}}</h3>--}}
                {{--</header>--}}
            {{--</div>--}}
            <div class="row">
                <div class="col-md-7 box-1">
                    @if($preorder->product_url!= NULL)
                        <?php

                        $var=$preorder->product_url;
                        $url = $var;
                        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                        $id = $matches[1];
                        $width = '750px';
                        $height = '400px';
                        ?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="ytplayer" type="text/html" class="embed-responsive-item"
                                    src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                                    frameborder="0" allowfullscreen></iframe>
                        </div>

                    @endif

                    <div class="product-slider-box">
                        <div class="single-product-slider">
                            <div class="demo slider-lighter-demo">
                                <ul id="lightSlider-2">
                                    @foreach($preorder->images as $key => $image)
                                        <li data-thumb="{{ asset('/public_img/shop_'.$shop->id.'/preorder/'.$image->image)}}">
                                            <a href="{{ asset( '/public_img/shop_'.$shop->id.'/preorder/'.$image->image ) }}" class="product-image-link">
                                                <img src="{{ asset( '/public_img/shop_'.$shop->id.'/preorder/'.$image->image ) }}" />
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  {{ dd($packages[0]->toArray()) }}--}}

                <div class="col-md-5">
                    @foreach($packages[0]->packages as $v_package)
                        <div class="details wrapper">
                            <p class="price">
                                <i class="icon-tag"></i>
                                <span class="pricewithcomma">{{$v_package->price}}</span> BDT
                            </p>

                            <p>{{$v_package->description}}</p>
                            <table class="table">
                                <tr>
                                    <th>Remaining</th>
                                    <td>{{$v_package->quantity}}</td>
                                </tr>
                                <tr>
                                    <th>Estimated Delivery</th>
                                    <td>{{ \Carbon\Carbon::createFromFormat( 'Y-m-d',$v_package->delivery_date )->toFormattedDateString('d M Y') }} to {{ \Carbon\Carbon::createFromFormat( 'Y-m-d',$v_package->delivery_date )->addDays(10)->toFormattedDateString('d M Y') }}</td>
                                </tr>
                            </table>

                            <a class="btn btn-success loginButton pack-shop-button preorder-button" id="" href="{{ route('preorder.checkout',array($shop->getSlug(),$v_package->preorder_package_id)) }}" role="button" >Pre-order Now!</a>
                        </div>
                    @endforeach

                        <div class="details wrapper">
                            <div class="accordion" id="accordion2">
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#description">
                                            <i class="icon-layout theme"></i> Product Description
                                        </a>
                                    </div>
                                    <div id="description" class="accordion-body">
                                        <div class="accordion-inner" id="prodesc" data-type="textarea" data-pk="1" data-url="post.php" data-title="Enter title">
                                            {{$preorder->description}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background: #bce8f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign In </h4>
                </div>
                {{Form::open(array('url'=>'preorder-login','role'=>'form','method'=>'POST','id'=>'frm'))}}
                <div class="modal-body" style="background: #28a4c9;">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-at"></i></div>
                            <input type="email" class="form-control" id="remail" placeholder="Email" name="email">
                        </div>
                        <span class="help-block has-error" data-error='0' id="remail-error"></span>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                            <input type="password" class="form-control" id="repassword" placeholder="Password" name="password">
                        </div>
                        <span class="help-block has-error" data-error='0' id="remail-error"></span>
                    </div>
                    <button type="submit" class="btn btn-success pack-shop-button" id="login_btn_1" >Login</button>
                </div>
                {{Form::close()}}
                <div class="modal-footer" style="background:greenyellow; ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop




@section('dhumketu_productPage_js_files')

    <!-- Product Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.5/js/lightslider.min.js"></script>
    <script>
        $('#lightSlider-2').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9,
            auto: true,
            pauseOnHover: true,
            slideEndAnimation: true,
            // controls: false,
            // adaptiveHeight: true,
            // autoWidth: true,
            // gallery: false,
            // galleryMargin: 50,
            enableTouch: true,
            // enableDrag: true,
            thumbMargin: 10,
            mode: 'slide',
            speed: 600,
            pause: 4000  //or 'slide'

        });
    </script>

@stop
