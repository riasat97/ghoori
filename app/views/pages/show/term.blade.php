@extends('shops.myshop._layouts.main')
@section('title')
    Terms & Conditions
@stop
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2>Terms & Conditions
            @if($shop->id == Session::get('shop_id'))
            <a id="add-new-term" href="#animatedModalTerm" class="add-new-term">
                <i class="fa fa-pencil"></i> <span class="link-caption"></span>
            </a>
            @endif
        </h2>
        <article  class="shop-page-article">@if($shop->shopTerm){{ $shop->shopTerm->content }}  @else Nothing to Display @endif</article>
    </div>
@stop
