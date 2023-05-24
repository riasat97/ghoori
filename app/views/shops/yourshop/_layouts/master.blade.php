<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Metatag -->
    @yield('metatags')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">

    {{HTML::style('public/css/font.css')}}
    {{HTML::style('public/css/stylenew.css')}}
    {{HTML::style('public/css/chorki.css')}}
    <!-- This style is specific for form -->
    {{HTML::style('css/form_style.css')}}
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'> -->

    <!-- This style is specific for my shop -->
    {{HTML::style('css/my_shop.css')}}
    <!-- This style is specific for modal -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
    
    {{HTML::style('css/magnific-popup.css')}}

    <!-- This style is specific for my pagination -->
    {{HTML::style('css/pagination.css')}}
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">
    @yield('css')
    <!-- =========== -->
    <!-- Google Font -->
    <!-- =========== -->
    <script type="text/javascript">

        // Add Google Font name here

        // WebFontConfig = { google: { families: [ 'Bangers', 'Lato' ] } };
        // (function() {
        //     var wf = document.createElement('script');
        //     wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        //     '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        //     wf.type = 'text/javascript';
        //     wf.async = 'true';
        //     var s = document.getElementsByTagName('script')[0];
        //     s.parentNode.insertBefore(wf, s);
        // })();
    </script>
    <style type="text/css">
        /* Add Google Font name here */
        /*.wf-active {font-family: 'Lato',sans-serif; font-size: 14px;}
        .wf-active .logo {font-family: 'Bangers', serif;}*/
    </style>
    @include('_partials.globalstyles')
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/ie7.css" />
    <![endif]-->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

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
<body class="wf-active">
<div class="loader-wrap">
    <div class="loader">
        <img class="wheeler" src="{{asset('img/wheels.png')}}">
    </div>
</div>
<div class="body_main">
    <!-- =========== -->
    <!-- Top section -->
    <!-- =========== -->
    <!-- <div class="header-container">
        <header>

        </header>
    </div> -->
    @include('_partials.header')
    <div class="container">
        <div class="mt68">
            
                {{--logo/banner/address view goes here--}}
            @yield('header')
            @include('flash')
            {{--main content goes here--}}
            <div class="row shop-content">
                @yield('content')
                <div class="clearfix"></div>
            </div>

            <!-- pagination -->
            <!-- @include('shops.myshop._partials.pagination') -->
            <!-- category selector modal -->
        </div>
        


    </div>
</div>
<!-- ============== -->
<!-- Footer section -->
<!-- ============== -->
@include('public.shop._partials.footer')
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
    {{ HTML::script('js/jquery.magnific-popup.min.js') }}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/elevatezoom/3.0.8/jqueryElevateZoom.js"></script>
    {{ HTML::script('public/js/shop.js') }}
    {{ HTML::script('public/js/script.js')}}
    {{ HTML::script('public/js/chorki.js') }}
@show
        <!-- Product Gallery -->
{{ HTML::script('public/js/productsgallery.js') }}
@include('_partials.globalscripts')

{{--@include('_partials.cart')--}}
<script>

    $(document).ready(function() {
      $('.product-image-link').magnificPopup({
          type: 'image',
          mainClass: 'mfp-with-zoom', // this class is for CSS animation below
          gallery:{
            enabled:true
          },
          zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function 

            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
              // openerElement is the element on which popup was initialized, in this case its <a> tag
              // you don't need to add "opener" option if this code matches your needs, it's defailt one.
              return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
          }

      });
    });
</script>
{{ HTML::script('js/cart.js') }}

@yield('cart-js')
@yield('cart-remove')
@yield('page-specific-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if ($('.mdtextraw').length > 0) {
            var mdtohtml = marked( $('.mdtextraw').val(), {  
              breaks: true          
            });
            $('.markdowntext').html(mdtohtml);
            $('.mdtextraw').remove();
        }
        
    })
</script>
@if (App::environment() == 'production') @include('analytics') @endif
</body>
</html>