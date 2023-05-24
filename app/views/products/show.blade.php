@extends('shops.myshop._layouts.main')
@section('title')
    {{ $product->name }}
@stop
@section('metatags')
    <link rel="canonical" href="{{ GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id) }}" /> 
    <meta property="og:title" content="{{ $product->name }} at {{$product->shop->title}}" />
    <meta property="og:site_name" content="{{$product->shop->title}} @ Ghoori"/>
    <meta property="og:url" content="{{ GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id) }}" />
    <meta property="og:description" content="{{$product->description}}" />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="product" />
    <meta property="og:locale" content="en_US" />
    @if($product->images[0])
    <meta property="og:image" content="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$product->images[0]->imageLink ) }}" />
    @else
    <meta property="og:image" content="" />
    @endif
    <meta property="article:author" content="{{GhooriURI::shopurl($product->shop->subDomain, URL::route('store.shops',$product->shop->getSlug()))}}" />
    
    <meta property="article:publisher" content="{{URL::route('home')}}" />
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

                                    <li><a href="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" class="product-image-link"><img src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" class="zoom" /></a></li>
                                @endforeach
                                @if($attributes)
                                
                                    @foreach($attributes as $attribute)
                                        @if($attribute->type== 'color')
                                            <li class="slide_{{ $attribute->productAttributeId }}" value="{{ $attribute->productAttributeId }}">
                                                <a href="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/'.$attribute->image ) }}" class="product-image-link"><img src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/'.$attribute->image ) }}" class="zoom" /></a>
                                            </li>
                                        @endif
                                    @endforeach
                                
                                @endif
                            </ul>
                        </div>

                        <div id="flexcarousel-product" class="flexslider visible-desktop">
                            <ul class="slides">
                                @foreach($product->images as $key => $image)
                                    <li><img class="img-slider-thumb" src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" /></li>
                                @endforeach
                                @if($attributes)
                                
                                    @foreach($attributes as $attribute)
                                        @if($attribute->type== 'color')
                                            <li class="carouselslide_{{ $attribute->productAttributeId }}"><img class="img-slider-thumb" src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/'.$attribute->image ) }}" /></li>
                                          
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
                        
                        <p>
                            @if($attributeCount['color'] >  0)
                                <select class="selectpicker"  name="color" id="#">
                                    @foreach($attributes as $attribute)
                                        @if($attribute->type== 'color')
                                            <option value="{{ $attribute->productAttributeId }}">{{ $attribute->value }}</option>
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
                        <input readonly type="number" min="1" class="qty" name="qty" value="1" max="{{$product->stock}}">

                        @else
                            <p class="alert alert-danger" >Stock: {{$product->stock}}</p>
                        @endif
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-6 decidernote">Hard to decide? Ask you friends :)</div>
                            <div class="col-sm-6 decider">
                                <!-- {{Config::get('facebook.appId')}}
                            {{urlencode(route('products.view',array($product->shop->getSlug(),$product->id)))}} -->
                                <!-- <a href="https://www.facebook.com/dialog/share?app_id={{Config::get('facebook.appId')}}&display=popup&href={{urlencode(route('products.view',array($product->shop->getSlug(),$product->id)))}}&redirect_uri={{urlencode(route('products.view',array($product->shop->getSlug(),$product->id)))}}" ><i class="icon-facebook-circled"></i></a> -->
                                <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?app_id={{Config::get('facebook.appId')}}&sdk=joey&u={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}&display=popup&ref=plugin&src=share_button', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-facebook-circled"></i></a>
                                <a href="#" onclick="window.open('https://twitter.com/share?url={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-twitter-circled"></i></a>
                                <a href="#" onclick="window.open('https://plus.google.com/share?url={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-gplus-circled"></i></a>
                                <a href="#" onclick="window.open('https://pinterest.com/pin/create/button/?url={{urlencode(GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->getSlug(),$product->id)),$product->id))}}&media={{urlencode(asset( '/public_img/shop_'.$product->shop_id.'/products/'.$product->images[0]->imageLink ))}}&description={{ urlencode($product->description) }}', 'newwindow', 'width=600, height=400'); return false;"><i class="icon-pinterest-circled"></i></a>
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

    </div>
@stop
