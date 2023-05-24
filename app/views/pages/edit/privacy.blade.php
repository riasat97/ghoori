@section('shop_privacy')
    <div id="animatedModalPrivacy">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalPrivacy">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                    {{ Form::model($shop->shopPrivacy,

                    array('route' => 'privacy.post','class'=>'cd-form floating-labels','id'=>'edit-privacy')) }}

                    <fieldset>
                        <legend>Privacy Policy</legend>

                        <div class="icon">
                            <label class="cd-label" for="cd-textarea-privacy">Privacy Policy</label>
                            {{ Form::textarea('content',null,array('id'=>'cd-textarea-privacy','class'=>'message addedtinymce','placeholder'=>'Tell something about your shop privacy policy')) }}
                        </div>

                        <div>
                            {{ Form::submit('Ok',array('id'=>'privacy-saved')) }}
                        </div>
                    </fieldset>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>


@show


