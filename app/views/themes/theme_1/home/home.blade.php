@extends('themes.theme_1._layout.default')

@section('title')
    <title>Home | {{$shop->title}}</title>
@stop


@section('body_content')

  <div class="shop_main">
        <div class="subhead_wrap">
            <div class="container top-container">
                @include('themes.theme_1._partials.default_subheader') {{--Template Default Sub-Header--}}
            </div>
        </div>
        
      <div class="container">

        {{--Category SideBar and Exclusive Product Slider--}}
        <div class="row">
            <div class="col-md-3">
                @include('themes.theme_1.home._partials.category_sidebar') {{--Category Sidebar--}}

                @include('themes.theme_1.home._partials.sidebar_product') {{--Sidebar Product--}}
            </div>

            <div class="col-md-9 exclusive-products-area">
                @include('themes.theme_1.home._partials.exclusive_product') {{--Exclusive Product Slider--}}
            </div>

            @include('themes.theme_1.home._partials.products_by_category') {{--Category wise Products Section--}}
        </div>
    </div>
  </div>  
    


@stop

