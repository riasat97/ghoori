@section('content')
<?php $statusRev = array('Published' => 'Unpublish', 'Unpublished' => 'Publish'); ?>
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
        <li class="ch-category-search ch-hide"><a href="#" class="loadProductsByCategory" data-actor="myshop">Go! <i class="productloading hidden fa fa-spinner fa-spin"></i> </a></li>
    </ul>
    <input type="hidden" name="shopid" id="shopidField" value="{{$shop->id}}">
    <input type="hidden" name="categoryid" id="categoryidField" value="">
    <input type="hidden" name="subcategoryid" id="subCategoryidField">
    <input type="hidden" name="subsubcategoryid" id="subSubCategoryidField">
                <!-- <input type="hidden" name=""> -->
    <ul class="cd-gallery">
        {{--show products according to the category of the present shop--}}
                @if($products)
                    @foreach($products as $key=>$product)
                        <li class="product product-{{$product->id}} {{strtolower($product->status)}}">
                            <a class="flexslider product-list-thumb-flexslider" href="javascript:" style="">
                                <ul class="slides">
                                    @foreach($product->images as $key=>$image)
                                        <li><img src="{{asset('/public_img/shop_'.$shop->id.'/products/thumb/'.$image['imageLink'])}}" alt="Preview image"></li>
                                    @endforeach
                                </ul>
                            </a>
                            <div class="row cd-item-info">
                                <b class="col-xs-8">{{ link_to_route('shop.products',$product->name,array($shop->getSlug(),$product->id))}}</b>
                                @if(!empty($product->getDiscountRate()))
                                    <strong class="col-xs-4 cd-price"><del class="small text-warning"><span class="pricewithcomma">{{$product->price}}</span></del><br><span class="pricewithcomma">{{ number_format($product->price - ( $product->price * rtrim($product->getDiscountRate(),'%') / 100 ), 2) }}</span> <small>BDT</small></strong>
                                @else
                                    <strong class="col-xs-4 cd-price"><span class="pricewithcomma">{{$product->price}}</span> <small>BDT</small></strong>
                                @endif
                                
                            </div>

                            <div class="btn-group options" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>{{ link_to_route('shop.products.edit','Edit Product',array($shop->getSlug(),$product->id)) }}</li>
                                    <li><a class=" product-status product-status-change-{{$product->id}}"  href="#" data-id="{{$product->id}}">{{$statusRev[$product->status]}}</a></li>
                                    <li>{{ Form::open(array('route' => array('products.destroy', $product->id), 'method' => 'delete')) }}
                                        {{ Form::submit('Delete',array('class'=>'input-menu-item', "onclick"=>"return confirm('Are you sure you want to delete this product?')" ))}}
                                        {{ Form::close() }}
                                    </li>
                                    <li><a class="move-cat-menu-nav" data-productid="{{$product->id}}" href="#">Move Category</a></li>
                                    <li><a class="add-discount-menu" data-toggle="modal" data-target="#discountModal" data-productid="{{$product->id}}" data-productname="{{$product->name}}" data-campaign-id="{{$product->campaigns()->first()->id or -1}}" href="#">Discount</a></li>                                    
                                </ul>
                            </div>
                            <div class="product-status-badge"><span class="label label-danger label-as-badge"><i class="fa fa-exclamation-triangle fa-fw"></i> This product is unpublished</span></div>

                            @if ( $product->getActiveCampaign() && $product->getDiscountRate() )
                                <div class="discount-tag discount-tag-lg">{{$product->getDiscountRate()}} off</div>
                            @endif
                            {{-- <hr> --}}
                            <div class="product-boost">
                                <a class="btn btn-primary btn-sm boost-product-nav" data-submit-url="{{URL::route('store-sponsored-item',array($shop->getSlug(),$product->id))}}" data-product-image="{{asset('/public_img/shop_'.$shop->id.'/products/'.(!empty($product->images[0]) ? $product->images[0]['imageLink'] : '') )}}" data-productid="{{$product->id}}" data-productname="{{$product->name}}" data-toggle="modal" data-target="#boostProductModal" href="#"><i class="fa fa-fw fa-bullhorn"></i>&nbsp; Boost</a>
                            </div>

                        </li>
                    @endforeach
                @endif
    </ul>
    {{ $products->links() }}
</div>

<!--Boost Product Modal-->
@include('shops.myshop._partials.boost-product-modal')
<!-- Modal -->
@include('shops.myshop._partials.winter-campaign-modal')
{{-- @include('shops.myshop._partials.camp.poabaro-campaign-modal') --}}

@show
