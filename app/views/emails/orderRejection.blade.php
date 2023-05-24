<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Order Rejected</h2>
<div>
    <p>Dear {{$userName}},</p>
    <p>
      Sorry,your order is rejected.
    </p>
    <h4>Order Rejection Reason</h4>
    <p>{{ $order['remarks'] }}</p>
</div>

</body>
</html>