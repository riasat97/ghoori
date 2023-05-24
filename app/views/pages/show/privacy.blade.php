@extends('shops.myshop._layouts.main')
@section('title')
    Privacy Policy
@stop
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Privacy Policy
            @if($shop->id == Session::get('shop_id'))
            <a id="add-new-privacy" href="#animatedModalPrivacy" class="add-new-privacy">
                <i class="fa fa-pencil"></i> <span class="link-caption"></span>
            </a>
            @endif
        </h2>
        <article  class="shop-page-article">@if($shop->shopPrivacy){{ $shop->shopPrivacy->content }} @else Nothing to Display @endif</article>
    </div>
@stop
