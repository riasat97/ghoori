<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">
    <!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->

  {{--  {{ HTML::style('css/admin.css') }}--}}
    {{HTML::style('orakuploader/orakuploader.css')}}
    {{HTML::style('public/css/font.css')}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
    {{HTML::style('public/css/stylenew.css')}}
    <!-- This style is specific for form -->
    {{HTML::style('css/my_shop.css')}}
    {{HTML::style('css/form_style.css')}}
    {{HTML::style('public/css/chorki.css')}}
    {{HTML::style('css/add_products.css')}}
    {{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css') }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.10.0/simplemde.min.css">
    @include('_partials.globalstyles')
    <!-- <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'> -->

    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
    {{ HTML::script('public/js/shop.js') }}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    {{HTML::script('orakuploader/orakuploader.js')}}
</head>
<body>
    <div class="body_main">
        
    
{{-- @include('_partials.header') --}}
@include('public.shop._partials.header')

    <div class="container">
        @if ( Session::has('flash_message') )

            <div class="alert {{ Session::get('flash_type') }}">
                <p>{{ Session::get('flash_message') }}</p>
            </div>

        @endif
        
    </div>
    <div class="container-fluid">
        <div class="row">
            
                @yield('content')
            
        </div>
    </div>

</div>
@include('public.shop._partials.footer')

{{HTML::script('js/product.js')}}
{{ HTML::script('public/js/chorki.js') }}

<script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.10.0/simplemde.min.js"></script>

<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("ProductDescMDE")
    });


    
</script>
@include('_partials.globalscripts')
</body>
</html>