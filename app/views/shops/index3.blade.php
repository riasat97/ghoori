{{-- Home page --}}

@extends('public.shop._layouts.index')
@section('title')
    Ghoori.com.bd
@stop
@section('homeCss')
    <link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    
    {{HTML::style('homepage/css/slide.css')}}
    {{HTML::style('homepage/slick/slick.css')}}
    {{HTML::style('homepage/slick/slick-theme.css')}}

    {{HTML::style('homepage/css/home.css')}}

    {{HTML::style('homepage/css/frontpage.css')}}
@endsection
@section('metatags')
    <meta property="og:title" content="Open #eShop at Ghoori" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('home')}}" />
    <meta property="og:description" content="Ghoori is an ecommerce platform where you can start your business any day and effortlessly. Email us at info@ghoori.com.bd for details." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/ghoori_post_og.jpg')}}" />

    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop
@section('jquery')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@stop
@section('home-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
    
    {{ HTML::script('homepage/js/jssor.js') }}
    {{ HTML::script('homepage/js/jssor.slider.js') }}

    {{ HTML::script('homepage/slick/slick.min.js')}}

    {{ HTML::script('homepage/script4jssor.js') }}

    <script>
    var requested = [''];
    
    function printd(data) {
        if(data.find('.group-loading').length != 0) {
            // console.log(data.data('group'));
            // console.log();
            if( $.inArray( data.data('group'), requested) === -1 ) {
                // console.log('send req:'+data.data('group'));
                requested.push(data.data('group'));
                // console.log(requested);
                $.ajax({
                    url: "{{route('homegroup')}}",
                    type: "post",
                    data: {
                        'group': data.data('group'),
                        '_token' : '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        var responseData = $.parseJSON(response);
                        if( responseData.success ) {
                            // console.log(responseData.data.large_ad)
                            var sliderbox = '<div class="col-sm-6">'
                                            +'<div class="slider">'
                                                +'<div id="carousel-example-'+data.data('group')+'" class="carousel slide" data-ride="carousel">'
                                                  +'<!-- Indicators -->'
                                                  +'<ol class="carousel-indicators">';
                                                  for (var i = 0; i < responseData.data.large_ad.length; i++) {
                                                      // console.log('hello bangladesh'+i);
                                                       sliderbox += '<li data-target="#carousel-example-'+data.data('group')+'" data-slide-to="'+i+'" class="'+ (i == 0 ? 'active' : '') +'"></li>'
                                                  };
                                                   
                                                    
                            sliderbox +=         '</ol>'

                                    sliderbox +=  '<!-- Wrapper for slides -->'
                                                  +'<div class="carousel-inner" role="listbox">'
                                                  for (var i = 0; i < responseData.data.large_ad.length; i++) {
                                                      // console.log(responseData.data.large_ad[i])
                                                       

                                            sliderbox += '<a href="'+( typeof responseData.data.large_ad[i].sponsored_item !== 'undefined' ? responseData.data.large_ad[i].sponsored_item.url : responseData.data.large_ad[i].url )+ '" class="item '+ (i == 0 ? 'active' : '') +'">'
                                                          +'<img src="{{asset('sp_img')}}/'+( typeof responseData.data.large_ad[i].sponsored_item !== 'undefined' ? responseData.data.large_ad[i].sponsored_item.image : responseData.data.large_ad[i].image )+ '"  alt="...">';
                                                          if( (typeof responseData.data.large_ad[i].sponsored_item !== 'undefined' && responseData.data.large_ad[i].sponsored_item.title.length > 0 ) || (typeof responseData.data.large_ad[i] !== 'undefined' && responseData.data.large_ad[i].title.length > 0) ) {
                                                            console.log('true')
                                                    sliderbox += '<div class="carousel-caption">'
                                                            +'<span>'+( typeof responseData.data.large_ad[i].sponsored_item !== 'undefined' ? responseData.data.large_ad[i].sponsored_item.title : responseData.data.large_ad[i].title )+ '</span>'
                                                           +' <hr>'
                                                            +'<p>'+( typeof responseData.data.large_ad[i].sponsored_item !== 'undefined' ? responseData.data.large_ad[i].sponsored_item.shortDescription : responseData.data.large_ad[i].shortDescription )+ '</p>'
                                                          +'</div>';
}
                                                     sliderbox +=   '</a>'
                                                  };
                                                    
                                sliderbox +=       '</div>'

                                                  +'<!-- Controls -->'
                                                  +'<a class="arrow-left" href="#carousel-example-'+data.data('group')+'" role="button" data-slide="prev">'
                                                    +'<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>'
                                                    +'<span class="sr-only">Previous</span>'
                                                  +'</a>'
                                                  +'<a class="arrow-right" href="#carousel-example-'+data.data('group')+'" role="button" data-slide="next">'
                                                    +'<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
                                                    +'<span class="sr-only">Next</span>'
                                                  +'</a>'
                                                +'</div>'
                                            +'</div>'
                                       + '</div>';

                                var ad_item_box = '<div class="col-sm-6 ptb15 product_link ">'
                                            +'<div class="row no-gutter">';
                                            if( typeof responseData.data.medium_ad !== 'undefined' ) {
                                                for (var i = 0; i < responseData.data.medium_ad.length; i++) {
                                                      // console.log(responseData.data.medium_ad);
                                                       ad_item_box += '<div class="col-lg-8 col-md-8 col-sm-8">'
                                                                +'<a href="'+( typeof responseData.data.medium_ad[i].sponsored_item !== 'undefined' ? responseData.data.medium_ad[i].sponsored_item.url : responseData.data.medium_ad[i].url )+ '" ><img src="{{asset('sp_img')}}/'+( typeof responseData.data.medium_ad[i].sponsored_item !== 'undefined' ? responseData.data.medium_ad[i].sponsored_item.image : responseData.data.medium_ad[i].image )+ '" class="img-responsive" alt=""/></a>'
                                                            +'</div>';
                                                  };
                                               
                                            }

                                            if( typeof responseData.data.small_ad !== 'undefined' ) {
                                                for (var i = 0; i < responseData.data.small_ad.length; i++) {
                                                      // console.log(responseData.data.small_ad);
                                                       ad_item_box += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">'
                                                                +'<a href="'+( typeof responseData.data.small_ad[i].sponsored_item !== 'undefined' ? responseData.data.small_ad[i].sponsored_item.url : responseData.data.small_ad[i].url )+ '">'
                                                                    +'<h2 >'+( typeof responseData.data.small_ad[i].sponsored_item !== 'undefined' ? responseData.data.small_ad[i].sponsored_item.title : responseData.data.small_ad[i].title )+ '</h2>'
                                                                    +'<p>'+( typeof responseData.data.small_ad[i].sponsored_item !== 'undefined' ? responseData.data.small_ad[i].sponsored_item.subtitle : responseData.data.small_ad[i].subtitle )+ '</p>'
                                                                    +'<img src="{{asset('sp_img')}}/'+( typeof responseData.data.small_ad[i].sponsored_item !== 'undefined' ? responseData.data.small_ad[i].sponsored_item.image : responseData.data.small_ad[i].image )+ '" class="img-responsive" alt=""/>'
                                                                +'</a>'
                                                            +'</div>';
                                                };
                                            }
                                            ad_item_box += '</div></div>';
                            $('section[data-group="' + data.data('group') + '"] .row.item_homepage_row').html(sliderbox+ad_item_box).show();
                            // console.log($('section[data-group="' + data.data('group') + '"] .row.item_homepage_row').html());
                            // $('body').append(sliderbox).show();
                            // console.log(sliderbox);
                            $('.carousel').carousel();


                        }
                        else {
                            var indexOfGroup = jQuery.inArray( data.data('group'), requested );
                            delete requested[indexOfGroup];
                            // console.log(requested);
                        }
                        // console.log();
                       // you will get response from your php page (what you echo or print)                 

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                    }


                });
            }
            else {
                // console.log('no req');
            }
            
        }
    }
    $(document).ready(function(){

        $('#fixed_left_panel ul li a').on('click', function(e) {
            e.preventDefault();
            var scrollAnchor = $(this).attr('data-scroll'),
                scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top-60;
                // alert(scrollAnchor+' asd '+scrollPoint);

            $('body,html').animate({
                scrollTop: scrollPoint
            }, 500);

            return false;

        })


        $(window).scroll( function(e) {
            var windscroll = $(window).scrollTop();
            $('#fixed_left_panel').hide();
            var x=$('#sidenav_ends').offset();
            var catOffsets=$('#total_cata').offset();
            console.log(catOffsets.top);
            if (windscroll >= (catOffsets.top - 150) ) {
                $('#fixed_left_panel').show();
                //$('nav').addClass('fixed');
                var imax = 0;
                $('#fixed_left_panel ul li a.active').removeClass('active');
                $('#total_cata section').each(function(i) {                  
                   
                      if ($(this).position().top <= windscroll+200) {
                          // console.log($('#fixed_left_panel ul li a').eq(i).data('scroll'));
                          if(imax < i+1) imax = i+1;
                      }
                    
                });
                $('#fixed_left_panel ul li a').eq(imax-1).addClass('active');

                printd($('section.cata').eq(imax-1));
              

            }
            if($(window).width()>=991){
                if(windscroll>=x.top-400){
                    $('#fixed_left_panel').hide();
                }

            }
            else {
                if(windscroll>=x.top-200){
                    $('#fixed_left_panel').hide();
                }
                
            }

        }).scroll();
    });
    
    </script>

@endsection
@section('content')

    <!-- ********************************************Head Slide Show Block Slider:1****************************************************** -->
    <div class="container-fluid slide-show-container">
        <div class="row">
            <!-- Jssor Slider Begin -->
            <!-- To move inline styles to css file/block, please specify a class name for each element. -->
            {{-- <div class="col-xs-12"> --}}
                <div id="slider1_container" class="home-content-box" style="position: relative; margin: 0 auto;
                    top: 0px; left: 0px; width: 1349px; height: 532px; overflow: hidden;">
                    <!-- Loading Screen -->
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;width: 100%; height: 100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px; width: 100%; height: 100%;">
                        </div>
                    </div>
                    <!-- Slides Container -->
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1349px;
                        height: 532px; overflow: hidden;">
                        <div>
                            <a href="{{route('poabaropage', ['discount'=> '50'])}}">
                            <img u="image" src2="{{ URL::asset('img/home/slider/camp_poa12_1.jpg') }}" alt="" style="width:100%">
                            </a>
                            

                        </div>
                        

                        
                    </div>


                    <!-- Arrow Left -->
                    <span u="arrowleft" class="jssora21l" style="top: 123px; left: 8px;">
                    </span>
                    <!-- Arrow Right -->
                    <span u="arrowright" class="jssora21r" style="top: 123px; right: 8px;">
                    </span>
                    <!--#endregion Arrow Navigator Skin End -->

                </div>
            {{-- </div> --}}
                
            <!-- Jssor Slider End -->
        </div>
    </div>
    <div class="container-fluid thin-container">
        <div class="row thin-row">
            <a href="{{route('poabaropage', ['discount'=> '40'])}}" class="thin-col-2-5" style="background-image: url('{{asset('img/home/poa12/medium.jpg')}}')">
                <img src="{{asset('img/home/poa12/placeholder-medium.png')}}" class="" style="width:100%;display:block; height:auto">
            </a>
            <a href="{{route('poabaropage', ['discount'=> '30'])}}" class="thin-col-2-5" style="background-image: url('{{asset('img/home/poa12/medium2.jpg')}}')">
                <img src="{{asset('img/home/poa12/placeholder-medium.png')}}" class="" style="width:100%;display:block; height:auto">
            </a>
            <a href="{{route('poabaropage', ['discount'=> '20'])}}" class="thin-col-1-5" style="background-image: url('{{asset('img/home/poa12/small.jpg')}}')">
                <img src="{{asset('img/home/poa12/placeholder-small.png')}}" class="" style="width:100%;display:block; height:auto">
            </a>
        </div>
    </div>
    <!--*******************************************left catagory bar *********************************************-->
                <div id="fixed_left_panel">
                    <ul>
                        <li><a href="#" data-scroll="demo1"><i class="fa fa-venus"></i><span>For Her</span></a></li>
                        <li><a href="#" data-scroll="demo2"><i class="fa fa-mars"></i><span>For Him</span></a></li>
                        <li><a href="#" data-scroll="demo3"><i class="fa fa-child"></i><span>For Kids</span></a></li>
                        <li><a href="#" data-scroll="demo4"><i class="fa fa-bolt"></i><span>Gadgets</span></a></li>
                        <li><a href="#" data-scroll="demo5"><i class="fa fa-home"></i><span>Home &amp; Decor</span></a></li>
                        <!-- <li><a href="" data-scroll="demo6"><i class="fa fa-umbrella"></i><span>Demo6</span></a></li> -->
                        <!-- <li><a href="" data-scroll="demo7"><i class="fa fa-umbrella"></i><span>Demo7</span></a></li> -->
                    </ul>
                </div>

   <?php /*  <!--*******************************************right catagory bar ******************************-->
                <div id="fixed_right_panel_box">   
                    <div id="fixed_right_panel">
                        <ul>
                            <li><a href="" data-scroll="demo1"><i class="fa fa-umbrella"></i><span>Demo1</span></a></li>
                            <li><a href="" data-scroll="demo2"><i class="fa fa-umbrella"></i><span>Demo2</span></a></li>
                            <li><a href="" data-scroll="demo3"><i class="fa fa-umbrella"></i><span>Demo3</span></a></li>
                            <li><a href="" data-scroll="demo4"><i class="fa fa-umbrella"></i><span>Demo4</span></a></li>
                            <li><a href="" data-scroll="demo5"><i class="fa fa-umbrella"></i><span>Demo5</span></a></li>
                            <li><a href="" data-scroll="demo6"><i class="fa fa-umbrella"></i><span>Demo6</span></a></li>
                            <li><a href="" data-scroll="demo7"><i class="fa fa-umbrella"></i><span>Demo7</span></a></li>
                        </ul>
                    </div>
                    <hr/>
                    <div id="fixed_right_panel_price">
                        <ul>
                            <li><a href="" data-scroll="demo1"><i class="fa fa-umbrella"></i><span>Demo1</span></a></li>
                            <li><a href="" data-scroll="demo2"><i class="fa fa-umbrella"></i><span>Demo2</span></a></li>
                            <li><a href="" data-scroll="demo3"><i class="fa fa-umbrella"></i><span>Demo3</span></a></li>
                            <li><a href="" data-scroll="demo4"><i class="fa fa-umbrella"></i><span>Demo4</span></a></li>

                        </ul>
                    </div>
                </div> */ ?>
    {{-- <pre>
        
    </pre> --}}
    <section class="gh_home_section">
                    <div class="container catainner">
                        <div class="row">
                            <div class="col-sm-8 col-md-9">
                                <div class="gh_home_panel bg collections-panel">
                                    <div class="row">                                        
                                        <div class="col-xs-12">
                                            <div class="bbuttom">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                                        <h2 class="gh_home_panel_title"><a href="{{route('poabaropage')}}">পোয়া১২</a></h2>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-md-4 text-right">
                                                        <a class="btn btn-link" href="{{route('poabaropage')}}"><h5>View more</h5></a>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="collections">
                                                <div class="collections-left-panel">
                                                    <img src="{{asset('img/home/campaign/poa-12.jpg')}}" alt="">
                                                </div>
                                                <div class="top-items">
                                                    
                                                     <div class="top-item">
                                                        @if( !empty($hotDeals) && count($hotDeals) >= 1)
                                                        <a href="{{route('products.view',[$hotDeals[0]->subDomain,$hotDeals[0]->product_id])}}">
                                                            <div class="imgbox" style="background-image:url('{{ asset( '/public_img/shop_'.$hotDeals[0]->shop_id.'/products/'.$hotDeals[0]->imageLink ) }}')"></div>
                                                            <div class="discount-tag discount-tag-md">{{(int)$hotDeals[0]->amount}}% off</div>
                                                        </a>
                                                        @endif
                                                     </div>
                                                     
                                                     

                                                     <div class="other-items">
                                                     @if(!empty($hotDeals) && count($hotDeals) >= 2)
                                                        @foreach ($hotDeals as $key => $value)
                                                            @if($key == 0 || $key > 3 )
                                                                <?php continue; ?>
                                                            @endif
                                                            <a href="{{route('products.view',[$value->subDomain,$value->product_id])}}">
                                                                <div class="imgbox" style="background-image:url('{{ asset( '/public_img/shop_'.$value->shop_id.'/products/'.$value->imageLink ) }}')"></div>
                                                                <div class="discount-tag discount-tag-sm">{{(int)$value->amount}}% off</div>
                                                            </a>
                                                        @endforeach
                                                     @endif
                                                     </div>
                                                    
                                                </div>
                                                <div class="collections-right-panel hidden-xs hidden-sm">
                                                    <div class="pic-group">
                                                        {{--  <a href="">
                                                            <div class="desc">
                                                                <span class="subject">Cat</span>
                                                            </div>
                                                        </a> --}}
                                                        @if(!empty($hotDeals) && count($hotDeals) >= 5)    
                                                            @foreach ( $hotDeals as $key => $value)
                                                                @if($key < 4 )
                                                                    <?php continue; ?>
                                                                @endif
                                                                <a href="{{route('products.view',[$hotDeals[$key]->subDomain,$hotDeals[$key]->product_id])}}" class="pic">                                
                                                                    <div class="imgbox" style="background-image:url('{{ asset( '/public_img/shop_'.$hotDeals[$key]->shop_id.'/products/'.$hotDeals[$key]->imageLink ) }}')" alt=""></div>
                                                                    <div class="discount-tag discount-tag-md">{{(int)$hotDeals[$key]->amount}}% off</div>
                                                                </a>
                                                            @endforeach
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                            
                                            </div>
                                                
                                        
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-3">
                                <div class="gh_home_panel bg today-deal-panel">
                                    <div class="row">                                        
                                        <div class="col-xs-12">
                                            <div class="bbuttom">
                                                <div class="row">
                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                        <h2 class="gh_home_panel_title"><a href="{{route('deals')}}">Extreme Deals</a></h2>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </div>
                                        {{-- <div class="col-lg-3 col-sm-3 col-md-3">
                                            <h4>View more</h4>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            @if(!empty($extremeDeal))
                                            <a href="{{route('products.view',[$extremeDeal->subDomain,$extremeDeal->product_id])}}">
                                                <div class="container-main clearfix" data-role="main">

                                                    <div class="product-pic">
                                                        <div class="imgbox" style="background-image:url('{{ asset( '/public_img/shop_'.$extremeDeal->shop_id.'/products/'.$extremeDeal->imageLink ) }}')"></div>
                                                    </div>
                                                    <div class="price-panel">
                                                        <div class="price">
                                                            <span>{{ $extremeDeal->price - ($extremeDeal->price * $extremeDeal->amount / 100 ) }} BDT</span>
                                                            <del>{{$extremeDeal->price}} BDT</del>
                                                        </div>
                                                        {{-- <div class="discount">
                                                            <span>47% off</span>
                                                        </div> --}}
                                                    </div>
                                                    <div class="discount-tag discount-tag-lg">{{(int)$extremeDeal->amount}}% off</div>
                                                </div>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>            
    <section class="gh_home_section">
                    <div class="container catainner">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="gh_home_panel bg">
                                    <div class="row">                                        
                                        <div class="col-xs-12">
                                            <div class="bbuttom">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <h2 class="gh_home_panel_title">Featured Shops</h2>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </div>
                                        {{-- <div class="col-lg-6 col-sm-6 col-md-6">
                                            <h4>View more</h4>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            {{-- <h3 class="section-title padding-right">Featured Shops</h3> --}}
                                            <div class="slick-class-shops">
                                                @foreach($featuredShops as $key=>$featuredShop)
                                                    <div class="shop-slide">
                                                        <a class="shop-slide-link" href="{{GhooriURI::shopurl($featuredShop->subDomain, URL::route('store.shops',$featuredShop->subDomain))}}">
                                                            <img class="shop-logo" alt="" data-lazy="{{ URL::asset('public_img/shop_'.$featuredShop->shopId.'/logos/'.$featuredShop->logo) }}">
                                                            <div class="shop-name">{{ $featuredShop->title }}</div>
                                                            <?php /*
                                                            @if ( shopHasGpCampaign( $featuredShop->shopId ) )
                                                                <div class="discount-badge-small">
                                                                    <img src="{{asset('img/discount_small.png')}}">
                                                                </div>
                                                            @endif
                                                            */
                                                            ?>
                                                        </a>
                                                        
                                                    </div>

                                                @endforeach
                                            
                                            </div>
                                            
                                        
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>

<div id="total_cata">
<!-- *********************************Cata  section***************************************************** -->
                    <section class="cata cata1" data-group="for_her" data-anchor="demo1">
                        <div class="container catainner">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="bg">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-2 col-md-2 ">
                                                <div class="cat_header">
                                                    <h1>For Her<i class="fa fa-chevron-right"></i></h1>
                                                    <ul>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=salwar+kamiz">Salwar Kamiz</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=saree">Saree</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=cosmetics">Cosmetics</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=bag">Bag &amp; Purse</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=ornaments">Ornaments</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=kurti">Kurti</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=sandals">Sandals</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=sunglass">Sunglass</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_her&cat=innerwear">Innerwear</a></li>
                                                    </ul>
                                                </div>  
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="slider">
                                                            <div id="carousel-example-forher" class="carousel slide" data-ride="carousel">
                                                              @if(!empty($forhermain['large_ad']))
                                                              <!-- Indicators -->
                                                              <ol class="carousel-indicators">
                                                                @foreach($forhermain['large_ad'] as $key => $value)
                                                                    <li data-target="#carousel-example-forher" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                                                                @endforeach
                                                                
                                                              </ol>

                                                              <!-- Wrapper for slides -->
                                                              <div class="carousel-inner" role="listbox">
                                                                @foreach($forhermain['large_ad'] as $key => $value)

                                                                    <div class="item @if($key == 0) active @endif">
                                                                        <a href="{{ empty($value->sponsoredItem->url)? $value->url : $value->sponsoredItem->url }}">
                                                                          <img src="{{asset('sp_img/'.(!empty($value->sponsoredItem->image) ? $value->sponsoredItem->image : $value->image) )}}"  alt="...">
                                                                          @if(!empty($value->sponsoredItem->title) || !empty($value->title))
                                                                          <div class="carousel-caption">
                                                                            <span>{{ empty($value->sponsoredItem->title)? $value->title : $value->sponsoredItem->title }}</span>
                                                                            <hr>
                                                                            <p>{{ empty($value->sponsoredItem->shortDescription)? $value->shortDescription : $value->sponsoredItem->shortDescription }}</p>
                                                                          </div>
                                                                          @endif                 
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                                
                                                              </div>

                                                              <!-- Controls -->
                                                              <a class="arrow-left " href="#carousel-example-forher" role="button" data-slide="prev">
                                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                              </a>
                                                              <a class="arrow-right " href="#carousel-example-forher" role="button" data-slide="next">
                                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                              </a>
                                                              @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ptb15 product_link ">
                                                        <div class="row no-gutter">
                                                                @if(!empty($forhermain['medium_ad']))
                                                                    @foreach($forhermain['medium_ad'] as $key => $value)
                                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                                            <a href="{{ empty($value->sponsoredItem->url)? $value->url : $value->sponsoredItem->url }}"><img src="{{asset('sp_img/'.(!empty($value->sponsoredItem->image) ? $value->sponsoredItem->image : $value->image) )}}" class="img-responsive" alt=""/></a>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                @if(!empty($forhermain['small_ad']))
                                                                    @foreach($forhermain['small_ad'] as $key => $value)
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                                                            <a href="{{ empty($value->sponsoredItem->url)? $value->url : $value->sponsoredItem->url }}">
                                                                                <h2 >{{ empty($value->sponsoredItem->title)? $value->title : $value->sponsoredItem->title }}</h2>
                                                                                <p>{{ empty($value->sponsoredItem->subtitle)? $value->subtitle : $value->sponsoredItem->subtitle }}</p>
                                                                                <img src="{{asset('sp_img/'.(!empty($value->sponsoredItem->image) ? $value->sponsoredItem->image : $value->image) )}}" class="img-responsive" alt=""/>
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
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
                    <section class="cata cata2" data-group="for_him" data-anchor="demo2">
                        <div class="container catainner">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="bg">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-2 col-md-2 ">
                                                <div class="cat_header">
                                                    <h1>For Him<i class="fa fa-chevron-right"></i></h1>
                                                    <ul>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=pant">Pants</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=tshirt">T-shirt</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=shirt">Shirt</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=watch">Watch</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=shoe">Shoe</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=perfume">Perfume </a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=shorts">Shorts   </a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=panjabi">Panjabi </a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=sunglass">Sunglass </a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_him&cat=accessories">Accessories</a></li>
                                                    </ul>
                                                </div>  
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row item_homepage_row">
                                                    <div class="col-sm-12">
                                                        <div class="group-loading">
                                                            <div class="text-center">
                                                                <img class="ghoori-only-flying" src="https://ghoori.com.bd/img/ghoori-flying.png">
                                                            </div>
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
                    <section class="cata cata3" data-group="for_kids" data-anchor="demo3">
                        <div class="container catainner">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="bg">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-2 col-md-2 ">
                                                <div class="cat_header">
                                                    <h1>For Kids<i class="fa fa-chevron-right"></i></h1>
                                                    <ul>
                                                        <li><a href="{{route('homeproducts')}}?group=for_kids&cat=books">Books </a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_kids&cat=boy+cloth">Baby Boys Clothing</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_kids&cat=girl+cloth">Baby Girls Clothing</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_kids&cat=baby+care">Baby Care</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=for_kids&cat=baby+shoe">Baby Shoe</a></li>

                                                    </ul>
                                                </div>  
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row item_homepage_row">
                                                    <div class="col-sm-12">
                                                        <div class="group-loading">
                                                            <div class="text-center">
                                                                <img class="ghoori-only-flying" src="https://ghoori.com.bd/img/ghoori-flying.png">
                                                            </div>
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
                    <section class="cata cata4" data-group="gadgets" data-anchor="demo4">
                        <div class="container catainner">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="bg">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-2 col-md-2 ">
                                                <div class="cat_header">
                                                    <h1>Gadgets<i class="fa fa-chevron-right"></i></h1>
                                                    <ul>
                                                        <li><a href="{{route('homeproducts')}}?group=gadgets&cat=smartphone">Smartphone</a>
                                                        <li><a href="{{route('homeproducts')}}?group=gadgets&cat=tab">Tab</a>
                                                        <li><a href="{{route('homeproducts')}}?group=gadgets&cat=smartwatch">Smartwatch</a>
                                                        <li><a href="{{route('homeproducts')}}?group=gadgets&cat=headphone">Headphone</a>
                                                        <li><a href="{{route('homeproducts')}}?group=gadgets&cat=mobile+case/cover">Mobile Case/Cover</a>
                                                        <li><a href="{{route('homeproducts')}}?group=gadgets&cat=powerbank">Powerbank</a>
                                                        <li><a href="{{route('homeproducts')}}?group=gadgets&cat=accessories">Accessories</a>

                                                    </ul>
                                                </div>  
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row item_homepage_row">
                                                    <div class="col-sm-12">
                                                        <div class="group-loading">
                                                            <div class="text-center">
                                                                <img class="ghoori-only-flying" src="https://ghoori.com.bd/img/ghoori-flying.png">
                                                            </div>
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
                    <section class="cata cata5" data-group="home_and_decor" data-anchor="demo5">
                        <div class="container catainner">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="bg">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-2 col-md-2 ">
                                                <div class="cat_header">
                                                    <h1>Home and Decor<i class="fa fa-chevron-right"></i></h1>
                                                    <ul>
                                                        <li><a href="{{route('homeproducts')}}?group=home_and_decor&cat=kitchen+and+dining">Kitchen & Dining </a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=home_and_decor&cat=home+appliance">Home Appliance</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=home_and_decor&cat=furniture">Furniture</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=home_and_decor&cat=tools+and+kits">Tools & Kits</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=home_and_decor&cat=toilet">Toilet</a></li>
                                                        <li><a href="{{route('homeproducts')}}?group=home_and_decor&cat=stationaries">Stationaries</a></li>
                                                    
                                                    </ul>
                                                </div>  
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row item_homepage_row">
                                                    <div class="col-sm-12">
                                                        <div class="group-loading">
                                                            <div class="text-center">
                                                                <img class="ghoori-only-flying" src="https://ghoori.com.bd/img/ghoori-flying.png">
                                                            </div>
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

</div>
<section class="gh_home_section" id="sidenav_ends">
                    <div class="container catainner">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="gh_home_panel bg">
                                    <div class="row">                                        
                                        <div class="col-xs-12">
                                            <div class="bbuttom">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <h2 class="gh_home_panel_title">New Shops</h2>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </div>
                                        {{-- <div class="col-lg-6 col-sm-6 col-md-6">
                                            <h4>View more</h4>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            {{-- <h3 class="section-title padding-right">Featured Shops</h3> --}}
                                            <div class="slick-class-shops">
                                                @foreach($newestShops as $key=>$newestShop)
                                                    <div class="shop-slide">
                                                        <a class="shop-slide-link" href="{{GhooriURI::shopurl($newestShop->subDomain, URL::route('store.shops',$newestShop->subDomain))}}">
                                                            <img class="shop-logo" alt="" data-lazy="{{ URL::asset('public_img/shop_'.$newestShop->shopId.'/logos/'.$newestShop->logo) }}">
                                                            <div class="shop-name">{{ $newestShop->title }}</div>
                                                            <?php /*
                                                            @if ( shopHasGpCampaign( $newestShop->shopId ) )
                                                                <div class="discount-badge-small">
                                                                    <img src="{{asset('img/discount_small.png')}}">
                                                                </div>
                                                            @endif
                                                            */
                                                            ?>
                                                        </a>
                                                        
                                                    </div>

                                                @endforeach
                                            
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
    <section id="slogan">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="flex-row">
                                    <div class="flex-item flex-item-xs-6 flex-item-sm-4 flex-item-md-2">
                                        <div class="slogan_box">
                                            <img class="info-icons" src="{{asset('img/home/infoicons/store_front.png')}}">
                                            <h2>Store Front</h2>
                                            <p>
                                            Ghoori eShop  gives the opportunity to open your own online shop with own shop URL.</p>
                                        </div>
                                    </div>
                                    <div class="flex-item flex-item-xs-6 flex-item-sm-4 flex-item-md-2">
                                        <div class="slogan_box">
                                            <img class="info-icons" src="{{asset('img/home/infoicons/product_management.png')}}">
                                            <h2>Product Management</h2>
                                            <p>Ghoori eShop will allow to manage the inventory in the best possible process to be much organized. With advanced discount and coupon management you can run your own campaign anytime you want.</p>
                                        </div>
                                    </div>
                                    <div class="flex-item flex-item-xs-6 flex-item-sm-4 flex-item-md-2">
                                        <div class="slogan_box">
                                            <img class="info-icons" src="{{asset('img/home/infoicons/fshop_button_blue.png')}}">
                                            <h2>Facebook Shop</h2>
                                            <p>Ghoori introduced fShop. This will help merchants to make their Facebook fans browse the Ghoori eShop products within their Facebook Fan Page. This is a unique proposition from Ghoori.</p>
                                        </div>
                                    </div>

                                    <div class="flex-item flex-item-xs-6 flex-item-sm-4 flex-item-md-2">
                                        <div class="slogan_box">
                                            <img class="info-icons" src="{{asset('img/home/infoicons/reporting_n_analysis.png')}}">
                                            <h2>Reporting and Analytics</h2>
                                            <p>Ghoori has the most advanced reporting system. With the help of Chorki.com Ghoori has the advantage to provide high level industry analytics and information. </p>
                                        </div>
                                    </div>

                                    <div class="flex-item flex-item-xs-6 flex-item-sm-4 flex-item-md-2">
                                        <div class="slogan_box">
                                            <img class="info-icons" src="{{asset('img/home/infoicons/inventory_management.png')}}">
                                            <h2>Inventory management</h2>
                                            <p>Manage your entire inventory with Ghoori. Track stock counts and automatically stop selling products when inventory runs out.</p>
                                        </div>
                                    </div>
                                    <div class="flex-item flex-item-xs-6 flex-item-sm-4 flex-item-md-2">
                                        <div class="slogan_box">
                                            <img class="info-icons" src="{{asset('img/home/infoicons/secure_shopping.png')}}">
                                            <h2>Secure shopping cart</h2>
                                            <p>All credit card and transaction information is protected. You don’t have to worry about it.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </section>
@stop