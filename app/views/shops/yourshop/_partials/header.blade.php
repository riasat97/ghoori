@section('header')

<div class="row">
    <div class="col-lg-12">
        <div class="logo-holder">
            <div class="shop-banner-container">
                @if(!empty($shop->banner->path))
                <?php $banner = asset('public_img/shop_'.$shop->id.'/banners/'.$shop->banner->path) ?>
                @else
                <?php $banner = asset('img/shopbanner-default.jpg'); ?>
                @endif
            </div>
            <style type="text/css">
                .shop-banner-container{
                    background:  linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0) 50%), url('{{$banner}}') no-repeat center center;
                    
                }
            </style>
            <div class="shop-logo" >
                @if(!empty($shop->logo->logo)){{ HTML::image('public_img/shop_'.$shop->id.'/logos/'.$shop->logo->logo,'alt=Image',array('class'=>'img-responsive','width'=>152,'height'=>152)) }}
                @else
                <img src="{{ asset('img/shoplogo-default.jpg') }}" class="img-responsive" alt="Image">
                @endif
            </div>
            <div class="shop-title-bar">
                <div class="shop-name-wrap">
                    <h1 class="shop-name">
                       <span class="shop-name-span"><a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}">{{ $shop->title }} </a></span>
                        
                    </h1>
                    <div class="shop-tagline">
                        @if($shop->tagline)
                            <a href="#">{{{$shop->tagline}}}</a>
                        @endif
                    </div>
                </div>
                <div class="shop-button-wrap text-right shop-icons">
                    <a class="btn btn-sm btn-facebook" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?app_id={{Config::get('facebook.appId')}}&sdk=joey&u={{urlencode(GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug())))}}&display=popup&ref=plugin&src=share_button', 'newwindow', 'width=600, height=400'); return false;">
                        <i class="fa fa-facebook"></i> Share
                    </a>
                    <a class="btn btn-sm btn-twitter" href="#" onclick="window.open('https://twitter.com/share?url={{urlencode(GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug())))}}', 'newwindow', 'width=600, height=400'); return false;">
                        <i class="fa fa-twitter"></i> Tweet</a>
                                        
                </div>
            </div>
        </div>

        @include('shops.yourshop._partials.address')
    </div>
    <div class="clearfix"></div>
</div>
<div class="row shop-tabs">
    <!-- <div class="col-md-3"></div> -->
    <div class="col-md-offset-2 col-md-6">
        <ul class="list-inline shop-nav">
            <li id="products-tab" class="current">
                <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}">Products</a>
            </li>
            @if($shop->preorder_status)
            <li id="preorder-tab" class="">
                <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/preorder">Pre-book</a>
            </li>
            @endif
            <li id="about-tab" class="">
                <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/about-shop">About</a>
            </li>
            <li id="privacy-tab" class="">
                <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/privacy-policy">Privacy Policy</a>
            </li>
            <li id="term-tab" class="">
                <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/terms-and-conditions">Terms &amp; Conditions</a>
            </li>

        </ul>
    </div>
    <div class="col-md-4">
        

    </div>

</div>
<div class="row">
    <div class="col-md-12 yourshop-cart">
        @include('_partials.cart')
    </div>
</div>

@show