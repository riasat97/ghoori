<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    {{--  <link rel="stylesheet" href="bootstrap3/css/font-awesome.min.css" />--}}
    {{HTML::style('public/css/font.css')}}
    {{HTML::style('public/css/stylenew.css')}}
    {{HTML::style('public/css/chorki.css')}}
    {{HTML::style('css/info.css')}}
    {{HTML::style('css/terms.css')}}
    @include('_partials.globalstyles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <title>Unauthorized Access</title>
</head>
<body>
<div class="body_main">
    @include('public.shop._partials.header')

    <div class="container">
        <h1>401</h1>
        <h2>Unauthorized access</h2>
        <h3>{{$message}}</h3>
    </div> <!-- /container -->

</div>

@include('public.shop._partials.footer')


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
{{ HTML::script('public/js/shop.js') }}
{{ HTML::script('public/js/script.js') }}
{{ HTML::script('public/js/chorki.js') }}
@include('_partials.globalscripts')
</body>
</html>