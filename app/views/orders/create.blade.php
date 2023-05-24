@extends('public.shop._layouts.shop')

@section('title')
    Add Order
@stop
@section('sidebar')
@stop
@section('pricebox')
<div class="price-box">
        <table>
            <tr>
                <td>Sub-total</td>
                <td><span class="subtotal">{{number_format($cartTotal,2)}}</span> BDT</td>
            </tr>
            <tr class="">
                <td>Discounts</td>
                <td><span class="disc">- {{number_format($cartTotal - $discountedTotal,2)}}</span> BDT</td>
            </tr>
            <tr class="discount-total border-top">
                <td></td>
                <td><span class="subdisctotal">{{number_format($discountedTotal,2)}}</span> BDT</td>
            </tr>
            <tr id="coupon-total" data-total="{{$cartTotal}}" data-discounttotal="{{$discountedTotal}}">

            </tr>
            <tr>
                <td>Delivery Charge</td>
                <td><span class="delivery-charge">0.00</span> BDT</td>
            </tr>
            <tr>
                <td>Payment Method Charge</td>
                <td><span class="payment-charge-value">0.00</span> BDT</td>
            </tr>
            <tr>
                <td>Total</td>
                <td><span class="total-disc-inc pricewithcomma">{{number_format($discountedTotal, 2)}}</span> BDT</td>
            </tr>
           {{-- <tr class="discount-total">
                <td>With 10% discount</td>
                <td><span class="total-disc-inc">{{$discountedTotal}}</span> BDT</td>
            </tr>--}}
            

        </table>
    </div>
@stop
@section('content')

    <div class="">
        {{ Form::model($shippingAddress,array('route'=>'orders.store','class'=>'chorki-form','id'=>'formElem','name'=>'check-out','data-id'=>$shop_id)) }}
        {{ Form::token() }}
        <div class="row row-flex-stretch">

            <div class="col-xs-12 col-sm-3 checkout-current">
                <div class="checkout-formbox">

                    <div class="checkout-formbox-title text-center">

                        <div class="checkout-formbox-icon">
                            {{ HTML::image('img/delivery.png') }}
                        </div>
                        <h4>Shipping Address</h4>
                    </div>
                    <div>
                        <div class="form-group">
                            <label class="chorki-label control-label" for="fullname">Full name</label>
                            {{ Form::text('name',null,array('id'=>'checkout_fullname','class'=>'form-control','required')) }}
                        </div>
                        <div class="form-group">
                            <label class="chorki-label control-label" for="email">Email</label>
                            {{ Form::email('email',null,array('id'=>'checkout_email','class'=>'form-control','required placeholder'=>'Email address','autocomplete'=>'off')) }}
                        </div>
                        <div class="form-group">
                            <label class="chorki-label control-label" for="mobile">Mobile No. (eg: 01XXXXXXXXX)</label>
                            {{ Form::text('mobile',null,array('id'=>'checkout_mobile','class'=>'form-control','required autocomplete'=>'off')) }}
                        </div>
                        <div class="form-group">
                            <label class="chorki-label control-label" for="address">Shipping Address</label>

                            {{ Form::textarea('address',null,array('size' => '0x0','id'=>'checkout_address','class'=>'form-control','required','autocomplete'=>'off')) }}
                        </div>
                        <div class="form-group">
                            <label class="chorki-label control-label" for="mobile">Postcode</label>
                            {{ Form::number('postcode',null,array('id'=>'checkout_postcode','class'=>'form-control','autocomplete'=>'off', 'min'=> '1000', 'max' => '9999')) }}
                        </div>
                        <div class="form-group">
                            <label class="chorki-label control-label" for="address">Shipping Division</label>
                            <select required name="shippingLocation_id" class="shipping-location form-control" style="padding:0">
                                <option value="" selected disabled> Select</option>
                                @if($shippingLocations->count() )
                                    @foreach($shippingLocations as $key=>$shippingLocation)
                                <option value="{{ $shippingLocation->id }}">{{ $shippingLocation->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="checkout-formbox">
                    <div class="checkout-formbox-title text-center">

                        <div class="checkout-formbox-icon">
                            {{ HTML::image('img/shipping.png') }}
                        </div>
                        <h4>Delivery Method</h4>
                    </div>
                    <div>
                        <label class="radio shipping-group">
                            <input class="shipping-package-main shipping-package-3rd" name="shippingPackage_system" value="3rd" type="radio" checked="checked"> <h4>Supported Couriers</h4>
                        </label>
                        <div class="radio shipping-detail-box" id="courier-form">
                        Select shipping division first.
                        </div>
                        <div id="own-shipping-channel">
                       {{-- <label class="radio shipping-group">
                            <input class="shipping-package-main shipping-package-own" name="shippingPackage_system" value="own" type="radio"> <h4>Merchant's Own System</h4>
                        </label>
                        <div class="radio shipping-detail-box disabled" id="own-courier-form">
                            BDT 50/KG
                        </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="checkout-formbox">
                    <div class="checkout-formbox-title text-center">

                        <div class="checkout-formbox-icon">
                            {{ HTML::image('img/payment.png') }}
                        </div>
                        <h4>Payment Method</h4>
                    </div>
                    <div>
                        <div class="radio">
                            @if ($shop->paymentMethods) <?php $i = 0 ?>
                            @foreach($shop->paymentMethods as $paymentMethod)
                            <label for="payment-method-{{ $paymentMethod->id }}">
                                <input type="radio" name="paymentMethod_id" class="payment-method" data-charge="{{$paymentMethod->charge}}" id="payment-method-{{ $paymentMethod->id }}" value="{{ $paymentMethod->id }}" {{ ($i==0) ? "checked" : '' }}>
                                <?php ++$i  ?>
                                {{ $paymentMethod->label }}
                            </label>
                            <br>
                            @endforeach
                            @else
                            <label>
                                <input name="paymentMethod_id" class="payment-method" data-charge="0.00" id="payment-method" value="1" type="radio" checked>
                                Cash on Delivery
                            </label>
                            @endif
                        </div>
                        <div class="alert alert-info otp-alert" role="alert">
                        After placing order, you will receive an SMS in your Mobile Phone containing a verification code. Please put this verification code in the order verification page to verify and confirm your order. You can verify your order later from My order page as well.
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::hidden('shop_id',$shop_id,array('class'=>'shop-id')) }}
            {{ Form::hidden('subtotal',$cartTotal) }}
            {{ Form::hidden('totalOrderWeight',$totalOrderWeight,array('class'=>'total-order-weight'))  }}
            {{ Form::hidden('shippingWeight_id',null,array('class'=>'shippingWeightId '))  }}

            <input type="hidden" name="cuponId" id="cuponInput" value="">
            <div class="col-xs-12 col-sm-3">

                <div class="checkout-formbox">
                    <div class="checkout-formbox-title text-center">

                        <div class="checkout-formbox-icon">
                            <i class="fa fa-3x fa-check"></i>
                        </div>
                        <h4>Confirm Order</h4>
                    </div>

                    @if($cuponActive)
                        <div class="form-inline text-center">
                            <p class="description">Do you have any coupon code? Try It Now!!!</p>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" id="cuponText" name="cuponText" placeholder="Try Coupon">
                              <span class="input-group-btn">
                                <button type="button" id="cuponCheckButton" data-shopid="{{$shop->id}}" class="btn btn-success btn-sm" >Apply</button>
                              </span>
                            </div>
                            
                            
                        </div>
                        <p id="cuponMessage" class="text-center"></p>
                        <br>
                    @endif
                    <div class="text-center" style="margin-bottom: 35px">

                        
                            <button id="registerButton" class="btn btn-success" type="submit" disabled>Place Your Order</button>
                        
                    </div>
                    <div class="text-center" style="margin-bottom: 35px">
                        @yield('pricebox')
                    </div>
                    
                    
                </div>

            </div>

        </div>
        {{ Form::close() }}
    </div>
    
@stop

@section('cart-js')
    {{HTML::script('https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js')}}
    <script>
        $(document).ready(function(){
            // $("#ch_create_shop input[type=submit]").removeAttr('disabled');

            jQuery.validator.addMethod("regex", function(value, element, regexpr) {
                return regexpr.test(value);
            }, "Invalid pattern");

            $("#formElem").validate({
                rules : {
                    name     : {
                        minlength : 3
                    },
                    mobile   : {
                        regex : /^01[15-9]\d{8}$/
                        // regex : /^([+]?88)?01[15-9]\d{8}$/
                    },
                    address  : {
                    },
                    postcode : {
                        required: true,
                        digits: true,
                        maxlength: 4,
                        minlength: 4
                    }
                },

                messages : {
                    mobile : {
                        regex : "Please enter a Bangladeshi Mobile number (without country code)."
                    },
                    postcode : {
                        range: "Please enter a valid Bangladeshi postcode."
                    }
                },
                highlight: function(element) {
                    $(element).closest('input').parent().addClass('has-error');
                    $(element).closest('textarea').parent().addClass('has-error');
                    $(element).closest('email').parent().addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('input').parent().removeClass('has-error');
                    $(element).closest('textarea').parent().removeClass('has-error');
                    $(element).closest('email').parent().removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'text-danger',
                errorPlacement: function(error, element) {
                    if(element.parent('.form-group').length) {
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
    <script>
        var cuponCode = null;
    $(document).ready(function(){
        $(document).on('click', ".checkout-formbox input, .checkout-formbox textarea, .checkout-formbox select", function() {
            $('.checkout-formbox').parent().removeClass('checkout-current')
            $(this).parents('.checkout-formbox').parent().addClass('checkout-current')
            // console.log();
        })
        $('.checkout-formbox #checkout_fullname, .checkout-formbox #checkout_email, .checkout-formbox #checkout_mobile').on( "focusout", function(){
            if ( $(this).val().length < 1 ) {
                // alert('validate false');
                $(this).parent().addClass('has-error');
            }
            else {
                $(this).parent().removeClass('has-error');
            }

        });

        $('.checkout-formbox #checkout_address').on( "focusout", function(){
            // console.log($(this).val().length);
            if ( $(this).val().length < 3 ) {
                // alert('validate false');
                $(this).parent().addClass('has-error');
            }
            else {
                $(this).parent().removeClass('has-error');
            }
            
        });

        $('#registerButton').click(function(){
            // e.preventDefault();
            $('#registerButton').val(cuponCode);
            if ($('#formElem').valid()) {
                setTimeout(function(){
                    $('#registerButton').prop('disabled', true);
                    $('#registerButton').html('<i class="fa fa-spin fa-spinner"></i> Order Processing');

                }, 300);
            }
            
        });

    });
    
/*    function validateEmail($email) {
        if ($email.length > 0) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
        } else {
            return false;
        }
        
    }
    function validatePhoneNo($phone) {
        
        if ($phone.length > 0) {
            var phoneReg = /^([+]?88)?01[15-9]\d{8}$/;
            return phoneReg.test( $phone );
        } else {
            return false;
        }
    }*/
        function validateGPNo($phone) {
        
            if ($phone.length > 0) {
                var phoneReg = /^([+]?88)?017\d{8}$/;
                return phoneReg.test( $phone );
            } else {
                return false;
            }
        }

        $(document).on('change', '.shipping-location', function (e) {
            e.preventDefault();
            var shippingLocationId= $('.shipping-location').val();
            var totalOrderWeight= $('.total-order-weight').val();
            var shopId=$('.shop-id').val();
            if (shippingLocationId) {
                // console.log("value "+shippingLocationId);
                $.ajax({
                    url: "{{ URL::route('orders.getShippingPackages') }}",
                    data: {"shippingLocation_id" : shippingLocationId , "totalOrderWeight" : totalOrderWeight ,
                          "shop_id" : shopId},
                    type: "GET",

                    success: function (response) {
                        if (response.success){
                            addShippingPackages(response);
                            addOwnShippingCharge(response);
                        }
                        else {

                        }
                    },
                    error: function (xhr, textStatus, thrownError) {
                        alert('Something went to wrong.Please Try again later...');

                    }
                });//ajax
            };
                
        });

        function addShippingPackages(response) {
            // console.log(response);
            var currentShipID;
            var formhtml = '';
            if (response.data.length > 0 ) {
                response.data.forEach(function (element, index, array) {
                    if(currentShipID == null || currentShipID != element.shippingChannel_id){
                        currentShipID = element.shippingChannel_id;
                        // console.log("courier = "+element.name+", package = "+element.label);
                        formhtml += '<h4>'+element.name+'</h4>';

                     /*  console.log("currentShipID "+currentShipID);
                       console.log("element.shippingChannel_id "+element.shippingChannel_id);*/

                    }

                    formhtml += '<label class="radio"><input type="radio" class="shipping-package" name="shippingPackage_id" data-charge="'+element.unitCost+'" data-weight-id="'+element.shippingWeight_id+'" value="'+ element.id +'"> <span>'+element.label+'</span></label>';
                });
            }
            else formhtml = 'Not available to this area.';
                
            $("#courier-form").html(formhtml);

        }
        function addOwnShippingCharge(response){
            var ownShippingCharge= response.ownShippingCharge;
            var ownShippingChannelHtml='';
            // console.log(ownShippingCharge);
            if( ownShippingCharge!=false && ownShippingCharge >= 0 )
            {
                ownShippingChannelHtml += ' <label class="radio shipping-group">'
               +'<input class="shipping-package-main shipping-package-own" data-charge="'+ownShippingCharge +'" name="shippingPackage_system" value="own" type="radio"> '
                +'<h4>Merchant\'s Own System</h4> </label>'
                +'<div class="radio shipping-detail-box disabled" id="own-courier-form">BDT '+ ownShippingCharge +'/KG'
                +'</div>';
             
            }
            
            $("#own-shipping-channel").html(ownShippingChannelHtml);
            $('#registerButton').prop('disabled', true);

        }
        $(document).on('click', '.shipping-package', function (e) {

            $(".shippingWeightId").prop('disabled', false);
            var shippingWeightId = $(this).data('weight-id');
            var weightId=$('.shippingWeightId').val(shippingWeightId);
            var shippingCharge= $(this).data('charge');
            $('.delivery-charge').text(shippingCharge);
            updateTotal();
            if ( $('.payment-method:checked').length > 0 ) {
                $('#registerButton').prop('disabled', false);
                $('#cuponCheckButton').prop('disabled',false);
                $('#cuponText').prop('disabled',false);

            } else {
                $('#registerButton').prop('disabled', true);
                $('#cuponCheckButton').prop('disabled',true);
                $('#cuponText').prop('disabled',true);
            }
            // console.log($('.payment-method:checked').length);
        });
        $(document).on('click', '.shipping-package-own', function (e) {
            // console.log($("#courier-form").find('input'));
            $("#courier-form").find('input').prop('disabled',true);
            $("#courier-form").addClass("disabled");
            $("#own-courier-form").removeClass("disabled hidden");
            $(".shippingWeightId").prop('disabled', true);

            var ownShippingCharge= $(this).data('charge');
            $('.delivery-charge').text(ownShippingCharge);
            
            updateTotal();
            if ( $('.payment-method:checked').length > 0 ) {
                $('#registerButton').prop('disabled', false);
            } else {
                $('#registerButton').prop('disabled', true);
            }
        });
        $(document).on('click', '.shipping-package-3rd', function (e) {
            // console.log($("#courier-form").find('input'));
            $("#courier-form").find('input').prop('disabled',false);
            $("#courier-form").removeClass("disabled");
            $("#own-courier-form").addClass("disabled");
            // console.log($('.shipping-package:checked').data('charge'));
            var shippingCharge= $('.shipping-package:checked').data('charge');
            if( shippingCharge )
                $('.delivery-charge').text(shippingCharge);
            else $('.delivery-charge').text('0');
            updateTotal();
            
            if ( $('.payment-method:checked').length > 0 && $('.shipping-package:checked').length > 0 ) {
                $('#registerButton').prop('disabled', false);
            } else {
                $('#registerButton').prop('disabled', true);
            }
        });
        $(document).on('click', '.payment-method', function (e) {
            var paymentCharge= $(this).data('charge');
            $('.payment-charge-value').text(paymentCharge);
            updateTotal();
            if ( $('.shipping-package:checked').length > 0 || $('.shipping-package-own:checked').length > 0 ) {
                $('#registerButton').prop('disabled', false);
            } else {
                $('#registerButton').prop('disabled', true);
            }
            if ($(this).val() != '1') {
                $('.otp-alert').addClass('hidden');
            }
            else {
                $('.otp-alert').removeClass('hidden');
            }
        });


        function updateTotal(){


            var shippingCharge = removeCommas($('.delivery-charge').text());
            var subtotal= removeCommas($('.subtotal').text());
            var subdisctotal= removeCommas($('.subdisctotal').text());
            var couponDiscount = $('.coupon-amount').text();

            var paymentCharge= parseFloat($('.payment-charge-value').text());
            if(($('.shipping-location').val()!=1)&&($('input[name=shippingPackage_id]:checked').val())&&($('input[name=paymentMethod_id]:checked').val()==1)){//cod outside dhaka m
                var chargableAmount= parseFloat(shippingCharge) + parseFloat(subdisctotal) - couponDiscount;
                paymentCharge = Math.ceil(chargableAmount/1000)*10;

            }else{
                paymentCharge = 0;
            }

            var total= parseFloat(shippingCharge) + parseFloat(paymentCharge)+ parseFloat(subtotal);
            var disctotal= parseFloat(shippingCharge) + parseFloat(paymentCharge)+ parseFloat(subdisctotal) - couponDiscount;

            $('.payment-charge-value').text(paymentCharge);
            $('.total-inc').text(total);
            $('.total-disc-inc').text(disctotal);



            renderPriceWithCommas();
        }

        /*$(document).on('blur', '#checkout_mobile', function (e) {
            // alert( validateGPNo( $('#checkout_mobile').val() ) )
            if ( !validateGPNo( $('#checkout_mobile').val() ) ) {
                $('.discount-total').hide();
            }
            else {
                $('.discount-total').show();
            }
        } );

*/


        $(document).on('click','#cuponCheckButton',function(){
            var cuponCode = $('#cuponText').val();
            var shopId = $(this).data('shopid');
            var data = {
                cuponId:cuponCode,
                shopId:shopId
            };
            $.ajax({
                url: "{{ URL::route('orders.cuponValidity') }}",
                data: data,
                type: "GET",

                success: function (response) {
                    $('#coupon-total').empty();
                    // console.log(response);
                    var cartTotal = $('#coupon-total').data('total');
                    var discounttotal = $('#coupon-total').data('discounttotal');
                    // console.log([cartTotal, discounttotal]);
                    $('#cuponMessage').val('');
                    if('error' in response){
                        $('#cuponMessage').text(response['error']);
                        $('#cuponMessage').css('color','red');
                    }else{
                        $('#cuponMessage').text('You got '+response['success']+'% discount');
                        $('#cuponMessage').css('color','green');
                        $('#cuponCheckButton').html('<i class="fa fa-check"></i>');
                        
                        var cuponDiscountAmount = Math.round(discounttotal*response['success']/100);
                        var discountedTotal = discounttotal - cuponDiscountAmount;
                        // console.log(cartTotal+' '+discountedTotal+' '+cuponDiscountAmount);
                        $('#coupon-total').append('<td>With '+response["success"]+ '% discount</td>' +
                                '<td>-<span class="coupon-amount">'+cuponDiscountAmount+'</span> BDT</td>');
                        updateTotal();
                    }
                },
                error: function (xhr, textStatus, thrownError) {
                    alert('Something went to wrong.Please Try again later...');

                }
            });
        });

    </script>
@stop