<div class="my-shop-contact">

    <div class="center-row address-wrap">
        
        <div class="center h150">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">
                <i class="fa fa-envelope-o"></i> 
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-9 shop-email">
                <a href="mailto:@if($shop->email){{$shop->email}} @else info@ghoori.com.bd @endif">
                    @if($shop->email) {{$shop->email}}
                    @else info@ghoori.com.bd 
                    @endif
                </a>
                @if($shop->emailVerified != 1)
                    <a href="{{route('settings.edit', array($shop->getSlug()) )}}#verify" class="text-warning" data-toggle="tooltip" data-placement="right" title="Verify your email address"><i class="fa fa-warning"></i></a>
                @endif
            </div>

            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">
                <i class="fa fa-external-link"></i>
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-9 shop-website">
                <a href="@if($shop->website){{ $shop->website }} @else https://{{$shop->subDomain}}.ghoori.com.bd @endif" targe="_blank">@if($shop->website){{ $shop->website }} @else https://{{$shop->subDomain}}.ghoori.com.bd @endif</a>
            </div>

            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">
                <i class="fa fa-map-marker"></i>
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-9 shop-address">
             @if($shop->address){{{ $shop->address }}}@else TA, 131 Wakil Tower (L7), Gulshan Badda Link Road, Dhaka @endif
            </div>

            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">
                <i class="fa fa-mobile"></i>
            </div>
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-9 shop-contact">
              <a href="tel:@if($shop->mobile){{{ $shop->mobile }}} @else  +8801842246754 @endif">@if($shop->mobile){{{ $shop->mobile }}} @else  01842 642 754 @endif</a> @if($shop->isVerified != 1) <a href="{{route('settings.edit', array($shop->getSlug()) )}}#verify" class="text-warning" data-toggle="tooltip" data-placement="right" title="Verify your phone number"><i class="fa fa-warning"></i></a> @endif
            </div>
        </div>
        
    </div>
    @section('address-edit')
        <a id="edit-address" href="#animatedModal" class="address-edit edit-button">
            <span class="link-caption">Change contact</span> <i class="fa fa-pencil fa-lg"></i>
        </a>
    @show
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
    <button type="button" class="btn btn-danger btn-sm call-request-button" data-toggle="modal" data-target="#rfcModal"><i class="fa fa-phone"></i> Request for Call</button>
</div>

