
{{--Products under Specific Category--}}

<div class="col-md-9 main-product-container">
    <div class="categorized-product">
        <h4 class="categorized-product-heading">{{ !empty($category)?$category:'' }} {{ (!empty($subCategory))?'> '.$subCategory:''}}</h4>
        <div class="mt20 no-left-rightr-margin row">
            <div class="grid">
                @if($products->count())
                @foreach($products as $key=>$product)
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 grid-item">
                    <div class="product-box">
                        <a href="{{GhooriURI::producturl($product->shop->subDomain,
                         URL::route('products.view',array($product->shop->subDomain,$product->id)), $product->id)  }}">
                            <div class="image-box">
                                <img class="img-responsive" src="{{asset('/public_img/shop_'.$product->shop_id.'/products/thumb/'.$product->image)}}" alt="">
                            </div>                           
                            <div class="product-info">
                                
                                
                                        <div class="product-title ellipsis">{{$product->name}}</div>
                                
                                        <div class="product-price text-success">{{$product->price}} BDT</div>
                                    
                            </div>
                        </a>

                        <div class="product-cart-button">
                            <a href="{{GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',array($product->shop->subDomain,$product->id)), $product->id)  }}" class="button">View</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <p>Sorry!!! Search result not found </p>
                @endif
            </div>
        </div>
        <div style="padding-left:15px" class=""> {{ $products->links() }} </div>
    </div>
    
</div>