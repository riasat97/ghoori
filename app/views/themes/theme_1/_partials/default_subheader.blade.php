
{{--Template Default Sub-Header Top Section--}}

<div class="row">
    <div class="col-md-3">
        <!-- <img class="eshop-life-logo" src="https://eshop.ghoori.com.bd/public_img/shop_235/logos/1447079660.jpg" alt="Logo"> -->
        {{--<div class="shop-top-section">--}}
            {{--<p class="brand-name"><a href="eshop-life.html">eShop Life</a></p>--}}
            {{--<p><span>Smarter shopping, better living</span></p>--}}
        {{--</div>--}}
        <div class="shop-top-section">
            {{--<p class="brand-name"><a href="eshop-life.html">eShop Life</a></p>--}}
            {{--<p><span>Smarter shopping, better living</span></p>--}}
            <div class="shop-logo">
                <a href="{{GhooriURI::shopurl($shop->slug, URL::route('store.shops',$shop->slug))}}">
                <div class="shop-logo-image pull-left">
                    <img class="img-thumbnail" src="{{asset('public_img/shop_'.$shop->id.'/logos/'.$shop->logo->logo
                    ) }}" alt="Shop Logo"/>
                </div>
                {{--<span><a href="">eShop Life</a></span>--}}
                <div class="shop-logo-title pull-left">
                    <p class="brand-name ellipsis">
                        
                            {{$shop->title}}
                        
                    </p>
                    {{--<p><span>Smarter shopping, better living</span></p>--}}
                </div>
                <div class="clearfix"></div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 search-box">        
       {{ Form::open(['route'=>['search.category',$shop->slug],'method' => 'GET']) }}
            <div class="custom-search-input center-search">
                <div class="input-group">
                    {{ Form::select('categoryId',[''=>'Category']+$categories['categories'],null,
                        ['class'=>'selectbox selectpicker form-control']) }}
                    {{ Form::text('name',null,
                        ['class'=>'inputbox form-control','placeholder'=>"I'm shopping for...",'aria-label'=>"..."]) }}
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search</button>
                    </span>
                </div>
            </div>
        {{Form::close()}}
    </div>

    <div class="col-md-3">

    </div>
</div>