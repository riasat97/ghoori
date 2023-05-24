@section('about_shop')
    <div id="animatedModalAbout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalAbout">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                        
                    {{ Form::open(array('route' => 'about.post','class'=>'cd-form floating-labels','id'=>'edit-about')) }}

                    <fieldset>
                        <legend>About Shop</legend>

                        <div class="icon">
                            <label class="cd-label" for="cd-shop">About</label>
                            {{ Form::textarea('description',$shop->description,array('id'=>'','class'=>'message addedtinymce','placeholder'=>'Tell something about your shop')) }}
                        </div>

                        <div>
                            {{ Form::submit('Ok',array('id'=>'about-saved')) }}
                        </div>
                    </fieldset>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>


@show


