
<div class="verify-message">
<div class="alert alert-warning alert-dismissible shop-chorkiVerification-alert @if(!isChorkiVerifiedMessage($shop))hidden @endif" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="chorki-verified">
        <p class="shop-chorkiVerification-unpublish-alert">
            <strong>Your shop is under review.</strong> It will be published within 48 hours.
        </p>
    </div>
</div>
</div>


<div class="alert alert-warning alert-dismissible shop-unpublish-alert @if(isPublished($shop)|| $shop->firstTimePublished == 0)hidden @endif" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="">
        <p class="shop-unpublish-alert"><strong>Shop is not published. Click Publish Button!</strong> Your shop will not be visible to your customers if you do not publish your shop.</p>
    </div>
</div>

@if( !($shop->isVerified == 1 &&$shop->emailVerified == 1&& $shop->logo && $shop->banner && $shop->products->count() ) )
<div class="row guide-bar">

    <div class="col-xs-12">
        <div class="bluebar"></div>
    </div>
    <div class="col-xs-12">
        <div class="text-center guide-item guide-item-1-5">
            <a href="{{route('settings.edit', array($shop->getSlug()) )}}#verify" class="guidetoaction guidetoverify guidetoverifymobile" data-toggle="tooltip" data-placement="top" title="Verify your phone number">
                <div class="guide-circle @if($shop->isVerified == 1 ) guide-circle-done @endif"></div>
                <p>Mobile Verification</p>
            </a>
        </div>
        <div class="text-center guide-item guide-item-1-5">
            <a href="{{route('settings.edit', array($shop->getSlug()) )}}#verify" class="guidetoaction guidetoverify guidetoverifyemail" data-toggle="tooltip" data-placement="top" title="Verify your email address">
                <div class="guide-circle @if($shop->emailVerified == 1) guide-circle-done @endif"></div>
                <p>Email Verification</p>
            </a>
        </div>
        <div class="text-center guide-item guide-item-1-5">
            <a href="#" class="guidetoaction guidetologo"  data-toggle="tooltip" data-placement="top" title="Upload your eShop logo">
                <div class="guide-circle @if($shop->logo) guide-circle-done @endif"></div>
                <p>Upload Logo</p>
            </a>
        </div>
        <div class="text-center guide-item guide-item-1-5">
            <a href="#" class="guidetoaction guidetobanner"  data-toggle="tooltip" data-placement="top" title="Upload a banner for your eShop">
                <div class="guide-circle @if($shop->banner) guide-circle-done @endif"></div>
                <p>Upload Banner</p>
            </a>
        </div>
        <div class="text-center guide-item guide-item-1-5">
            <a href="#" class="guidetoaction guidetoaddproduct" data-toggle="tooltip" data-placement="top" title="Add some products">
                <div class="guide-circle @if($shop->products->count()) guide-circle-done @endif"></div>
                <p>Add Product</p>
            </a>
        </div>
    </div>

</div>
@endif

