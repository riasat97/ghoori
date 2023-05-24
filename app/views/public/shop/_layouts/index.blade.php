<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('metatags')
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    {{HTML::style('public/css/font.css')}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
    {{HTML::style('public/css/stylenew.css')}}
    {{HTML::style('public/css/chorki.css')}}
    {{HTML::style('css/info.css')}}
    {{HTML::style('css/terms.css')}}
    {{HTML::style('css/features.css')}}
    <!-- This style is specific for form -->
    {{HTML::style('css/form_style.css')}}
    @yield('staticpagestyles')
    @include('_partials.globalstyles')
    @yield('homeCss')
    @yield('page-specific-css')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <title>@yield('title')</title>
    @if (App::environment() == 'production') @yield('cookiejarconversion') @endif

@if (App::environment() == 'production')
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '807173902734072');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=807173902734072&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

@endif

</head>
<body>

    <div class="body_main">

        @include('public.shop._partials.header')

        @if ( Auth::user() && false ) {{-- @todo if user is logged in and do not have a password --}}
        <div class="alert alert-info alert-dismissible fade in quick-banner" role="alert">
          <div class="container">
              <div class="row">
                  <div class="col-xs-12">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Hello {{ Auth::user()->name }}!</strong> Now you can login using your email address and password. Set your password here from your <a href="{{route('user.settings')}}">"Settings"</a>.
                  </div>
              </div>
          </div>
        </div>
        @endif
        
        @yield('info')
        @yield('terms')
        @yield('privacy')
        @yield('features')
        @yield('aboutus')
        @yield('static')

        @yield('photography')

        <div class="container-fluid">
            <!-- Example row of columns -->
            <div class="row">
                @yield('content')
            </div>

            <!-- <hr> -->
        </div> <!-- /container -->

    </div>


    @include('public.shop._partials.footer')

    @section('jquery')
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    @show
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
    {{ HTML::script('public/js/shop.js') }}
    {{ HTML::script('public/js/script.js') }}
    {{ HTML::script('public/js/chorki.js') }}
    {{ HTML::script('js/features.js') }}
    {{ HTML::script('js/cart.js') }}
    <!-- Animate Modal -->
    {{ HTML::script('public/js/animatedModal.min.js') }}
    @yield('cart-js')
    @yield('cart-remove')
    @yield('staticpagescripts')
    @yield('home-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#callContactModal").animatedModal({
                modalTarget:'animatedModalContact',
                'color': '#fff'
            });
        });
    </script>
    @include('_partials.globalscripts')
    @yield('page-specific-js')
    @if (App::environment() == 'production') @include('analytics') @endif
</body>
</html>