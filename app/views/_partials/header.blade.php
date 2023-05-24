<nav class="navbar navbar-ghoori-main navbar-default navbar-fixed-top navbar-fat">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand chorki-nav-logo" href="{{route('home')}}">{{HTML::image('img/55_double.png')}}</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-left" action="{{route('search')}}">

                <div class="input-group input-group-lg gh-input-group-search">
                  <input type="text" class="form-control search_input " placeholder="Search" id="nav_serach_bar" name="q" value="{{{Input::get('q')}}}">
                  <span class="input-group-btn group-btn_search">
                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
                  </span>
                </div><!-- /input-group -->
            </form>
            <ul class="nav navbar-nav navbar-right ch-nav-menugroup">
                <li><a class="" href="{{URL::route('home')}}"><i class="fa fa-home"></i>Home</a></li>
                <li>
                    @if(Auth::user()&&($shop= Auth::user()->shop))
                        <a href="{{URL::route('shops.show',$shop->getSlug(),array('class'=>'myShopButton'))}}">My Shop @if (!empty($ordersCount))
                            <span class="label label-as-badge label-danger">{{$ordersCount}}</span>
                            @endif
                        </a>
                    @else
                        {{-- <a id="createShopBtn" class="createShopButton" href="{{URL::route('login.show')}}?redirectUrl={{ urlencode( URL::route('shops.create') )}}">Create Your Shop</a> --}}
                        <a href="{{URL::route('pricing')}}">Create <span class="hidden-xs hidden-sm hidden-md">Your</span> Shop</a>
                    @endif
                </li>
                @if(Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ Gravatar::imageURL( Auth::user()->email, 24 ) }}" class="profile-pic-head"> <span class="user-name">{{ explode(' ', Auth::user()->name)[0] }} <span class="caret"></span> </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>{{ link_to_route('orders.myOrder','My Orders',null,array('class'=>'')) }}</li>

                            <li role="separator" class="divider"></li>
                            <li>{{ link_to_route('user.settings','Settings',null,array('class'=>'')) }}</li>
                            {{-- <li class="dropdown-header">Nav header</li> --}}
                            <li>{{ link_to_route('logout','Logout',null,array('class'=>'btn-log-out-head')) }}</li>
                        </ul>
                      </li>
                @else
                    <li>
                        <a class="user-menu" href="{{URL::route('login.show')}}?redirectUrl={{ urlencode( URL::current() )}}"><img src="{{ Gravatar::imageURL( '', 24 ) }}" class="profile-pic-head"> <span class="user-name">Login</span></a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>

{{Form::open(array('id'=>'fbForm', 'style' => 'display:none'))}}
{{Form::hidden('fbAppId' , Config::get('facebook.appId') )}}
{{Form::hidden('ajaxLoginUrl' , URL::route('ajaxFbLogin') )}}
{{Form::hidden('loginStatusUrl' , URL::route('userLoginStatus') )}}
{{Form::hidden('permissions', implode(' , ' , Config::get('facebook.permissions')))}}
{{Form::hidden('redirectUrl' , Input::get('redirectUrl') )}}
{{Form::close()}}

<!-- Sign In Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body login-modal">
                <div class="row">
                    <div class="col-xs-6 col-lg-6">
                        <div id="logoHolder">
                            <img class="logo" src="{{ asset('img/logo-white.png') }}" width="140px" alt=""/>
                            <img class="ghoori-flying" src="{{ asset('img/ghoori-flying-white.png') }}">
                        </div>
                    </div>
                    <div class="col-xs-6 col-lg-6" id="fb-button-holder">
                        <div>
                            <a class="btn btn-primary fbLoginButton fbLoginButtoninmodal" href=""><i class="fa fa-facebook fa-fw"></i> Login with facebook</a>
                        </div>
                        <div>
                            <a class="btn btn-warning emailloginbutton" data-orig-url="{{URL::route('login.show')}}" href="{{URL::route('login.show')}}?redirectUrl={{ urlencode( URL::current() )}}"><i class="fa fa-envelope fa-fw"></i> Login with email</a>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>