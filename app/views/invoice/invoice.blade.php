<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pdf/bootstrap.css')}}">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <tr>
                    <td>
                        <h1 class="big-head ghoori-orange">Invoice</h1>
                    </td>
                    <td class="text-right">
                        <img class="img-responsive" src="{{asset('img/ghoori_w_clouds.png')}}">
                    </td>
                </tr>
            </table>
            
        </div>
        <div class="col-xs-12">
            <table class="table">
                <tr>
                    <td class="width50">
                        <h4 class="ghoori-title">Invoice To</h4>
                    </td>
                    <td>
                        <h4 class="ghoori-title">Invoice No. : {{ $invoiceId }}</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-thin table-no-border">
                            <tr>
                                <th>Shop ID</th>
                                <td>{{ $shop->id }}</td>
                            </tr>
                            <tr>
                                <th>Shop Name</th>
                                <td>{{ $shop->title }} - {{ $shop->slug }}.ghoori.com.bd</td>
                            </tr>
                            <tr>
                                <th>Shop Owner</th>
                                <td> {{ $shop->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Package</th>
                                <td>{{ $shop->package->name }}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-thin table-no-border">
                            <tr>
                                <th>Invoice Date</th>
                                <td>{{ $today }}</td>
                            </tr>
                            <tr>
                                <th>Invoice Period</th>
                                <td>From <b>{{ $date['start']?$date['start']->toFormattedDateString():'N/A' }}</b> To <b>{{ $date['end']?$date['end']->toFormattedDateString():'N/A' }}</b></td>
                            </tr>
                            <tr>
                                <th>Vat Reg. No.</th>
                                <td>18141126690</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <hr class="big_strip">
        </div>
        <div class="col-xs-12">
            <table class="table table-centered">
                <tr>
                    <th class="ghoori-orange">Receivable</th>
                    <td></td>
                    <th class="ghoori-orange">Payable to Ghoori</th>
                    <!-- <td></td>
                    <th class="ghoori-orange">{{ $total['finalStatus'] }}</th> -->
                </tr>
                <tr>
                    <td>
                        <h1 class="big-amount">{{ number_format($receivableAmount,2) }}</h1>
                    </td>
                    <td>  </td>
                    <td>
                        <h1 class="big-amount">{{ number_format($payableAmount,2) }}</h1>
                    </td>
                    <!-- <td>  </td>
                    <td>
                    <h2>{{ number_format($total['total'],2) }}</h2>
                    </td> -->
                </tr>
            </table>
        </div>
        <div class="col-xs-12">
            <hr class="big_strip">
        </div>
    </div>
</div>

        <img class="mid-banner" src="{{asset('img/success_banner.jpg')}}">

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-thin table-no-border table-stripped">
                <tr>
                     <th colspan="2" class="ghoori-orange"><h4>
                         Receivable Information
                     </h4></th>
                </tr>
                <tr>
                    <td>Total Revenue</td>
                    <td class="text-right">{{ number_format($totalRevenue,2)}} BDT</td>
                </tr>
                <tr>
                    <td>Revenue Received</th>
                    <td class="text-right"> {{number_format($revenueReceived,2)
                                                            }} BDT </td>
                </tr>
                <tr>
                    <td>Receiavable amount from Ghoori</th>
                    <td class="text-right">{{ number_format($receivableAmount,2) }} BDT</td>
                </tr>
                <tr>
                     <th colspan="2" class="ghoori-orange">
                         <h4>Payable to Ghoori</h4>
                     </th>
                </tr>
                <tr>
                    <td>Total Transaction Charge</td>
                    <td class="text-right">{{ number_format($totalTransactionCharge['unPaid'],2) }} BDT</td>
                </tr>
                <tr>
                    <td>Total Service Cost</th>
                    <td class="text-right"> {{ number_format($totalServiceCost['unPaid'],2) }} BDT </td>
                </tr>
                <tr>
                    <td>Previous Due</th>
                    <td class="text-right">{{ number_format($previousDue,2) }} BDT</td>
                </tr>
                <tr>
                    <td>Total Payable to Ghoori</th>
                    <td class="text-right">{{ number_format($payableAmount,2) }} BDT</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-12">
            * 4.5% VAT Applicable
        </div>
        <div class="col-xs-12">
            For payment information visit <a href="https://ghoori.com.bd/faq#payment-to-ghoori" class="ghoori-blue">https://ghoori.com.bd/faq#payment-to-ghoori</a>
        </div>
    </div>
</div>
<div class="row footer-line">
    <div class="col-xs-12">
        <table class="table">
            <tr>
                <td>bill.information@ghoori.com.bd</td>
                <td>https://ghoori.com.bd</td>
                <td>Chorki Limited, Wakil Tower(L7), Gulshan Badda Link Road, Dhaka</td>
            </tr>
        </table>
    </div>
</div>



</body>
</html>