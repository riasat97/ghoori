@extends('shops.myshop._layouts.main')
@section('title')
    Transaction Charges
@stop
@section('order-css')
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <style type="text/css">
        .border-gayeb td{
            border-right : none !important;
        }
    </style>
    
@stop
@section('content')
    <div class="container">
        <div class="row">
            @include('revenues._partials.dateRange')
            <div class="col-xs-12">
                <div class="well">
                    @include('revenues._partials.search', array('routeName'=>'revenues.transactionCharges','slug'=>$shop->slug,'lifetime'=>false))
                </div>
            </div>

            <div class="col-sm-12">
                <h2>Transaction Charges</h2>
            </div>

            <div class="col-sm-12">
                @if($transactionChargesList)
                    <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Completed At</th>
                            <th>Order ID</th>
                            <th>Merchant Package</th>
                            <th>Sales</th>
                            <th>TXN</th>
                            <th>Transaction Charge Unpaid</th>
                            <th>Transaction Charge Paid</th>
                            <th>Total Transaction Charge</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactionChargesList as $transactionCharge)
                            <tr>
                                <td>{{ $transactionCharge->completed_at->addHours(6)->toDayDateTimeString()  }}</td>
                                <td>{{ $transactionCharge->id + 100000}}</td>
                                <td> {{ $merchantPackage }}</td>
                                <td>{{  number_format($transactionCharge->subtotal,2)}}</td>
                                <td> {{ number_format($transactionCharge->txn,2) }}</td>
                                <td> {{ number_format($transactionCharge->unPaid,2)  }}</td>
                                <td> {{ number_format($transactionCharge->paid,2) }}</td>
                                <td>{{ number_format($transactionCharge->unPaid,2) }}</td>
                                <td>
                                    <a data-id="{{ $transactionCharge->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="border-gayeb">
                            <td>Total Amount</td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($totalSales,2) }}</td>
                            <td>{{ number_format($totalTransactionCharge['totalCommission'],2) }}</td>
                            <td>{{ number_format($totalTransactionCharge['unPaid'],2) }}</td>
                            <td>{{ number_format($totalTransactionCharge['paid'],2)}}</td>
                            <td>{{ number_format($totalTransactionCharge['unPaid'],2)}}</td>
                            <td style="border-right : 1px solid #ddd !important;" ></td>
                        </tr>
                        </tbody>
                    </table>
                    @include('orders._partials.orderDetailPopUp')

                @else
                    <p>No records found.</p>
                @endif

            </div>

        </div>

    </div>

@stop
@section('order-js')
    @include('orders._partials.orderJs')
@stop
