
@extends('themes.theme_1._layout.default')

@section('title')
    <title>Product | {{$shop->title}}</title>
@stop

@section('slider_css')
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.5/css/lightslider.min.css">
@stop

@section('external_css')
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.5/css/lightslider.min.css">
    {{HTML::style('themes/theme_1/css/product.css')}}
@stop




@section('body_content')
<div class="subhead_wrap">
            <div class="container top-container">
                @include('themes.theme_1._partials.default_subheader') {{--Template Default Sub-Header--}}
            </div>
    </div>
    <div class="container">




        @include('themes.theme_1.product._partials.category_breadcrumbs') {{--Category Breadcrumbs--}}


        @include('themes.theme_1.product._partials.single_product') {{--Single Product--}}

    </div>

@stop




@section('slider_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.5/js/lightslider.min.js"></script>
@stop


@section('external_js')
    {{ HTML::script('themes/theme_1/js/product-2.js') }}
    {{ HTML::script('themes/theme_1/js/_partials/product_slider_light.js') }}
@stop

