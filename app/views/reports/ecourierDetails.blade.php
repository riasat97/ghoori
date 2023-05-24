@extends('public.shop._layouts.shop')
@section('title')
Ecourier | Orders
@stop
@section('sidebar')
@stop
@section('order-css')
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
    <div class="container">
        <div class="row">
            @include('revenues._partials.dateRange')
            <div class="well">
                @include('revenues._partials.search', array('routeName'=>'generateReportDetails','slug'=>null,'lifetime'=>false,'filter'=>true,'shopHidden'=>true))
            </div>
            <div class="col-sm-12">
                <h2>Orders</h2>
            </div>
            <div class="col-sm-12">
                <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>eShop</th>
                        <th>Payment Method</th>
                        <th>Shipping Channel</th>
                        <th>Subtotal</th>
                        <th>Shipping Charge</th>
                        <th>Grand Total</th>
                        <th>Merchant Revenue</th>
                        <th>Ghoori Revenue</th>
                        <th>Ecourier Revenue</th>
                        <th>Created On</th>
                        <th>Completed On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->shop->title }}</td>
                                <td>{{ $report->paymentMethod->label }}</td>
                                <td>
                                    {{ $report->shippingPackage->shippingChannel->name }}
                                </td>
                                <td>{{ $report->subtotal }}</td>
                                <td>{{ $report->shippingCharge }}</td>
                                <td> {{ $report->total }}</td>
                                <td>{{ $report->merchantRevenue }}</td>
                                <td>{{ $report->ghooriRevenue }}</td>
                                <td>{{ $report->ecourierRevenue }}</td>
                                <td>{{ $report->created_at->addHours(6)->toDayDateTimeString()  }}</td>
                                <td>{{ $report->completed_at->addHours(6)->toDayDateTimeString()  }}</td>

                                <td>
                                    <a data-id="{{ $report->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
              @include('reports._partials.total')
            </div>
        </div>

    </div>
    @include('orders._partials.orderDetailPopUp')
@stop
@section('order-js')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <script>
      $(".multi-select").select2();
        $(document).ready(function() {
            $('#example').dataTable({
                "order": []
            });
        });

        $('#example').on( 'draw.dt', function () {
            console.log('draw fired');
            $(".order-detail").animatedModal({
                modalTarget:'animatedModalOrderDetails',
                'color': '#fff'
            });
            $(".my-order-reject").animatedModal({
                modalTarget:'animatedModalMyOrderReject',
                'color': '#fff'
            });
        } );


        $(document).ready(function(){
            $(document).on('click','.order-detail',function(e) {
                $(".order-details-wrap").html('');
                e.preventDefault();
                var orderId = $(this).data('id');
                var url = '{{ URL::route('orders.orderDetail') }}';

                $.ajax({
                    url: url,
                    data: { 'orderId' :orderId} ,
                    type: "GET",
                    success: function(response) {
//                        console.log(response);
                        orderDetails(response);

                    },
                    error: function(xhr, textStatus, thrownError) {
                        alert('Something went to wrong.Please Try again later...');
                    }
                });
            });

        });


        function orderDetails(response){

            $(".order-details-wrap-main").html(response);
        }
    </script>
    <script>
        $(document).on('click','.order-proceed',function(e) {
            if(!confirm("Are you sure you want to proceed?")) return false;
        });

        $(document).ready(function(){
            $(document).on('click','.present-status',function(e) {
                e.preventDefault();
                var parcelId = $(this).data('id');
                var shopId= $(this).data('shopid');
                var orderId = $(this).data('orderid');
                var url = '{{ URL::route('orders.parcelInquiry') }}';

                $.ajax({
                    url: url,
                    data: { 'parcelId' :parcelId , 'shopId' :shopId,'orderId':orderId } ,
                    type: "GET",
                    success: function(response) {
                        parselStatus(response);

                    },
                    error: function(xhr, textStatus, thrownError) {
                        alert('Something went to wrong.Please Try again later...');
                    }
                });
            });

        });
        function parselStatus(response){
            var html=response.parcelStatus+'@<small>'+ response.date+'</small>';
            $(".shipping-status").html(html);

        }




    </script>
@stop