<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
<div class="col-sm-12">
    <div class="row">
        <div class="col-xs-6">
            <h4 class="ghoori-title">Invoice To</h4>
            <table class="table table-thin table-no-border">
                <tr>
                    <th>Shop ID</th>
                    <td>{{ $shop->id }}</td>
                </tr>
                <tr>
                    <th>Shop Name</th>
                    <td>{{ $shop->title }}</td>
                </tr>
                <tr>
                    <th>Shop Owner</th>
                    <td>{{ $shop->user->name }}</td>
                </tr>
                <tr>
                    <th>Package</th>
                    <td>{{ $shop->package->name }}</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-6">
            <h4 class="ghoori-title">Chorki Limited</h4>
            <table class="table table-thin table-no-border">
                {{-- <tr>
                     <th>Invoice No.</th>
                     <td>123456</td>
                 </tr>--}}
                <tr>
                    <th>Invoice Date</th>
                    <td>{{ $today }}</td>
                </tr>
                <tr>
                    <th>Invoice Period</th>
                    <td>From <b>{{ $date['start']?$date['start']->toFormattedDateString():'N/A' }}</b> To <b>{{ $date['end']?$date['end']->toFormattedDateString():'N/A' }}</b></td>
                </tr>
                {{--<tr>
                    <th>Vat Reg. No.</th>
                    <td>XXXXXXXXXXXXXXXXXXXX</td>
                </tr>--}}
            </table>
        </div>
    </div>



    @if($filteredOrderList)

    <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Created On</th>
            <th>Completed On</th>
            <th>Receivable</th>
            <th>Payable</th>
        </tr>
        </thead>
        <tbody>
        @foreach($filteredOrderList as $filteredOrder)
            <tr>
                <td>{{ $filteredOrder->id + 100000}}</td>
                <td>{{ $filteredOrder->created_at->addHours(6)->toDayDateTimeString()  }}</td>
                <td>{{ $filteredOrder->completed_at->addHours(6)->toDayDateTimeString()  }}</td>
                <td>{{ $filteredOrder->totalAmount}}</td>
                <td>{{ $filteredOrder->commission }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    @endif

</div>




<table class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th colspan="2">Summary</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Receivable</th>  <td class="">{{ $grandReceivable }} BDT</td>
    </tr>
    <tr>
        <th>Payable</th>  <td>{{$revenues[0]->totalCommission?$revenues[0]->totalCommission:'0'}} BDT</td>
    </tr>
    <tr>
        <th>Subscription Fee</th> <td>{{ $totalSubscriptionFee }} BDT</td>
    </tr>
    <tr>
    <th>Own Shipping Charge</th> <td>{{ $ownChannelFee }} BDT</td>
    </tr>
    <tr>
        <th>Grand Total </th>   <td>{{ $grandTotal }} BDT</td>
    </tr>
    </tbody>
</table>
</body>
</html>