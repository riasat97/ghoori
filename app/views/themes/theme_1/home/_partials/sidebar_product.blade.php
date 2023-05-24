
{{--Sidebar Product--}}
<aside class="sidebar_container">
    @if($latestProducts->count())
    <div class="row">
        <div class="col-md-12">
            <div class="main-section-sidebar">
                <h4>What's New</h4>
                <div class="slider-nav fr">
                    <div role="button" data-dir="prev" class="slide-icon fl">
                        <i class="fa fa-angle-left"></i>
                    </div>

                    <div role="button" data-dir="next" class="slide-icon fl">
                        <i class="fa fa-angle-right"></i>
                    </div>
                </div>

                <div class="sidebar-slider">
                    <ul>
                        @foreach($latestProducts as $key=>$product)
                        <li>
                            <a href="{{GhooriURI::producturl($product->shop->subDomain,
                            URL::route('products.view',array($product->shop->subDomain,$product->id)),
                            $product->id)  }}">
                                <img class="img-responsive" src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/thumb/'.$product->image ) }}">
                                <div class="sidebar-product-info">
                                    <p class="item-title">{{ $product->name }}</p>
                                    <p class="description">{{ str_limit($product->description,25) }}</p>
                                    <p class="text-success">{{ $product->price }} BDT</p>
                                    <!-- <button>View</button> -->
                                </div>

                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
@if($popularProducts->count())
    <div class="row">
        <div class="col-md-12">
            <div class="main-section-sidebar">
                <h4>Popular</h4>
                <div class="slider-nav-2 fr">
                    <div role="button" data-dir="prev" class="slide-icon fl">
                        <i class="fa fa-angle-left"></i>
                    </div>

                    <div role="button" data-dir="next" class="slide-icon fl">
                        <i class="fa fa-angle-right"></i>
                    </div>
                </div>

                <div class="sidebar-slider-2">
                    <ul>
                        @foreach($popularProducts as $key=>$product)

                        <li>
                            <a href="{{GhooriURI::producturl($product->shop->subDomain,
                            URL::route('products.view',array($product->shop->subDomain,$product->productId)),
                            $product->productId)  }}">
                                <img class="img-responsive" src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/thumb/'.$product->image ) }}">
                                <div class="sidebar-product-info">
                                    <p class="item-title">{{ $product->productName }}</p>
                                    <p class="description">{{ str_limit($product->description,25) }}</p>
                                    <p class="text-success">{{ $product->productPrice }} BDT</p>
                                    <!-- <button>View</button> -->
                                </div>

                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

</aside>
   
