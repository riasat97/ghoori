<nav class="navbar navbar-default navbar-ghoori-info">
    <div class="container">
        <ul class="nav navbar-nav navbar-left nav-info-items">
            <li class=""><a href="tel:+8809612000888"><i class="fa fa-phone phone-icon"></i>09612000888</a></li>
	    	<li class=""><a href="mailto:info@ghoori.com.bd"><i class="fa fa-envelope mail-icon"></i>info@ghoori.com.bd</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right nav-link-items">
            <li><a href="{{ URL::route('market')  }}"><i class="fa fa-shopping-bag marketplace-icon"></i>Marketplace</a></li>

            @if(Auth::user()&&($shop= Auth::user()->shop))
                <li>
                    <a href="{{URL::route('shops.show',$shop->getSlug(),array('class'=>'myShopButton'))}}">
                        My Shop
                        @if (!empty($ordersCount))
                            <span class="label label-as-badge label-danger">{{$ordersCount}}</span>
                        @endif
                    </a>
                </li>

                <li>{{ link_to_route('logout','Logout',null,array('class'=>'btn-log-out-head')) }}</li>

                @else
                    <li>
                        {{--<a class="user-menu" href="{{URL::route('login.show')}}?redirectUrl={{ urlencode( URL::current() )}}"><img src="{{ Gravatar::imageURL( '', 24 ) }}" class="profile-pic-head"> <span class="user-name">Login</span></a>--}}
                        <a class="user-menu" href="{{URL::route('login.show')}}?redirectUrl={{ urlencode( URL::current() )}}"><span class="user-name">Login</span></a>
                    </li>
                @endif
            </ul>
	    </div><!-- /.container-fluid -->
	</nav>

	<nav class="navbar navbar-default navbar-ghoori-main">
	    <div class="container">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="{{ URL::route('market')  }}"><img src="{{asset('img/home/noya/ghoori.svg')}}"></a>
	        </div>

	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <form class="navbar-form navbar-right" role="search" action="{{route('search')}}">

                    <div class="input-group">
                        <input type="text" class="form-control search" placeholder="Search Products" id="" name="q" value="{{{Input::get('q')}}}">
                    </div><!-- /input-group -->
                </form>

	            {{--<form class="navbar-form navbar-right" role="search">--}}
			        {{--<div class="form-group">--}}
			            {{--<input type="text" class="form-control search" placeholder="Search">--}}
			        {{--</div>--}}
			        <!-- <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> -->
                {{--</form>--}}
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a href="{{ route('home',null,array('class'=>'current', 'id'=>'shops-link')) }}"><i class="fa fa-home"></i> Home </a></li>
                    <li class="" id="shops-link"><a href="{{route('store.index')}}">Shops</a></li>
                    @if(Auth::user()&&($shop = Auth::user()->shop))
                        {{-- link_to_route('shops.show','My Shop',$shop->getSlug(),array('class'=>'', 'id'=>'my-shop-link')) --}}
                    @else
                        <li id="get-started-link"><a href="{{ route('store.getStarted', null) }}">Get Started</a></li>
                    @endif
                    <li id="pricing-link"><a href="{{ route('pricing', null) }}">Pricing</a></li>
                    <li id="faq-link"><a href="{{route('faq')}}">FAQ</a></li>
                </ul>
	        </div><!-- /.navbar-collapse -->
	    </div><!-- /.container-fluid -->
	</nav>
