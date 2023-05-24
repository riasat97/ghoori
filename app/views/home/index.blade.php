@extends('home._layouts.master')
@section('title')
    Ghoori
@stop

@section('metatags')
    <meta property="og:title" content="Open #eShop at Ghoori" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('home')}}" />
    <meta property="og:description" content="Ghoori is an ecommerce platform where you can start your business any day and effortlessly. Email us at info@ghoori.com.bd for details." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/ghoori_post_og.jpg')}}" />

    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop

@section('content')

<section class="home_sec home_sec_hero ghoori_toon ghoori_blue">
	
	<div class="nav_wrapper">
		@include('home._partials.navbar')
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-4">
				
			</div>
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-8">
				<div class="text-center home_sec_content">
					<h3>Take Your Business Wherever You Go.</h3>
					{{--<p>Create Your Online Store Today. 15 Days Free Trial.</p>--}}
					{{--<div class="ghoori_form_box">--}}
						{{--<form>--}}
							{{--<div class="form-inline">--}}
							  {{--<div class="form-group">--}}
							    {{--<label class="sr-only" for="name_field">Full Name</label>--}}
							    {{--<input type="text" class="form-control" id="name_field" placeholder="Full Name">--}}
							  {{--</div>--}}
							  {{--<div class="form-group">--}}
							    {{--<label class="sr-only" for="emailid_field">Email ID</label>--}}
							    {{--<input type="email" class="form-control" id="emailid_field" placeholder="Email ID">--}}
							  {{--</div>--}}
							  {{--<div class="form-group">--}}
							    {{--<label class="sr-only" for="phone_field">Phone</label>--}}
							    {{--<input type="phone" class="form-control" id="phone_field" placeholder="Phone">--}}
							  {{--</div>--}}
							{{--</div>--}}
							{{--<div class="button_wrap">--}}
								{{--<button class="btn btn-lg btn_home_primary">Start Your Free Trial</button>--}}
							{{--</div>--}}
						{{--</form>--}}
					{{--</div>--}}
                    <div class="form-group ghoori_form_box">
                        {{-- Form::open(array('route' => 'pricing','method' => 'get', 'class' => 'loginBeforeSubmitForm form-inline getting-started-form','data-remote', 'data-remote-success-message'=>'Well done!')) --}}
                        {{ Form::open(array('route' => 'pricing','method' => 'get', 'class' => 'getting-started-form','data-remote', 'data-remote-success-message'=>'Well done!')) }}
                        <div class="form-inline">
                            {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>"Full Name", 'id' => 'subscriber-name', 'required' => 'required')) }}

                            {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>"Email ID", 'id' => 'subscriber-email', 'required' => 'required')) }}

                            {{ Form::text('mobile', null, array('class'=>'form-control', 'placeholder'=>"Phone", 'id' => 'subscriber-mobile', 'required' => 'required')) }}
                        </div>

                        <div class="button_wrap">
                            {{ Form::submit('Start Now !!!', array('class'=>'btn btn-lg btn_home_primary')) }}
                            {{--<button class="btn btn-lg btn_home_primary">Start Your Free Trial</button>--}}
                        </div>

                        {{ Form::close() }}

                    </div>
					{{--<p class="sign_up_link"><a href="#">Signup for free</a></p>--}}
				</div>
			</div>
		</div>
	</div>

</section>
<section class="home_sec package_sec">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<header class="sec_header"><h1 class="sec_title">Our Packages</h1></header>
				@include('home._partials.prices', array('some' => 'data'))
			</div>
		</div>
	</div>
	
	<img src="{{ asset('img/home/noya/pointer.png') }}"  class="the_pointer hidden-xs">
</section>
<section class="home_sec offers_sec">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<header class="sec_header"><h1 class="sec_title">Finally an eCommerce Solution That Offers You Everything</h1></header>
				<div class="row">
					<div class="col-sm-4">
						<div class="row">
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_left">
									<div class="feature_icon"><i class="fa fa-shopping-cart"></i></div>
								Stunning Online Store Theme</div>
							</div>
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_left">
									<div class="feature_icon"><i class="fa fa-facebook"></i></div>
								fShop Button</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_left">
									<div class="feature_icon"><i class="fa fa-archive"></i></div>
								Product Management</div>
							</div>
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_left">
									<div class="feature_icon"><i class="fa fa-truck"></i></div>
								Delivery & Inventory Management</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="feature_map"><img class="img-responsive" src="{{asset('img/home/noya/datamap.png')}}"></div>
					</div>
					<div class="col-sm-4">
						<div class="row">
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_right">
									<div class="feature_icon"><i class="fa fa-credit-card"></i></div>
								Multiple Payment Option</div>
							</div>
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_right">
									<div class="feature_icon"><i class="fa fa-bullhorn"></i></div>
								Marketing</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_right">
									<div class="feature_icon"><i class="fa fa-bar-chart"></i></div>
								Reporting & Analysis</div>
							</div>
							<div class="col-xs-6 col-sm-12">
								<div class="bullet_features bullet_on_right">
									<div class="feature_icon"><i class="preorder-icon"></i></div>
								Pre Order</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="home_sec ownsite_sec ghoori_light_grey">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<header class="sec_header">
					<h1 class="sec_title">Create Your Own Website</h1>
					<p class="sub_head">Find out how Ghoori will provide the best platform for your shop</p>
				</header>
				<div class="row">
					<div class="col-sm-6">
						<div class="text-center macbook_wrap">
							<img class="img-responsive macbook" src="{{asset('img/home/noya/laptop.png')}}" alt="">
                            {{--<img class="img-responsive macbook" src="{{asset('img/home/noya/ipad.png')}}" alt="">--}}
							<a href="https://www.youtube.com/watch?v=bdX7TwFdiwQ" class="inside_play_button"><i class="fa fa-play"></i></a>
						</div>
					</div>
					<div class="col-sm-6 text-center">
						<header>
							<h2>Ghoori</h2>
							<h4>Ghoori is the first ever complete e-Commerce platform of Bangladesh.</h4>
						</header>
						<p>Ghoori is the first ever complete e-Commerce platform of Bangladesh. Here merchants can start e-business effortlessly from anywhere. Ghoori is the place where you can build your own brand with a painless ecommerce platform. In Bangladesh market, it is a game changer in e-com industry. Also, it is the place where customers can search their desired products, compare those and purchase at convenience.
                            Ghoori stands for the freedom and entrepreneurship. It is the platform for entrepreneurs to open their road of independence.
                        </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="home_sec ownsite_sec extra-padding-top-90">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				{{--<header class="sec_header">--}}
					{{--<h1 class="sec_title">Create Your Own Website</h1>--}}
					{{--<p class="sub_head">Find out how Ghoori will provide best platform for you shop</p>--}}
				{{--</header>--}}
				<div class="row">
					<div class="col-sm-6 text-center static-position">
						<div class="start-ownsite-info-sec">
                            <header>
                                {{--<h2>ঘুড়ি</h2>--}}
                                {{--<h4>দেশের একমাত্র সম্পূর্ণ ই-কমার্স প্ল্যাটফর্ম</h4>--}}
                                <h2>Ghoori: Start Your eCommerce Business Today</h2>
                            </header>
                            <p>The way we buy things has changed. Your customers are shopping online, in person, on mobile devices, and with social media. Reach them all with one platform.</p>
                            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum semper nulla et mauris commodo pretium. Praesent eu ipsum at neque ullamcorper finibus sit amet a massa. Proin pharetra sapien non lacinia congue. Cras facilisis velit ac lacus tempor congue volutpat eget metus.</p>--}}
                        </div>
					</div>
					<div class="col-sm-6">
						<div class="text-center ipad_wrap">
							<img class="img-responsive macbook" src="{{asset('img/home/noya/tab.png')}}" alt="">
							<a href="https://www.youtube.com/watch?v=pprWFN94rx0" class="inside_play_button"><i class="fa fa-play"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="home_sec mob_biz_sec ghoori_rose_gold">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 stunning-info-block pull-right">
                <header class="sec_header">
                    <h1 class="sec_title">Stunning Online Store</h1>
                    <!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
                </header>
                <p>Ghoori eShop gives the opportunity to open your own online shop with own shop URL. You don’t need a designer to create a stunning online store anymore. Ghoori already has lots of beautiful themes and you can choose your theme which will reflect your brand and business type. In order to install these themes in your Ghoori website you don’t need to possess any technical knowledge, it is the single most flexible process to have a proper website design for your website and launch it to the world.</p>
			</div>

            <div class="col-sm-6 stunning-img-block pull-left">
                <img class="img-responsive center-block" src="{{ asset('img/home/noya/mobile-shopping-retro-design.jpg') }}" alt=""/>
            </div>
		</div>
	</div>
</section>
<section class="home_sec facebook_sec ghoori_facebook">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<header class="sec_header facebook-shop-info-sec">
					<h1 class="sec_title">fShop Button</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
				<p>fShop button allows you to have a fully integrated store on your Facebook page. Customers can easily browse your products and collections using the new, always visible, shop section on your Facebook Page. Add your products to Facebook with just few clicks. Product details, images, and inventory automatically sync as soon as you make an update in Ghoori. This fShop button will help you to spark a conversation with your desired customers on Facebook with the most hassle free process.</p>
			</div>
			<div class="col-sm-6">
			<img class="img-responsive center-block facebook-shop-img" src="{{ asset('img/home/noya/facebook.png') }}">
			</div>
		</div>
	</div>
</section>
<section class="home_sec prod_mang_sec ghoori_lite_blue">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="sec_hero sec_hero_half">
					<img class="img-responsive center-block lite-blue-img" src="{{ asset('img/home/noya/shirt-rocket.png') }}">
				</div>
				
			</div>
			<div class="col-sm-6 static-position">
				<header class="sec_header lite-blue-info-sec">
					<h1 class="sec_title">Product Boosting</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
				<p>Ghoori brings a unique opportunity for the Ghoori merchants to boost their products or services to the millions. Through Ghoori’s product boosting feature Ghoori merchants has the option to promote their product in all the top portal from Bangladesh and many more. This feature will boost your product visibility as well as increase the brand value accordingly.</p>
			</div>
		</div>
	</div>
</section>
<section class="home_sec delivery_sec ghoori_light_grey">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<header class="sec_header">
					<h1 class="sec_title">Delivery & Inventory Management</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
				<p>Shipping is no more a hassle for you. Ghoori offers you a complete automate shipping solution through which you can ship anywhere in Bangladesh using Bangladesh’s best courier companies, at affordable pricing. You will be notify through SMS and e-mail in different steps of the shipping. Also, you can integrate your own delivery channel in Ghoori system if you like to.

                    Manage your entire inventory with Ghoori. Track stock counts and automatically stop selling products when inventory runs out.
                </p>
			</div>
			<div class="col-sm-6">
				<img class="img-responsive center-block delivery-img" src="{{ asset('img/home/noya/delivery.png') }}">
			</div>
		</div>
	</div>
</section>
<section class="home_sec delivery_sec ghoori_blue product-management-sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 static-position">
				<img class="img-responsive center-block" src="{{ asset('img/home/noya/marketing.png') }}">
			</div>
			<div class="col-sm-6">
				<header class="sec_header">
					<h1 class="sec_title">Product Management</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
				<p>Ghoori eShop will allow to manage the products in the most organized way. A Ghoori merchant will enjoy an advance cart management system, product billing process etc. Also, Ghoori has a flexible and advanced coupon and discount management system which will allow Ghoori merchants to run their own campaigns anytime they want.</p>
			</div>
		</div>
	</div>
</section>
<section class="home_sec analysis_sec ghoori_rose_gold">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 static-position">
				<header class="sec_header">
					<h1 class="sec_title">Reporting & Analysis</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
				<p>Ghoori has the most advanced reporting system. With the help of Chorki.com, Ghoori has the advantage to provide high level industry analytics and information. This analysis will help you to understand the market requirement, trend in proper manner. These reporting and analysis from Ghoori will help you to have an insight on the growth of your business.</p>
			</div>
			<div class="col-sm-6">
                <img class="img-responsive center-block analytics-img" src="{{ asset('img/home/noya/report.png') }}">
			</div>
		</div>
	</div>
</section>
<section class="home_sec payment_sec ghoori_grey payment-sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<img class="img-responsive center-block" src="{{ asset('img/home/noya/payment.png') }}">
			</div>
			<div class="col-sm-6">
				<header class="sec_header">
					<h1 class="sec_title">Multiple Payment Options</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
				<p>Whatever payment mood your customers are willing to use to pay, your Ghoori eShop is ready to take that. One merchant is allowed to take multiple payment options in his Ghoori eShop. This will make customer’s life more convenient in order to purchase a product from your Ghoori eShop.</p>
			</div>
		</div>
	</div>
</section>
<section class="home_sec prebook_sec ghoori_purple">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 static-position">
				<header class="sec_header">
					<h1 class="sec_title">Pre-Booking</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
				<p>If you like to sell your product before if it is even released then Ghoori offers you to use the pre-booking feature. By using this feature you can take pre orders from your customers and deliver that when the product will available.</p>
			</div>
			<div class="col-sm-6">
                <img class="img-responsive center-block prebook_sec_img pre-book-img" src="{{ asset('img/home/noya/prebooking.png') }}">
			</div>
		</div>
	</div>
</section>
<section class="home_sec_flex ghoori_light_grey">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<header class="sec_header">
					<h1 class="sec_title">Ghoori Featured Shops</h1>
					<!-- <p class="sub_head">Find out how Ghoori will provide best platform for you shop</p> -->
				</header>
			</div>
			<div class="col-xs-12">
				<!-- Place somewhere in the <body> of your page -->
				<div class="flexslider">
				  <ul class="slides">
				    <li class="shop-slide">
					    <a class="shop-slide-link" href="https://ontorbash.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_582/logos/1454565045.jpg">
					        <!-- <div class="shop-name">Ontorbash</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://exclusive.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_1453/logos/1452575968.jpg">
					        <!-- <div class="shop-name">BDExclusive</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://bestdeal24x7.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_1555/logos/1454238957.jpg">
					        <!-- <div class="shop-name">Bestdeal24x7.com</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://meilleurdeco.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_1340/logos/1448779430.jpg">
					        <!-- <div class="shop-name">MEILLEUR DECO</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://estilo.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_1277/logos/1447558668.jpg">
					        <!-- <div class="shop-name">estilo</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://eshop.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_235/logos/1447079660.jpg">
					        <!-- <div class="shop-name">eshop.life</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://canvasbd.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_1101/logos/1454226031.jpg">
					        <!-- <div class="shop-name">canvas bangladesh</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://jolrong.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_202/logos/1440573041.jpg">
					        <!-- <div class="shop-name">Gallery Jolrong</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://malaysia-products.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_49/logos/1438411199.jpg">
					        <!-- <div class="shop-name">Malaysia products</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://futureshop.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_537/logos/1452358265.jpg">
					        <!-- <div class="shop-name">Future Shop</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://dhakarosarium.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_72/logos/1441705202.jpg">
					        <!-- <div class="shop-name">Dhaka Rosarium</div> -->
					    </a>
					</li>

					<li class="shop-slide">
					    <a class="shop-slide-link" href="https://azreensfashion.ghoori.com.bd">
					        <img class="shop-logo" alt="" src="https://ghoori.com.bd/public_img/shop_125/logos/1438354985.jpg">
					        <!-- <div class="shop-name">Azreen's Fashion</div> -->
					    </a>
					</li>
				    <!-- items mirrored twice, total of 12 -->
				  </ul>
				</div>
			</div>
		</div>
	</div>
</section>
@stop
