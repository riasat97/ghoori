@extends('shops.myshop._layouts.main')
@section('title')
    about
@stop
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>About
            @if($shop->id == Session::get('shop_id'))
            <a id="add-new-about" href="#animatedModalAbout" class="add-new-about">
                <i class="fa fa-pencil"></i> <span class="link-caption"></span>
            </a>
            @endif
        </h2>
        <article  class="shop-page-article">@if($shop->description){{ $shop->description }}@endif</article>
    </div>
@stop
