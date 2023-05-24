@extends('shops.yourshop._layouts.master')
@section('title')
    about
@stop
@section('address-edit')
@overwrite
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>About
        </h2>
        <article class="shop-page-article">@if($shop->description){{ $shop->description }}@endif</article>
    </div>
@stop
