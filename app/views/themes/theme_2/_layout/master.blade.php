<!DOCTYPE html>
<html>
<head>
    @yield('title')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Metatag -->
    @yield('metatags')

    <link rel="shortcut icon" href="{{route('home')}}/img/favicon.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Fonts and Icons -->
    <link media="all" type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700|Varela+Round">
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- CSS files from ghoori -->
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/public/css/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/public/css/stylenew.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/public/css/chorki.css">

    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/css/form_style.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/growl/css/ns-default.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/growl/css/ns-style-growl.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/css/checkout-boxes.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/css/style.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/homepage/css/slide.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{route('home')}}/homepage/css/home.css">

    <!-- Animation and Sliders -->
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.0.2/nouislider.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">



    <!-- This style is specific for my shop -->
    {{HTML::style('css/my_shop.css')}}


    <!-- External CSS Files -->
    {{HTML::style('themes/theme_2/css/main.css')}}
    {{HTML::style('themes/theme_2/css/slider.css')}}
    {{----}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


    {{--Related Css Files--}}
    @yield('homePage_css_files')

    @yield('dhumketu_productPage_css_files')
    @yield('dhumketu_homePage_css_files')

    @yield('homePage_bannerSlider_js_files')

    @yield('related_product_css')

    @yield('shop-tab')

    @yield('dhumketu-theme-css')

    {{--@yield('flexslider-preorder')--}}

    {{--{{ HTML::script('themes/theme_2/js/_partials/bannerSlider.js') }}--}}

</head>


<body class="dhumketu-theme">


<!-- Global Header -->
@include('_partials.header') {{-- Ghoori Default Header --}}






@yield('dhumketu_home_body_content')

@yield('tab-content')

@yield('preorder-content')

@yield('dhumketu_product_body_content')





@include('public.shop._partials.footer') {{-- Default Footer --}}





<!-- JQuery CDN -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->


<!-- JS version for Bootstrap -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->



<!-- JS files from Ghoori -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
{{ HTML::script('public/js/shop.js') }}
{{ HTML::script('public/js/chorki.js') }}
{{ HTML::script('js/cart.js') }}


<!-- Animate Modal -->
{{ HTML::script('public/js/animatedModal.min.js') }}

<!-- JS files from Ghoori -->
{{ HTML::script('growl/js/classie.js') }}
{{ HTML::script('growl/js/notificationFx.js') }}
{{ HTML::script('public/js/fbscript.js') }}




<!-- Ghoori JS for Placing Comma with Price -->
<script type="text/javascript">
    function renderPriceWithCommas() {
        $( ".pricewithcomma" ).each(function( index ) {
            var x = $( this ).text();
            $( this ).text(addCommas(x));
        });
    }

    function addCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    function removeCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(",", "");
        return parts.join(".");
    }

    $(function () {
        renderPriceWithCommas();
    });
</script>



<!-- Load Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.js"></script>


<!-- Load WOW JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<!-- Initialize wow -->
<script>
    new WOW().init();
</script>


<!-- Necessary JS Files for Massonry -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>

<!-- Custom JS for Massonry Implementation -->
<!-- <script src="public/themes/theme_1/js/_partials/product_masonry.js"></script> -->
<!-- or -->
<script>
    var $boxes = $('.grid-item');
    $boxes.hide();

    var $container = $('.grid');
    $container.imagesLoaded( function() {
    $boxes.fadeIn();

    $grid = $container.masonry({
        itemSelector : '.grid-item',
        columnWidth  : '.grid-item'
    });    
  });
    
</script>

<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.lazyload/1.8.4/jquery.lazyload.js"></script>


@yield('dhumketu_productPage_js_files')


{{ HTML::script('themes/theme_2/js/_partials/bootstrap-slider.js') }}
{{ HTML::script('themes/theme_2/js/_partials/custom.js') }}


@yield('dhumketu-theme-js')

@yield('page-specific-js')

@yield('cart-js')
@yield('cart-remove')
</body>

</html>