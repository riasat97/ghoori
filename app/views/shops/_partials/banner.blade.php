
    <div class="modal fade" id="banner-image-upload-form" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">

                {{ Form::open(array('route' => 'uploadBanner.post','id'=>'banner-image-upload','enctype' => 'multipart/form-data','files' => true, 'name' =>'banner-uploader')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload Banner</h4>
                </div>

                <div class="modal-body">
                    <!--Form Body-->
                    <li>
                        {{ Form::label('banner-title', 'Banner Title') }}
                        {{ Form::text('title') }}
                        {{ $errors->first('title', '<p class="error">:message</p>') }}
                    </li>
                    {{Form::file('path')}}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{ Form::submit('upload', array('id'=>'banner-image-submit','class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                    {{--<button type="button" class="btn btn-primary">Save</button>--}}
                </div>
            </div>
        </div>
    </div>
<script>

    $(document).on('click','.banner-image',function(){
    $("#banner-image-upload-form").modal('show');
    });

</script>