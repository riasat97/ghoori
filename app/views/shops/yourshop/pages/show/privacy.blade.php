@extends('shops.yourshop._layouts.master')
@section('title')
    Privacy Policy
@stop
@section('address-edit')
@stop
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Privacy Policy
        </h2>
        <article class="shop-page-article">@if($shop->shopPrivacy){{ $shop->shopPrivacy->content }} @else Nothing to Display @endif</article>
    </div>
@stop
