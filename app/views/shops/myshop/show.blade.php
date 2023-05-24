@extends('shops.myshop._layouts.main')
@section('title')
    {{$shop->title}}
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

@section('content')
    @include('shops.myshop._partials.content')
@stop

