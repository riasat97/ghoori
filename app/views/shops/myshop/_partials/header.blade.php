@section('header')

<div class="row">
    <div class="col-lg-12">
        <div class="logo-holder">
            <div class="shop-banner-container">
                
            </div>
            
            <a id="add-new-banner" href="#animatedModalBanner" class="edit-button add-new-banner">
                <i class="fa fa-camera fa-lg"></i> <span class="link-caption">Change banner</span>
            </a>
            <div class="shop-logo" >
                @if(!empty($shop->logo->logo)){{ HTML::image('public_img/shop_'.$shop->id.'/logos/'.$shop->logo->logo,'alt=Image',array('class'=>'img-responsive','width'=>152,'height'=>152)) }}
                @else
                <img src="{{ asset('img/shoplogo-default.jpg') }}" class="img-responsive" alt="Image">
                @endif
                    <a id="add-new-logo" href="#animatedModalLogo" class="add-new-logo">
                        <i class="fa fa-camera"></i> <span class="link-caption">Change logo</span>
                    </a>
            </div>
            <div class="shop-title-bar">
                <div class="shop-name-wrap">
                    <h1 class="shop-name">
                       <span class="shop-name-span"><a href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}">{{ $shop->title }} </a></span>
                    </h1>
                    <div class="shop-tagline">
                        
                        <a href="#" id="tagline">{{{$shop->tagline}}}</a>
                        <!-- <a id="edittagline" href="#" data-toggle="tooltip" data-placement="right" title="Click on text to edit"><i class="fa fa-fw fa-pencil"></i></a> -->
                        <a id="edittagline" href="#" class="edit-button">
                            <i class="fa fa-fw fa-pencil"></i> <span class="link-caption">Edit tagline</span>
                        </a>
                        
                    </div>
                </div>
                <div class="shop-button-wrap shop-icons">
                    <div class="share-buttons pull-left">
                        <a class="btn btn-sm btn-facebook" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?app_id={{Config::get('facebook.appId')}}&sdk=joey&u={{urlencode(GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug())))}}&display=popup&ref=plugin&src=share_button', 'newwindow', 'width=600, height=400'); return false;">
                            <i class="fa fa-facebook"></i></a>
                        <a class="btn btn-sm btn-twitter" href="#" onclick="window.open('https://twitter.com/share?url={{urlencode(GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug())))}}', 'newwindow', 'width=600, height=400'); return false;">
                            <i class="fa fa-twitter"></i></a>
                    </div>
                    <div class="pull-right shop-action-buttons">

                        {{--<a role="button" class="theme-button btn btn-sm btn-warning" href="">Theme</a>--}}
                        {{--<span class="dropdown">--}}
                            {{--<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">--}}
                                {{--Theme--}}
                                {{--<span class="caret"></span>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">--}}
                                {{--<li><a id="add_theme_banner" href="#animatedModalThemeBanner" class="add_theme_banner">--}}
                                        {{--<i class="fa fa-camera"></i> <span class="link-caption">Banner</span>--}}
                                    {{--</a></li>--}}

                            {{--</ul>--}}
                        {{--</span>--}}

                        <a class="shop-status btn btn-sm btn-{{ $statusRev[$shop->status] == 'Publish'? 'success' : 'danger' }} @if(!isEshopVerifiedToShowShopStatusBtn($shop)) hidden @endif"  data-id="{{ $shop->id }}" href="#">{{ $statusRev[$shop->status]}}</a>
                        
                        @if ( !isFShopInstalled($shop->id) && isEshopVerifiedToAppearInPublic($shop) )
                            <a data-id="{{ $shop->id }}"
                            @if( !doCurrentUserHasFB() )
                                data-toggle="modal" data-target="#fbloginrequired"
                            @elseif( doCurrentUserHasFB() && in_array($shop->package->id, [1,2]) )
                                data-toggle="modal" data-target="#fbshopmodal"
                            @else
                                <?php $fbLoginBeforeFollowLink = 'fbLoginBeforeFollowLink'?>
                            @endif
                            class="{{$fbLoginBeforeFollowLink or ''}} fbshop btn btn-sm btn-facebook"
                            href="@if( !in_array($shop->package->id, [1,2])) {{route('fbShop.index',[$shop->slug])}} @else # @endif "><i class="fa fa-facebook"></i> FB Shop</a>
                        @endif
                        <a class="btn btn-sm btn-success" id="add-new-product" href="#animatedModalProduct">Add product</a>

                        <a class="btn btn-sm btn-primary" id="add-delivery" href="{{ route('settings.edit',array($shop->getSlug())) }}#shipping">Add Delivery System</a>
                        {{-- @if( !$shop->campaigns->count() )
                        <a class="btn btn-sm btn-warning" id="add-campaign-all-products" href="{{ route('gp.campaign.all.product',array($shop->getSlug())) }}">Activate GP Discount</a>
                        @else
                        <a class="btn btn-sm btn-success" disabled="disabled" id="" href="{{ route('gp.campaign.all.product',array($shop->getSlug())) }}">GP Discount Active</a>
                        @endif --}}
                        

                       {{-- <a class="btn btn-sm btn-primary" id="add-delivery" href="{{ route('settings.edit',array($shop->getSlug())) }}#shipping">Add Delivery System</a>
                        <a class="btn btn-sm btn-warning" id="add-campaign-all-products" href="{{ route('gp.campaign.all.product',array($shop->getSlug())) }}">Activated GP Discount</a>--}}

                        
                        
                    </div>    
                </div>
            </div>
        </div>
        @include('shops.myshop._partials.address')
    </div>
    <div class="clearfix"></div>

</div>


<div class="row shop-tabs">
    <!-- <div class="col-md-3"></div> -->
    <div class="col-md-offset-2 col-md-10">
        <ul class="list-inline shop-nav">
            <li id="products-tab" class="current">{{ link_to_route('shops.show','Products',array($shop->getSlug())) }}</li>
            @if($shop->preorder_status)
                <li id="preorder-tab" >{{ link_to_route('shops.preorder','Pre-books',array($shop->getSlug())) }}</li>
            @endif
            <li id="about-tab">{{ link_to_route('about.show','About',array($shop->getSlug())) }}</li>
            <li id="privacy-tab">{{ link_to_route('privacy.show','Privacy Policy',array($shop->getSlug())) }}</li>
            <li id="term-tab">{{ link_to_route('term.show','Terms &amp; Conditions',array($shop->getSlug())) }}</li>
            @if($shop->preorder_status)
                <li id="order-dropdown" class="dropdown">
                  <a class="dropdown-toggle" id="orderDropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#" role="button">
                    Orders {{(!empty($ordersCount)?'<span class="label label-as-badge label-danger">'.$ordersCount.'</span>':'')}}
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="orderDropdownMenu1">
                    <li  id="order-tab">{{ HTML::decode( link_to_route('orders.all','<i class="fa fa-cart-arrow-down"></i> All Orders ',array($shop->getSlug())) ) }}

                    </li>
                    {{-- <li role="separator" class="divider"></li> --}}
                    <li  id="preorderlist-tab">{{ HTML::decode( link_to_route('shops.preorderlist','<i class="fa fa-cart-arrow-down"></i> All Pre-book Orders',array($shop->getSlug())) ) }}

                    </li>
                  </ul>
                </li>
            @else
                <li  id="order-tab">{{ HTML::decode( link_to_route('orders.all','<i class="fa fa-cart-arrow-down"></i> All Orders ',array($shop->getSlug())) ) }}

                </li>
            @endif

            
            <li id="revenue-tab">{{ HTML::decode( link_to_route('revenue.index','<i class="fa fa-money"></i> Revenues',array($shop->getSlug())) ) }}</li>

            <li id="settings-tab"> {{ HTML::decode(link_to_route('settings.edit','<i class="fa fa-cog"></i> Settings',array($shop->getSlug()))) }}</li>           

        </ul>

        <!-- <ul class="list-inline share-nav pull-right">  
            <li>
                <a class="btn btn-facebook btn-xs" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?app_id={{Config::get('facebook.appId')}}&sdk=joey&u={{urlencode(GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug())))}}&display=popup&ref=plugin&src=share_button', 'newwindow', 'width=600, height=400'); return false;">
                    <i class="fa fa-facebook"></i> Share
                </a>
                <a class="btn btn-xs btn-twitter" href="#" onclick="window.open('https://twitter.com/share?url={{urlencode(GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug())))}}', 'newwindow', 'width=600, height=400'); return false;">
                    <i class="fa fa-twitter"></i> Tweet
                </a>
            </li>
        </ul> -->
    </div>
</div>



<div class="modal fade" id="fbloginrequired" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Facebook Connect Required</h4>
      </div>
      <div class="modal-body">
        
        <p class="text-center">
        This feature will require you to connect your Ghoori account with your facebook account. Please proceed to your user settings page and click the <mark><i class="fa fa-facebook"></i> Connect</mark> button there.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <a type="button" href="{{route('user.settings')}}" class="btn btn-success">User Settings</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="fbshopmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Facebook Shop</h4>
      </div>
      <div class="modal-body">
        
        <p class="text-center">
        This feature will require you to pay
        <br>
        <span class="pricing-num-big">99</span>+VAT
        <br>
        BDT/month</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <a type="button" href="{{route('fbShop.index',[$shop->slug])}}" class="btn btn-success">Enable</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="own-channel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Own delivery system</h4>
            </div>
            <div class="modal-body">

                <p class="text-center">
                    This feature will require you to pay
                    <br>
                    <span class="pricing-num-big">99</span>+VAT
                    <br>
                    BDT/month</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-id='0' class="btn btn-danger own-channel" data-dismiss="modal">Cancel</button>
                <button type="button" data-id="1"  class="btn btn-success own-channel" data-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>

<!-- call request modal  -->
<div class="modal fade bs-example-modal-lg" id="rfcModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Request for a call from Team Ghoori</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="preferredTime" class="control-label">Preferred Time:</label>
                        <select class="form-control" id="preferredTime" name="preferredTime">
                            <option value="10 to 11 am">10 to 11 am</option>
                            <option value="11 to 12 am">11 to 12 am</option>
                            <option value="12 to 01 pm">12 to 01 pm</option>
                            <option value="01 to 02 pm">01 to 02 pm</option>
                            <option value="02 to 03 pm">02 to 03 pm</option>
                            <option value="03 to 04 pm">03 to 04 pm</option>
                            <option value="04 to 05 pm">04 to 05 pm</option>
                            <option value="05 to 06 pm">05 to 06 pm</option>
                            <option value="06 to 07 pm">06 to 07 pm</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mobileNo" class="control-label">Mobile No:</label>
                        <input type="text" class="form-control" id="mobileNo" name="mobileNo" value="{{$shop->mobile}}">
                    </div>

                    <div class="form-group">
                        <label for="question" class="control-label">Questions:</label>
                        <select class="form-control" id="question" name="question">
                            <option value="I missed the call from Ghoori Customer care">I missed the call from Ghoori Customer care</option>
                            <option value="I want to know about my order status ">I want to know about my order status </option>
                            <option value="I want to know about the  payment delivery date">I want to know about the  payment delivery date</option>
                            <option value="I want to know whether my product is delivered or not">I want to know whether my product is delivered or not</option>
                            <option value="I want to talk with  customer care to know about Ghoori shop opening process">I want to talk with  customer care to know about Ghoori shop opening process</option>
                            <option value="I want to talk with customer care to know about how to give ad on Ghoori">I want to talk with customer care to know about how to give ad on Ghoori</option>
                            <option value="I am facing problem to open Ghoori eShop ">I am facing problem to open Ghoori eShop </option>
                            <option value="I am facing problem to add product">I am facing problem to add product</option>
                            <option value="I like to talk with Ghoori customer care">I like to talk with Ghoori customer care</option>
                            <option value="others" class="write-something">Others</option>
                        </select>
                    </div>



                    <div class="form-group" style="display:none;" id="reason-box">
                        <label for="reason" class="control-label">Reason:</label>
                        <textarea class="form-control" id="reason" name="reason"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="requestForCall">Submit</button>
            </div>

            <input type="hidden" name="put-custom-reason" class="put-custom-reason" value="false" />
        </div>
    </div>
</div>
@include('shops.myshop._partials.logo')
@include('shops.myshop._partials.banner')
<div class="row">
    <div class="col-xs-12">
        @include('shops.myshop._partials.verificationRules')
        @include('shops.myshop._partials.productLimitAlert')
    </div>
</div>
@show