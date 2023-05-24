
@extends('themes.theme_1._layout.default')

@section('title')
    <title>Category | {{$shop->title}}</title>
@stop


@section('external_css')
    {{HTML::style('themes/theme_1/css/category.css')}}
@stop


@section('body_content')
    <div class="subhead_wrap">
            <div class="container top-container">
                @include('themes.theme_1._partials.default_subheader') {{--Template Default Sub-Header--}}
            </div>
    </div>
    <div class="container">


        <!-- *******************************SideBar********************** -->
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        @include('themes.theme_1.home._partials.category_sidebar') {{--Category Sidebar--}}
                    </div>
                </div>


                {{-- <div class="row">
                    <div class="col-md-12">
                        @include('themes.theme_1.category._partials.price_filter') 
                    </div>
                </div> --}}

                @include('themes.theme_1.home._partials.sidebar_product') {{--Sidebar Product--}}
            </div>

            @include('themes.theme_1.category._partials.single_category_products')
            {{--Products under Specific Category--}}

        </div>
    </div>

@stop



@section('external_js')
    {{ HTML::script('themes/theme_1/js/category.js') }}
    {{ HTML::script('themes/theme_1/js/_partials/product_masonry.js') }}
@stop

