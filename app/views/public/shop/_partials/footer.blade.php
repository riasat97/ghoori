
	<footer>
		@yield('extra-footer')
		<section class="footer-sec-links">
			<div class="container">
				<div class="row">

					<div class="col-sm-12">
						<div class="row">
							<div class="col-xs-12 col-sm-2 footer-sec">
								<a class="footer-logo" href="{{route('home')}}" style="background-image: url('{{asset('img/logo-sprite.png')}}'); background-size:200%"></a>

							</div>
							<div class="col-xs-4 col-sm-5 footer-sec">
								<h4>Links</h4>
										
								<div class="row">
									<div class="col-sm-6">
										<ul>
											<li>{{ link_to_route('about-us','About Us',null,array('class'=>'footer-single-link')) }}</li>
											<li>{{ link_to_route('store.getTerms','Terms of Service',null,array('class'=>'footer-single-link')) }}</li>
										</ul>
									</div>
									<div class="col-sm-6">
										
										<ul>
											<li>{{ link_to_route('store.getPrivacy','Privacy Policy',null,array('class'=>'footer-single-link')) }}</li>
											<li>{{ link_to_route('faq','FAQ',null,array('class'=>'footer-single-link')) }}</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-xs-4 col-sm-3 footer-sec">
								<h4>Stay Connected</h4>
								<ul>
									<li>
										<a class="footer-single-link social-links call" target="_blank" href="tel:+8809612000888"><i class="fa fa-fw fa-phone-square fa-lg"></i> 09612000888</a>
									</li>
									<li>
										<a class="footer-single-link social-links facebook" target="_blank" href="https://www.facebook.com/Ghooribd"><i class="fa fa-fw fa-facebook-square fa-lg"></i> facebook</a>
									</li>
									<li>
										<a class="footer-single-link social-links twitter" target="_blank" href="https://twitter.com/gh00ri"><i class="fa fa-fw fa-twitter-square fa-lg"></i> twitter</a>
									</li>
								</ul>
							</div>
							<div class="col-xs-4 col-sm-2 footer-sec">
								<h4>Powered By</h4>
								<ul>
									<li>
										<a class="blink_logo" target="_blank" href="http://www.banglalink.com.bd">
											<img class="img-responsive" src="{{ asset('img/blink.png') }}">
										</a>
									</li>
								</ul>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		</section>
		<section class="footer-sec-currency">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<a class="card-icons" href="#"><i class="fa fa-fw fa-lg fa-money"></i></a>
						<a class="card-icons" href="#"><i class="fa fa-fw fa-lg fa-credit-card"></i></a>
						<a class="card-icons" href="#"><i class="fa fa-fw fa-lg fa-cc-visa"></i></a>
						<a class="card-icons" href="#"><i class="fa fa-fw fa-lg fa-cc-mastercard"></i> </a>
					</div>
				</div>
			</div>
		</section>
		<section class="footer-sec-chorki">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<a href="https://chorki.com">a <span class="chorki-footer-logo"></span> product</a>
					</div>
				</div>
			</div>				
		</section>
		
	</footer>