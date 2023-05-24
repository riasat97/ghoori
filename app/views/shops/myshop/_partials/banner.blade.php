@section('banner')
    <div id="animatedModalBanner">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalBanner">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content container-fluid">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                {{ Form::open(array('route' => 'uploadBanner.post','class'=>'cd-form floating-labels','id'=>'banner-image-upload','enctype' => 'multipart/form-data','files' => true, 'name' =>'banner-uploader')) }}

                    <fieldset>
                        <legend>Upload Banner</legend>
                        <div class="">
                            <!-- <label class="cd-label" for="">Banner Image</label> -->
                            <div class="row upload-box">
                                <div class="col-lg-12">
                                    <p>Instruction about banner upload</p>
                                </div>
                                <div class="col-lg-6">
                                    <input id="uploadFile" class="uploadFile" placeholder="Choose File" disabled="disabled" />
                                </div>
                                <div class="col-lg-2">
                                    <div class="fileUpload btn btn-primary">
                                        <span>Select Image</span>
                                        {{Form::file('path', array('class' => 'upload')) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                        {{ Form::submit('Upload',array('id'=>'banner-upload'/*,'class'=>'close-animatedModalBanner'*/)) }}
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


