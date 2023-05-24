<!DOCTYPE html>
<html>
<head>
    @yield('title')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="shortcut icon" href="{{route('home')}}/img/favicon.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    {{--CSS files from ghoori--}}
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

    {{--Animation and Sliders--}}
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.0.2/nouislider.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    @yield('slider_css')

    {{--Fonts and Icons--}}
    <link media="all" type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700|Varela+Round">
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    {{--Chorki CSS files--}}
    {{-- <link media="all" type="text/css" rel="stylesheet" href="https://product.chorki.com/css/pages/style.css?v=1.6">
    <link media="all" type="text/css" rel="stylesheet" href="https://product.chorki.com/css/product/style.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://product.chorki.com/css/product/css.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://product.chorki.com/css/product/carousel.css"> --}}
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    {{-- <link media="all" type="text/css" rel="stylesheet" href="https://product.chorki.com/css/product/product.css?v=2.0.1">
    <link media="all" type="text/css" rel="stylesheet" href="https://product.chorki.com/css/styleBondLanding-2.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">
    {{HTML::style('css/magnific-popup.css')}}
    {{--External CSS files--}}
    {{HTML::style('themes/theme_1/css/style-1.css')}}

    {{HTML::style('themes/theme_1/css/responsive.css')}}
    
    @yield('external_css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


    <style>
        #owl-exclusive-product-slider img{
            display: block;
            width: inherit;
            height: 329px;
            width: 100%;
        }

        #owl-exclusive-product-slider {
            width: 100%;
        }
    </style>

</head>


<body>



@include('themes.theme_1._partials.default_header') {{-- Ghoori Default Header --}}


@yield('body_content')


@include('public.shop._partials.footer') {{-- Default Footer --}}





<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
<script src="{{route('home')}}/public/js/shop.js"></script>


<script src="{{route('home')}}/public/js/chorki.js"></script>


<script src="{{route('home')}}/js/cart.js"></script>

{{-- //Animate Modal --}}
<script src="{{route('home')}}/public/js/animatedModal.min.js"></script>



<script src="{{route('home')}}/growl/js/classie.js"></script>
<script src="{{route('home')}}/growl/js/notificationFx.js"></script>

<script src="{{route('home')}}/public/js/fbscript.js"></script>

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









<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.2/owl.carousel.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="https://bfintal.github.io/Counter-Up/jquery.counterup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.0.2/nouislider.min.js"></script>
{{ HTML::script('js/jquery.magnific-popup.min.js') }}
<script src="https://product.chorki.com/js/products/products.js"></script>


<script>
    new WOW().init();
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>

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



{{ HTML::script('themes/theme_1/js/15.js') }}

<script>
    // console.log($('.slider'));
    $('div.sidebar-slider').css('overflow', 'hidden');
    var slider = new Slider( $('div.sidebar-slider ul'), $('div.slider-nav') );



    slider.nav.show().find('.slide-icon').on('click', function() {
        slider.setCurrent( $(this).data('dir') );

        slider.transition();
    });

    console.log(slider.nav);
</script>


{{ HTML::script('themes/theme_1/js/eshop-life.js') }}
{{ HTML::script('themes/theme_1/js/slider-owl-exclusive.js') }}



<script>
    // console.log($('.slider'));
    $('div.sidebar-slider-2').css('overflow', 'hidden');
    var slider2 = new Slider2( $('div.sidebar-slider-2 ul'), $('div.slider-nav-2') );



    slider2.nav.show().find('.slide-icon').on('click', function() {
        slider2.setCurrent( $(this).data('dir') );

        slider2.transition();
    });

    // console.log(slider.nav);
</script>

<a style="position: fixed; z-index: 9;" href="#top" id="scrollUp"><i class="fa fa-angle-up"></i></a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>



<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>


{{ HTML::script('themes/theme_1/js/all-js/jquery-ui.min.js') }}


{{ HTML::script('themes/theme_1/js/category.js') }}






@yield('slider_js')

@yield('external_js')

@yield('cart-js')
@yield('cart-remove')







</body>

</html>