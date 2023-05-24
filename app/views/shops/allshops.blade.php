{{-- Home page --}}

@extends('public.shop._layouts.index')
@section('title')
All #eShops in Ghoori
@stop
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
@section('content')

<!-- Mdal -->

<div class="modal fade welcome-modal" tabindex="-1" role="dialog" aria-labelledby="WelcomeModalLabel">
  <div class="modal-dialog modal-lg">
    
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        
            <div class="modal-body welcome-modal-body">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="merchant-header__signup">
                            <h2>Ghoori is an ecommerce platform where you can <span class="segment-heading">start your business</span> any day and effortlessly
                            </h2>
                            <h4>Your own eShop is just a click away!!!</h4>
                            {{ Form::open(array('route' => 'shops.create','method' => 'get', 'class' => 'loginBeforeSubmitForm form-inline email-subscription-form','data-remote', 'data-remote-success-message'=>'Well done!')) }}
                            <div class="input-group input-group-md">
                                    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>"Email address",'id' => 'subscribed-email')) }}
                                    <span class="input-group-btn">
                                        {{ Form::submit('Get started', array('class'=>'btn btn-primary email-subscription-button', 'data-toggle'=>'modal', 'data-target'=>'#subscription-pop-up')) }}
                                    </span>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="col-xs-6 col-xs-offset-1">
                        <p class="banner-image-para">
                        <img id="banner-hero" class="" src="{{asset('img/intro/4_desktop_x1.jpg')}}" srcset="{{asset('img/intro/4_desktop_x1.jpg')}} 1x, {{asset('img/intro/4_desktop_x2.jpg')}} 2x" alt="Ghoori">

                    </div>
                </div>
                <div class="row no-gutter border-top">
                    <div class="col-sm-6">
                        <div class="left_box border_right">
                            <div class="row">
                                <div class="col-xs-7">
                                    <div class="half_home_text">
                                        <h4>Create an online store or add ecommerce to an existing site</h4>
                                        {{ link_to_route('shops.create','Open eShop​',null,array('class'=>'btn btn-warning btn-md loginButton', 'id'=>'createShopBtn')) }}
                                    </div>
                                </div>

                                <div class="col-xs-5">
                                    <div class="half_home_image">
                                        {{ HTML::image('img/intro/shop-feed-in-mac.png', 'device',array("class" => "img-responsive")) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="right_box">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="half_home_image">
                                        {{ HTML::image('img/intro/products-in-tab-n-mobile.png', 'device',array("class" => "img-responsive")) }}
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="half_home_text">
                                        <h4>Your eShop is fully customized secure and fully loaded with features</h4>
                                        {{ link_to_route('store.getFeatures','Learn More',null,array('class'=>'btn btn-primary btn-md', 'id'=>'')) }}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
  </div>
</div>


<div class="container mt60">
    <div class="row">
        <div class="col-md-3 col-lg-2 col-xs-6 col-sm-4">
            <div class="shop-box create-shop-box">
                <a href="{{URL::route('pricing') }}" class="createShopButton">
                    {{HTML::image('img/create-shop.png')}}
                </a>
            </div>
        </div>
        @foreach($shops as $shop)
            @if(isEshopVerifiedToAppearInPublic($shop))
                <div class="col-md-3 col-lg-2 col-xs-6 col-sm-4">
                    <div class="shop-box">
                        <div class="shop-box-header shop-logo">
                            <div class="total-products"></div>
                            <p class="ch_shoplist_logo">
                                @if($shop->id == $ownShopId)
                                    <a class="ch_shoplist_link" href="{{URL::route('shops.show',$shop->getSlug())}}" role="button">
                                @else
                                    <a class="ch_shoplist_link" href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}" role="button">
                                @endif
                                @if($shop->logo)
                                    {{ HTML::image(asset('public_img/shop_'.$shop->id.'/logos/'.$shop->logo->logo),'', array( 'width' => '165','height'=>'165','class' => "img-responsive ch_shoplist_thumb" )) }}
                                @else
                                    <img src="{{asset('img/e-shop.jpg')}}" class="img-responsive ch_shoplist_thumb">
                                @endif
                                </a>
                            </p>

                        </div>              
                        <div class="shop-box-body">
                            @if($shop->id == $ownShopId)
                                <a class="ch_shoplist_link" href="{{URL::route('shops.show',$shop->getSlug())}}" role="button">
                            @else
                                <a class="ch_shoplist_link" href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}" role="button">
                            @endif
                                
                                <p class="shop-box-title"><b>{{$shop->title}}</b></p>
                                <p class="shop-box-description">
                                                {{strip_tags($shop->description)}}
                                </p>
                            </a>
                        </div>
                        <div class="shop-footer">
                            @if($shop->id == $ownShopId)
                                <a href="{{URL::route('shops.show',$shop->getSlug())}}" class="btn btn-info btn-shop-view">View</a>

                            @else
                                <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}" class="btn btn-info btn-shop-view">View</a>
                                
                            @endif
                            
                        </div>
                    </div>

                </div>

            @endif
        @endforeach
                

    </div>
</div>
@stop
