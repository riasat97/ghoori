@section('shop_term')
    <div id="animatedModalTerm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalTerm">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                    {{ Form::model($shop->shopTerm,array('route' => 'term.post','class'=>'cd-form floating-labels','id'=>'edit-term')) }}

                    <fieldset>
                        <legend>Terms and Conditions</legend>

                        <div class="icon">
                            <label class="cd-label" for="cd-textarea-terms">Terms & conditions</label>
                            {{ Form::textarea('content',null,array('id'=>'cd-textarea-terms','class'=>'message addedtinymce','placeholder'=>'Tell something about terms and conditions')) }}
                        </div>

                        <div>
                            {{ Form::submit('Ok',array('id'=>'term-saved')) }}
                        </div>
                    </fieldset>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@show


