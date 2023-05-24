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
                            url: "{{route('morehomeproducts')}}",
                            type: "post",
                            data: {
                                'url': window.location.search,
                                'page': page+1,
                                '_token' : '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                response = $.parseJSON(response);
                                // console.log(response);
                                var items = '';
                                for (var i = 0; i < response.result.length; i++) {
                                    // console.log(response.result[i]);
                                   items += '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 grid-item">'
                                                        +'<div class="recomendation_product_box">'
                                                            +'<a href="https://'+response.result[i].url+'">'
                                                                +'<img src="https://'+response.result[i].image+'" class="img-responsive">'
                                                                +'<div class="product-info">'
                                                                    +'<div class="row">'
                                                                        +'<div class="col-xs-12">'
                                                                            +'<div class="product-title">'+response.result[i].title+'</div>'
                                                                        +'</div>'
                                                                       + '<div class="col-xs-12">'
                                                                       +     '<div class="text-success product-price pricewithcomma">'+response.result[i].price+' BDT</div>'
                                                                       + '</div>'
                                                                       + '<div class="col-xs-12">'
                                                                       +     '<div class="product-shop">@'+response.result[i].shopTitle+'</div>'
                                                                       + '</div>'
                                                                   + '</div>'
                                                               + '</div>'
                                                               
                                                          +   '</a>  '
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
                                
                                if(response.numFound == 0){
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
                                                        <h2>Products</h2>
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
                                                      <div class="gh-prod-pan gh-prod-pan-color1">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingOne">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                              For Her
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseOne" class="gh-prod-pan-collapse collapse{{($group == 'for_her' || empty($group) ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingOne">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{($cat == 'salwar kamiz' ? ' class="active"' : '')}}><a href="?group=for_her&cat=salwar+kamiz">Salwar Kamiz</a></li>
                                                                <li{{($cat == 'saree' ? ' class="active"' : '')}}><a href="?group=for_her&cat=saree">Saree</a></li>
                                                                <li{{($cat == 'cosmetics' ? ' class="active"' : '')}}><a href="?group=for_her&cat=cosmetics">Cosmetics</a></li>                                                                
                                                                <li{{($cat == 'bag' ? ' class="active"' : '')}}><a href="?group=for_her&cat=bag">Bag &amp; Purse</a></li>
                                                                <li{{($cat == 'ornaments' ? ' class="active"' : '')}}><a href="?group=for_her&cat=ornaments">Ornaments</a></li>
                                                                <li{{($cat == 'kurti' ? ' class="active"' : '')}}><a href="?group=for_her&cat=kurti">Kurti</a></li>
                                                                <li{{($cat == 'sandal' ? ' class="active"' : '')}}><a href="?group=for_her&cat=sandal">Sandals</a></li>
                                                                <li{{($cat == 'sunglass' ? ' class="active"' : '')}}><a href="?group=for_her&cat=sunglass">Sunglass</a></li>
                                                                <li{{($cat == 'innerwear' ? ' class="active"' : '')}}><a href="?group=for_her&cat=innerwear">Innerwear</a></li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="gh-prod-pan gh-prod-pan-color2">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingTwo">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                              For Him
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="gh-prod-pan-collapse collapse{{($group == 'for_him' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingTwo">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{($cat == 'pants' ? ' class="active"' : '')}}><a href="?group=for_him&cat=pant">Pants</a></li>
                                                                <li{{($cat == 'tshirt' ? ' class="active"' : '')}}><a href="?group=for_him&cat=tshirt">t-shirt</a></li>
                                                                <li{{($cat == 'shirt' ? ' class="active"' : '')}}><a href="?group=for_him&cat=shirt">shirt</a></li>
                                                                <li{{($cat == 'watch' ? ' class="active"' : '')}}><a href="?group=for_him&cat=watch">Watch</a></li>
                                                                <li{{($cat == 'shoe' ? ' class="active"' : '')}}><a href="?group=for_him&cat=shoe">Shoe</a></li>
                                                                <li{{($cat == 'perfume' ? ' class="active"' : '')}}><a href="?group=for_him&cat=perfume">Perfume </a></li>
                                                                <li{{($cat == 'shorts' ? ' class="active"' : '')}}><a href="?group=for_him&cat=shorts">Shorts   </a></li>
                                                                <li{{($cat == 'panjabi' ? ' class="active"' : '')}}><a href="?group=for_him&cat=panjabi">Panjabi </a></li>
                                                                <li{{($cat == 'sunglass' ? ' class="active"' : '')}}><a href="?group=for_him&cat=sunglass">Sunglass </a></li>
                                                                <li{{($cat == 'accessories' ? ' class="active"' : '')}}><a href="?group=for_him&cat=accessories">Accessories </a></li>
                                                                <li{{($cat == 'innerwear' ? ' class="active"' : '')}}><a href="?group=for_him&cat=innerwear">Innerwear</a></li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="gh-prod-pan gh-prod-pan-color3">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingThree">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                              For Kids
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseThree" class="gh-prod-pan-collapse collapse{{($group == 'for_kids' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingThree">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{($cat == 'books'      ? ' class="active"' : '')}}><a href="?group=for_kids&cat=books">Books </a></li>
                                                                <li{{($cat == 'boy cloth'  ? ' class="active"' : '')}}><a href="?group=for_kids&cat=boy+cloth">Baby Boys Clothing</a></li>
                                                                <li{{($cat == 'girl cloth' ? ' class="active"' : '')}}><a href="?group=for_kids&cat=girl+cloth">Baby Girls Clothing</a></li>
                                                                {{-- <li{{($cat == 'toy'        ? ' class="active"' : '')}}><a href="?group=for_kids&cat=toy">Toys &amp; Games</a></li> --}}
                                                                <li{{($cat == 'baby care'  ? ' class="active"' : '')}}><a href="?group=for_kids&cat=baby+care">Baby Care</a></li>
                                                                <li{{($cat == 'baby shoe'  ? ' class="active"' : '')}}><a href="?group=for_kids&cat=baby+shoe">Baby Shoe</a></li>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="gh-prod-pan gh-prod-pan-color4">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingFour">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                              Gadgets
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseFour" class="gh-prod-pan-collapse collapse{{($group == 'gadgets' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingFour">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{($cat == 'smartphone'        ? ' class="active"':'') }}><a href="?group=gadgets&cat=smartphone">Smartphone</a>
                                                                <li{{($cat == 'tab'               ? ' class="active"':'') }}><a href="?group=gadgets&cat=tab">Tab</a>
                                                                <li{{($cat == 'smartwatch'        ? ' class="active"':'') }}><a href="?group=gadgets&cat=smartwatch">Smartwatch</a>
                                                                <li{{($cat == 'headphone'         ? ' class="active"':'') }}><a href="?group=gadgets&cat=headphone">Headphone</a>
                                                                <li{{($cat == 'mobile case/cover' ? ' class="active"':'') }}><a href="?group=gadgets&cat=mobile+case/cover">Mobile Case/Cover</a>
                                                                <li{{($cat == 'powerbank'         ? ' class="active"':'') }}><a href="?group=gadgets&cat=powerbank">Powerbank</a>
                                                                <li{{($cat == 'accessories'       ? ' class="active"':'') }}><a href="?group=gadgets&cat=accessories">Accessories</a>
                                                            </ul>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="gh-prod-pan gh-prod-pan-color5">
                                                        <div class="gh-prod-pan-heading" role="tab" id="headingFive">
                                                          <h4 class="gh-prod-pan-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                              Home and Decor
                                                            </a>
                                                          </h4>
                                                        </div>
                                                        <div id="collapseFive" class="gh-prod-pan-collapse collapse{{($group == 'home_and_decor' ? ' in' : '')}}" role="tabpanel" aria-labelledby="headingFive">
                                                          <div class="gh-prod-pan-body">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li{{ ($cat == 'kitchen & dining' ? ' class="active"' : '') }}><a href="?group=home_and_decor&cat=kitchen+and+dining">Kitchen & Dining </a></li>
                                                                <li{{ ($cat == 'home appliance' ? ' class="active"' : '') }}><a href="?group=home_and_decor&cat=home+appliance">Home Appliance</a></li>
                                                                <li{{ ($cat == 'furniture' ? ' class="active"' : '') }}><a href="?group=home_and_decor&cat=furniture">Furniture</a></li>
                                                                <li{{ ($cat == 'tools & kits' ? ' class="active"' : '') }}><a href="?group=home_and_decor&cat=tools+and+kits">Tools & Kits</a></li>
                                                                <li{{ ($cat == 'toilet' ? ' class="active"' : '') }}><a href="?group=home_and_decor&cat=toilet">Toilet</a></li>
                                                                <li{{ ($cat == 'stationaries' ? ' class="active"' : '') }}><a href="?group=home_and_decor&cat=stationaries">Stationaries</a></li>
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
                                                                            <div class="text-success product-price pricewithcomma">{{{$item->price[0]}}} BDT</div>
                                                                        </div>
                                                                        <div class="col-xs-12">
                                                                            <div class="product-shop">@{{{$item->shopTitle[0]}}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                               
                                                             </a>  
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