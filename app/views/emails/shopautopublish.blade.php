<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Ghoori eShop Auto Published Notification</h2>

<div>
  Dear {{ $userName }}, eShop#{{$shop['id']}} named {{$shop['title']}} has been auto published .Publication Time ::{{ date('F d, Y @ H:i', strtotime('+6 hour', strtotime($shop['updated_at']))) }}.
  Please review the shop.
  <p>Thank you</p>
</div>
</body>
</html>
