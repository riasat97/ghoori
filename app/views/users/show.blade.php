<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>




    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Metatag -->
    <meta property="og:title" content="Demo Theme For SSD-Tech" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Responsive eCommerce Template" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    {{HTML::style('public/css/font.css')}}
    {{HTML::style('public/css/stylenew.css')}}
    @include('_partials.globalstyles')
    <!-- Favicon -->
    <link rel="icon" href="img/hsfavicon.png">

    <!-- =========== -->
    <!-- Google Font -->
    <!-- =========== -->

    <script type="text/javascript">

        // Add Google Font name here

        WebFontConfig = { google: { families: [ 'Bangers', 'Lato' ] } };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();

    </script>

    <style type="text/css">

        /* Add Google Font name here */

        .wf-active {font-family: 'Lato',serif; font-size: 14px;}
        .wf-active .logo {font-family: 'Bangers', serif;}

    </style>






    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
</head>







<body class="wf-active">
@include('public.shop._partials.header')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <h1>Welcome {{{ Auth::user()->name  }}}</h1>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    Profile page
</div>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
{{ HTML::script('public/js/shop.js') }}


@include('public.shop._partials.footer')
@include('_partials.globalscripts')
</body>
</html>