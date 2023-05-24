@extends('shops.myshop._layouts.main')
@section('title')
    All Preorders
@stop
@section('order-css')
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Pre-Orders</h2>
            </div>
            <div class="col-sm-12">
                <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Pre-Order ID</th>
                        <th>Product</th>
                        <th>Package</th>
                        <th>Division</th>
                        <th>Shipping Address</th>
                        <th>Payment Method</th>
                        <th>Total</th>
                        <th>Due</th>
                        <th>Remarks</th>
                        <th>Placed On</th>
                        <th>Release Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- sample data --}}

                    {{-- sample data ends --}}
                @if($orders)
                  @foreach($orders as $order)
                    <tr class="@if ($order->status == 'Proceed') warning @elseif ($order->status == 'Complete') success @elseif ($order->status == 'Reject') danger @endif">
                        <td>{{$order->id+100000}}</td>
                        <td><a href="#"></a></td>
                        <td>@if($order->shippingPackage)
                                {{ $order->shippingPackage->shippingChannel->name }}
                            @else
                                Shop shipping Method
                            @endif
                        </td>
                        <td>{{ $order->shippingLocation->name }}</td>
                        <td>{{ $order->shippingAddress->address }}</td>
                        <td>Bkash</td>
                        <td>{{ $order->total }} BDT</td>
                        <td>0 BDT</td>
                        <td>{{ $orderRejected[$order->id] }}</td>
                        <td>{{ date('F d, Y @ H:i', strtotime('+6 hour', strtotime($order->created_at))) }}</td>
                        <td>{{ date('F d, Y @ H:i', strtotime('+6 hour', strtotime($order->preorderPackage->delivery_date))) }}</td>
                        @if($order->status == 'New')
                            <td>
                                <a href="{{ URL::route('preorders.proceed',$order->id) }}" class="btn btn-xs btn-success order-proceed"><i class="fa fa-check"></i> Accept</a>
                                <a data-id="{{ $order->id }}" href="#animatedModalPreOrderReject" class="btn btn-xs btn-danger order-reject"><i class="fa fa-times"></i> Reject</a>
                            </td>
                        @endif
                        @if($order->status == 'Proceed' or $order->status == 'Complete')
                            <td class="success">
                                <a data-id="{{ $order->id }}" href="#animatedModalPreOrderDetails" class="btn btn-xs btn-info order-detail"><i class="fa fa-table"></i> Details</a>

                            </td>
                        @endif
                        @if($order->status == 'Reject')
                            <td class="danger">

                            </td>
                        @endif
                    </tr>
                  @endforeach
                @endif
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

    @include('shops.myshop._partials.orderDetailModal')
    @include('shops.myshop._partials.preorderReject')
@stop
@section('order-js')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $('#example').dataTable({
            "order": [],
            "oLanguage": {
                 "sInfo": "Showing _START_ to _END_ of _TOTAL_ orders",
                 "sInfoEmpty": "Showing 0 to 0 of 0 orders",
                 "sEmptyTable": "No information available"
              }
        });
    });

    $('#example').on( 'draw.dt', function () {
        console.log('draw fired');
        $(".order-detail").animatedModal({
            modalTarget:'animatedModalPreOrderDetails',
            'color': '#fff'
        });
        $(".order-reject").animatedModal({
            modalTarget:'animatedModalPreOrderReject',
            'color': '#fff'
        });
    } );


        $(document).ready(function(){
            $(document).on('click','.order-detail',function(e) {
                $(".order-details-wrap").html('');
                e.preventDefault();
                var orderId = $(this).data('id');
                var url = '{{ URL::route('preorders.orderDetail') }}';

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

            $(document).on('click','.seeproducts',function(e) {
                // $(".order-details-wrap").html('');
                e.preventDefault();
                var orderId = $(this).data('orderid');
                var url = '{{ URL::route('orders.productList') }}';


                $.ajax({
                    url: url,
                    data: { 'orderId' :orderId} ,
                    type: "GET",
                    success: function(response) {
                        // console.log(response);
                        productList(response, orderId);

                    },
                    error: function(xhr, textStatus, thrownError) {
                        alert('Something went to wrong.Please Try again later...');
                    }
                });
            });

        });


        function orderDetails(response){
            /*var formhtml = '';
            var detail=response;*/
          /*  details.products.forEach(function (element, index, array) {
            formhtml += ' <tr><td>'+element.name+'</td><td>'+element.pivot.quantity+
            '</td><td>'+element.pivot.price+'</td>' +
            '<td>'+element.pivot.color+'</td>'+
            '<td>'+element.pivot.size+'</td>'+
            '<td>'+element.pivot.subtotal+'</td> </tr>';
            })*/
            $(".order-details-wrap-main").html(response);
        }

        function productList(response, orderId){
            var formhtml = '';
            $('#productListModal .modal-title').text("Product List of Order #"+(orderId+100000));
            formhtml = '<table class="table">';
            formhtml += '<tr><th>Name</th><th>Color</th><th>Size</th><th>Quantity</th></tr>';
            var product = response.products;
            for (var i = product.length - 1; i >= 0; i--) {
                console.log(product[i]);
                formhtml += '<tr><td><a target="_blank" href="{{ route('shops.show',$shop->slug)}}/products/'+product[i].id+'">'+product[i].name+'</a></td><td>'+( product[i].pivot.color != null ? product[i].pivot.color : '' )+'</td><td>'+( product[i].pivot.size != null ? product[i].pivot.size : '' )+'</td><td>'+product[i].pivot.quantity+'</td></tr>';
            };
            formhtml += '</table>';
            $('#productListModal .modal-body').html(formhtml);
            $('#productListModal').modal('show');
        }


        $(document).on('click','.order-proceed',function(e) {
            if(!confirm("Are you sure you want to accept the order?")) return false;
        });

        $(document).on('click','.order-reject',function(e) {
            if(!confirm("Are you sure you want to reject the order?")) return false;
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
                    data: { 'parcelId' :parcelId , 'shopId' :shopId ,'orderId':orderId } ,
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
            var html=response.parcelStatus+'<small>'+ response.date+'</small>';
            $(".shipping-status").html(html);

        }
    </script>
@stop

@section('neworderscount')

@stop