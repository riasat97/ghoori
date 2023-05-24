@extends('public.shop._layouts.shop')
@section('title')
    My Order history
@stop
@section('sidebar')
@stop
@section('order-css')
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
@stop
@section('content')
    <div class="container">
        <div class="row">
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
                        <th>Order Total</th>
                        <th>Created On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myOrders as $myOrder)
                        @if($myOrder->shop)
                        <tr class="@if ($myOrder->status == 'Proceed') warning @elseif ($myOrder->status == 'Complete') success @elseif ($myOrder->status == 'Reject' || $myOrder->status == 'PaymentFailed') danger @endif">
                            <td>{{ $myOrder->id + 100000 }}</td>
                            <td>{{ $myOrder->shop->title }}</td>
                            <td>{{ $myOrder->paymentMethod->label }}</td>
                            <td>@if($myOrder->shippingPackage)
                                    {{ $myOrder->shippingPackage->shippingChannel->name }}
                                @else
                                    Shop shipping Method
                                @endif
                            </td>
                            <td> {{ $myOrder->total - $myOrder->couponDiscount }}</td>
                            <td>{{ $myOrder->created_at->diffForHumans() }}</td>
                            @if($myOrder->status == 'Unverified')
                                <td>
                                    <a data-id="{{ $myOrder->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>
                                    <a data-id="{{ $myOrder->id }}" data-toggle="modal" data-target="#orderCancelModal" class="btn btn-xs btn-danger my-order-reject"><i class="fa fa-times"></i> Cancel</a>
                                   @if($unVerifiedOrdersLink[$myOrder->id]) <a  href="{{ $unVerifiedOrdersLink[$myOrder->id] }}" class="btn btn-xs btn-success "><i class="fa fa-check"></i> Verify</a>@endif

                                </td>
                            @elseif($myOrder->status == 'New')
                                <td>
                                    <a data-id="{{ $myOrder->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>
                                    <a data-id="{{ $myOrder->id }}" data-toggle="modal" data-target="#orderCancelModal" class="btn btn-xs btn-danger my-order-reject"><i class="fa fa-times"></i> Cancel</a>
                                </td>
                            @elseif ($myOrder->status == 'Proceed')
                                <td class="success">
                                    <a data-id="{{ $myOrder->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>
                                  <?php $orderParcelStatus= explode('@',$myOrder->parcelStatus,-1); ?>

                                   @if( !empty($orderParcelStatus[0]) && in_array($orderParcelStatus[0],$acceptedEcourierStatus,true) or $myOrder->shippingPackage_id == null )
                                    <a data-id="{{ $myOrder->id }}" data-toggle="modal" data-target="#orderCancelModal" class="btn btn-xs btn-danger my-order-reject"><i class="fa fa-times"></i> Cancel</a>
                                    @endif

                                </td>
                            @elseif($myOrder->status == 'Reject')
                                <td class="danger">
                                    <a data-id="{{ $myOrder->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>

                                </td>
                            @elseif($myOrder->status == 'Complete')
                                <td>
                                    <a data-id="{{ $myOrder->id }}" href="#animatedModalOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>

                                </td>
                            @else 
                                <td></td> 
                            @endif
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @include('orders._partials.orderDetailPopUp')
    {{-- @include('orders.myorders.reject') --}}
    @include('orders.myorders._partials.rejectModal')

    <!-- Button trigger modal -->

@stop
@section('order-js')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script>
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
            // $(".my-order-reject").animatedModal({
            //     modalTarget:'animatedModalMyOrderReject',
            //     'color': '#fff'
            // });
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
                        alert('Something went to wrong. Please Try again later...');
                    }
                });
            });

        });
        function parselStatus(response){
            var html=response.parcelStatus+'@<small>'+ response.date+'</small>';
            $(".shipping-status").html(html);

        }

        // $(document).on('change','input[type="checkbox"]',function(e) {
        //     $('input[type="checkbox"]').not(this).prop('checked', false);
        // });

        $(document).on('click','.other',function(e) {

                $('.other-reason').removeClass('hidden');
                $('.other-reason textarea').focus();
        });
        $(document).on('click','.group',function(e) {

           $('.other-reason').addClass('hidden');
        });

        $(document).on('click','.my-order-reject',function(e) {

            var orderId = $(this).data('id');
            // var hiddenField = '<input type="hidden" name="order_id" value="'+orderId+'">';
            $('.orderId input[name=order_id]').val(orderId);
        });
        $(document).ready(function(){
            $(document).on('click','.my-order-reject',function(e) {
                // $(".order-reject-wrap").html('');
                e.preventDefault();
                var orderId = $(this).data('id');

//                 var url = '{{ URL::route('myOrders.rejectForm') }}';

//                 $.ajax({
//                     url: url,
//                     data: { 'orderId' :orderId} ,
//                     type: "GET",
//                     success: function(response) {
// //                        console.log(response);
//                         orderReject(response);

//                     },
//                     error: function(xhr, textStatus, thrownError) {
//                         alert('Something went to wrong.Please Try again later...');
//                     }
//                 });
            });

        });


        // function orderReject(response){

        //     $(".order-reject-wrap").html(response);
        // }

    </script>
@stop