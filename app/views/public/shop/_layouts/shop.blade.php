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
  <!--  <link rel="stylesheet" href="bootstrap3/css/font-awesome.min.css" />-->
    <!-- This style is specific for modal -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
    @yield('order-css')
    {{HTML::style('css/css.css')}}
    {{HTML::style('public/css/font.css')}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
    {{HTML::style('public/css/stylenew.css')}}
    {{HTML::style('public/css/chorki.css')}}
    {{HTML::style('css/formstyle.css') }}
    {{HTML::style('css/form_style.css') }}
    
    {{HTML::style('css/magnific-popup.css')}}
    {{ HTML::style('css/printstyle.css', array('media' => 'print')) }}
    @include('_partials.globalstyles')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">
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

     /*   .wf-active {font-family: 'Lato',sans-serif; font-size: 14px;}
        .wf-active .logo {font-family: 'Bangers', serif;}
*/
    </style>

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE 7]>
    <![endif]-->

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

<!-- =========== -->
<!-- Top section -->
<!-- =========== -->
<div class="body_main">
@include('public.shop._partials.header')
@yield('banner')
@yield('header')

<div class="container">
@include('flash')
    <!-- ================ -->
    <!-- Products section -->
    <!-- ================ -->
    
    <section class="product">
        <div class="row">
            <header class="col-xs-12 prime">
                <!-- <p><a href="index.html">Home</a> &#9656; <a href="product.html">Mens</a> &#9656; T-Shirts</p> -->
                <h2>@yield('title')</h2>
              <?php /*
                    {{--  <label style="display: block;" class="cd-label" id="category-tree">
                    <span id="catspan">{{$product->category_id}}</span>
                    <i class="fa fa-angle-right"></i>
                    <span id="subcatspan">{{$product->subcategory_id}}</span>
                    <i class="fa fa-angle-right"></i>
                    <span id="subsubcatspan">{{$product->subSubCategory_id}}</span>
                </label>--}}
              */?>
            </header>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @include('public.shop._partials.sidebar')
                @include('_layouts.errors')
            @yield('content')
            </div>
                


        </div>
    </section>

</div>
</div>

<!-- ============== -->
<!-- Footer section -->
<!-- ============== -->

@include('public.shop._partials.footer')

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
{{ HTML::script('public/js/shop.js') }}
{{ HTML::script('public/js/script.js') }}
{{ HTML::script('public/js/chorki.js') }}
{{ HTML::script('js/sliding.form.js') }}
<!-- Animate Modal -->
{{ HTML::script('public/js/animatedModal.min.js') }}
@include('_partials.globalscripts')
{{ HTML::script('js/jquery.magnific-popup.min.js') }}
{{ HTML::script('js/cart.js') }}
{{--@include('_partials.cart')--}}
<script>

    $(document).ready(function() {
      $('.product-image-link').magnificPopup({
          type: 'image',
          mainClass: 'mfp-with-zoom', // this class is for CSS animation below

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
@yield('cart-js')
@yield('cart-remove')
@yield('order-js')
@if (App::environment() == 'production') @include('analytics') @endif
</body>
</html>