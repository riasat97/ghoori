@extends('shops.myshop._layouts.main')


@section('content')


            <div class="col-md-12">
                <div style="color: #00dd00; font-size: 15px;"><?php echo Session::get('info');?></div>

                {{ Form::open(array('route'=>'update-preorder','class'=>'cd-form floating-labels','id'=>'update-preorder','files'=>true,'enctype' => 'multipart/form-data','method'=>'POST')) }}


                <legend>Edit Product</legend>
                <input type="hidden" name="preorder_key" id="" value="{{$preorder->preorder_key}}">
                <input type="hidden" name="preorder_id" id="" value="{{$preorder->preorder_id}}">
                <input type="hidden" name="status" id="" value="{{$preorder->status}}">
                <div class="icon field">
                    <label class="cd-label" for="website">Name</label>
                    <input required class="" type="text" name="name" id="name" placeholder="Product Name" value="{{$preorder->name}}">
                    <p class="cd-form-error error-name hidden"></p>
                </div>

                <div id="file" orakuploader="on"></div>

                <div class="icon field">
                    <label class="cd-label" for="website"></label>

                    <p class="cd-form-error error-name hidden"></p>
                </div>


                <textarea id="test" name="description">{{$preorder->description}}</textarea>

                <div class="icon field">
                    <label class="cd-label" for="cd-shop">Weight (including packaging)</label>
                    <input class="cd-product-weight" type="text" name="weight" id="" required placeholder="Weight" value="{{$preorder->weight}}">
                    <select class="cd-product-weightunit" name="weightunit" id="" placeholder="Unit Weight">
                        <option value="gm" selected>
                            Gram
                        </option>
                        <option value="kg">
                            KG
                        </option>
                    </select>
                    <div class="clearfix"></div>
                    <p class="cd-form-error error-weight hidden"></p>
                </div>

                <div class="icon field">
                    <label class="cd-label" for="website">Price</label>
                    <input required class="" type="text" name="price" id="price" placeholder="price" value="{{$preorder->price}}">
                    <p class="cd-form-error error-name hidden"></p>
                </div>


                <div class="icon field">
                    <label class="cd-label" for="website"></label>
                    <input type="submit" value="Update" id="productsubmit" >
                    <p class="cd-form-error error-name hidden"></p>
                </div>
                {{ Form::hidden('shop_id',Session::get('shop_id')) }}
                {{ Form::close() }}
            </div>

<script>
    $(document).ready(function(){

        $('#file').orakuploader({
            orakuploader_path  		       : '{{URL::to('orakuploader')}}/',
            orakuploader_main_path         : '{{URL::to('img_tmp')}}',
            orakuploader_thumbnail_path    : '{{URL::to('img_tmp/thumb')}}',
            orakuploader_add_image         : '{{asset('orakuploader/images/add.png')}}',
            orakuploader_add_label         : 'Browser for images',
            orakuploader_use_sortable      : true,
            orakuploader_resize_to	       : 600,
            orakuploader_thumbnail_size    : 150,
            orakuploader_use_main          : true,
            orakuploader_main_changed      : function (filename) {
                $("#mainlabel-file").remove();
                $("div").find("[filename='" + filename + "']").append("<div id='mainlabel-file' class='maintext'>Main Image</div>");

                if ($("#file .multibox.file").length >= 4) {
                    $(".multibox.uploadButton").fadeOut();
                } else {
                    $(".multibox.uploadButton").fadeIn();
                };
            },
            orakuploader_maximum_uploads   : 4,
            orakuploader_max_exceeded      : function() {
                alert("You exceeded the max. limit of 4 images.");
            },
            orakuploader_attach_images: ["{{implode('" , "',$images)}}"],
            orakuploader_picture_deleted : function(filename) {

                if (window.confirm("Do you really want to remove this image?")) {
                    var imageCount = $("#file .multibox.file").length - 1;
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