@extends('shops.yourshop._layouts.master')
@section('title')
    Terms & Conditions
@stop
@section('address-edit')
@overwrite
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Terms & Conditions
        </h2>
        <article class="shop-page-article">@if($shop->shopTerm){{ $shop->shopTerm->content }}  @else Nothing to Display @endif</article>
    </div>
@stop
