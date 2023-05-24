@section('logo')
    <div id="animatedModalLogo">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalLogo">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content container-fluid">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                    {{ Form::open(array('route' => 'uploadLogo.post','class'=>'cd-form floating-labels','id'=>'logo-image-upload','enctype' => 'multipart/form-data','files' => true, 'name' =>'logo-uploader')) }}

                    <fieldset>
                        <legend>Upload Logo</legend>
                        <div class="row upload-box">
                            <div class="col-lg-12">
                                <p>Instruction about logo upload</p>
                            </div>
                            <div class="col-lg-6">
                                <input id="uploadFile" class="uploadFile" placeholder="Choose File" disabled="disabled" />
                            </div>
                            <div class="col-lg-2">
                                <div class="fileUpload btn btn-primary">
                                    <span>Select Image</span>
                                    {{Form::file('logo', array('class' => 'upload')) }}
                                </div>
                            </div>
                        </div>

                        <div>
                            {{ Form::submit('Upload',array('id'=>'logo-upload')) }}
                        </div>
                    </fieldset>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@show


