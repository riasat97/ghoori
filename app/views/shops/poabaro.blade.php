{{-- Home page --}}

@extends('public.shop._layouts.index')
@section('title')
    Ghoori.com.bd
@stop
@section('homeCss')
    <link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    {{-- 
    {{HTML::style('homepage/css/slide.css')}}
    {{HTML::style('homepage/slick/slick.css')}}
    {{HTML::style('homepage/slick/slick-theme.css')}} --}}

    {{HTML::style('homepage/css/home.css')}}
    {{HTML::style('homepage/css/cat.css')}}
@endsection
@section('metatags')
    <meta property="og:title" content="পোয়া১২" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('poabaropage')}}" />
    <meta property="og:description" content="পোয়া১২! Call 09612000888 to know more." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/og/poa12.jpg')}}" />

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
    {{-- {{ HTML::script('homepage/js/jssor.js') }} --}}
    {{-- {{ HTML::script('homepage/js/jssor.slider.js') }} --}}

    {{-- {{ HTML::script('homepage/slick/slick.min.js')}} --}}

    {{-- {{ HTML::script('homepage/script4jssor.js') }} --}}

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
                            url: "{{route('morepoabaro')}}",
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
                                for (var i = 0; i < response.docs.length; i++) {
                                    // console.log(response.result[i]);
                                   items += '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 grid-item">'
                                                        +'<div class="recomendation_product_box">'
                                                            +'<a href="https://'+response.docs[i].url+'">'
                                                                +'<img src="https://'+response.docs[i].image+'" class="img-responsive">'
                                                                +'<div class="product-info">'
                                                                    +'<div class="row">'
                                                                        +'<div class="col-xs-12">'
                                                                            +'<div class="product-title">'+response.docs[i].title+'</div>'
                                                                        +'</div>'
                                                                       + '<div class="col-xs-12">'
                                                                       // +     '<div class="text-success product-price pricewithcomma">'+response.docs[i].price+' BDT</div>'
                                                                        + '<div class="text-success product-price price"><del class="pricewithcomma">'+response.docs[i].price+' BDT</del></div>'
                                                                        + '<div class="text-success product-price pricewithcomma">'+ (response.docs[i].price - (response.docs[i].price * response.docs[i].discountpercentage[0] / 100 ) ) +' BDT</div>'
                                                                       + '</div>'
                                                                       + '<div class="col-xs-12">'
                                                                       +     '<div class="product-shop">@'+response.docs[i].shopTitle+'</div>'
                                                                       + '</div>'
                                                                   + '</div>'
                                                               + '</div>'
                                                               
                                                          +   '</a>  '
                                                          +   '<div class="discount-tag discount-tag-sm discount-tag-color-'+response.docs[i].discountpercentage[0]+'">'+response.docs[i].discountpercentage[0]+'% off</div> '

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
                                
                                if(response.docs.length == 0 || response.docs.length < 24){
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
    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="gh_home_panel">
                                    @if(empty($discount))
                                    {{-- <img u="image" src="{{ URL::asset('img/home/slider/camp_poa12_1.jpg') }}" alt="" style="width:100%"> --}}
                                    @elseif ($discount == 15)
                                    <img u="image" src="{{ URL::asset('img/home/poa12/banners/poa12banner'.$discount.'.jpg') }}" alt="" style="width:100%">
                                    @elseif ($discount == 20)
                                    <img u="image" src="{{ URL::asset('img/home/poa12/banners/poa12banner'.$discount.'.jpg') }}" alt="" style="width:100%">
                                    @elseif ($discount == 30)
                                    <img u="image" src="{{ URL::asset('img/home/poa12/banners/poa12banner'.$discount.'.jpg') }}" alt="" style="width:100%">
                                    @elseif ($discount == 40)
                                    <img u="image" src="{{ URL::asset('img/home/poa12/banners/poa12banner'.$discount.'.jpg') }}" alt="" style="width:100%">
                                    @elseif ($discount == 50)
                                    <img u="image" src="{{ URL::asset('img/home/poa12/banners/poa12banner'.$discount.'.jpg') }}" alt="" style="width:100%">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
    <div class="container">
                        <div class="row" style="margin-top:30px;">
                            {{-- <div class="col-xs-12"> --}}
                                <a class="discount_filters" href="?group={{urlencode($group)}}&cat={{urlencode($cat)}}&discount=15" style="width:20%; float:left">
                                    <img u="image" src="{{ URL::asset('img/home/poa12/buttons/210_15.jpg') }}" alt="" class="@if($discount == 15) active @endif filter_buttons" style="width:100%; padding: 0 15px;">
                                </a>
                                <a class="discount_filters" href="?group={{urlencode($group)}}&cat={{urlencode($cat)}}&discount=20" style="width:20%; float:left">
                                    <img u="image" src="{{ URL::asset('img/home/poa12/buttons/210_20.jpg') }}" alt="" class="@if($discount == 20) active @endif filter_buttons" style="width:100%; padding: 0 15px;">
                                </a>
                                <a class="discount_filters" href="?group={{urlencode($group)}}&cat={{urlencode($cat)}}&discount=30" style="width:20%; float:left">
                                    <img u="image" src="{{ URL::asset('img/home/poa12/buttons/210_30.jpg') }}" alt="" class="@if($discount == 30) active @endif filter_buttons" style="width:100%; padding: 0 15px;">
                                </a>
                                <a class="discount_filters" href="?group={{urlencode($group)}}&cat={{urlencode($cat)}}&discount=40" style="width:20%; float:left">
                                    <img u="image" src="{{ URL::asset('img/home/poa12/buttons/210_40.jpg') }}" alt="" class="@if($discount == 40) active @endif filter_buttons" style="width:100%; padding: 0 15px;">
                                </a>
                                <a class="discount_filters" href="?group={{urlencode($group)}}&cat={{urlencode($cat)}}&discount=50" style="width:20%; float:left">
                                    <img u="image" src="{{ URL::asset('img/home/poa12/buttons/210_50.jpg') }}" alt="" class="@if($discount == 50) active @endif filter_buttons" style="width:100%; padding: 0 15px;">
                                </a>


                            {{-- </div> --}}
                        </div>
                    </div>
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
                                                        <h2>পোয়া ১২</h2>
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
                                        <div class="col-sm-3">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    
                                                    <div class="gh-prod-pan-group mt20" id="accordion" role="tablist" aria-multiselectable="true">
                                                        <div class="gh-prod-pan gh-prod-pan-color0">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingZero">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a role="button" href="{{route('poabaropage')}}">
                                                              See All
                                                            </a>
                                                          </h4>
                                                        </div>
                                                      </div>
                                                      <div class="gh-prod-pan gh-prod-pan-color1">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingOne">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                              Fashion
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseOne" class="gh-prod-pan-collapse collapse{{($group == 'Fashion' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{($cat == 'Mens+Wear' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Mens+Wear">Mens Wear</a></li>
                                                                <li{{($cat == 'Womens+Wear' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Womens+Wear">Womens Wear</a></li>
                                                                <li{{($cat == 'Jewellery' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Jewellery">Jewellery</a></li>
                                                                <li{{($cat == 'Mens+Footwear' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Mens+Footwear">Mens Footwear</a></li>
                                                                <li{{($cat == 'Womens+Footwear' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Womens+Footwear">Womens Footwear</a></li>
                                                                <li{{($cat == 'Mens+Watches' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Mens+Watches">Mens Watches</a></li>
                                                                <li{{($cat == 'Womens+Watches' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Womens+Watches">Womens Watches</a></li>
                                                                <li{{($cat == 'Mens+Glasses' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Mens+Glasses">Mens Glasses</a></li>
                                                                <li{{($cat == 'Womens+Glasses' ? ' class="active"' : '')}}><a href="?group=Fashion&cat=Womens+Glasses">Womens Glasses</a></li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>

                                                      <div class="gh-prod-pan gh-prod-pan-color2">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingTwo">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseThree">
                                                              Health and beauty
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="gh-prod-pan-collapse collapse{{($group == 'health_n_beauty' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingTwo">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{($cat == 'Cosmetics'?' class="active"' : '')}}><a href="?group=health_n_beauty&cat=Cosmetics">Cosmetics </a></li>
                                                                <li{{($cat == 'Hair+Care'?' class="active"' : '')}}><a href="?group=health_n_beauty&cat=Hair+Care">Hair Care </a></li>
                                                                <li{{($cat == 'Perfumes'?' class="active"' : '')}}><a href="?group=health_n_beauty&cat=Perfumes">Perfumes </a></li>
                                                                <li{{($cat == 'Skin+care'?' class="active"' : '')}}><a href="?group=health_n_beauty&cat=Skin+care">Skin care </a></li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>

                                                      <div class="gh-prod-pan gh-prod-pan-color3">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingThree">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                              Electronics
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseThree" class="gh-prod-pan-collapse collapse{{($group == 'Electronics' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingThree">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{($cat == 'Computer+Accessories'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Computer+Accessories">Computer Accessories</a></li>
                                                                <li{{($cat == 'Desktop PCs'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Desktop+PCs">Desktop PCs</a></li>
                                                                <li{{($cat == 'Laptops'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Laptops">Laptops</a></li>
                                                                <li{{($cat == 'Printer+&+Scanner'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Printer+&+Scanner">Printer & Scanner</a></li>
                                                                <li{{($cat == 'Audio'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Audio">Audio</a></li>
                                                                <li{{($cat == 'Camera'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Camera">Camera</a></li>
                                                                <li{{($cat == 'Gaming'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Gaming">Gaming</a></li>
                                                                <li{{($cat == 'Power+Banks'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Power+Banks">Power Banks</a></li>
                                                                <li{{($cat == 'Tv+&+Video'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Tv+&+Video">Tv & Video</a></li>
                                                                <li{{($cat == 'Mobile'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Mobile">Mobile</a></li>
                                                                <li{{($cat == 'Tabs'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Tabs">Tabs</a></li>
                                                                <li{{($cat == 'Mobile+Accessories'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Mobile+Accessories">Mobile Accessories</a></li>
                                                                <li{{($cat == 'Other+Electronics'?' class="active"' : '')}}><a href="?group=Elcetronics&cat=Other+Electronics">Other Electronics</a></li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="gh-prod-pan gh-prod-pan-color4">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingFour">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                              Home & Living
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseFour" class="gh-prod-pan-collapse collapse{{($group == 'home-n-living' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingFour">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                              <li{{($cat == 'Furniture' ? ' class="active"' : '')}}><a href="?group=home-n-living&cat=Furniture">Furniture </a></li>
                                                              <li{{($cat == 'Gardening' ? ' class="active"' : '')}}><a href="?group=home-n-living&cat=Gardening">Gardening </a></li>
                                                              <li{{($cat == 'Home+Appliances' ? ' class="active"' : '')}}><a href="?group=home-n-living&cat=Home+Appliances">Home Appliances </a></li>
                                                              <li{{($cat == 'Home+decor' ? ' class="active"' : '')}}><a href="?group=home-n-living&cat=Home+decor">Home decor </a></li>
                                                              <li{{($cat == 'Kitchen+Dining' ? ' class="active"' : '')}}><a href="?group=home-n-living&cat=Kitchen+Dining">Kitchen & Dining </a></li>
                                                            
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="gh-prod-pan gh-prod-pan-color5">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingFive">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                              Others
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseFive" class="gh-prod-pan-collapse collapse{{($group == 'others' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingFive">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                              <li{{($cat == 'Books+Media' ? ' class="active"' : '')}}><a href="?group=Others&cat=Books+Media">Books & Media </a></li>
                                                              <li{{($cat == 'Food+and+Beverage' ? ' class="active"' : '')}}><a href="?group=Others&cat=Food+and+Beverage">Food and Beverage </a></li>
                                                              <li{{($cat == 'Service' ? ' class="active"' : '')}}><a href="?group=Others&cat=Service">Service </a></li>
                                                              <li{{($cat == 'Everything+else' ? ' class="active"' : '')}}><a href="?group=Others&cat=Everything+else">Everything else </a></li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row mt20 no-leftright">
                                                @if (count($results) > 0)
                                                    <div class="grid">
                                                        @foreach($results as $key => $item)
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 grid-item half-hidden">
                                                            <div class="recomendation_product_box">
                                                                <a href="https://{{{$item->url[0]}}}">
                                                                    <img src="https://{{{$item->image[0]}}}" class="img-responsive">
                                                                    <div class="product-info">
                                                                        <div class="row">
                                                                            <div class="col-xs-12">
                                                                                <div class="product-title">{{{$item->title[0]}}}</div>
                                                                            </div>
                                                                            <div class="col-xs-12">
                                                                                <div class="text-success product-price price">
                                                                                    <del class="pricewithcomma">{{{$item->price[0]}}} BDT</del>
                                                                                </div>
                                                                                <div class="text-success product-price pricewithcomma">{{{$item->price[0] - ($item->price[0] * $item->discountpercentage[0] /100 )}}} BDT</div>
                                                                            </div>
                                                                            <div class="col-xs-12">
                                                                                <div class="product-shop">@{{{$item->shopTitle[0]}}}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                 </a>
                                                                 <div class="discount-tag discount-tag-sm discount-tag-color-{{$item->discountpercentage[0]}}">{{$item->discountpercentage[0]}}% off</div> 
                                                            </div>
                                                           
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="col-xs-12 grid">
                                                        <div class="alert alert-warning">No products found in these parameters. Try again.</div>
                                                    </div>
                                                @endif
                                         
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