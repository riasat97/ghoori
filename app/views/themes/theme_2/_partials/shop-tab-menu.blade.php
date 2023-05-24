<div class="container">
    <div class="row shop-tabs">
        <!-- <div class="col-md-3"></div> -->
        <div class="col-md-12">
            <ul class="list-inline shop-nav">
                <li id="products-tab" class="current">
                    <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}">Products</a>
                </li>
                @if($shop->preorder_status)
                    <li id="preorder-tab" class="">
                        <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/preorder">Pre-book</a>
                    </li>
                @endif
                <li id="about-tab" class="">
                    <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/about-shop">About</a>
                </li>
                <li id="privacy-tab" class="">
                    <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/privacy-policy">Privacy Policy</a>
                </li>
                <li id="term-tab" class="">
                    <a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}/terms-and-conditions">Terms &amp; Conditions</a>
                </li>
            </ul>
        </div>
    </div>
</div>