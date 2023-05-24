@extends('shops.yourshop._layouts.master')
@section('title')
    {{$shop->title}}
@stop
@section('metatags')
    <meta property="og:title" content="{{ $shop->title }}" />
    <meta property="og:site_name" content="{{ $shop->title }} @ Ghoori"/>
    <meta property="og:url" content="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}" />
    <meta property="og:description" content="{{ substr(strip_tags($shop->description), 0, 200) }}" />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />

    @if($shop->banner)
    <meta property="og:image" content="{{ asset('public_img/shop_'.$shop->id.'/banners/'.$shop->banner->path) }}" />
    @else
    <meta property="og:image" content="{{asset('img/shopbanner-default.jpg')}}" />
    @endif
    <meta property="article:author" content="{{URL::route('store.shops',$shop->getSlug())}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop


@section('address-edit')
@overwrite

@section('content')
<script>
    var shopcattreejson = "{{URL::route('categorytreebyid', array('shopID' => $shop->id))}}";
    var getProductsByCategories = "{{URL::route('getproductsbycategories')}}";
    console.log(shopcattreejson);
    console.log(getProductsByCategories);

</script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="smartbread">
        <li class="ch-category-toggle focused"><a href="#">All Categories</a></li>

        <li class="dropdown ch-category-selectors ch-category-cat ch-hide">
            <a class="dropdown-toggle" type="button" data-toggle="dropdown" href="#">Select Category...</a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                
            </ul>
        </li>
        <li class="dropdown ch-category-selectors ch-category-subcat ch-hide">
            <a class="dropdown-toggle" type="button" data-toggle="dropdown" href="#">Select Sub-Category...</a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                
            </ul>
        </li>
        <li class="dropdown ch-category-selectors ch-category-subsubcat ch-hide">
            <a class="dropdown-toggle" type="button" data-toggle="dropdown" href="#">Select Sub-Category...</a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                
            </ul>
        </li>

        <li class="ch-category-search ch-hide"><a href="#" class="loadProductsByCategory">Go!  <i class="productloading hidden fa fa-spinner fa-spin"></i> </a></li>
    </ul>
    <input type="hidden" name="shopid" id="shopidField" value="{{$shop->id}}">
    <input type="hidden" name="categoryid" id="categoryidField" value="">
    <input type="hidden" name="subcategoryid" id="subCategoryidField">
    <input type="hidden" name="subsubcategoryid" id="subSubCategoryidField">
 <ul class="cd-gallery">
     {{--show products according to the category of the present shop--}}
     @if($shop->products)
         @foreach($products as $product)
             @if($product->status == 'Published' && isEshopVerifiedToAppearInPublic($shop))
             <li class="product product-{{$product->id}}">
                 <a class="flexslider product-list-thumb-flexslider" href="{{GhooriURI::producturl($shop->subDomain, URL::route('products.view',array($shop->getSlug(),$product->id)), $product->id)  }}" style="">
                     <ul class="slides">
                         @foreach($product->images as $key=>$image)
                             <li><img src="{{asset('/public_img/shop_'.$shop->id.'/products/thumb/'.$image->imageLink)}}" alt="Preview image"></li>
                         @endforeach
                     </ul>
                 </a>
                 <div class="row cd-item-info">
                                <b class="col-xs-7">{{ link_to_route('products.view',$product->name,array($shop->getSlug(),$product->id))}}</b>
                                @if(!empty($product->getDiscountRate()))
                                    <strong class="col-xs-5 cd-price"><del class="small text-warning"><span class="pricewithcomma">{{$product->price}}</span> BDT</del><br><span class="pricewithcomma">{{ number_format($product->price - ( $product->price * rtrim($product->getDiscountRate(),'%') / 100 ), 2) }}</span> <small>BDT</small></strong>
                                @else
                                    <strong class="col-xs-5 cd-price"><span class="pricewithcomma">{{$product->price}}</span> <small>BDT</small></strong>
                                @endif
                                
                            </div>
                 @if ( $product->getActiveCampaign() && $product->getDiscountRate() )
                     <div class="discount-tag discount-tag-lg">{{$product->getDiscountRate()}} off</div>
                 @endif
                 <div class="buy-now-row">
                    <a href="{{GhooriURI::producturl($shop->subDomain, URL::route('products.view',array($shop->getSlug(),$product->id)), $product->id)  }}" class="btn btn-info btn-lg btn-buy">
                        <i class="fa fa-shopping-cart"></i> Buy
                    </a>
                 </div>

             </li>
             @endif
         @endforeach
     @endif
 </ul>
    {{ $products->links() }}
</div>
@stop

