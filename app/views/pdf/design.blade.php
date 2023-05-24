<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,900,700' rel='stylesheet' type='text/css'>
    {{HTML::style('css/revenuepdf.css')}}
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-7">
                <div class="huge-text">Invoice</div>
            </div>
            <div class="col-xs-5">
                <img class="img-responsive" src="{{asset('img/ghoori_w_clouds.png')}}">
            </div>
        </div>
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
                        <td>From <b> {{ $date['start']?$date['start']->addHours(6)->toFormattedDateString():'N/A' }}</b> To <b> {{ $date['end']?$date['end']->addHours(6)->toFormattedDateString():'N/A' }}</b></td>
                    </tr>
                    {{--<tr>
                        <th>Vat Reg. No.</th>
                        <td>XXXXXXXXXXXXXXXXXXXX</td>
                    </tr>--}}
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <hr class="hr-thick">
                <div>
                    <table class="table table-thin table-no-border text-center">
                        <tr>
                            <td>
                              {{--  <h4>Current Bill in BDT</h4>--}}
                            </td>
                            <td></td>
                            <td>
                                <h4>Amount Receivable in BDT</h4>
                            </td>
                            <td></td>
                            <td>
                              {{--  <h4>Amount Payable by DATE</h4>--}}
                            </td>
                        </tr>
                        <tr class="big-text">
                            <td>
                               {{-- <div>950.00</div>--}}
                            </td>
                            <td> </td>
                            <td>
                                <div>{{ $grandTotal }}</div>
                            </td>
                            <td></td>
                            <td>
                              {{--  <div>1900.00</div>--}}
                            </td>
                        </tr>
                    </table>
                </div>
                <hr class="hr-thick">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="">
                <img class="img-responsive" src="{{asset('img/success_banner.jpg')}}">
            </div>
        </div>
    </div>
{{-- <div class="col-sm-12"> --}}


    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h4>Orders</h4>
                @if($filteredOrderList)
                <table  id="example" class="table table-striped table-thin" cellspacing="0" width="100%">
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
                @else
                <b>No orders found !</b>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-xs-offset-6">
                <table class="table table-striped table-thin" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th colspan="2"><h4> Summary</h4></th>
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
                        <th>Facebook Shop Charge</th> <td>{{ $facebookShopFee }} BDT</td>
                    </tr>
                    <tr>
                        <th>Card Fee</th> <td>{{ $cardFee }} BDT</td>
                    </tr>
                    <tr>
                        <th>Grand Total </th>   <td>{{ $grandTotal }} BDT</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>