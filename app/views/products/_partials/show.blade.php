{{-- Public Product Page --}}


@extends('shops.yourshop._layouts.master')
@section('title')
    {{ $product->name }}
@stop
@section('address-edit')
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

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
{{ HTML::style('css/similarproducts.css') }}
@stop
@section('content')
    <div class="container">

        <!-- ====================== -->
        <!-- Single Product Section -->
        <!-- ====================== -->
        <section class="single">

           <div class="row">
                <header class="col-sm-12 prime">
                    <h3 id="ptitle" data-type="text" data-pk="1" data-url="post.php" data-title="Enter title">{{$product->name}}</h3>
                </header>
            </div>
            <div class="row">

                <div class="col-sm-5">

                    <!-- Product Images -->
                    <div class="wrap">

                        <div id="flexslider-product" class="flexslider">
                            <ul class="slides">
                                @foreach($product->images as $key => $image)

                                    <li><a href="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" class="product-image-link"><img src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" data-zoom-image="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" class="zoom" /></a></li>
                                @endforeach
                                @if($attributes)
                                
                                    @foreach($attributes as $attribute)
                                        @if($attribute->type== 'color')
                                            <li class="slide_{{ $attribute->productAttributeId }}" value="{{ $attribute->productAttributeId }}">
                                                <a href="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/'.$attribute->image ) }}" class="product-image-link"><img src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/'.$attribute->image ) }}" data-zoom-image="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/'.$attribute->image ) }}" class="zoom" /></a>
                                            </li>
                                        @endif
                                    @endforeach
                                
                                @endif
                            </ul>
                        </div>

                        <div id="flexcarousel-product" class="flexslider visible-desktop">
                            <ul class="slides">
                                @foreach($product->images as $key => $image)
                                    <li><img class="img-slider-thumb" src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/thumb/'.$image->imageLink ) }}" /></li>
                                @endforeach
                                @if($attributes)
                                
                                    @foreach($attributes as $attribute)
                                        @if($attribute->type== 'color')
                                            <li class="carouselslide_{{ $attribute->productAttributeId }}"><img class="img-slider-thumb" src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/thumb/'.$attribute->image ) }}" /></li>
                                          
                                        @endif
                                    @endforeach
                                
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-sm-7">

                    <!-- Product Info -->
                    <div class="details wrapper">
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
                            <div class="clearfix">
                {{ Form::open(array('route'=>'carts.buyNow','id'=>'add-to-cart')) }}

                        <p>
                            @if($attributeCount['color'] >  0)
                                <select class="selectpicker selectcolorpicker"  name="color" id="#">
                                    @foreach($attributes as $attribute)
                                        @if($attribute->type== 'color')
                                            <option data-attid="{{ $attribute->productAttributeId }}" value="{{ $attribute->productAttributeId }}">{{ $attribute->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                        </p>
                        <p>
                            @if($attributeCount['size'] >  0)
                                <select class="selectpicker" name="size" id="#">
                                    @foreach($attributes as $attribute)
                                        @if($attribute->type == 'size')
                                            <option value="{{ $attribute->productAttributeId }}">{{ $attribute->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                        </p>
                <div class="pull-left qty">
                @if($product->stock > 0)
                {{ Form::number('qty',1,array('class'=>'qty','min'=>1,'max'=>$product->stock)) }}
                @else
                <p class="alert alert-danger" >Out of Stock</p>
                @endif
                </div>
                {{ Form::hidden('shop_id',$product->shop->id)}}
                {{ Form::hidden('product_id',$product->id) }}
            <div class="pull-left">
                @if ((!$ownProduct) && $product->stock > 0)
                    {{ Form::submit('Add to Cart',array('id'=>'add-cart','class'=>'btn theme')) }}&nbsp;
                    {{ Form::submit('Buy Now',array('id'=>'buy-now','class'=>'btn btn-success')) }}
                @endif</div>
            </div>
                {{ Form::close() }}
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 decidernote">Hard to decide? Ask you friends :)</div>
                            <div class="col-sm-6 decider">
                            
                                <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?app_id={{Config::get('facebook.appId')}}&sdk=joey&u={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}&display=popup&ref=plugin&src=share_button', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-facebook-circled"></i></a>
                                <a href="#" onclick="window.open('https://twitter.com/share?url={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-twitter-circled"></i></a>
                                <a href="#" onclick="window.open('https://plus.google.com/share?url={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-gplus-circled"></i></a>
                                <a href="#" onclick="window.open('https://pinterest.com/pin/create/button/?url={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}&media={{urlencode(asset( '/public_img/shop_'.$product->shop_id.'/products/'.( is_array($product->images) ? $product->images[0]->imageLink : '' ) ))}}&description={{ urlencode($product->description) }}', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-pinterest-circled"></i></a>
                                <a href="mailto:yourfriend@somewhere?&body={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}"><i class="icon-mail"></i></a>
                            </div>
                        </div>

                        <hr>

                        <!-- Product details -->

                        <div class="accordion" id="accordion2">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#description">
                                        <i class="icon-layout theme"></i> Product Description
                                    </a>
                                </div>
                                <div id="description" class="accordion-body">
                                    <textarea class="mdtextraw hidden" readonly>{{{$product->description}}}</textarea>
                                    <div class="accordion-inner markdowntext" id="prodesc">
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#sizing">
                                            <i class="icon-layout theme"></i> Product Specification
                                        </a>
                                    </div>

                                  <div id="sizing" class="accordion-body collapse in">
                                        <div class="accordion-inner">
                                            <table class="table table-striped table-hover">
                                                @foreach($product->properties as $property)
                                                    <tr>
                                                        <th>{{ $property->type }}</th>                                        
                                                        <td>{{ $property->value }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            
                                        </div>
                                    </div>
                            </div>
                            
                        </div>

                    </div>

                </div>
            </div>



        </section>

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
@stop

@section('cart-js')
    <script type="text/javascript">

        var shopcattreejson = "{{URL::route('categorytreebyid', array('shopID' => $shop->id))}}";
        var getProductsByCategories = "{{URL::route('getproductsbycategories')}}";
    </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
@include('carts._partials.addToCart')
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