@extends('shops.myshop._layouts.main')
@section('title')
    Receivable From Ghoori
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
                    @include('revenues._partials.search', array('routeName'=>'revenues.netSalesDetails','slug'=>$shop->slug,'lifetime'=>false))
                </div>
            </div>

            <div class="col-sm-12">
                <h2>Receivable From Ghoori</h2>
            </div>

            <div class="col-sm-12">
                @if($netSalesDetails)
                    <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Completed At</th>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Merchant Package</th>
                            <th>Shipping Method</th>
                            <th>Payment Method</th>
                            <th>Sales</th>
                            <th>Own Channel delivery Charge</th>
                            <th>Merchant Receivable</th>
                            <th>Payment Receive Status</th>
                            <th>Receivable From Ghoori</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($netSalesDetails as $netSalesDetail)
                            <tr>
                                <td>{{ $netSalesDetail->completed_at->addHours(6)->toDayDateTimeString()  }}</td>
                                <td>{{ $netSalesDetail->id + 100000}}</td>
                                <td>{{$netSalesDetail->shippingAddress->name}}</td>
                                <td> {{ $merchantPackage }}</td>
                                <td>{{ ($netSalesDetail->shippingPackage)?
                                $netSalesDetail->shippingPackage->shippingChannel->name:"Own Channel" }}</td>
                                <td> {{ $netSalesDetail->paymentMethod->label }}</td>
                                <td>{{  number_format($netSalesDetail->subtotal,2)}}</td>
                                <td> {{ number_format($netSalesDetail->ownChannelShippingCharge,2) }}</td>
                                <td> {{ number_format($netSalesDetail->merchantReceivable,2) }}</td>
                                <td> {{ $netSalesDetail->paymentStatus }}</td>
                                <td>{{ number_format($netSalesDetail->netSales,2) }}</td>
                                <td>
                                    <a data-id="{{ $netSalesDetail->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>
                                </td>
                            </tr>
                        @endforeach
                            <tr class="border-gayeb">
                                <td>Total Amount</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{number_format($totalSales,2)}}</td>
                                <td>{{ ($totalOwnShippingCharge->totalOwnChannelCharge)?
                                      number_format($totalOwnShippingCharge->totalOwnChannelCharge,2):'0.00'}}
                                </td>
                                <td></td>
                                <td></td>
                                <td>{{ number_format($netSales,2) }}</td>
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

@section('neworderscount')

@stop