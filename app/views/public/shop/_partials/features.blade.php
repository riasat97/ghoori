@extends('public.shop._layouts.index')
@section('title')
    Ghoori eShop Features
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('store.getFeatures')}}">
    <meta property="og:title" content="Ghoori eShop Features" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('store.getFeatures')}}" />
    <meta property="og:description" content="To visit Ghoori Platform you need to have internet connection in your Laptop/PC or Mobile/Tab." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/learnmore_og.jpg')}}" />
    
    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop
@section('features')
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="intro_title_box">
                <h1>Ghoori eShop Features</h1>
                <!-- <p class="intro_title_sub">.........................</p> -->
            </div>
            <div>{{ HTML::image('img/c_cover.png', null, array('class' => 'img-responsive')) }}</div>
        </div>
    </div>
        
    <div class="row">        
        <!--Main Content -->
        <div class="col-xs-9">
            <section id="GroupA" class="group">
                <h3 class="group-head">Store Front</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div id="GroupASub1" class="subgroup">
                            <h4>Brand and customize your online store</h4>
                          Give your eShop your own look by uploading cover and profile photo. 
                        </div>
                        <div id="GroupASub2" class="subgroup">
                            <h4>Mobile commerce ready</h4>
                          Your online  eShop includes a built-in mobile commerce shopping cart. Your customers can browse and buy from your store using any mobile phone or tablet
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="GroupASub3" class="subgroup">
                            <h4>Your own online Shop Address</h4>
                          You will get a unique shop address from Ghoori. Example: yourshop.ghoori.com.bd. Or you can have your own domain as well.
                        </div>
                        <div id="GroupASub4" class="subgroup">
                            <h4>Your own online Shop Address</h4>
                          You can work with one of our Experts to customize your store from the ground up.
                        </div>
                    </div>
                </div>
            </section>
            <section id="GroupB" class="group">
                <h3 class="group-head">Shopping Cart</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div id="GroupBSub1" class="subgroup">
                            <h4>Secure shopping cart</h4>
                            All credit card and transaction information is protected. You don’t have to worry about it.
                        </div>
                        <div id="GroupBSub2" class="subgroup">
                            <h4>Accept credit cards with Ghoori</h4>
                            You can accept Visa, MasterCard, DBBL and American Express the minute you launch your shop with a very minimum commission rate. bKash and other mobile financial services will also be available. 
                        </div>
                        <div id="GroupBSub3" class="subgroup">
                            <h4>Flexible shipping rates</h4>
                            Set up shipping rates by fixed-price, tiered pricing, weight-based and location-based rates.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="GroupBSub4" class="subgroup">
                            <h4>Cash On Delivery</h4>
                            You can have the cash on delivery service as well from Ghoori. 
                        </div>
                        <div id="GroupBSub5" class="subgroup">
                            <h4>Abandoned checkout recovery</h4>
                            Recover lost sales by automatically sending an email to prospective customers with a link to their abandoned shopping carts, encouraging them to complete their purchase.
                        </div>  
                    </div>
                </div>                
            </section>
            <section id="GroupC" class="group">
                <h3 class="group-head">Store Management</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div id="GroupCSub1" class="subgroup">
                            <h4>Customer profiles</h4>
                            Learn more about your customers and their shopping habits. Find their contact info and order history at a glance.
                        </div>
                        <div id="GroupCSub2" class="subgroup">
                            <h4>Customer accounts</h4>
                            Encourage repeat shopping by enabling customer account creation at checkout.
                        </div>                        
                    </div>
                    <div class="col-md-6">
                        <div id="GroupCSub3" class="subgroup">
                            <h4>Refunds</h4>
                            Refund some or all of an order to the payment method used. Your inventory is updated automatically.
                        </div>
                        <div id="GroupCSub4" class="subgroup">
                            <h4>Customer groups</h4>
                            Categorize and export customer lists based on location, purchase history and more.
                        </div>
                    </div>
                </div>
            </section>
            <section id="GroupD" class="group">
                <h3 class="group-head">Marketing</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div id="GroupDSub1" class="subgroup">
                            <h4>Auto inclusion is Ghoori Search Engine</h4>
                            Opening an eShop will ensure auto inclusion in Ghoori search engine which will ensure more visibility and comparability.
                        </div>
                        <div id="GroupDSub2" class="subgroup">
                            <h4>Email marketing</h4>
                            Notify your customers of upcoming sales or new products with the Ghoori email system.
                        </div>
                        <div id="GroupDSub3" class="subgroup">
                            <h4>Free credits in Ghoori ad system</h4>
                            You'll get 250 Tk ad credit in Ghoori system if you open an eShop instantly.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="GroupDSub4" class="subgroup">
                            <h4>Discount codes and coupons</h4>
                            Run sales and promotions by offering coupon codes that save customers money. 
                        </div>
                        <div id="GroupDSub5" class="subgroup">
                            <h4>Sell on Facebook</h4>
                            Your Facebook fans can browse your products and make a purchase without leaving Facebook.
                        </div>
                        <div id="GroupDSub6" class="subgroup">
                            <h4>Social media integration</h4>
                            All Ghoori eShops include social media integration, such as Facebook, Twitter, YouTube etc. 
                        </div>
                    </div>
                </div>
            </section>
            <section id="GroupE" class="group">
                <h3 class="group-head">Product Management</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div id="GroupESub1" class="subgroup">
                            <h4>Inventory management</h4>
                            Manage your entire inventory with Ghoori. Track stock counts and automatically stop selling products when inventory runs out.
                        </div>
                        <div id="GroupESub2" class="subgroup">
                            <h4>Product variations</h4>
                            Offer different variations of your products, such as multiple sizes, colors, materials and more. Each variation can have its own price, weight and inventory.
                        </div>
                        <div id="GroupESub3" class="subgroup">
                            <h4>Product organization</h4>
                            Organize products by category, type, season, sale and more. Use smart collections to automatically sort products based on vendor, price and inventory level.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="GroupESub4" class="subgroup">
                            <h4>Multiple images</h4>
                            Add multiple images for your products, so you can show off your product from all angles.
                        </div>
                        <div id="GroupESub5" class="subgroup">
                            <h4>Import/Export</h4>
                            Import or export your products using CSV files or one of Ghoori's importer/exporter apps.
                        </div>
                        <div id="GroupESub6" class="subgroup">
                            <h4>Unlimited products</h4>
                            There's no limit to the number or type of products you can sell in your online store.
                        </div>
                    </div>
                </div>
            </section>    
        </div>
        <!--Nav Bar -->
        <nav class="col-xs-3 bs-docs-sidebar">
            <ul id="sidebar" class="nav nav-stacked">
                <li>
                    <a href="#GroupA">Store Front</a>
                    <!-- <ul class="nav nav-stacked">
                        <li><a href="#GroupASub1">Brand and customize your online store</a></li>
                        <li><a href="#GroupASub2">Mobile commerce ready</a></li>
                        <li><a href="#GroupASub3">Your own online Shop Address</a></li>
                        <li><a href="#GroupASub4">Work with an expert</a></li>
                    </ul> -->
                </li>
                <li>
                    <a href="#GroupB">Shopping Cart</a>
                </li>
                <li>
                    <a href="#GroupC">Store Management</a>
                </li>
                <li>
                    <a href="#GroupD">Marketing</a>
                </li>
                <li>
                    <a href="#GroupE">Product Management</a>
                </li>
            </ul>
        </nav>
    </div> 
</div>

@stop