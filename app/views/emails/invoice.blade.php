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
    <p>Time: {{ date('F d, Y @ H:i', strtotime('+6 hour', strtotime($order['created_at']))) }}</p>
    <h4>Order details</h4>

    <table  border="1" cellspacing="0" cellpadding="10" width="80%">

        <tr>
            <td colspan="1">Order ID</td>
            <td colspan="2"><h2>{{ $order['id'] + 100000 }}</h2></td>
        </tr>
        <tr>
            <td colspan="1">Customer Name</td>
            <td colspan="2">{{ $order['shipping_address']['name'] }}</td>
        </tr>
        {{-- <tr>
            <td colspan="1">Customer Mobile</td>
            <td colspan="2">{{ $order['shipping_address']['mobile'] }}</td>
        </tr> --}}
        <tr>
            <td colspan="1">Address</td>
            <td colspan="2">{{ $order['shipping_address']['address'] }}, {{ $order['shipping_location']['name']  }}</td>
        </tr>
        <tr>
            <td colspan="1">Payment Method</td>
            <td colspan="2">{{ $order['payment_method']['label'] }}</td>
        </tr>
        <tr>
            <td colspan="1">Shipping Method</td>
            <td colspan="2">{{ $order['shippingChannel'] }}</td>
        </tr>
        <tr>
            <td colspan="1">Shipping Package</td>
            <td colspan="2">@if($order['shipping_package']){{ $order['shipping_package']['label'] }} @else N/A @endif</td>
        </tr>
        <tr>
            <td colspan="1">Amount</td>
            <td colspan="2"><h3>{{ $order['total'] }}</h3></td>
        </tr>
    </table>
    <table  border="1" cellspacing="0" cellpadding="10" width="80%">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Color</th>
            <th>Size</th>
            <th>Discount</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order['products']  as $product)
        <tr >
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['pivot']['quantity'] }}</td>
                <td>{{ $product['pivot']['price'] }}</td>
                <td>@if($product['pivot']['color']){{ $product['pivot']['color'] }} @else N/A @endif</td>
                <td>@if($product['pivot']['size']){{ $product['pivot']['size'] }} @else N/A @endif</td>
                <td>@if($product['pivot']['discount'] > 0.00)  {{$product['pivot']['discount']}}&nbsp;({{ $product['pivot']['discountComment'] }}) @else N/A  @endif</td>
            <td>{{ $product['pivot']['lineTotal'] }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" class="text-right">Coupon Discount</td>
            <td class="text-right">{{ $order['couponDiscount'] }}</td>
        </tr>
        <tr>
            <td colspan="6" class="text-right">Delivery chrarge</td>
            <td class="text-right">{{ $order['shippingCharge'] }}</td>
        </tr>
        <tr>
            <td colspan="6" class="text-right">Payment method charge</td>
            <td class="text-right"> {{ $order['payment_method']['charge'] }}</td>
        </tr>
        <tr>
            <td colspan="6" class="text-right">Total</td>
            <td class="text-right">{{ $order['total'] }}</td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>