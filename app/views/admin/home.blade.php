<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chorki.com</title>

</head>

<body>

    <h1>Home</h1>
    <p>This is Chorki</p>
    <p>You have arrived...</p>
    <a href="{{URL::route('shops.index')}}">Shops</a>


    @if ( Session::has('flash_message') )

        <div class="alert {{ Session::get('flash_type') }}">
            <h3>{{ Session::get('flash_message') }}</h3>
        </div>

    @endif



</body>
</html>
