<div id="animatedModalMyOrderReject">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="close-animatedModalMyOrderReject">
                    <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-content container-fluid">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 ">

                {{ Form::open(array('route' => 'myOrders.rejectForm','class'=>'floating-labels','id'=>'')) }}
                {{ Form::token() }}
                <fieldset>

                    <legend>Tell us your rejection reason</legend>
                <div class="order-reject-wrap">

                </div>
                    <table class="table table-hover">
                            <tr>
                                <td><span class="settings-value">Others</span></td>
                                <td><input class="other" name="others" type="checkbox"></td>
                            </tr>
                    </table>
                    <div class='other-reason'></div>
                <div class="orderId"></div>
                <div>
                    <input class="btn btn-primary" type="submit" value="Ok">
                </div>
                </fieldset>
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>


<script>



</script>



