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
            },
            "sScrollX": '100%'
        });

    });

    $('#example').on( 'draw.dt', function () {
        console.log('draw fired');
        $(".order-detail").animatedModal({
            modalTarget:'animatedModalOrderDetails',
            'color': '#fff'
        });
        $(".order-reject").animatedModal({
            modalTarget:'animatedModalOrderReject',
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