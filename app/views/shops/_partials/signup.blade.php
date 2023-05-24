<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Your Sub-domain</title>
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>


<h3>Sign up with your Email...</h3><br><br>

<div class="domain col-md-4 user-domain-form" style="">

    {{ Form::open(array('data-remote', 'data-remote-success-message'=>'Well done!')) }}
    <div class="form-group" >
        {{ Form::label('Email-Address', 'Enter Email Address:') }}<br>
        {{ Form::text('email') }}
    </div>

    {{--<div class="form-group">
        {{ Form::hidden('shop_id',Session::get('shop_id')) }}
    </div>--}}

    <div class="form-group">
        {{ Form::submit('Sign up', array('class'=>'btn btn-default', 'id'=>'domain-save')) }}
    </div>

    {{ Form::close() }}

</div>



</body>

</html>