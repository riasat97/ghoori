@extends('shops.yourshop._layouts.master')
@section('title')
Preorders | {{$shop->title}} @ ghoori.com.bd
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

@section('address-edit')
@overwrite
@section('content')

    <header class="col-sm-12 prime">
        <h3>Pre-orders</h3>
    </header>
    <div class="col-xs-12">
        <ul class="cd-gallery">
            {{--show products according to the category of the present shop--}}
            @foreach($all_packages as $v_packages)
                <li class="package package-{{$v_packages->preorder_package_id}}">
                    <div class="flexslider product-list-thumb-flexslider" style="">
                        <ul class="slides">
                            <li>
                                <a href="{{ route('preorder.details',array($shop->getSlug(),$v_packages->preorder_id)) }}"><img src="{{asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_packages->image)}}" width="100" height="160" alt="" /></a>
                            </li>
                        </ul>
                    </div>
                    <div class="row cd-item-info">
                        <b class="col-xs-7">{{ link_to_route('preorder.details',$v_packages->name,array($shop->getSlug(),$v_packages->preorder_id))}}</b>
                        <strong class="col-xs-5 cd-price"><span class="pricewithcomma">{{$v_packages->price}}</span> <small>BDT</small></strong>
                    </div>
                    <div class="buy-now-row">
                        <a href="{{ route('preorder.details',array($shop->getSlug(),$v_packages->preorder_id)) }}" class="btn btn-info btn-lg btn-buy">
                            View
                        </a>
                     </div>
                    
                </li>
            @endforeach
        </ul>    
    </div>
    
@stop
