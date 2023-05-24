<div id="animatedModalOrderReject">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalOrderReject">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-content container-fluid">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                    {{ Form::open(array('route' => 'orders.reject','class'=>'cd-form floating-labels','id'=>'')) }}
                    <fieldset>
                        <legend>The reason of rejection</legend>

                        <div class="icon field">
                            <label class="cd-label" for="cd-textarea">Reason</label>
                            {{ Form::textarea('remarks',null,array('class'=>'message','id'=>'cd-textarea','size'=>'0x0','required placeholder'=>'Reason Goes Here')) }}
                        </div>
                        <div class="orderId"></div>
                        <div>
                            {{ Form::submit('Ok',array('id'=>'','class'=>'')) }}
                        </div>
                    </fieldset>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>


    <script>

        $(document).on('click','.order-reject',function(e) {
            var orderId = $(this).data('id');
            var hiddenField = '<input type="hidden" name="order_id" value="'+orderId+'">';
            $('.orderId').append(hiddenField);
        });

    </script>



