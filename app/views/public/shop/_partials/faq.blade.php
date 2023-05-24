@extends('public.shop._layouts.index')
@section('title')
    FAQ | Ghoori
@stop
@section('staticpagestyles')
    {{HTML::style('css/faqstyle.css')}}
@stop
@section('staticpagescripts')
    {{HTML::script('js/faqmain.js')}}
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('faq')}}">
    <meta property="og:title" content="Ghoori #FAQ" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('faq')}}" />
    <meta property="og:description" content="To visit Ghoori Platform you need to have internet connection in your Laptop/PC or Mobile/Tab." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/faq_og.jpg')}}" />
    
    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop


@section('aboutus')
    <header class="faq-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="faq_form">
                        <form  role="search">
                            <div class="input-group col-sm-10">
                                <!-- <input type="text" class="form-control faq_search_input" placeholder="How Can We Help You" id=""> -->
                                <!-- <span class="input-group-btn group-btn_search "> -->
                                    <!-- <input class="btn_search" type="submit" value=""> -->
                                <!-- </span> -->
                            </div><!-- /input-group -->
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="tac">
                        <img src="image/dummy.png"/>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav class="faq-navbar">
        <div class="container">
            <div class="menu">
                <a href="{{route('faq')}}">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> FAQ
                </a>
                <span class="breadcrumb-child"></span>
            </div>
        </div>
    </nav>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 ">
                    <section class="details_shop icon_section">    <!-- Icon section -->
                        <div class="box">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="#get_started">
                                    <img src="image/icon/start.png">
                                    <p>Getting Started</p>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#about_ghoori">
                                     <img src="image/icon/about.png">
                                      <p>About Ghoori</p>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                     <a href="#create_shop">
                                        <img src="image/icon/shop.png">
                                     <p>Create Ghoori eShop</p>
                                    </a>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#manage_ghoori">
                                    <img src="image/icon/manage.png">
                                     <p>Manage Ghoori eShop</p>
                                     </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#add_product">
                                     <img src="image/icon/add.png">
                                      <p>Add Product</p>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#visit_ghoori">
                                     <img src="image/icon/visit.png">
                                      <p>Visit Ghoori</p>
                                    </a>
                                </div>
                                
                                <div class="col-sm-4">
                                    <a href="#campaign">
                                    <img src="image/icon/campaign.png">
                                     <p>Campaign</p>
                                     </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#pricing">
                                    <img src="image/icon/price.png">
                                    <p>Pricing</p>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#billing">
                                     <img src="image/icon/billing.png">
                                      <p>Billing System</p>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                     <a href="#delivery">
                                        <img src="image/icon/delivery.png">
                                     <p>Delivery Method</p>
                                    </a>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#purchase">
                                        <img src="image/icon/purchase.png">
                                        <p>Purchase Method</p>
                                    </a>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#payment-system">
                                        <img src="image/icon/payment-2.png">
                                        <p>Payment</p>
                                    </a>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#payment-to-ghoori">
                                        <img src="image/icon/payment-2.png">
                                        <p>Payment to Ghoori</p>
                                    </a>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#ghoori-ad-price">
                                        <img src="image/icon/price.png">
                                        <p>Ghoori Ad Price</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="details_shop get_started" id="get_started"> <!-- Get start section -->
                        <h2>Getting Started</h2>
                        <div class="box">
                            <h2>Connecting with Ghoori</h2>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Have a Device</a>
                                    <p>Use any Laptop/Desktop or Mobile/Tab to get into <a style="color:#4d90fe" href="ghoori.com.bd">Ghoori</a>.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Get an Internet connection</a>
                                    <p>Use any kind of internet connectivity [ Example: Broadband, WiMax or 3G ] to get into <a style="color:#4d90fe" href="ghoori.com.bd">Ghoori</a>.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Choose a Browser</a>
                                    <p>You can use any browser to get connected. You are highly recommended to use Mozilla, Chrome, Safari or Opera browser.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Get into an eShop</a>
                                    <div>
                                        <p>To find your Ghoori eShop you need to follow below steps:
                                        <ul>
                                            <li>Open your desire browser and type www.ghoori.com.bd in the address bar and press enter</li>
                                        </ul>
                                        </p>
                                    </div>
                                </li>                                
                            </ul>
                        </div>
                    </section>

                    <section class="details_shop about_ghoori" id="about_ghoori"> <!-- Ghoori About section -->
                        <h2>About Ghoori</h2><br>
                        <div class="box">
                            <br>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What is Ghoori?</a>
                                    <p>
                                        Ghoori is an e-commerce Platform. Here you can open an eShop and share your eShop with others. You can share your eShop with others. Also you can visit other eShops and purchase your desired products. Ghoori will give you a complete ecommerce solution.
                                    </p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Why should I open a Ghoori eShop?</a>
                                    <p>
                                        Ghoori eShop stands for entrepreneurship. Ghoori eShop gives you the opportunity to create your own online shop. It helps to build your own entity. It gives you the freedom to add and sell your product. It will give you a complete independence to edit your shop anytime. Ghoori eShop will connect with your desired customers. This will help you to build your strategy. Ghoori eShop will boost your sale. In summary this Ghoori eShop will help you to shape your whole business and earn profit.
                                    </p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Why would I visit Ghoori Platform?</a>
                                    <p>
                                        Ghoori is a unique Platform where you will find your preferred products in one place. You can access in this Platform from anywhere with your device. Different features of Ghoori Platform will help you to get the access into the shop easily and get the product in fastest possible way. 
                                    </p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How Ghoori Platform will help you to open a new business?</a>
                                    <p>
                                        Ghoori is the Platform where you can open an eShop. It will help you to reach to maximum number of customers. It gives you features to connect with customers through innovative process. It will give you and customers some new and better experience with features like store front, inventory system, product management, payment system etc. Ghoori Platform is the perfect way to start an e-commerce business any day effortlessly. Not only this, your eShop will be searchable and comparable in Ghoori Search.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <section class="details_shop create_shop" id="create_shop"> <!-- Create Shop section -->
                        <h2>Create Ghoori eShop <span>(Open an eShop)</span></h2>

                        <div class="fb-video" data-href="https://www.facebook.com/Ghooribd/videos/1541179536207997/" data-width="500">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/Ghooribd/videos/1541179536207997/">
                                    <p>How to create Ghoori eShop?</p>
                                </blockquote>
                            </div>
                        </div>


                        <div class="box">
                            <h2>Before creating an eShop</h2>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Does it cost to open a Ghoori eShop?</a>
                                    <p>Yes. To open an Ghoori eShop merchants need to choose from Ghoori pricing package. Merchants need to pay as the amount mentioned from the package those chose. For details click <a href="https://ghoori.com.bd/price" style="color:#4d90fe">here</a>.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Who can open a Ghoori eShop?</a>
                                    <p>Anyone who has a Facebook account or a verified e-mail address can open a Ghoori eShop.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How do I share the Ghoori eShop with others?</a>
                                    <p>You can share your Ghoori eShop through social media or you can directly share your Ghoori eShop link.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="box">
                            <h2>Creating a Shop</h2>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How do I log in to Ghoori Platform?</a>
                                    <div>
                                        <p>The steps you need to follow to log in to Ghoori Platform:</p>
                                        <ul>
                                            <li>Visit <a style="color:#4d90fe" href="https://ghoori.com.bd">ghoori.com.bd</a>.</li>
                                            <li>Click log in and then “Sign in with Facebook”.</li>
                                            <li>A new window will appear. Then click “Allow”.</li>
                                            <li>Click “Okay” to access Ghoori Platform.</li>
                                        </ul>
                                        <p>Or</p>
                                        <ul>
                                            <li>Visit <a style="color:#4d90fe" href="https://ghoori.com.bd">ghoori.com.bd</a>.</li>
                                            <li>Click “Log in”.</li>
                                            <li>Sign up with an e-mail address.</li>
                                            <li>“Log in “with the email and password.</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How do I create Ghoori eShop?</a>
                                    <div>
                                        <p>To create a Ghoori eShop you need to follow the steps below:</p>
                                        <ul>
                                            <li>After logging in then click “Create Your Shop”.</li>
                                            <li>The merchant will be directed to price package page, then merchants are required to choose their package accordingly.</li>
                                            <li>Then a new page will appear and you need to fill the shop info. Write your shop name, description, address, e-mail address, mobile number and photo ID number (Example: NID) then click “OK”.</li>
                                            <li>Then you will receive an e-mail and SMS from Ghoori and it will inform you that your eShop will be activated within 48 hours.</li>
                                            <li>You need to verify your mobile and e-mail, upload logo and banner, add at least one product and add shipping channel.</li>
                                            <li>If all the above steps are followed perfectly then your eShop will be activated within the next 48 hours.</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How to choose a price package?</a>
                                    <div>
                                        <p>After click on the “Log in” button merchants are required to click on “Create Your Shop”. The merchants will directly diverted to price package page. From that page merchants can chose the package they find suitable.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How to add shipping channel?</a>
                                    <div>
                                        <p>Ghoori platform incorporated shipping channels will automatically add in the system of the eShop. Merchants are allowed to add their own shipping channel as well. To add own shipping channel merchants needs to click on the “Add Shipping Channel” button available in their eShop page and add the shipping charge for different regions.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Which shipping channels are available?</a>
                                    <div>
                                        <p>Currently ecourier and Aramex two shipping channels are available in Ghoori eShop system.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How to choose payment method for eShop?</a>
                                    <div>
                                        <p>COD and bKash, these payment methods are available in Ghoori platform. These payment methods are automatically incorporated with Ghoori eShop system.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How will merchant receive payment?</a>
                                    <div>
                                        <p>Merchants will receive money after every 15 days period. Merchants will be informed about the payment through e-mail about the payment.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <section class="details_shop manage_ghoori" id="manage_ghoori"> <!-- Manage Ghoori section -->
                        <h2>Manage Ghoori eShop <span>(eShop Customization)</span></h2>
                        <div class="box">
                            <h2>Account Settings</h2>      
                            <ul>
                                <li>
                                    <h3>Edit your Settings</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How do I permanently delete my Ghoori eShop?</a>
                                            <p>
                                                You cannot delete your eShop permanently but you can unpublish your account. If you unpublish your eShop then it will not be available to anyone except you.<br>To know how to unpublish click <a href="#unpublish" style="color:#4d90fe">here</a>.
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <h3>Language specific Ghoori eShop Name</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Which Language should I use to name Ghoori eShop?</a>
                                            <p>
                                                You can use any Language, but we highly recommend to use Bengali or English.
                                            </p>
                                        </li>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Can I switch my Ghoori eShop Name from one Language to other?</a>
                                            <p>
                                                Yes, you can switch my Ghoori eShop Name from one Language to other. 
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <h3>Warning &amp; blocks</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How I might be warnned/blocked by Ghoori Authority?</a>
                                            <p>
                                                If any Ghoori eShop owner goes out of terms and condition of Ghoori then Ghoori reserves the authority to warn the eShop owner. Further steps against the Ghoori terms and condition might cause to block the eShop.
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <div class="box">
                            <h2>Change in Ghoori eShop</h2>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I change my Ghoori eShop name?</a>
                                    <div>
                                        <p>Merchants are not allowed to change their eShop name.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I change the Ghoori email address and phone number?</a>
                                    <p>
                                        Shop owner cannot change the e-mail address and phone number in general. However, with proper justification shop owner can send change request to Ghoori authority.
                                    </p>
                                </li><br>
                                <li>
                                    <h3>Publish Ghoori eShop</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I publish my Ghoori eShop?</a>
                                            <div>
                                                <!-- Visit your Ghoori eShop and click the “Publish” button then you will receive an activation code through SMS and also a new window will appear to put the activation code. Put the activation code in the box then click “OK” and your shop will be published.  -->  
                                                <p>To publish your Ghoori eShop you need to follow the steps below:</p>
                                                <ul>
                                                    <li>Visit your Ghoori eShop.</li>
                                                    <li>Before publishing your Ghoori eShop you have to fulfill the requirements.</li>
                                                    <li>Your Ghoori eShop must be verified by Mobile Number and Email Address.</li>
                                                    <li>You must upload your Cover photo and Logo for your Ghoori eShop</li>
                                                    <li>You must have to add Product and add Shipping Channel.</li>
                                                    <li>Now click the "Publish" button.</li>
                                                </ul>                               
                                            </div>
                                        </li>
                                    </ul>
                                    <h3 id="unpublish">Unpublish Ghoori eShop</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I unpublish my Ghoori eShop?</a>
                                            <p>
                                                Merchant can unpublish his/her shop any time from admin panel.
                                            </p>
                                        </li>
                                    </ul>
                                </li>


                                <li>
                                    <h3>Password</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I add password in Ghoori account?</a>
                                            <div>
                                                <!-- Visit your Ghoori eShop and click the “Publish” button then you will receive an activation code through SMS and also a new window will appear to put the activation code. Put the activation code in the box then click “OK” and your shop will be published.  -->  
                                                <p>To add password in your Ghoori account you need to follow the steps below:</p>
                                                <ul>
                                                    <li>Visit ghoori.com.bd</li>
                                                    <li>Log into Ghoori with Facebook or email account</li>
                                                    <li>Click on the button beside merchant name</li>
                                                    <li>Choose settings</li>
                                                    <li>Type new password on "New "Password" box</li>
                                                    <li>Again type that new password on "Retype New Password" box</li>
                                                    <li>Click on "Update" button and you have successfully added password in your Ghoori account.</li>
                                                </ul>
                                                <p>Now you can log into your Ghoori account by using existing Ghoori e-mail address and new password.</p>                            
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- <h3 id="unpublish">Change Password</h3> -->
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I change my password?</a>
                                            <div>
                                                <!-- Visit your Ghoori eShop and click the “Publish” button then you will receive an activation code through SMS and also a new window will appear to put the activation code. Put the activation code in the box then click “OK” and your shop will be published.  -->  
                                                <p>To change your Ghoori password you need to follow the steps below:</p>
                                                <ul>
                                                    <li>Visit ghoori.com.bd</li>
                                                    <li>Log into Ghoori with their Facebook account or email address</li>
                                                    <li>Click on the button beside merchant name</li>
                                                    <li>Choose settings</li>
                                                    <li>Type password in "Old Password" box</li>
                                                    <li>Type new password on "New Password" box</li>
                                                    <li>Again type that new password on "Retype New Password" box</li>
                                                    <li>Click on "Update" button and you have successfully changed password in your Ghoori account.</li>
                                                </ul>
                                                <p>Now you can log into your Ghoori account by using existing Ghoori e-mail address and new password.</p>                            
                                            </div>
                                        </li>
                                    </ul>

                                    <!-- <h3 id="unpublish">Password Recovery</h3> -->
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I recover password if I forget it?</a>
                                            <div>
                                                <!-- Visit your Ghoori eShop and click the “Publish” button then you will receive an activation code through SMS and also a new window will appear to put the activation code. Put the activation code in the box then click “OK” and your shop will be published.  -->  
                                                <p>To recover your Ghoori password you need to follow the steps below:</p>
                                                <ul>
                                                    <li>Visit ghoori.com.bd</li>
                                                    <li>Click on "Log In" button</li>
                                                    <li>Click on "Forgot password" button</li>
                                                    <li>Type your registered email address</li>
                                                    <li>An email will be sent to your email address</li>
                                                    <li>Check your email address and click on the link. </li>
                                                    <li>Now type your email address</li>
                                                    <li>Type new password on "New Password" box</li>
                                                    <li>Again type that new password on "Retype New Password" box and click "Reset Password" button. </li>
                                                    <li>You have successfully recovered your Ghoori account password. </li>
                                                </ul>
                                                <p>Now you can log into your Ghoori account by using existing Ghoori e-mail address and new password.</p>                              
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <h3>Stop Ghoori Service</h3>
                                    <br>
                                    <ul>
                                        <li>
                                            <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How I can stop Ghoori Service?</a>
                                            <div>
                                                <p>To stop ghoori service all you need to do is to unpublish your shop from your admin panel. If you want to remove your shop from ghoori system, send an email from your registered email ID mentioning the reason.</p>                           
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <section class="details_shop add_product" id="add_product"> <!-- Add Product section -->
                        <h2>Add Product</h2>
                        <div class="box">
                            <br>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What kind of product can I update in my Ghoori eShop?</a>
                                    <p>You can update any product except the one that violates Ghoori <a href="https://ghoori.com.bd/privacy-policy" style=" color:blue">Privacy Policy</a>.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How I can add product?</a>
                                    <div>
                                        <p>To add product in the Ghoori Platform you need to follow below steps:</p>
                                        <ul>
                                            <li>Visit <a href="ghoori.com.bd">ghoori.com.bd</a></li>
                                            <li>Click “Log in”</li>
                                            <li>Now click “My Shop” (if you don’t have Ghoori eShop click on “Create Your Shop”, for details click For details click <a href="https://ghoori.com.bd/admin/shops/create" style="color:#4d90fe">here</a>).</li>
                                            <li>Now click on “Add product” then add name of the product, browse category of the product, add description and add the price of the product.</li>
                                            <li>Click on upload product image and select the product image. You can add multiple product images as well.</li>
                                            <li>Now click on “Ok” and your product will available on your shop. </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How merchants will notify about order?</a>
                                    <p>Merchants will notify through e-mail and SMS about the order.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What will happen if there is no stock?</a>
                                    <p>The value will be automatically show “0” if the product goes out of stock. From the concern service provider it is suggested to add “1000” in the stock amount.</p>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <section class="details_shop visit_ghoori" id="visit_ghoori"> <!-- Visit Ghoori section -->
                        <h2>Visit Ghoori <span>(Browse eShop)</span></h2>
                        <div class="box">
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I visit my Ghoori eShop? </a>
                                    <p>
                                        To visit Ghoori Platform you need to have internet connection in your Laptop/PC or Mobile/Tab. Now open your desire browser and type ghoori.com.bd. Then you need to log in and then click “My Shop” to visit your eShop. <br>For details click: <a href="https://ghoori.com.bd/get-started" style=" color:blue">Get Started</a>.
                                    </p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Who can visit my Ghoori eShop?</a>
                                    <p>Anyone who is connected with internet will be able to visit your Ghoori eShop.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>From where I can visit Ghoori?</a>
                                    <p>If you have internet connection, you can visit Ghoori from anywhere.</p>
                                </li>                               
                            </ul>
                        </div>
                    </section>


                    <section class="details_shop campaign" id="campaign"> <!-- Ghoori Campaign section -->
                        <h2>Campaign</h2>
                        <div class="box campaign-4">
                            <h2>Campaign 4: <strong>"পাঁচে পাঁচশ"</strong> Campaign</h2>
                            <p>We are going to start a new campaign named as “<strong>পাঁচে পাঁচশ</strong>”. This is a price specific campaign and in this campaign Ghoori will promote the product priced between BDT 1 to BDT 500. All the Ghoori merchants who has products within this range, automatically include in this campaign. Merchants are not required to pay any extra amount to participate in this campaign and Ghoori will charge as per the package nature in case of TXN commission. This campaign will run from January 17, 2016 – January 21, 2016.</p>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do merchants need to pay for this campaign?</a>
                                    <p>Merchants are not required to pay any extra amount to participate in this campaign and Ghoori will charge as per the package nature in case of TXN commission.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How long this campaign will run?</a>
                                    <p>This campaign will run from January 17, 2016 – January 21, 2016.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Who are eligible for this campaign?</a>
                                    <p>All the Ghoori merchants who has products priced between BDT 1 to BDT 500, will include in this campaign automatically.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Is this required to give any discount to participate this campaign?</a>
                                    <p>To participate in this "<strong>পাঁচে পাঁচশ</strong>" campaign, merchants doesn’t need to give any discount in their products.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What are the benefits of this campaign?</a>
                                    <p>This campaign will ensure the visibility of the product which are priced between BDT 1 to BDT 500. It will increase the probability of sales. It will also help them to reach a lot of people.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can you ensure the success of your Ghoori shop from this campaign?</a>
                                    <div>
                                        <ol>
                                            <li>Enable your fShop. This will help your Facebook Fans to purchase your products directly from your Facebook Fan page. To know more about it click: <a href="https://ghoori.com.bd/fshop">https://ghoori.com.bd/fshop</a>. Also make sure you inform all your customers and friends regarding the campaign to get maximum benefits.</li>
                                            <li>You can make your eShop standout from other shops. All you need to do is make your shop "Featured" or "Sponsored". To know about the pricing of these features visit this link: <a href="https://ghoori.com.bd/faq#ghoori-ad-price">https://ghoori.com.bd/faq#ghoori-ad-price</a><br> Call us at 09612000888 for registration.</li>
                                            <li>Please make sure you have enough stocks. The campaign will raise the bar and customers will knock your shops for sure. So for future reference you need to provide good quality products for your customers and make them your repeat buyers. Call us if you need any help.</li>
                                        </ol>
                                    </div>
                                </li>
                            </ul>
                        </div>


                        <div class="box">
                            <h2>Campaign 3: <strong>"Hot Deals"</strong> Campaign</h2>
                            <p>This is a campaign where we are selecting shops based on last month’s activity of the eShops in the Ghoori platform. In this campaign Ghoori will specially promote the selected eShops through different channels. Ghoori team is solely authorized to choose the eShop.</p>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do merchants need to pay for this campaign?</a>
                                    <p>Merchants are not required to pay any extra amount to participate in this campaign and Ghoori will charge as per the package nature in case of TXN commission.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How long this campaign will run?</a>
                                    <p>This campaign will run from 20th December – 27th December, 2015.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Is this required to give any discount to participate this campaign?</a>
                                    <p>To participate in this "Winter is Here" campaign, merchants need to give at least 15% discount in all or particular product.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How merchant will add discount at their product?</a>
                                    <div>
                                        <p>Steps to add discount in your shop:</p>
                                        <ul>
                                            <li>Log in to your Ghoori account</li>
                                            <li>Go to "My Shop"</li>
                                            <li>Click on the "Discount" button beside "Add Product" button</li>
                                            <li>Chose the discount amount</li>
                                            <li>Click "Save Discount" amount</li>
                                        </ul>
                                        <p>Steps to add discount in specific product:</p>
                                        <ul>
                                            <li>Log in to your Ghoori account</li>
                                            <li>Go to "My Shop"</li>
                                            <li>Click the drop down context menu of your desired product</li>
                                            <li>Chose the discount amount</li>
                                            <li>Click "Save Discount" amount</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Can merchants add/remove discounted products?</a>
                                    <p>Once you have configured your discount process, you cannot add or remove it till the campaign ends.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What are the benefits of this campaign?</a>
                                    <p>The visibility of the eShops will increase significantly. It will increase the brand value of the eShops as well as increase the probability of sales. It will also help them to reach a lot of people.</p>
                                </li>

                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can you ensure the success of your Ghoori shop from this campaign?</a>
                                    <div>
                                        <p>1. Enable your fShop. This will help your Facebook Fans to purchase your products directly from your Facebook Fan page. To know more about it click: <a  style="color:#4d90fe;text-decoration:none;" target="_blank" href="https://ghoori.com.bd/fshop">https://ghoori.com.bd/fshop</a>. Also make sure you inform all your customers and friends regarding the campaign to get maximum benefits.</p>
                                        <p>2. You can make your eShop standout from other shops. All you need to do is make your shop "Featured" or "Sponsored"</p>
                                        <ul>
                                            <li>Cost of a "Featured" Shop: BDT 99/day +VAT. 30% discount is available if you register for 6 months and pay in advance.</li>
                                            <li>Cost of a "Sponsored" shop: BDT 75/day + VAT. 20% discount will be available if you register for 6 months and pay in advance.</li>
                                        </ul>

                                        <p>Call us at 09612000888 for registration. This offer is valid till December 25, 2015.</p>

                                        <p>3. Feature your Product/s in Ghoori: This is an amazing feature from Ghoori. You can boost your product/s from your eShop. From 15 December 2015 you will see a "BOOST" button beside "VIEW" in your every product window.  Just click and select your place and dates to start featuring your product/s in Ghoori. This will help you generate more sales from your Ghoori eShop. Feel free to knock us if you have any query or support at 09612000888. Please remember boosting is Prepaid. You can pay through credit card, bKash and Doze wallet for boosting.</p>

                                        <p>4. Please make sure you have enough stocks. The campaign will raise the bar and customers will knock your shops for sure. So for future reference you need to provide good quality products for your customers and make them your repeat buyers. Call us if you need any help.</p>

                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="box">
                            <h2>Campaign 2: Ghoori – Grameenphone Campaign</h2>
                            <p>This is joint campaign of Ghoori and Grameenphone. Ghoori has selected 21 eShops as their featured shop based on last month’s activity of the eShops in the Ghoori platform. In this campaign Ghoori featured eShops will specially promoted by both Ghoori and Grameenphone.</p>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do merchants need to pay for this campaign?</a>
                                    <p>Merchants are not required to pay any extra amount to participate in this campaign and Ghoori will charge as per the package nature in case of TXN commission.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How long this campaign will run?</a>
                                    <p>This campaign will run from 20th September – 24th September, 2015.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Is this required to give any discount to participate this campaign?</a>
                                    <p>To participate Ghoori featured shop campaign merchants need to give 10% discount in all or particular product.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What are the benefit of this campaign?</a>
                                    <p>Featured Ghoori eShops will enjoy a special treatment from Ghoori. The visibility of the eShops will increase significantly. It will increase the brand value of the eShops as well as increase the probability of sales. Also in this campaign Ghoori Featured eShops will promote specially through Grameenphone and Ghoori. This will increase the credibility of the eShop as well.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Who can avail this offer?</a>
                                    <p>Only Grameenphone users can participate this Eid campaign.</p>
                                </li>
                            </ul>
                        </div>

                        <div class="box">
                            <h2>Campaign 1: Ghoori Featured Shop</h2>
                            <p>This is a monthly campaign program of Ghoori. Ghoori has selected 21 eShops as their featured shop based on last month’s activity of the eShops in the Ghoori platform. In this campaign Ghoori will specially promote the selected featured eShops in online media. Ghoori team is solely authorized to choose the featured Ghoori eShop.</p>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do merchants need to pay for this campaign?</a>
                                    <p>Merchants are not required to pay any extra amount to participate in this campaign and Ghoori will charge as per the package nature in case of TXN commission.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How long this campaign will run?</a>
                                    <p>This campaign will run from 15th September – 20th September, 2015.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Is this required to give any discount to participate this campaign?</a>
                                    <p>To participate Ghoori-Grameenphone campaign, merchants need to give at least 10% discount in all or particular product.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How Grameenphone customers will be benefited by this campaign?</a>
                                    <p>All Grameenphone internet users will enjoy a free access (will not charge any data) at ghoori.com.bd during this campaign. Also Grameenphone users will get a special 10% discount from Ghoori featured shops on all or specific products. Grameenphone Customers will also enjoy 50% discount in delivery charge during this campaign.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How merchant will add discount at their product?</a>
                                    <div>
                                        <p>Steps to add discount in your shop:</p>
                                        <ul>
                                            <li>Log in to your Ghoori account</li>
                                            <li>Go to "My Shop"</li>
                                            <li>Click on the "Discount" button beside "Add Product" button</li>
                                            <li>Chose the discount amount</li>
                                            <li>Click "Save Discount" amount</li>
                                        </ul>
                                        <p>Steps to add discount in specific product:</p>
                                        <ul>
                                            <li>Log in to your Ghoori account</li>
                                            <li>Go to "My Shop"</li>
                                            <li>Click the drop down context menu of your desired product</li>
                                            <li>Chose the discount amount</li>
                                            <li>Click "Save Discount" amount</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Can merchants add/remove discounted products?</a>
                                    <p>Once you have configured your discount process, you cannot add or remove it till the campaign ends.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What are the benefits of this campaign?</a>
                                    <p>Featured Ghoori eShops will enjoy a special treatment from Ghoori. The visibility of the eShops will increase significantly. It will increase the brand value of the eShops as well as increase the probability of sales.</p>
                                </li>
                            </ul>
                        </div>
                    </section>


                    <section class="details_shop delivery" id="delivery"> <!-- Delivery System section -->
                        <h2>Delivery Method</h2><br>
                        <div class="box">
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Steps of delivery</a>
                                    <div>
                                        <p>The steps are as follows:</p>
                                        <ul>
                                            <li>Step 1: Customer will place an order from Ghoori eShop.</li>
                                            <li>Step 2: Merchant will be notifed about the order through SMS and e-mail. If merchant accept the order then customer will be notified through SMS about the acceptance. If merchant reject the order then customer will also be notified through SMS about the rejection and the process will end.</li>
                                            <li>Step 3: Shipping channel service provider will contact with the merchant and collect the product.</li>
                                            <li>Step 4: After collecting the product courier service will contact with customer and deliver accordingly.</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Products picking points</a>
                                    <div>
                                        <p>Ghoori shipping channel will pick products only from Dhaka area.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Products delivery zone</a>
                                    <div>
                                        <p>Inside Dhaka, Gazipur, Savar, Narayangonj, Jatrabari, Barisal city and Chittagong city.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Shipping service organization</a>
                                    <div>
                                        <p>Currently eCourier is integrated in the Ghoori platform system as a delivery service provider. Soon other delivery services will be added in the system.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How Merchants will get their money from Ghoori?</a>
                                    <div>
                                        <p>Ghoori will provide or disburse merchant money twice in a month. Merchants will be notified before that and merchant needs to confirm that. Currently Ghoori will only disburse through cheque.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Is there any other hidden cost?</a>
                                    <div>
                                        <p>There is no hidden cost. Ghoori will charge as per the package nature in case of TXN commission.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Delivery charge at Ghoori</a>
                                    <div>
                                        <p>Here is the delivery charge at Ghoori for different packages:</p>
                                        <table>
                                            <tr>
                                                <th>Timing</th>
                                                <th>Inside Dhaka City (Below 500grams)</th>
                                                <th>Inside Dhaka City (>500 grams up to 1kg )</th>
                                                <th>Inside Dhaka City (up to 2kg )</th>
                                            </tr>
                                            <tr>
                                                <td>24 hours after picking up</td>
                                                <td>50</td>
                                                <td>70</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>8 hours after picking up</td>
                                                <td>100</td>
                                                <td>120</td>
                                                <td>140</td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>When the product will be delivered to customer?</a>
                                    <div>
                                        <p>Counting of delivery time starts after picking up the product from merchant’s end.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I order from Ghoori?</a>
                                    <div>
                                        <p>The steps are as follows:</p>
                                        <ol>
                                            <li>1. Visit <a style="color:#4d90fe;" href="https://ghoori.com.bd/">ghoori.com.bd</a></li>
                                            <li>2. Log into Ghoori with your e-mail address or Facebook account.</li>
                                            <li>3. Visit a Ghoori eShop.</li>
                                            <li>4. Select a product (click on the view button)</li>
                                            <li>5. Click "Add to cart" button.</li>
                                            <li>6. Now click on the cart button (Yellow button with cart sign on the top right section of page) and click on "Buy" button.</li>
                                            <li>7. Now you will be moved to Check Out page. Check the details (Unit Price, Quantity, Color, Size, Subtotal, discount and total price of product) about the order price. Now click on the "Check Out" button.</li>
                                            <li>8. Now you will be move to order confirmation page. Here customer needs to provide "Full Name, E-mail Address, Mobile Number, Shipping Address, Shipping Division, Delivery Method and Payment Method".  To confirm the order click on "Place your order" button.</li>
                                        </ol>
                                    </div>
                                </li>

                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I add own channel?</a>
                                    <div>
                                        <p>To add your own delivery channel you need to follow below steps:</p>
                                        <ol>
                                            <li>1. Log into <a style="color:#4d90fe;" href="https://ghoori.com.bd/"><b>Ghoori</b></a></li>
                                            <li>2. Click on "<b>My Shop</b>"</li>
                                            <li>3. Click "<b>Settings</b>"</li>
                                            <li>4. Click "<b>Delivery</b>"</li>
                                            <li>5. Check "<b>Own Delivery Channel</b>"</li>
                                            <li>6. Click "<b>OK</b>"</li>
                                        </ol>
                                    </div>
                                </li>

                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Can I use my own delivery system for my eShop?</a>
                                    <div>
                                        <p>Yes, you can add your own delivery system for your Ghoori eShop.</p>
                                    </div>
                                </li>

                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do I need to pay any extra amount for own channel?</a>
                                    <div>
                                        <p>Ghoori will charge BDT 99+VAT monthly if you install the own delivery channel in your Ghoori eShop.</p>
                                    </div>
                                </li>

                                <!-- <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do I need to pay anything else except monthly charge for own channel?</a>
                                    <div>
                                        <p>No, except the monthly charge you don’t need to pay anything else to install own delivery channel.</p>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </section>

                    <section class="details_shop pricing" id="pricing"> <!-- Pricing section -->
                        <h2>Pricing</h2><br>
                        <div class="box">
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Types of pricing</a>
                                    <p>Ghoori is offering 3 types of pricing. These are starter pack, basic and premium.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Can merchants change the pack?</a>
                                    <p>Yes, merchants can change the pricing package if they want.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What are the differences between these pricing packages?</a>
                                    <p>Merchants will enjoy different premium features from different packages. For details click <a style="color:#4d90fe" href="https://ghoori.com.bd/price">here</a>.</p>
                                </li>                                
                            </ul>
                        </div>
                    </section>

                    <section class="details_shop billing" id="billing"> <!-- Billing System section -->
                        <h2>Billing System</h2><br>
                        <div class="box">
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How Ghoori will charge merchant?</a>
                                    <p>Ghoori will charge as per the package nature in case of TXN commission.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Will Ghoori charge any customer for using Ghoori Services?</a>
                                    <p>Ghoori will not charge any customer for using Ghoori services.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What is the Billing cycle of Ghoori?</a>
                                    <p>There are two billing cycle of Ghoori, first is from day 1 to day 15 of month and second will be from day 16 to end of month.</p>
                                </li>


                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Billing Cycle</a>

                                    <div>
                                        <p>There are two billing cycles in Ghoori, first is from day 1 to day 15 of the month and second is from day 16 to end of the month.</p>
                                        <p>How to claim my balance amount from Ghoori account?</p>
                                        <ul>
                                            <li>All complete orders (Complete Order: Customer received the product successfully) within the period of Day 1 to Day 15 of each month are included in this cycle.</li>
                                            <li>Merchants can check their current balance from their admin panel. Merchants need to click revenue tab to check the balance.</li>
                                            <li>Ghoori will send claim request after each billing cycle and merchants needs to claim their amount to receive the payment.</li>
                                            <li>There are two ways merchant can receive their payment:</li>
                                            <li class="remove-list-style">
                                                <ul>
                                                    <li>Bank Account</li>
                                                    <li>bKash Account</li>
                                                </ul>
                                            </li>
                                            <li>If Merchant already provided the bank/bKash account in Ghoori system he/she can claim his/her amount. If not, then they need to provide account information in the system before claiming the balance.</li>
                                            <li>Merchant can claim amount if the balance is more than or equal to 2500 taka in each bill cycle.</li>
                                            <li>Ghoori will deduct all charges [subscription fee, Txn commission and VAT/TAX] before disbursing the amount to merchant account. </li>
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How merchants will receive money from Ghoori?</a>
                                    <p>After every billing cycle merchant's balance will be calculated by Ghoori team and disburse to merchant's bank or bKash account in a specific date after keeping the transaction and monthly fee [if applicable]</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How many times merchant can claim his/her money from Ghoori?</a>
                                    <p>Merchant can claim his/her money in each billing cycle.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What is the process of claiming money from Ghoori?</a>
                                    <p>Ghoori will notify merchant to claim his/her money through email and sms. Merchants need to accept the claim email for confirmation. Without accepting merchants won’t able to claim their money from Ghoori.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How do merchants know how much money he/she has in his/her Ghoori account?</a>
                                    <p>After every cycle ends merchants will be notified about the Ghoori balance (the amount of money merchant has in Ghoori account) through e-mail and SMS. </p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What merchant needs to do to get his/her money from Ghoori?</a>
                                    <p>Merchant needs to confirm and claim his money through email to get his money.</p>
                                </li>                        
                            </ul>
                        </div>
                    </section>


                    <section class="details_shop purchase" id="purchase"> <!-- Purchase Methos section -->
                        <h2>Purchase Method</h2>
                        <br>

                        <div class="fb-video" data-href="https://www.facebook.com/Ghooribd/videos/1541173192875298/" data-width="500">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/Ghooribd/videos/1541173192875298/">
                                    <p>How to purchase from Ghoori?</p>
                                </blockquote>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>

                        <div class="box">
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I order from Ghoori?</a>
                                    <div>
                                        <p>Before going for any order first you have to login from either your Facebook account or any of the Email Id that you have. Than follow the procedure below:</p>
                                        <ul>
                                            <li>Step 1: Go to the shop from where you want to purchase the product.</li>
                                            <li>Step 2: Click "View" button that will take you to product view page.</li>
                                            <li>Step 3: You select the quantity of product that you want to purchase.</li>
                                            <li>Step 4: Then click "Add to Cart" button. Than you also can buy different product from another shop.</li>
                                            <li>Step 5: After finishing your shopping you have to click "Cart" button than you can see which products you have selected to purchase. You can also unselect product from there. Than for further process click "Buy" button.</li>
                                            <li>Step 6: Now you are at checkout page. Here all the product information is available product size, color, subtotal, discount (if discount is applicable for product). If every information is right please click "Check Out" button.</li>
                                            <li>Step 7: Please put your Shipping address, Delivery Method (Pick up time), Payment Method. Then check the total details of pricing, if it is all right Click "Place Your Order" button.</li>
                                            <li>Step 8: After placing order, you will receive a SMS in your Mobile Phone containing a verification code. Please put this verification code in the order verification page to verify and confirm your order. You can verify your order later from My order page as well.</li>
                                            <li>Step 9: You will get a text message about the placement of your order. And after that you will get your order within the delivery time.</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I find product form Ghoori?</a>
                                    <div>
                                        <p>You can search, your desire product at search bar on the top of Ghoori website. Also you can find all the feature eShops, products, and new & exciting products at Ghoori home page. Apart from that you can browse different Ghoori eShops and chose the product you are looking for.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Can I cancel my order?</a>
                                    <div>
                                        <p>Steps to cancel the order:</p>
                                        <ul>
                                            <li>Log in to your Ghoori account</li>
                                            <li>Click My Order</li>
                                            <li>Click on "Cancel"</li>
                                            <li>Chose the reason of canceling the order</li>
                                            <li>Click "OK"</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I change my order?</a>
                                    <div>
                                        <p>Yes, you can change your order within 3 hours [180 minutes] after placing order through our customer care (Helpline: 09612000888).</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What are the ways I can pay in Ghoori?</a>
                                    <div>
                                        <p>Currently, only cash on delivery system is available. But soon bKash and credit card facilities will be integrated.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Where I can find Ghoori cart?</a>
                                    <div>
                                        <p>You can find it at the top right side on website at <a style="color:#4d90fe;" href="https://ghoori.com.bd/">www.ghoori.com.bd</a></p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do I need to pay any extra amount for delivery?</a>
                                    <div>
                                        <p>When you complete the total delivery process you can see the total pricing including delivery charge. Apart from that you need not to pay any extra amount for delivery.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I be sure my order is accepted?</a>
                                    <div>
                                        <p>After your order has been accepted you will get a text message regarding the order acceptance.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I log complaint against a merchant?</a>
                                    <div>
                                        <p>You can complain, give suggestions for the betterment of our service through customer care helpline. (09612000888). Mention the merchant name and reason while logging the complaint.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>


                    <section class="details_shop payment-system" id="payment-system"> <!-- Payment System section -->
                        <h2>Payment</h2>
                        <div class="box">
                            <h2>Payment Section</h2>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How I can pay in Ghoori?</a>
                                    <p>You can pay in Ghoori through COD, Doze account and Debit/Credit Card.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What types of cards are applicable in Ghoori card payment?</a>
                                    <p>DBBL, Visa, Master Card, Qcash, American express, Fast Cash cards are applicable in Ghoori card payment.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How do I know my payment is successful in case of card payment?</a>
                                    <p>When your payment has been successful then you will be directed to a new page and you will show a message that "your payment is successful".</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do I need to pay extra amount in case of card payment?</a>
                                    <p>No, you don’t need to pay any extra amount in case of card payment.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>What is the process to pay through card?</a>
                                    <div>
                                        <p>Steps to pay through card:</p>
                                        <ul>
                                            <li>Visit and select your desire product.</li>
                                            <li>Add the product in "Cart" and Click "Buy" button.</li>
                                            <li>Click "Check Out".</li>
                                            <li>Provide required information.</li>
                                            <li>Chose "Credit Card" as payment system and click "Place Your Order".</li>
                                            <li>Chose the Card service to pay.</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="box">
                            <h2>Payment Gateway</h2>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How many ways customer can pay in Ghoori?</a>
                                    <p>Customers can pay in Ghoori through COD and Card system.</p>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I add card payment system in my ghoori eShop?</a>
                                    <div>
                                        <p>To add card payment system in your Ghoori eShop you need to follow below steps:</p>
                                        <ul>
                                            <li>Log into <b>Ghoori</b>.</li>
                                            <li>Click on "<b>My Shop</b>".</li>
                                            <li>Click "<b>Settings</b>".</li>
                                            <li>Click "<b>Payment Method</b>".</li>
                                            <li>Check "<b>Card</b>".</li>
                                            <li>Click "<b>OK</b>".</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I add COD in my ghoori eshop?</a>
                                    <div>
                                        <p>To add card payment system in your Ghoori eShop you need to follow below steps:</p>
                                        <ul>
                                            <li>Log into <b>Ghoori</b>.</li>
                                            <li>Click on "<b>My Shop</b>".</li>
                                            <li>Click "<b>Settings</b>".</li>
                                            <li>Click "<b>Payment Method</b>".</li>
                                            <li>Check "<b>Cash on delivery</b>".</li>
                                            <li>Click "<b>OK</b>".</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Do I need to pay any extra amount to avail card payment option?</a>
                                    <div>
                                        <p>No, you don't need to pay any extra amount to avail card payment option.</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How can I get my money back?</a>
                                    <div>
                                        <p>You will get back money in two billing cycle. For details click <a href="https://ghoori.com.bd/faq#billing" style="color:#4d90fe">here</a>.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>




                    <section class="details_shop payment-to-ghoori" id="payment-to-ghoori"> <!-- Payment to Ghoori section -->
                        <h2>Payment to Ghoori</h2>
                        <div class="box">
                            <h2>Payment to Ghoori Details</h2>
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How to make your payment to Ghoori through bKash?</a>
                                    <div>
                                        <p>Please follow below steps make your payment to Ghoori through bKash:</p>
                                        <ul>
                                            <li>Press *247# </li>
                                            <li>Select  Payment option "3"</li>
                                            <li>Enter merchant wallet no. "01842246754"</li>
                                            <li>Enter amount "<b>***</b>" (Example "99")</li>
                                            <li>Enter Reference "Your Shop Name" (example: "Tarabati")</li>
                                            <li>Enter counter No. "1"</li>
                                            <li>Enter Menu Pin "<b>****</b>" </li>
                                            <li>You will receive confirmation message of your payment</li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="payment-to-ghoori-2nd-list-content-style">
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How to pay to Ghoori through bank?</a>
                                    <div>
                                        <p>Pay your Ghoori due to Ghoori bank account.</p>

                                        <p>Ghoori Bank Account details:</p>
                                        
                                        <!-- <ul>
                                            <li>Account name <span>: Chorki Limited</span></li>
                                            <li>A/C no <span>: 1131101000000279</span></li>
                                            <li>A/C Type <span>: STD</span></li>
                                            <li>Branch <span>: Progoti Sarani Branch, UCBL</span></li>
                                        </ul> -->

                                        <!-- <p>
                                            <table>
                                                <tr span="2">
                                                    <th>Account name </th>
                                                    <td>: Chorki Limited</td>
                                                </tr>

                                                <tr>
                                                    <th>A/C no </th>
                                                    <td>: 1131101000000279</td>
                                                </tr>

                                                <tr>
                                                    <th>A/C Type </th>
                                                    <td>: STD</td>
                                                </tr>

                                                <tr>
                                                    <th>Branch </th>
                                                    <td>: Progoti Sarani Branch, UCBL</td>
                                                </tr>
                                            </table>
                                        </p> -->


                                        <ul>
                                            <li>
                                                <table>
                                                    <tr>
                                                        <th>Account name </th>
                                                        <td>: Chorki Limited</td>
                                                    </tr>

                                                    <tr>
                                                        <th>A/C no </th>
                                                        <td>: 1131101000000279</td>
                                                    </tr>

                                                    <tr>
                                                        <th>A/C Type </th>
                                                        <td>: STD</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Branch </th>
                                                        <td>: Progoti Sarani Branch, UCBL</td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>

                                        <p>After your payment, send the scan copy of payment slip to Ghoori e-mail address at <b>info@ghoori.com.bd</b>.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>


                    <section class="details_shop ghoori-ad-price" id="ghoori-ad-price"> <!-- Delivery System section -->
                        <h2>Ghoori Ad price</h2><br>
                        <div class="box">
                            <ul>
                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Ghoori eShop Advertisement</a>
                                    <div>
                                        <p>Here are the pricing for shop advertisement:</p>
                                        <table>
                                            <tr>
                                                <th>Ad Place</th>
                                                <th>Pricing</th>
                                                
                                            </tr>
                                            <tr>
                                                <td>Sponsor Shop</td>
                                                <td>99 taka/Day + VAT</td>
                                            </tr>
                                            <tr>
                                                <td>Featured Shop</td>
                                                <td>75 taka/day +VAT</td>
                                            </tr>
                                            <tr>
                                                <td>Verified Shop</td>
                                                <td>199 taka/day + VAT</td>
                                            </tr><br>
                                        </table>
                                        <span>*VAT = 4.5%</span><br><br><br>
                                    </div>
                                    
                                </li>

                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>Product Advertisement</a>
                                    <div>
                                        <p>Here are the pricing your product advertisement:</p>
                                        <table>
                                            <tr>
                                                <th>Ad Place</th>
                                                <th>Pricing</th>
                                                
                                            </tr>
                                            <tr>
                                                <td>Big Slider</td>
                                                <td>399 taka/Day + VAT</td>
                                            </tr>
                                            <tr>
                                                <td>Medium Box</td>
                                                <td>199 taka/day +VAT</td>
                                            </tr>
                                            <tr>
                                                <td>Small Box</td>
                                                <td>99 taka/day + VAT</td>
                                            </tr><br>
                                        </table>
                                        <span>*VAT = 4.5%</span>
                                    </div>
                                </li>

                                <li>
                                    <a href="javascript:"><span class="glyphicon glyphicon-triangle-right"></span>How to do product boost?</a>
                                    <div>
                                        <p>The steps are as follows:</p>
                                        <ul>
                                            <li>Go to ghoori.com.bd</li>
                                            <li>log in to your eShop</li>
                                            <li>Select any product you want to boost and then click Boost button</li>
                                            <li>Select place and group</li>
                                            <li>Post Headline and Description of the product</li>
                                            <li>Select Dates for Boosting</li>
                                            <li>Read the Terms and conditions and Press confirm and <a href="https://ghoori.com.bd/faq#payment-to-ghoori" style="color:#4d90fe" target="_blank">pay</a> through bKash.</b></li>
                                            <li>Now wait for the approval. It would take maximum 24 hours to approve your boost.</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>


                    <!-- <div class="helpful">
                        <p>Was the content of this page helpful to you?</p>
                        <div class="choice">
                             <a href="">Yes</a> <a href="">No</a>
                        </div>
                        <div class="clr"></div>                           
                    </div> -->
                </div>

                <div class="col-sm-4 col-sm-offset-1 right_side">
                    <ul class="sidebar-links">
                        <li>
                            <a href="#get_started"><span class="glyphicon glyphicon-chevron-left"></span>Getting Started</a>
                        </li>
                        <li>
                            <a href="#about_ghoori"><span class="glyphicon glyphicon-chevron-left"></span>About Ghoori</a>
                        </li>
                        <li>
                            <a href="#create_shop"><span class="glyphicon glyphicon-chevron-left"></span>Create Ghoori eShop</a>
                        </li>
                        <li>
                            <a href="#manage_ghoori"><span class="glyphicon glyphicon-chevron-left"></span>Manage Ghoori eShop</a>
                        </li>
                        <li>
                            <a href="#add_product"><span class="glyphicon glyphicon-chevron-left"></span>Add Product</a>
                        </li>
                        <li>
                            <a href="#visit_ghoori"><span class="glyphicon glyphicon-chevron-left"></span>Visit Ghoori</a>
                        </li>




                        <li>
                            <a href="#campaign"><span class="glyphicon glyphicon-chevron-left"></span>Campaign</a>
                        </li>



                        <li>
                            <a href="#pricing"><span class="glyphicon glyphicon-chevron-left"></span>Pricing</a>
                        </li>
                        <li>
                            <a href="#billing"><span class="glyphicon glyphicon-chevron-left"></span>Billing System</a>
                        </li>
                        <li>
                            <a href="#delivery"><span class="glyphicon glyphicon-chevron-left"></span>Delivery Method</a>
                        </li>



                        <li>
                            <a href="#purchase"><span class="glyphicon glyphicon-chevron-left"></span>Purchase Method</a>
                        </li>

                        <li>
                            <a href="#payment-system"><span class="glyphicon glyphicon-chevron-left"></span>Payment</a>
                        </li>



                        <li>
                            <a href="#payment-to-ghoori"><span class="glyphicon glyphicon-chevron-left"></span>Payment to Ghoori</a>
                        </li>




                        <li>
                            <a href="#ghoori-ad-price"><span class="glyphicon glyphicon-chevron-left"></span>Ghoori Ad Price</a>
                        </li>
                    </ul>
                    
                    <a href="{{route('shops.create')}}" class="createShopButton loginButton">
                        <p class="shop_add">
                            <span>Create Your Shop</span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </section>                         
@stop

<!-- @section('home-js')
    
@stop -->