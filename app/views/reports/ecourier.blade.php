@extends('public.shop._layouts.shop')
@section('title')
    Ecourier | Orders
@stop
@section('sidebar')
@stop

@section('content')
    <div class="container">
        <div class="row">
            @include('revenues._partials.dateRange')
            <div class="well">
                @include('revenues._partials.search', array('routeName'=>'generateReports','slug'=>null,'lifetime'=>false,'filter'=>true))
            </div>
            <div class="col-sm-12">
                <h2>Orders</h2>
            </div>
            <div class="col-sm-12">
                <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>eShop</th>
                        <th>Payment Method</th>
                        <th>Shipping Channel</th>
                        <th>Subtotal</th>
                        <th>Shipping Charge</th>
                        <th>Grand Total(Including Shipping)</th>
                        <th>Merchant Revenue</th>
                        <th>Ghoori Revenue</th>
                        <th>Ecourier Revenue</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $report->shop->title }}</td>
                            <td>{{ $report->paymentMethod->label }}</td>
                            <td>
                                {{ $report->shippingPackage->shippingChannel->name }}
                            </td>
                            <td>{{ $report->subTotal }}</td>
                            <td>{{ $report->shippingFee }}</td>
                            <td> {{ $report->grandTotal }}</td>
                            <td>{{ $report->merchantRevenue }}</td>
                            <td>{{ $report->ghooriRevenue }}</td>
                            <td>{{ $report->ecourierRevenue }}</td>

                            <td>
                                <a  href="{{ $reportDetailsLink[$report->shop_id] }}" class="btn btn-xs btn-info"><i class="fa fa-table"></i> Details</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @include('reports._partials.total')
            </div>
        </div>

    </div>
@stop
