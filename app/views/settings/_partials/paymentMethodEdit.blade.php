
<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); overflow-y: auto; z-index: -9999; opacity: 0;" class="animated animatedModalPayment-off" id="animatedModalPayment">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="close-animatedModalPayment">
                    <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-content container-fluid">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                {{ Form::model($shop,array('route' => array('settings.updatePaymentMethods',$shop->getSlug()),'method'=>'PUT','class'=>'cd-form floating-labels')) }}
                {{ Form::token() }}
                    <fieldset>
                        <legend>Payment Method</legend>
                        <div class="icon">
                            {{ Form::label('', 'Choose Payment Methods', array("class"=>'cd-label')) }}
                            {{ Form::select('paymentMethod_id',$paymentMethods,$shop->paymentMethods->lists('id'),array('name'=>'paymentMethod_id[]',"class"=>"","id"=>"","multiple"=>"multiple")) }}
                        </div>
                        <!-- Other methods will be added soon. -->
                        <div class="icon">
                            <input class="btn btn-default" value="Ok" type="submit">
                        </div>
                    </fieldset>
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>