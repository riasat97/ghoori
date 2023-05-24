@extends('public.shop._layouts.index')
@section('title')
     Search Shops
@stop
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="search-result-head">
                    <h4>Search results for '{{{Input::get('q')}}}'</h4>
                    <p>{{{$found}}} products found.</p>
                </div>
            </div>

            @if ($results)

            @foreach ($results as $data)
                
                @if (!empty($data->shopTitle[0]))
                <div class="col-md-3 col-lg-2 col-xs-6 col-sm-4">
                    <div class="shop-box">
                        <div class="shop-box-header shop-logo">
                            <div class="total-products"></div>
                            <a class="ch_shoplist_link" href="https://{{ $data->url[0] }}" role="link"> 
                                <div class="ch_productlist_imgbox">
                                
                                @if($data->image)
                                    <img src="https://{{$data->image[0]}}" class="img-responsive ch_shoplist_thumb">
                                    
                                @else
                                    <img src="{{asset('img/e-shop.jpg')}}" class="img-responsive ch_shoplist_thumb">
                                @endif
                                
                                </div>
                            </a>
                        </div>              
                        <div class="shop-box-body">
                            
                            <a class="ch_shoplist_link" href="https://{{ $data->url[0] }}" role="link">
                            
                                
                                <p class="shop-box-title"><b>{{{$data->title[0]}}}</b></p>

                                <p class="shop-box-description">
                                {{{$data->description[0]}}}
                                </p>

                            </a>
                            @if (!empty($data->discountedprice[0]))
                            <p class="ch_shoplist_price"><del class="text-danger"><small>{{$data->price[0]}} BDT</small></del> {{$data->discountedprice[0]}} BDT</p>
                            @else
                            <p class="ch_shoplist_price">{{$data->price[0]}} BDT</p>
                            @endif
                            <p class="shop-box-shoptitle">@ {{{$data->shopTitle[0]}}}</p>
                        </div>
                        <div class="shop-footer">
                            
                                <a href="https://{{$data->url[0] }}" class="btn btn-info btn-log-out-head btn-shop-view"><i class="fa fa-shopping-cart"></i> Buy</a>

                            
                        </div>
                        @if ( !empty($data->discountedprice[0]) && !empty($data->discountpercentage[0]) && $data->discountpercentage[0] > 0 )
                                <div class="discount-tag discount-tag-md">{{(int)$data->discountpercentage[0]}}% off</div>
                            @endif
                    </div>

                </div>
                @else
                    <!-- blackhole://{{ $data->url[0] }} -->
                @endif
            @endforeach
        </div>
        <div class="row">
           <div class="col-xs-12 col-sm-8 col-md-12 col-lg-12 chorki-pagination">
               {{$page->links()}}
           </div>
           @else
           <div class="col-xs-12">No results found.
           <p>You can search again or <a href="{{route('home')}}">go back to home.</a></p></div>
           @endif
        </div>
    </div>


@stop