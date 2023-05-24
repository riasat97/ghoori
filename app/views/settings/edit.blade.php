@extends('shops.myshop._layouts.main')
@section('title')
    Settings
@stop
@section('settings-css')
{{ HTML::style('css/bootstrap.vertical-tabs.min.css') }}
<!-- {{ HTML::style('css/settings.css') }} -->
{{ HTML::style('css/jquery.multiselect.css') }}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">
@stop
@section('content')

    <div id="cuponMessage">

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="col-xs-3"> <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
                <li class="active"><a href="#social" data-toggle="tab">Social</a></li>
                <li><a href="#shipping" data-toggle="tab">Delivery</a></li>
                <li><a href="#payment" data-toggle="tab">Payment method</a></li>
                <li><a href="#verify" data-toggle="tab">Verification</a></li>
                <li><a href="#bank" data-toggle="tab">Bank Information</a></li>
                <li><a href="#boost" data-toggle="tab">Product Boost</a></li>
                <li><a href="#cupon" data-toggle="tab">Coupon</a></li>
                @if( isFShopInstalled($shop->id) )
                <li><a href="#fbshop" data-toggle="tab">Facebook Shop</a></li>
                @endif
                <li>{{ link_to_route('package.index','Upgrade Your Package',array($shop->getSlug())) }}</li>
                @if($shop->theme)<li><a href="#theme" data-toggle="tab">Theme</a></li>@endif
            </ul>
        </div>
        <div class="col-xs-9">
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="social">
                    @include('settings._partials.socialNetwork')
                    @include('settings._partials.socialNetworkEdit')
                </div>
                <div class="tab-pane" id="shipping">
                   {{-- @include('settings._partials.shippingChannel')
                    @include('settings._partials.shippingChannelEdit')--}}
                    @include('settings._partials.ownShippingChannel',['ownChannel'=>$shop->ownChannel])
                </div>
                <div class="tab-pane" id="payment">
                    @include('settings._partials.paymentMethod')
                    @include('settings._partials.paymentMethodEdit')
                </div>
                <div class="tab-pane" id="verify">
                    <div class="settings-show">
                        @include('verificationCode.mobileCode')
                    </div>
                </div>
                <div class="tab-pane" id="bank">
                    <div class="settings-show">
                        @include('settings._partials.bankInformation')
                    </div>
                </div>
                <div class="tab-pane" id="boost">
                    <div class="settings-show">
                        @include('settings._partials.boost')
                    </div>

                </div>
                <div class="tab-pane" id="cupon">
                    <div class="settings-show">
                        @include('settings._partials.cuponSettings')
                    </div>
                </div>
                @if( isFShopInstalled($shop->id) )
                <div class="tab-pane" id="fbshop">
                    <div class="settings-show">
                        <h3>Facebook Shop</h3>
                        <p class="description">Choose your desire Tab name. You can change it anytime. Catchy tab name can bring more sales. So choose carefully.</p>
                        <a class="btn btn-info" href="{{URL::route('fbShop.edit',[$shop->slug])}}">Edit Tab Name</a>  
                        <a class="btn btn-primary" target="_blank" href="{{$fbShopUrl}}">Go to your Facebook Shop</a>
                        
                    </div>
                </div>
                @endif
                @if($shop->theme)
                <div class="tab-pane" id="theme">
                    <div class="settings-show">
                        {{--@include('settings._partials.boost')--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="theme-content">
                                    <h3>Upload Your Theme Banner Images</h3>
                                    <hr/>
                                    <a class="btn btn-info" role="button" href="{{URL::route('theme.uploadBanner', array('slug' => $shop->slug, 'theme' => $shop->theme->name))}}">Upload Banner</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>            
    </div>
@stop
@section('settings-js')
{{ HTML::script('js/settings/jquery.multiselect.js') }}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
<script>

    $(document).ready(function(){
       /* $("select").multiselect({
            header: "Choose an Shipping Method!"
        });*/
        // Javascript to enable link to tab
        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
        }

        // Change hash for page-reload
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        })
    });
    $(".add-shop-social").animatedModal({
        modalTarget:'animatedModalSocial',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOut'
    });
    $(".add-shop-shipping").animatedModal({
        modalTarget:'animatedModalShipping',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOut'
    });
    $(".add-shop-payment").animatedModal({
        modalTarget:'animatedModalPayment',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOut'
    });
    $(document).on('click','.own-channel',function(e){

        var ownChannel= $(this).data('id');

        var ownChannelBox=$('.own-channel-box');

        if(ownChannel == 0 ){
            ownChannelBox.prop( 'checked',false );
            $(ownChannelBox).attr('data-target','#own-channel');

        }
        else if(ownChannel == 1 ){
            ownChannelBox.prop( 'checked',true );
        }

    });
    $(document).on('click', '.own-channel-box', function(e) {
        var checked = $(this).is(':checked');

        if(checked) {

            $(this).removeAttr('data-target');
        }
        else{

            $(this).attr('data-target','#own-channel');
        }


    });
    
    $(document).on('click','.cuponCheckbox',function(e){

        var shopId = $(this).closest('tr').data('shopid');
        var campaignId = $(this).closest('tr').data('campaignid');
        var name = $(this).closest('tr').data('name');
        var active = 0;
        var confirmationMessage = '';
        var token = $('#mytoken').attr('value');
        var cuponMessage = '' ;
        if($(this).is(':checked')){
            active = 1;
            confirmationMessage = 'Do you really want to activate '+name+' campaign ?';
            cuponMessage = '<div class="alert alert-success fade in" style="margin-top:18px;">'
                            +'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>'
                            +' You activated '+name+' campaign.</div>' ;
        }else{
            active = 0;
            confirmationMessage = 'Do you really want to deactivate '+name+' campaign ?';
            cuponMessage = '<div class="alert alert-danger fade in" style="margin-top:18px;">'
                            +'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>'
                            +' You deactivated '+name+' campaign.</div>' ;
        }
        var data = {
            _token : token ,
            shopId:shopId,
            campaignId:campaignId,
            active:active,
            name:name
        };
        if(window.confirm(confirmationMessage)){
            $.ajax({
                headers: { 'csrftoken' : token },
                type : 'POST',
                url : '{{ URL::route('settings.updateCuponSettings') }}',
                data : data,
                success:function(message){
                    console.log(message);
                    $('#cuponMessage').append(cuponMessage);
                }
            });
        }
    });
    $(document).ready(function(){
        var checked = $('.own-channel-box').is(':checked');

        if(checked) {
            $('.own-channel-box').removeAttr('data-target');
        }
    });

$(function(){
    $('.boost-pay').on('click', function(){
        $('#inputBoostId').val( $(this).data('boostid') );
        // console.log();
    });
});


</script>

@stop