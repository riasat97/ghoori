<!-- Main jumbotron for a primary marketing message or call to action -->
<!-- Main jumbotron for a primary marketing message or call to action -->
@extends('public.shop._layouts.index')
@section('title')
    Get Started
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('store.getFeatures')}}">
    <meta property="og:title" content="Ghoori #LearnMore" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('store.getFeatures')}}" />
    <meta property="og:description" content="You will get a unique shop address from Ghoori. Example: yourshop.ghoori.com.bd. Or you can have your own domain as well." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/learnmore_og.jpg')}}" />
    
    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop

@section('cookiejarconversion')
<!-- Facebook Conversion Code for Leads - Ghoori.com.bd -->
<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6026083850573', {'value':'0.00','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6026083850573&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
@stop

@section('info')


<div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="merchant-header__signup">
                    <h1>Ghoori is an ecommerce platform where you can <span class="segment-heading">start your business</span> any day and effortlessly
                    </h1>
                    <h3>Your own eShop is just a click away!!!</h3>
                    {{ Form::open(array('route' => 'pricing','method' => 'get', 'class' => 'loginBeforeSubmitForm form-inline email-subscription-form','data-remote', 'data-remote-success-message'=>'Well done!')) }}
                    <div class="input-group input-group-lg">
                            {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>"Email address",'id' => 'subscribed-email')) }}
                            <span class="input-group-btn">
                                {{ Form::submit('Get started', array('class'=>'btn btn-primary email-subscription-button', 'data-toggle'=>'modal', 'data-target'=>'#subscription-pop-up')) }}
                            </span>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="col-sm-6">
                <p class="banner-image-para">
                <img id="banner-hero" class="" src="{{asset('img/intro/4_desktop_x1.jpg')}}" srcset="{{asset('img/intro/4_desktop_x1.jpg')}} 1x, {{asset('img/intro/4_desktop_x2.jpg')}} 2x" alt="Ghoori">

            </div>
        </div>
</div>

<div class="full_width">
    <div class="container">
        <div class="row no-gutter">
            <div class="col-sm-6">
                <div class="left_box border_right">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="half_home_text">
                                <h4>Create an online store or add ecommerce to an existing site</h4>
                                {{ link_to_route('pricing','Open eShop​',null,array('class'=>'btn btn-warning btn-lg loginButton', 'id'=>'createShopBtn')) }}
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
                                <h4>Your eShop is fully customized secure and fully loaded with features…</h4>
                                {{ link_to_route('store.getFeatures','Learn More',null,array('class'=>'btn btn-primary btn-lg', 'id'=>'')) }}
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="intro_title_box">
                <h1>The way we buy things has changed</h1>
                <p class="intro_title_sub">Your customers are shopping online, in person, on mobile devices, and with social media. Reach them all with one platform.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-8">
            <h3 class="heading--2 segment-everywhere-heading">Do you know users are buying more from Online?</h3>
            <p>People are purchasing products from online stores more than ever. In past, opening a new ecommerce business was tough and complicated- Ghoori makes it simple.
            </p>
        </div>
        <div class="col-sm-4 info-block-icon">
            {{ HTML::image('img/intro/sales.png', 'device',array("class" => "")) }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 info-block-icon">

            {{ HTML::image('img/intro/shopping-bags-and-shoes.png', 'device',array("class" => "")) }}
        </div>
        <div class="col-sm-8">
            <h3 class="heading--2 segment-everywhere-heading">Grow Your Online Business</h3>
            <p>
            You can increase your online sales by having more than one online stores. Opening an eShop in Ghoori is as simple as having a cup of Coffee. 
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-8">
            <h3 class="heading--2 segment-everywhere-heading">All in one platform</h3>
            <p>
            Ghoori is the ecommerce platform you are looking for. No matter where you are you can start a fully loaded ecommerce website @ FOC.
            </p>
        </div>
        <div class="col-sm-4 info-block-icon">
            {{ HTML::image('img/intro/cloud-pc.png', 'device',array("class" => "")) }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="intro_title_box">
                <h3>Start your own store today!!!​</h3>

                <div class="form-group">

                    {{-- Form::open(array('route' => 'pricing','method' => 'get', 'class' => 'loginBeforeSubmitForm form-inline getting-started-form','data-remote', 'data-remote-success-message'=>'Well done!')) --}}
                    {{ Form::open(array('route' => 'pricing','method' => 'get', 'class' => 'form-inline getting-started-form','data-remote', 'data-remote-success-message'=>'Well done!')) }}

                    {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>"Your Name", 'id' => 'subscriber-name')) }}

                    {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>"Shop Name", 'id' => 'subscriber-shop')) }}

                    {{ Form::text('mobile', null, array('class'=>'form-control', 'placeholder'=>"Your Phone Number", 'id' => 'subscriber-mobile')) }}

                    {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>"Your Email ID", 'id' => 'subscriber-email')) }}

                    {{-- Form::submit('Get started', array('class'=>'btn btn-primary getting-started-button', 'data-toggle'=>'modal', 'data-target'=>'#confirmation-pop-up')) --}}
                    {{ Form::submit('Get started', array('class'=>'btn btn-primary getting-started-button')) }}

                    {{ Form::close() }}

                </div>

            </div>
        </div>
    </div>
</div>
@stop
