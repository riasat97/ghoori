<!-- ***********************Banner Slider Block Block****************************** -->
<div class="shop-banner-slider">
    <!-- #region Jssor Slider Begin -->
    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1920px; height: 740px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('../../public/themes/theme_2/Loading-gif-Images/Loading_15.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>

        <!-- Slider Real Banner -->
        <div data-u="slides" style="cursor: default; width: 1920px; height: 740px; overflow: hidden;">
            @if($shop->themeBanners->count())
                @foreach($shop->themeBanners as $key=>$banner)
                    <div data-p="225.00" style="display: none;">
                        <img class="img-responsive" data-u="image" src="{{  asset('public_img/shop_'.$shop->id.'/theme/banners/'.$banner->name)}}" />
                    </div>
                @endforeach
            @else
                <div data-p="225.00" style="display: none;">
                    <img class="img-responsive" data-u="image" src="{{  asset('public_img/shop_'.$shop->id.'/banners/'.$shop->banner->path)}}" />
                </div>
            @endif
        </div>


        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>

    <!-- #endregion Jssor Slider End -->
</div>





{{--Secondary Navigation Bar--}}
@include('themes.theme_2._partials.theme-second-nav')