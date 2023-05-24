@extends('admin._layouts.admin')
@section('title')
    Upload Banner
@stop
@section('content')
    @include('_layouts.errors')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                {{ Form::model($shop,array('route' => array('post.theme.uploadBanner'),'files' => true,'method' => 'post','class'=>'cd-form floating-labels')) }}

                <fieldset>

                    <div id="images" orakuploader="on"></div>

                    {{ Form::hidden('shop_id',$shop->id) }}
                    {{ Form::token()}}
                    <div>
                        <input type="submit" value="Ok" name="submit" id="productUpdate" >
                    </div>

                </fieldset>

                {{ Form::close() }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#images').orakuploader({
                orakuploader_path  		       : '{{URL::to('orakuploader')}}/',
                orakuploader_main_path         : '{{URL::to('img_tmp')}}',
                orakuploader_thumbnail_path    : '{{URL::to('img_tmp/thumb')}}',
                orakuploader_add_image         : '{{asset('orakuploader/images/add.png')}}',
                orakuploader_add_label         : 'Browser for images',
                orakuploader_use_sortable      : true,
                // orakuploader_resize_to	       : 800,
                orakuploader_thumbnail_size    : 150,
                orakuploader_use_main          : true,
                orakuploader_main_changed      : function (filename) {
                    $("#mainlabel-images").remove();
                    $("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Main Image</div>");

                    if ($("#images .multibox.file").length >= 4) {
                        $(".multibox.uploadButton").fadeOut();
                    } else {
                        $(".multibox.uploadButton").fadeIn();
                    };
                },
                orakuploader_maximum_uploads   : 4,
                orakuploader_max_exceeded      : function() {
                    alert("You exceeded the max. limit of 4 images.");
                },
                @if ($images)
                    orakuploader_attach_images: ["{{implode('" , "', $images)}}"],
                @else
                    orakuploader_attach_images: [],
                @endif
                orakuploader_picture_deleted : function(filename) {

                    if (window.confirm("Do you really want to remove this image?")) {
                        var imageCount = $("#images .multibox.file").length - 1;
                        console.log(imageCount+" Picture \""+filename+ "\" is deleted.");
                        if (imageCount >= 4) {
                            $(".multibox.uploadButton").fadeOut();
                        } else {
                            $(".multibox.uploadButton").fadeIn();
                        };
                        return true;
                    }
                    else return false;


                }
            });
        });

    </script>
@stop