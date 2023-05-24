<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); overflow-y: auto; z-index: -9999; opacity: 0;" class="animated animatedModalShipping-off" id="animatedModalShipping">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="close-animatedModalShipping">
                    <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-content container-fluid">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                {{ Form::model($shop,array('route' => array('settings.updateShippingChannels',$shop->getSlug()),'method'=>'PUT','class'=>'cd-form floating-labels')) }}
                {{ Form::token() }}
                    <fieldset>

                        <legend>Shipping</legend>

                        <h4>Delivery</h4>

                        <ul class="cd-form-list">
                            <div class="icon">
                                {{ Form::label('', 'Choose Shipping Channels', array("class"=>'cd-label')) }}
                                {{ Form::select('shippingChannel_id',$shippingChannels,$shop->shippingChannels->lists('id'),array('name'=>'shippingChannel_id[]',"class"=>"","id"=>"","multiple"=>"multiple")) }}
                            </div>
                           
                        </ul>

                        <div class="icon">
                            <input class="btn btn-default" value="Ok" type="submit">
                        </div>
                    </fieldset>
             {{ Form::close() }}

            </div>
        </div>
    </div>
</div>