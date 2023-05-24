<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <p>Dear {{ $userName }},</p>
    <p>
        You have received a new order (#{{ $order['id'] + 100000 }}) in your "{{ $shopTitle }}" eShop. Please click the link below to accept the order. If you want to hold or reject the order visit your order page. For any query call us.
    </p>
    <p>Accept- {{ $acceptURL }}</p>
    <p>All ordres- {{ $allOrders }}</p>
    <p>
Cheers,<br>
Team Ghoori<br>
09612-000888
    </p>

</div>

</body>
</html>