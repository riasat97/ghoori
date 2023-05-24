<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>invoice</h2>
<div>
    <p>Dear {{$userName}},</p>
    <p>
        {{ $msg }}
    </p>
    <p>Time: {{ date('F d, Y @ H:i', strtotime('+6 hour', strtotime($prebookorder['created_at']))) }}</p>
    <h4>Order details</h4>

    <table  border="1" cellspacing="0" cellpadding="10" width="80%">

        <tr>
            <td colspan="1">Order ID</td>
            <td colspan="2"><h2>{{ $prebookorder['id'] + 100000 }}</h2></td>
        </tr>
        <tr>
            <td colspan="1">Customer Name</td>
            <td colspan="2"> {{$userName}} </td>
        </tr>
        <tr>
            <td colspan="1">Address</td>
            <td colspan="2">{{ $address  }}</td>
        </tr>
        <tr>
            <td colspan="1">Amount</td>
            <td colspan="2"><h3>{{ $prebookorder['total'] }}</h3></td>
        </tr>
    </table>
    <table  border="1" cellspacing="0" cellpadding="10" width="80%">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($preorder  as $product)
            <tr >
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['price'] }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

</body>
</html>