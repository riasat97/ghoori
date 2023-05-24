@if($total->count())
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Subtotal</th>
            <th>Shipping Charge</th>
            <th>Grand Total</th>
            <th>Merchant Revenue</th>
            <th>Ghoori Revenue</th>
            <th>Ecourier Revenue</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $total[0]->subTotal }}</td>
            <td>{{ $total[0]->shippingFee }}</td>
            <td> {{ $total[0]->grandTotal }}</td>
            <td>{{ $total[0]->merchantRevenue }}</td>
            <td>{{ $total[0]->ghooriRevenue }}</td>
            <td>{{ $total[0]->ecourierRevenue }}</td>
        </tr>
        </tbody>
    </table>
@endif