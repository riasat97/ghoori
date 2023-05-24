<div class="my-shop-contact">
    <div class="center address-wrap">
        <div class="address-table">

            <div class="address-table-row">
                <div class="address-table-cell address-table-icon">
                    <i class="fa fa-envelope-o"></i>
                </div>
                <div class="address-table-cell shop-website">
                    <a href="mailto:@if($shop->email){{$shop->email}} @else info@ghoori.com.bd @endif">
                        @if($shop->email) {{$shop->email}}
                        @else info@ghoori.com.bd
                        @endif
                    </a>
                </div>
            </div>

            <div class="address-table-row">
                <div class="address-table-cell address-table-icon">
                     <i class="fa fa-external-link"></i>
                </div>
                <div class="address-table-cell shop-website">
                    <a href="@if($shop->website){{ $shop->website }} @else https://{{$shop->subDomain}}.ghoori.com.bd @endif" targe="_blank">@if($shop->website){{ $shop->website }} @else https://{{$shop->subDomain}}.ghoori.com.bd @endif</a>
                </div>
            </div>
            <div class="address-table-row">
                <div class="address-table-cell address-table-icon">
                     <i class="fa fa-map-marker"></i>
                </div>
                <div class="address-table-cell shop-address">
                    <div class="">@if($shop->address){{ $shop->address }}@else TA, 131 Wakil Tower (L7), Gulshan Badda Link Road, Dhaka @endif</div>
                </div>
            </div>

            <div class="address-table-row">
                <div class="address-table-cell address-table-icon">
                    <i class="fa fa-mobile"></i>
                </div>
                <div class="address-table-cell shop-address">
                    <a href="tel:@if($shop->mobile){{{ $shop->mobile }}} @else  +8801842246754 @endif">@if($shop->mobile){{{ $shop->mobile }}} @else  01842 642 754 @endif</a> @if($shop->isVerified != 1) <a href="{{route('settings.edit', array($shop->getSlug()) )}}#verify" class="text-warning" data-toggle="tooltip" data-placement="right" title="Verify your phone number"><i class="fa fa-warning"></i></a> @endif
                </div>
            </div>


        </div>
    </div>
    <div class="shopSocialLinks">
        @if(!empty($shop->shopSocialNetwork->facebook))
        <a class="facebook" href="{{ fix_url_https($shop->shopSocialNetwork->facebook) }}" title="Facebook page" target="_blank"><i class="fa fa-facebook-square"></i></a>
        @endif
        
        @if(!empty($shop->shopSocialNetwork->twitter))
        <a class="twitter" href="{{ fix_url_https($shop->shopSocialNetwork->twitter) }}" title="Twitter" target="_blank"><i class="fa fa-twitter-square"></i></a>
        @endif
        
        @if(!empty($shop->shopSocialNetwork->youtube))
        <a class="youtube" href="{{ fix_url_https( $shop->shopSocialNetwork->youtube ) }}" title="Youtube Channel" target="_blank"><i class="fa fa-youtube-square"></i></a>
        @endif
            
    </div>
</div>