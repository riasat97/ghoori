@extends('public.shop._layouts.index')
@section('title')
    Pricing | Ghoori
@stop
@section('staticpagestyles')
    {{HTML::style('css/pricing.css')}}
@stop
@section('staticpagescripts')
    <script type="text/javascript">
        $(function(){
            $('#contact-form').submit(function(e){
                e.preventDefault();
                $("#productsubmit").prop('disabled', true);
                if(checkForm(this)){
                    var form = $(this).serializeArray();
                    var token = $('#contact-form > input[name="_token"]').val();
                    $.ajax({
                        url: "{{route('store.contactUsAjax')}}",
                        type: 'post',
                        dataType: 'json',
                        data: { _token: token, form: form },
                        beforeSend: function(request) {
                            // return request.setRequestHeader("X-CSRF-Token", $("meta[name='token']").attr('content'));
                        },
                        success: function(ev) {
                            // console.log(ev);
                            if (ev.success){
                                $("#contact-form").get(0).reset();
                                $('#contact-form > input[name="_token"]').val(token);
                                $('.close-animatedModalContact').find('a.btn').click();
                                alert('Thanks for your opinion.');
                                $("#productsubmit").prop('disabled', false);
                            }
                        },
                        error: function(xhr, error, status) {
                            $("#productsubmit").prop('disabled', false);
                        }
                    });
                }

            });
        });
        function checkForm(form) {
            // if(this.name.value == "") {
            //   alert("Please enter your Name in the form");
            //   this.name.focus();
            //   return false;
            // }
            // if(this.email.value == "" || !this.valid_email.checked) {
            //   alert("Please enter a valid Email address");
            //   this.email.focus();
            //   return false;
            // }
            // if(this.age.value == "" || !this.valid_age.checked) {
            //   alert("Please enter an Age between 16 and 100");
            //   this.age.focus();
            //   return false;
            // }
            // console.log(form);
            return true;
        }
    </script>
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('pricing')}}">
    <meta property="og:title" content="Ghoori Pricing" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('pricing')}}" />
    <meta property="og:description" content="To visit Ghoori Platform you need to have internet connection in your Laptop/PC or Mobile/Tab." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/ghoori_cloud.jpg')}}" />

    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop

@section('static')
    <!-- ****************************Top highlighted section container************************* -->
    <div class="container-fluid pack-container-box clearfix">
        <div class="row">
            <div class="background-img"></div>
        </div>
        <div class="container packages-container">
            <div class="row">
                <div class="">
                    <!-- *******************Top highlighted section container******************* -->
                    <div class="container trial-box">
                        <div class="row">
                            <img class="img-responsive pricing-head-image" src="{{asset('img/ghoori-orange.png')}}" alt="Ghoori" width="150px" height="190px">
                        </div>
                        <div class="row">
                            <!-- <h2 class="top-main-heading">নতুন কিছু আজকেই</h2> -->
                            <img class="img-responsive pricing-head-image" src="{{asset('img/heading-text-4.png')}}" alt="">
                        </div>
                    </div>
                    <div class="ghoori-all-packs">
                        <!-- ****************************Starter package section***************************** -->
                        <div class="pck-fl box-seze box-1">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="starter-package-heading">Starter</h1>
                                    <span class="starter-package-pricing">299<span class="vat-item">+VAT</span></span>
                                    <p class="fee-per-month">BDT/Month</p>
                                    {{--<p class="basic-package-description">Trial Period: 15 days</p>--}}
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        <a href="{{route('shops.create')}}?pid=2" data-package-id = "2" class="createShopButton loginButton btn btn-danger pack-shop-button">Create Your eShop </a>
                                    </div>
                                    <ul class="starter-package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>COD Facility within Dhaka</span></li>
                                        <li><span>Security Management</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>Enlisted in Ghoori Product Search Engine</span></li>
                                        <li><span>Space to add 120 Products</span></li>
                                        {{--<li><span>Payment Gateway: Txn Fee: 8%</span></li>--}}
                                        <li><span>Payment Gateway fee: Card: 3.5%, COD: 1%, bKash: 1.5%</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <!-- ****************************Bsic package section***************************** -->
                        <div class="pck-fl box-seze box-2">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="basic-package-heading">Basic</h1>
                                    <span class="basic-package-pricing">499<span class="vat-item">+VAT</span></span>
                                    <p class="fee-per-month">BDT/Month</p>
                                    {{--<p class="basic-package-description">Trial Period: 15 days</p>--}}
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        <a class="createShopButton loginButton btn btn-danger pack-shop-button" href="{{route('shops.create')}}?pid=3" data-package-id = "3" role="button">Create Your eShop </a>
                                    </div>
                                    <ul class="basic-package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>COD Facility within all divisional cities</span></li>
                                        <li><span>Security Management</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>SMS Notification</span></li>
                                        <li><span>Enlisted in Ghoori Product Search Engine</span></li>
                                        <li><span>Space to add 240 Products</span></li>
                                        {{--<li><span>Payment Gateway: Txn Fee: 7%</span></li>--}}
                                        <!-- <li><span>Free Ad: BDT 5000</span></li> -->
                                        <li><span><a href="{{route('fshop')}}">Facebook Shop</a></span></li>
                                        <li><span>Payment Gateway fee: Card: 3.5%, COD: 1%, bKash: 1.5%</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <!-- ****************************Premium package section***************************** -->
                        <div class="pck-fl box-seze box-3">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="premium-package-heading">Premium</h1>
                                    <span class="premium-package-pricing">899<span class="vat-item">+VAT</span></span>
                                    <p class="fee-per-month">BDT/Month</p>
                                    {{-- <img src="{{asset('img/ghoori-kites-1.png')}}" alt="Ghoori"> --}}
                                    {{--<p class="premium-package-description">Trial Period: 15 days</p>--}}
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        <a class="createShopButton loginButton btn btn-danger pack-shop-button" href="{{route('shops.create')}}?pid=4" data-package-id = "4" role="button">Create Your eShop </a>
                                    </div>
                                    <ul class="premium-package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>COD Facility within all divisional cities</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>SMS Notification</span></li>
                                        <li><span>Security Management</span></li>
                                        <li><span>Enlisted in Ghoori Product Search Engine</span></li>
                                        <li><span>Space to add 2400 Products</span></li>
                                        <li><span><a href="{{route('fshop')}}">Facebook Shop</a></span></li>
                                        {{--<li><span>Payment Gateway Txn Fee: 5%</span></li>--}}
                                        <li><span>Reporting & Analytics</span></li>
                                        {{--<li><span>Own delivery channel fee: Free</span></li>--}}
                                        {{-- <li><span>Role Management</span></li> --}}
                                        <li><span>Payment Gateway fee: Card: 3.5%, COD: 1%, bKash: 1.5%</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <!-- ****************************Business package section***************************** -->
                        <div class="pck-fl box-seze box-4">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="business-package-heading">Business</h1>
                                    <span class="premium-package-pricing">4999<span class="vat-item">+VAT</span></span>
                                    <p class="fee-per-month">BDT/Month</p>
                                    {{--<img src="{{asset('img/ghoori-kites-1.png')}}" alt="Ghoori">--}}
                                    {{--<p class="business-package-description">Trial Period: 30 days</p>--}}
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        {{--<a class="btn btn-default pack-shop-button pack-shop-button-comming" href="" role="button" disabled="disabled">Coming Soon</a>--}}
                                        <a class="createShopButton loginButton btn btn-danger pack-shop-button" href="{{route('shops.create')}}?pid=5" data-package-id = "5" role="button">Create Your eShop</a>
                                    </div>
                                    <ul class="business-package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>Product Management: Unlimited Product Add</span></li>
                                        <li><span>Security</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>SMS Notification</span></li>
                                        <li><span>Enlisted in Ghoori and Chorki Product Search Engine</span></li>
                                        <!-- <li><span>Own Domain Facility</span></li> -->
                                        <li><span>Security Management</span></li>
                                        <li><span><a href="{{route('fshop')}}">Facebook Shop</a></span></li>
                                        <li><span>Coupon and Discount Management</span></li>
                                        <!-- <li><span>Free Ad: BDT 20000</span></li> -->
                                        {{--<li><span>Payment Gateway: Txn Fee: 5%</span></li>--}}
                                        <li><span>Customized Analytics and Reporting</span></li>
                                        <li><span>Role Management</span></li>
                                        <li><span>Payment Gateway fee: Card: 3.5%, COD: 1%, bKash: 1.5%</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="help-block">
            <h1><i class="fa fa-fw fa-phone"></i> 09612000888</h1>
        </div>
        <div class="help-block">
            <h2>Need help? Feel free to contact with Ghoori.</h2>
            <a id="callContactModal" class="btn btn-default pack-shop-button pack-shop-button-comming" href="#animatedModalContact" role="button" >Contact us</a>
        </div>
    </div><!-- end Ghoori Packages section container -->



    <div class="container temp1">
        <div class="row">
            <div class="col-md-12">
                <img class="img-responsive" src="{{asset('img/ghoori2_breakdown2.jpg')}}" alt="Ghoori" width="100%" height="100%">
            </div>
        </div>
    </div>

    <div id="animatedModalContact">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalContact">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-content">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-lg-offset-1">
                    {{ Form::open(array('class'=>'cd-form floating-labels','id'=>'contact-form','name'=>'contact-form')) }}
                    <!-- {{ Form::token()}} -->
                    <fieldset>
                        <legend>Contact Us</legend>
                        <div class="icon field">
                            <label class="cd-label" for="cd-shop">Name</label>
                            <input class="cd-product-stock" type="text" name="name" id=""  required="required" placeholder="">
                            <p class="cd-form-error error-stock hidden"></p>
                        </div>
                        <div class="icon field">
                            <label class="cd-label" for="cd-shop">Email</label>
                            <input class="cd-product-stock" type="email" name="email" id=""  required="required" placeholder="">
                            <p class="cd-form-error error-stock hidden"></p>
                        </div>
                        <div class="icon field">
                            <label class="cd-label" for="cd-shop">Phone no.</label>
                            <input class="cd-product-stock" type="tel" name="phone" id="" required="required"  placeholder="">
                            <p class="cd-form-error error-stock hidden"></p>
                        </div>
                        <div class="icon field">
                            <label class="cd-label" for="cd-shop">Message</label>
                            <textarea class="cd-product-stock"  name="message" id=""  required="required" placeholder=""></textarea>
                            <p class="cd-form-error error-stock hidden"></p>
                        </div>
                    </fieldset>
                    <button name="submit" id="productsubmit" class="" type="submit" value="Ok">Ok</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>


@stop