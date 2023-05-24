
@extends('themes.theme_2._layout.master')

@section('title')
    <title>Product | {{$shop->title}}</title>
@stop


@section('metatags')
    <link rel="canonical" href="{{ GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id) }}" />
    <meta property="og:title" content="{{ $product->name }} at {{$product->shop->title}}" />
    <meta property="og:site_name" content="{{$product->shop->title}} @ Ghoori"/>
    <meta property="og:url" content="{{ GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id) }}" />
    <meta property="og:description" content="{{{$product->description}}}" />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="product" />
    <meta property="og:locale" content="en_US" />
    @if(!empty($product->images[0]))
        <meta property="og:image" content="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$product->images[0]->imageLink ) }}" />
    @else
        <meta property="og:image" content="" />
    @endif
    <meta property="article:author" content="{{GhooriURI::shopurl($product->shop->subDomain, URL::route('store.shops',$product->shop->getSlug()))}}" />

    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop


@section('dhumketu_productPage_css_files')

    <!-- Product Slider -->
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.5/css/lightslider.min.css">

        {{HTML::style('themes/theme_2/css/category-breadcrumb.css')}}
    {{HTML::style('themes/theme_2/css/product.css')}}

@stop

@section('related_product_css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    {{ HTML::style('css/similarproducts.css') }}
@stop

@section('dhumketu_product_body_content')

    {{--Secondary Navigation Bar--}}
    @include('themes.theme_2._partials.theme-second-nav')

    @include('themes.theme_2._partials.shop-tab-menu')


    {{--Category Breadcrumb--}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 breadcrumb-background">
                                <ul class="breadcrumb">
                                    <li><a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}">
                                            Products </a>
                                    </li>
                                    @if($product->category)
                                        <li  {{ (($product->subCategory && $product->category) or !$product->category)?"":"class='active'" }}>
                                            {{ link_to_route('shops.category',$product->category->name,[$shop->slug,
                                           $product->category->name])
                                            }}
                                        </li>
                                    @endif
                                    @if($product->subCategory)
                                        <li {{ ($product->subCategory)?"class='active'":'' }} >
                                            {{ link_to_route('shops.category',$product->subCategory->name,[$shop->slug,
                                             $product->category->name,'sub-category'=>$product->subCategory->name])
                                          }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Single Product Show Area--}}
    <div class="container-fluid product-container">
        <div class="row product-row">
            <div class="col-md-12">
                <div class="row">
                    {{--Single product Slider Section--}}
                    <div class="col-md-8 box-1">
                        <div class="product-slider-box">
                            <div class="single-product-slider">
                                <div class="demo slider-lighter-demo">
                                    <ul id="lightSlider">
                                        @foreach($product->images as $key => $image)
                                            <li data-thumb="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/thumb/'.$image->imageLink ) }}">
                                                <a class="product-image-link" href="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}">
                                                    <img src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" />
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Product Information Section--}}
                    <div class="col-md-4 box-2">
                        <div class="product-info-area">
                            <div class="single-product-description">
                                <div class="product-title-view">
                                    <h2>{{ $product->name }}</h2>
                                </div>

                                <div class="product-price">
                                    @if ( $product->getActiveCampaign() && $product->getDiscountRate() )
                                        <div class="discount-tag discount-tag-lg">{{$product->getDiscountRate()}} off</div>
                                    @endif
                                    <p class="price">

                                        <i class="icon-tag"></i>

                                        @if ( $product->getActiveCampaign() && $product->getDiscountRate() )
                                            <span style='color:red;text-decoration:line-through'>
                                                <small style="color:#999">
                                                    <span class="pricewithcomma">{{$product->price}}</span> BDT
                                                </small>
                                            </span>&nbsp;

                                            <span class="pricewithcomma">{{$product->price - $product->getDiscountAmmount()}}</span> BDT
                                        @else
                                            <span class="pricewithcomma">{{$product->price}}</span> BDT
                                        @endif

                                    </p>
                                </div>

                                <div class="button-section">
                                    {{ Form::open(array('route'=>'carts.buyNow','id'=>'add-to-cart', 'class' => 'product_buy_form form-horizontal')) }}
                                    <div class="product-attributes">

                                        @if($attributeCount['color'] >  0)
                                            <div class="form-group">
                                                <label for="product_color" class="col-sm-4 control-label text-left ">Color</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control"  name="color" id="product_color">
                                                        @foreach($attributes as $attribute)
                                                            @if($attribute->type== 'color')
                                                                <option data-attid="{{ $attribute->productAttributeId }}" value="{{ $attribute->productAttributeId }}">{{ $attribute->value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        @if($attributeCount['size'] >  0)
                                            <div class="form-group">
                                                <label for="product_size" class="col-sm-4 control-label text-left ">Size</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control"  name="size" id="product_size">
                                                        @foreach($attributes as $attribute)
                                                            @if($attribute->type == 'size')
                                                                <option value="{{ $attribute->productAttributeId }}">{{ $attribute->value }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="">
                                            @if($product->stock > 0)
                                                <div class="form-group">
                                                    <label for="product_quantity" class="col-sm-4 control-label text-left ">Quantity</label>
                                                    <div class="col-sm-8">
                                                        {{ Form::number('qty',1,array('class'=>'form-control','id'=>'product_quantity','min'=>1,'max'=>$product->stock)) }}
                                                    </div>
                                                </div>
                                            @else
                                                <p class="alert alert-danger" >Out of Stock</p>
                                            @endif
                                        </div>

                                        </div>
                                            {{ Form::hidden('shop_id',$product->shop->id)}}
                                            {{ Form::hidden('product_id',$product->id) }}
                                        <div class="button-section">

                                        @if ($product->shop->id != Session::get('shop_id') && $product->stock > 0)
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    {{ Form::submit('ADD TO CART',array('id'=>'add-cart','class'=>'btn-success add-to-cart-button')) }}
                                                </div>

                                                <div class="col-xs-6">
                                                    {{ Form::submit('BUY NOW',array('id'=>'buy-now','class'=>'btn-danger buy-button')) }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{ Form::close() }}
                                </div>

                                <div class="product-description">
                                    <a href="javascript:">Description</a>
                                    <p>{{ $product->description }}</p>
                                </div>

                                <div class="product-specification">
                                    <a href="javascript:">Specification</a>
                                    <div>
                                        <table class="table table-striped table-hover">
                                            @if($product->properties->count())
                                                @foreach($product->properties as $property)
                                                    <tr>
                                                        <th>{{ $property->type }}</th>
                                                        <td>{{ $property->value }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p> N/A</p>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Related Product Show Area--}}
    <div class="container-fluid related-product-box-background">
        <div class="related-product-box">
            <div class="row">
                <dov class="col-md-12">
                    <div class="related-product-heading">
                        <h3>Related Product</h3>
                    </div>
                </dov>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="related-product-slider">
                        <section class="similarProducts " >
                            <div class="row">
                                <header class="col-sm-12">
                                    <h4>More Products from <a href="https://{{$product->shop->subDomain}}.ghoori.com.bd">{{$product->shop->title}}</a></h4>
                                </header>
                            </div>

                            <div class="row owl-carousel" id="sameShopSP">

                            </div>
                        </section>

                        <section class="similarProducts " >
                            <div class="row">
                                <header class="col-sm-12">
                                    <h4>RECOMMENDED FOR YOU</h4>
                                </header>
                            </div>

                            <div class="row owl-carousel" id="differentShopSP">

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop




@section('dhumketu_productPage_js_files')

    <!-- Product Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.5/js/lightslider.min.js"></script>
    <script>
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 9,
            auto: true,
            pauseOnHover: true,
            slideEndAnimation: true,
            // controls: false,
            // adaptiveHeight: true,
            // autoWidth: true,
            // gallery: false,
            // galleryMargin: 50,
            enableTouch: true,
            // enableDrag: true,
            thumbMargin: 10,
            mode: 'slide',
            speed: 600,
            pause: 4000  //or 'slide'

        });
    </script>


    <!-- Related Product Slider -->
    <script>
        $(document).ready(function() {
            // $("#related-content-slider").lightSlider({
            //     loop:true,
            //     keyPress:true
            // });
//            alert('hello');
            $('#related-content-slider').lightSlider({
                gallery:false,
                item:4,
                autoWidth: false,

                mode: "slide",


                thumbItem:9,
                slideMargin: 15,
                speed:400,

                auto: false,
                // slideMove: 2, //for auto play
                slideEndAnimation: true,
                pause: 2000,
                loop:true,

                onSliderLoad: function() {
                    $('#related-content-slider').removeClass('cS-hidden');
                }
            });
        });
    </script>

    <!-- for product specification slider -->
    <script>
        $(document).ready(function(){
            var link = $('.product-specification a');
            link.next('table').hide();
            link.click(function(){
                if($(this).next('p:visible, div:visible').length==0){
                    $(this).parent('li').children('a').css('font-weight','bold');
                    $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
                    $(this).next('p, div').slideDown();
                }
                else{
                    $(this).parent('li').children('a').css('font-weight','normal');
                    $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
                    $(this).next('p, div').slideUp();
                }
            });
        });
    </script>

    <!-- for product description slider -->
    <script>
        $(document).ready(function(){
            var link = $('.product-description a');
            link.next('p').show();
            link.click(function(){
                if($(this).next('p:visible, div:visible').length==0){
                    $(this).parent('li').children('a').css('font-weight','bold');
                    $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
                    $(this).next('p, div').slideDown();
                }
                else{
                    $(this).parent('li').children('a').css('font-weight','normal');
                    $(this).parent('li').children('a').children('span').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
                    $(this).next('p, div').slideUp();
                }
            });
        });
    </script>

@stop

@section('page-specific-js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            var data = relatedProductRequest(1);
            data = relatedProductRequest(0);
        });

        function relatedProductRequest(sameShop){
            var shopId = {{$shop->id}};
            var productId = {{$product->id}};
            var data = {
                shopId : shopId,
                productId : productId,
                sameShop : sameShop
            }
            $.ajax({
                type:'GET',
                url:'{{ URL::route('relatedProducts') }}',
                data:data,
                dataType: "jsonp",
                type: "get",
                success:function(data){
                    // console.log(data);
                    var divId = '';
                    if(sameShop){
                        divId = '#sameShopSP';
                    }else{
                        divId = '#differentShopSP';
                    }
                    var htmlData = relatedProductView(data);
                    if(data.length>=5){
                        $(divId).closest('.similarProducts').show();
                    }
                    $(divId).append(htmlData);
                    $(divId).owlCarousel({

                    });

                },
                error:function(err){
                    console.log(err);
                }
            });
        }

        function relatedProductView(data){
            var divData = '';
            $.each(data,function(key,item){
                var url = 'http://click.chorki.com/click?url=https://'+ item["subDomain"]+'.ghoori.com.bd/products/' + String(item["id"]) + '&source=' +'{{Request::url()}}' + "&query=Similar+Product&user={{ Auth::id()?Auth::id():Null}}";
                divData = divData + '<div class="similar-product-box"><a href='+url+'>'+
                '<div class="similar-product-img"><img src="https://'+ item['image'][0]+'"></div>'+
                '<div class="similar-product-info"><div class="row">' +
                '<div class="col-xs-12"><div class="similar-product-title">'+item["title"][0]+'</div></div>'+
                '<div class="col-xs-12"><div class="text-success similar-product-price pricewithcomma">'+item["price"][0]+'</div></div>'+
                '<div class="col-xs-12"><div class="similar-product-shop">'+item["shopTitle"][0]+'</div></div>'+
                '</div></div>'+
                '</a></div>';
            });
            return divData;
        }

    </script>

@stop

@section('cart-js')
    @include('carts._partials.addToCart')
@stop





