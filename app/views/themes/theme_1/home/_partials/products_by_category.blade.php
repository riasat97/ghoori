
{{--***********Category wise Products Section**************--}}

<div class="col-md-9 main-area">
    @foreach($products['products'] as $key=>$categoryProducts)
    <div class="category-1-product wow fadeInUp">
        <section class="" style="visibility: visible; animation-name: fadeInUp;">
            <div class="row">
                <div class="col-xs-12">

                    <h4>{{ $products['categories'][$key] }}</h4>
                    <div class="product-tab">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <?php $count=0; ?>
                            @foreach($products['subCategories'][$key] as $item=>$subCategory)
                                <li role="presentation" class="{{ ($count == 0)?'active':''}} ">
                                <a href="#{{preg_replace('/[[:space:]]+/', '-', $subCategory)}}" aria-controls="{{preg_replace('/[[:space:]]+/', '-', $subCategory)}}" role="tab" data-toggle="tab">{{$subCategory}}</a></li>
                             <?php $count++; ?>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php $count=0; ?>

                        @foreach($categoryProducts as $index=>$subCategoryProducts)
                                <div role="tabpanel" class="tab-pane {{ ($count == 0)?'in active':''}} " id="{{preg_replace('/[[:space:]]+/', '-',  $products['subCategories'][$key][$index]) }}">

                                <div class="owl-carousel owl-theme" style="opacity: 1; display: block;">

                                @foreach($subCategoryProducts as $id=>$product)

                                    <div class="item-inner">
                                        <a class="" href="{{GhooriURI::producturl($product->shop->subDomain,
                                         URL::route('products.view',array($product->shop->subDomain,$product->id)), $product->id) }}">

                                        <div class="img-wrap">
                                                <img class="lazyOwl" src="{{asset('/public_img/shop_'.$product->shop_id.'/products/thumb/'.$product->image)}}" style="display: block;">
                                            </div>
                                            <div class="item-title">{{$product->name}}</div>
                                            <div class="item-price text-success"> {{$product->price}} BDT</div>
                                        </a>
                                    </div>
                                    @endforeach

                                </div>

                                </div>
                                    <?php $count++; ?>

                                @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

        @endforeach

</div>