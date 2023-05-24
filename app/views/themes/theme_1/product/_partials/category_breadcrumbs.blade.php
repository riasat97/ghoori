
{{--Category Breadcrumbs--}}

<div class="row">
    <div class="col-md-12">
        <div class="single-product-flow">
            <ol class="breadcrumb">
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
            </ol>
        </div>
    </div>
</div>