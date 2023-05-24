<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); overflow-y: auto; z-index: -9999; opacity: 0;" class="animated animatedModalSocial-off" id="animatedModalSocial">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="close-animatedModalSocial">
                    <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-content container-fluid">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                    <fieldset>
                        {{ Form::model($shop->shopSocialNetwork,array('route' => array('settings.updateSocialNetwork',$shop->getSlug()),'method'=>'PUT','class'=>'cd-form floating-labels')) }}
                        @include('settings._partials.form')
                        {{ Form::close() }}
                    </fieldset>
            </div>
        </div>
    </div>
</div>