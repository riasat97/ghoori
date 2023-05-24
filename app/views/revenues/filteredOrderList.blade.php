@extends('shops.myshop._layouts.main')
@section('title')
Filter Orders
@stop
@section('order-css')
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <style type="text/css">
        .alert{
            margin: 15px;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="row">
            @include('revenues._partials.dateRange')
            <div class="col-xs-12">
                <div class="well">
                    @include('revenues._partials.search', array('routeName'=>'revenues.filteredOrderList','slug'=>$shop->slug,'lifetime'=>false))
                </div>
            </div>

            <div class="col-sm-12">
                <h2>Filtered Orders</h2>
            </div>

            <div class="col-sm-12">
                @if($filteredOrderList)
                <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Created On</th>
                        <th>Completed On</th>
                        <th>Receivable</th>
                        <th>Payable</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($filteredOrderList as $filteredOrder)
                        <tr>
                            <td>{{ $filteredOrder->id + 100000}}</td>
                            <td>{{ $filteredOrder->created_at->addHours(6)->toDayDateTimeString()  }}</td>
                            <td>{{ $filteredOrder->completed_at->addHours(6)->toDayDateTimeString()  }}</td>
                            <td>{{$filteredOrder->totalAmount}}</td>
                            <td>{{ $filteredOrder->commission }}</td>
                            <td>
                                <a data-id="{{ $filteredOrder->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                @else
                <p>Oppsss!!! No records found</p>
                @endif
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>

                        <th>Receivable</th>
                        <th>Payable</th>
                        <th>Subscription Fee</th>
                        <th>Own Shipping Charge</th>
                        <th>Facebook Shop Charge</th>
                        <th>Card Fee</th>
                        <th>Grand Total </th>
                    </tr>
                    </thead>
                    <tbody>
                     <tr>
                       <td class="">{{ $grandReceivable }} BDT</td>
                       <td>{{$revenues[0]->totalCommission?$revenues[0]->totalCommission:'0'}} BDT</td>
                       <td>{{ $totalSubscriptionFee }} BDT</td>
                       <td>{{ $ownChannelFee }} BDT</td>
                       <td>{{ $facebookShopFee }} BDT</td>
                       <td>{{ $cardFee }} BDT</td>
                       <td>{{ $grandTotal }} BDT</td>


                     </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="productListModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p>One fine body&hellip;</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div>


    </div>

    @include('orders._partials.orderDetailPopUp')

@stop
@section('order-js')
    @include('orders._partials.orderJs')
@stop

@section('neworderscount')

@stop