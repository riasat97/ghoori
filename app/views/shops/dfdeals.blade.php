@extends('public.shop._layouts.index')
@section('title')
    Ghoori Hot Deals
@stop
@section('homeCss')
    <link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

    {{HTML::style('homepage/css/home.css')}}
    {{HTML::style('homepage/css/cat.css')}}
@endsection
@section('metatags')
    <meta property="og:title" content="Ghoori Deals for Dhakafoodies" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('deals')}}" />
    <meta property="og:description" content="Get up to 50% “Hot Deal” discounts in products at ghoori.com.bd. Call 09612000888 to know more." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/og/hot-deals-og.jpg')}}" />

    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop
@section('jquery')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@stop
@section('home-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>

    <script>
        function getQueryVariable(variable)
        {
               var query = window.location.search.substring(1);
               var vars = query.split("&");
               for (var i=0;i<vars.length;i++) {
                       var pair = vars[i].split("=");
                       if(pair[0] == variable){return pair[1];}
               }
               return(false);
        }
    $(document).ready(function(){
        var page = 1;
        var requested = false;
        var pageended = false;
        var firstloaded = false;
        // console.log(window.location);
        $grid = $('.grid').masonry({
                  itemSelector : '.grid-item',
                  columnWidth         : '.grid-item'
                });
        // $('.grid-item').hide();
        $('.grid').imagesLoaded().always( function( instance ) {
            $('.grid-item').removeClass('half-hidden');
            $grid.masonry('layout');
            firstloaded = true;
        });
        $(window).scroll($.debounce( 500, function () {
                if($(window).scrollTop() >= $('.grid').offset().top + $('.grid').outerHeight() - window.innerHeight) {
                    // console.log('end reached'+(firstloaded? ' and firstloaded': ' but first not loaded'));
                    // console.log(getQueryVariable('group'));
                    // console.log(getQueryVariable('cat'));
                    if (!requested && !pageended && firstloaded) {
                        requested = true;
                        $.ajax({
                            url: "{{route('moredeals')}}",
                            type: "post",
                            data: {
                                'url': window.location.search,
                                'page': page+1,
                                '_token' : '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                response = $.parseJSON(response);
                                console.log(response);
                                var items = '';
                                for (var i = 0; i < response.data.length; i++) {
                                    // console.log(response.result[i]);
                                   items += '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 grid-item">'
                                                        +'<div class="recomendation_product_box">'
                                                            +'<a href="https://'+response.data[i].subDomain+'.ghoori.com.bd/products/'+response.data[i].product_id+'">'
                                                                +'<img src="{{route('home')}}/public_img/shop_'+response.data[i].shop_id+'/products/thumb/'+response.data[i].imageLink+'" class="img-responsive">'
                                                                +'<div class="product-info">'
                                                                    +'<div class="row">'
                                                                        +'<div class="col-xs-12">'
                                                                            +'<div class="product-title">'+response.data[i].name+'</div>'
                                                                        +'</div>'
                                                                       + '<div class="col-xs-12">'
                                                                       +     '<div class="text-success product-price price"><del class="pricewithcomma">'+response.data[i].price+' BDT</del></div>'
                                                                        + '<div class="text-success product-price pricewithcomma">'+ ( response.data[i].price - (response.data[i].price * response.data[i].amount / 100 )) +' BDT</div>'
                                                                       + '</div>'
                                                                       + '<div class="col-xs-12">'
                                                                       +     '<div class="product-shop">@'+response.data[i].title+'</div>'
                                                                       + '</div>'
                                                                   + '</div>'
                                                               + '</div>'
                                                               
                                                          +   '</a>  '
                                                          + '<div class="discount-tag discount-tag-sm">'+ parseInt(response.data[i].amount) +'% off</div>'
                                                      +  '</div>'
                                                       
                                                  +  '</div>';
                                };
                                
                                var $item = $(items);
                                $item.hide();
                                $('.grid').append($item);
                                // console.log($item);
                                $('.grid').imagesLoaded().always( function( instance ) {
                                    $('.grid-item').show();
                                    $('.grid').masonry( 'appended', $item, true );
                                    $grid.masonry('layout');
                                    renderPriceWithCommas();
                                    requested = false;
                                });
                                // $grid.masonry( 'appended', $item );
                                
                                page = page+1;
                                
                                if(response.data.length == 0){
                                    // console.log(response.numFound);
                                    // $('.grid').masonry( 'appended', '' );
                                    $grid.masonry('layout');
                                    // console.log(response.numFound);
                                    pageended = true;
                                    $('.chorki-pagination').hide();
                                    // $grid.masonry();
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                               console.log(textStatus, errorThrown);
                            }


                        });
                    };
                    
                }
            } ));
    });
    
    </script>

@endsection
@section('content')
    
    <section class="gh_home_section">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="gh_home_panel bg">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="bbuttom">
                                                <div class="row no-leftright">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <h2>Dhaka Foodies Deals</h2>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                                        <!-- <h4 class="panel_title_more">View more</h4> -->
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row mt20 no-leftright">
                                                <div class="grid">

                                                    @foreach($results as $key => $item)

                                                    
                                                    
                                                    
                                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 grid-item half-hidden">
                                                        <div class="recomendation_product_box">
                                                            <a href="{{route('products.view',array($item->subDomain, $item->product_id))}}">
                                                                <img src="{{asset('/public_img/shop_'.$item->shop_id.'/products/thumb/'.$item->imageLink)}}" class="img-responsive">
                                                                <div class="product-info">
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="product-title">{{{$item->name}}}</div>
                                                                        </div>
                                                                        <div class="col-xs-12">
                                                                            <div class="text-success product-price price">
                                                                                <del class="pricewithcomma">{{{$item->price}}} BDT</del>
                                                                            </div>
                                                                            <div class="text-success product-price pricewithcomma">{{ $item->price - ($item->price * $item->amount / 100 ) }} BDT</div>
                                                                        </div>
                                                                        <div class="col-xs-12">
                                                                            <div class="product-shop">@{{{$item->title}}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               
                                                             </a>
                                                             <div class="discount-tag discount-tag-sm">{{(int)$item->amount}}% off</div> 
                                                        </div>
                                                       
                                                    </div>
                                                    
                                                    @endforeach
                                                </div>
                                                
                                         
                                            </div>
                                            <div class="row">
                                               <div class="col-xs-12 col-sm-8 col-md-12 col-lg-12 chorki-pagination">
                                                   <div class="text-center">
                                                        <img class="" src="https://ghoori.com.bd/img/loading.gif">
                                                    </div>
                                               </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>

@stop

@section('extra-footer')
    
@stop