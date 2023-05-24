<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verify your {{ $content }} </h2>
<div>
    <p>Dear {{$userName}},</p>
    <p>
        Thanks for opening eShop with Ghoori.
        Please follow the link below to verify your {{ $content }} @if($number){{ $number }}@endif.
    </p>
    <a href="{{$confirmationUrl}}">{{$confirmationUrl}}</a>
</div>

</body>
</html>