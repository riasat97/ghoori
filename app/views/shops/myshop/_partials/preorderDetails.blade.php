<div class="row">
    <div class="col-xs-6 visible-print-block">
        <div class="order-shop" >
            @if($orderDetails->shop->logo){{ HTML::image('public_img/shop_'.$orderDetails->shop->id.'/logos/'.$orderDetails->shop->logo->logo,'alt=Image',array('class'=>'img-responsive orderdetail-shop-logo','width'=>152,'height'=>152)) }}
            @else
                <img src="{{ asset('img/shoplogo-default.jpg') }}" class="img-responsive orderdetail-shop-logo" alt="Image">
            @endif
            <h2>{{$orderDetails->shop->title}}</h2>
        </div>
    </div>
    <div class="col-xs-6 visible-print-block text-right">
        {{ HTML::image('img/55_double.png', 'Ghoori.com.bd', array('class' => 'orderdetails-ghoori-logo')) }}
    </div>
    <div class="col-xs-8">
        <h3></h3>
    </div>
    <div class="col-xs-4">
        <a class="print-order btn btn-default pull-right" href="#"><i class="fa fa-print"></i> Print</a>
    </div>
</div>
<div class="order-details-wrap">
    <div class="row">
        <div class="col-xs-12">
            <h4>Order#{{ $orderDetails->id + 100000 }} Details</h4>
            <table class="table table-condensed gh-table-address">

                <tr><th class="col-xs-2">Customer Name </th><td class="col-xs-10">{{ $orderDetails->shippingAddress->name }}</td></tr>
                <tr><th class="col-xs-2">Address       </th><td class="col-xs-10">{{ $orderDetails->shippingAddress->address }}</td></tr>
                {{-- <tr><th class="col-xs-2">Mobile no     </th><td class="col-xs-10">{{ $orderDetails->shippingAddress->mobile }}</td></tr> --}}
                <tr><th class="col-xs-2">Email Address </th><td class="col-xs-10">{{ $orderDetails->shippingAddress->email }}</td></tr>
                <tr class="hidden-print"><th class="col-xs-2">Division      </th><td class="col-xs-10">{{ $orderDetails->shippingLocation->name }}</td></tr>
            </table>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <table class="table table-condensed">
                <tr>
                    <th>Order ID</th>
                    <td><b>{{ $orderDetails->id + 100000 }}</b></td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ date('H:i, F d, Y', strtotime('+6 hour', strtotime($orderDetails->created_at))) }}</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <table class="table table-condensed">
                <tr><td>Shipping Channel </td><td>@if($orderDetails->shippingPackage)
                            {{ $orderDetails->shippingPackage->shippingChannel->name }}
                        @else
                            Shop Shipping Method
                        @endif</td></tr>
                <tr><td>Shipping Package </td><td>@if($orderDetails->shippingPackage){{ $orderDetails->shippingPackage->label }} @else N/A @endif</td></tr>
                <tr  class="hidden-print"><td>Parcel Id  </td><td>@if($orderDetails->parcelId)
                            {{$orderDetails->parcelId}}
                        @else
                            Processing
                        @endif
                    </td>
                </tr>
                <tr  class="hidden-print"><td>Shipping Status  </td>
                    <td class="shipping-status"> @if($orderDetails->parcelId)
                            {{ $orderDetails->parcelStatus}}
                        @else
                            Processing
                        @endif
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
            <table class="table table-condensed">
                <tr><td>Payment Method   </td><td>{{ $orderDetails->paymentMethod->label }}</td></tr>
                <tr class="hidden-print"><td>Payment Status   </td><td>{{$orderDetails['transaction_status']}}</td></tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h4>Preorder Product</h4>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Weight</th>
                    <th>Unit Price</th>
                </tr>
                </thead>
                <tbody >

                    <tr>
                        <td>{{$preorder->name}}</td>
                        <td>{{$preorder->weight}}</td>
                        <td>{{$preorder->price}}</td>
                    </tr>

                <tr>
                    <td colspan="6" class="text-right">Online Payment/MFS Charge</td>
                    <td class="text-right"> {{ $orderDetails->paymentMethod->charge }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-right">Total</td>
                    <td class="text-right">{{ $orderDetails->total }}</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>

<div class="row">
    <div class="col-xs-12 visible-print-block">
        <small>ghoori.com.bd</small>
    </div>
</div>