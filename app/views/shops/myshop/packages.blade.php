@extends('shops.myshop._layouts.main')
@section('title')
    Upgrade Package
@stop
@section('page-specific-css')
{{ HTML::style('css/pricing-2.css') }}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">
@stop
@section('content')

        <div class="col-xs-12">
            <h2>Upgrade Your Package</h2>
            <h5 class="alert alert-info">Current Package : {{ $shop->package->name }}</h5>
        </div>
        <div class="col-xs-12">
            <div class="ghoori-all-packs row">
                        <!-- ****************************Starter package section***************************** -->
                        <div class="col-xs-12 col-sm-6 col-md-3 main-pack-col">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="starter-package-heading package-heading">Starter</h1>
                                    <span class="starter-package-pricing package-pricing">99</span><span class="vat-item">+VAT</span>
                                    <p class="fee-per-month">BDT/Month</p>
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        <a type="button" href="{{URL::route('admin.packages.edit',[2])}}" class="btn btn-success pack-shop-button" {{ isSamePackage($shop,2)?'disabled':' '}}>Select Package</a>
                                    </div>
                                    <ul class="starter-package-features package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>COD Facility within Dhaka</span></li>
                                        <li><span>Security Management</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>Enlisted in Ghoori Product Search Engine</span></li>
                                        <li><span>Space to add 120 Products</span></li>
                                        <li><span>Payment Gateway: Txn Fee: 8%</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <!-- ****************************Bsic package section***************************** -->
                        <div class="col-xs-12 col-sm-6 col-md-3 main-pack-col">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="basic-package-heading package-heading">Basic</h1>
                                    <span class="basic-package-pricing package-pricing">299</span><span class="vat-item">+VAT</span>
                                    <p class="fee-per-month">BDT/Month</p>
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        <a type="button" class="btn btn-success pack-shop-button" href="{{URL::route('admin.packages.edit',[3])}}" role="button" {{ isSamePackage($shop,3)?'disabled':' '}}>Select Package</a>
                                    </div>
                                    <ul class="basic-package-features package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>COD Facility within all divisional cities</span></li>
                                        <li><span>Security Management</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>SMS Notification</span></li>
                                        <li><span>Enlisted in Ghoori Product Search Engine</span></li>
                                        <li><span>Space to add 240 Products</span></li>
                                        <li><span>Payment Gateway: Txn Fee: 7%</span></li>
                                        <li><span>Facebook Shop Button</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <!-- ****************************Premium package section***************************** -->
                        <div class="col-xs-12 col-sm-6 col-md-3 main-pack-col">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="premium-package-heading package-heading">Premium</h1>
                                    <span class="premium-package-pricing package-pricing">899</span><span class="vat-item">+VAT</span>
                                    <p class="fee-per-month">BDT/Month</p>
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        <a class="btn btn-success pack-shop-button " href="{{URL::route('admin.packages.edit',[4])}}" role="button" {{ isSamePackage($shop,4)?'disabled':' '}}>Select Package</a>
                                    </div>
                                    <ul class="premium-package-features package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>COD Facility within all divisional cities</span></li>
                                        <li><span>Product Management: unlimited product add</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>SMS Notification</span></li>
                                        <li><span>Security Management</span></li>
                                        <li><span>Enlisted in Ghoori Product Search Engine</span></li>
                                        <li><span>Space to add 2400 Products</span></li>
                                        <li><span>Facebook Shop Button</span></li>
                                        <li><span>Payment Gateway: Txn Fee: 5%</span></li>
                                        <li><span>Reporting</span></li>
                                        <li><span>Role Management</span></li>
                                        <li><span>Facebook Page Integration</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <!-- ****************************Business package section***************************** -->
                        <div class="col-xs-12 col-sm-6 col-md-3 main-pack-col">
                            <div class="main-pack-box">
                                <section class="pack-head">
                                    <h1 class="business-package-heading package-heading">Business</h1>
                                    <!-- <span class="business-package-pricing package-pricing">3999</span><span class="vat-item">+VAT</span>
                                    <p class="fee-per-month">BDT/Month</p> -->
                                    <img src="{{asset('img/ghoori-kites-1.png')}}" alt="Ghoori">
                                </section>
                                <section class="pack-content">
                                    <div class="package-button">
                                        <a class="btn btn-default pack-shop-button pack-shop-button-comming" href="" role="button" disabled="disabled">Coming Soon</a>
                                    </div>
                                    <ul class="business-package-features package-features">
                                        <li><span>Store Front Management</span></li>
                                        <li><span>Inventory Management System</span></li>
                                        <li><span>Cart and Check Out Management System</span></li>
                                        <li><span>Product Management: Unlimited Product Add</span></li>
                                        <li><span>Security</span></li>
                                        <li><span>Email Notification</span></li>
                                        <li><span>SMS Notification</span></li>
                                        <li><span>Enlisted in Ghoori and Chorki Product Search Engine</span></li>
                                        <li><span>Security Management</span></li>
                                        <li><span>Space to add unlimited Products</span></li>
                                        <li><span>Facebook Shop Button</span></li>
                                        <li><span>Coupon and Discount Management</span></li>
                                        <li><span>Payment Gateway: Txn Fee: 5%</span></li>
                                        <li><span>Customized Analytics and Reporting</span></li>
                                        <li><span>Role Management</span></li>
                                        <li><span>Facebook Page Integration</span></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>

        </div>

@stop
@section('settings-js')
{{-- {{ HTML::script('js/settings/jquery.multiselect.js') }} --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
<script>

    $(document).ready(function(){
     $('.pack-shop-button').on('click', function(e){
        if (!confirm("Are you sure you want to select this package?")) {
            e.preventDefault();
        };
     })
    });
</script>

@stop