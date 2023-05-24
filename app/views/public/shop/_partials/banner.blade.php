@section('banner')
<div class="container banner-container">
    <div class="row no-gutter">
        <div class="col-sm-4">
            <div class="profile-pic-wrap">
                <div class="profile-pic-circle" style="background-image:url('@if($shop->logo){{ $shop->logo->logo }}@endif')"></div>
                <h3 class="address">{{$shop->title}}</h3>
                <div class="address-container">
                    <dl class="">
                        <dt>Address <a href="javascript:" class="edit-address"><span class="glyphicon glyphicon-pencil"></span></a></dt>
                        <dd class="shop-address">{{str_limit($shop->address,7)}}</dd>
                        <dt>Phone</dt>
                        <dd class="shop-contact">{{$shop->mobile}}</dd>
                        <dt>Email</dt>
                        <dd class="shop-email">{{$shop->email}}</dd>
                    </dl>

                </div>

            </div>
        </div>
        <div class="col-sm-8 banner_parent hidden-xs">
            <div style="background-image:url('http://cdn.wallwuzz.com/uploads/photos-computer-background-rain-spring-backgrounds-desktop-wallpaper-wallpapers-array-wallwuzz-hd-wallpaper-1475.jpg')" class="banner"></div>

        </div>
    </div>
</div>
@stop