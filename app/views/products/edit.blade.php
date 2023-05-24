@extends('admin._layouts.admin')
@section('title')
Edit {{ $product->name }} | Ghoori
@stop
@section('content')
    @include('_layouts.errors')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                {{ Form::model($product,array('route' => array('products.update',$product->id),'files' => true,'method' => 'put','class'=>'cd-form floating-labels')) }}

                <fieldset>
                    <legend>Update Product Info</legend>
                    <div class="icon field">
                        <label class="cd-label" for="website">Name</label>
                        {{ Form::text('name',null,array('class'=>'cd-product-name','id'=>'cd-product-name','required placeholder'=>'Product Name')) }}
                    </div>
                    <div id="images" orakuploader="on"></div>
                    
                    <div class="icon field">
                        <label class="cd-label" for="cd-textarea">Description</label><span class="char_counter"></span>
                        {{ Form::textarea('description',null,array('class'=>'message','id'=>'ProductDescMDE','required placeholder'=>'Product Description Goes Here')) }}
                        <p class="cd-form-error error-description hidden"></p>
                    </div>

                    <div class="icon field">
                        <label class="cd-label" for="cd-shop">Price</label>
                        {{ Form::text('price',null,array('id'=>'cd-price','class'=>'cd-product-price','required placeholder'=>'Price')) }}
                    </div>
                    <div class="icon field">
                        <label class="cd-label" for="cd-shop">No. of Stock</label>
                        {{ Form::text('stock',null,array('class'=>'','id'=>'','placeholder'=>'product quantity')) }}
                        <p class="cd-form-error error-stock hidden"></p>
                    </div>
                    <div class="icon field">
                        <label class="cd-label" for="cd-shop">Weight</label>
                        {{ Form::text('weight',null,array('class'=>'cd-product-weight','id'=>'','placeholder'=>'Weight')) }}

                        {{ Form::select('weightunit',array('gm' => 'Gram', 'kg' => 'KG'),null,array('class' => 'cd-product-weightunit')) }}

                        <div class="clearfix"></div>
                        <p class="cd-form-error error-weight hidden"></p>
                    </div>

                    <div class="icon field">
                        <div class="icon field" id="p_colors">
                            
                            <label class="cd-label" for="p_scnts">Add Colors <a href="#" id="addColor" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></a></label>
                                
                                {{-- $color --}}
                                @foreach($attributes as $color)

                                    @if($color->type == 'color')
                                    <div class="color_item">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                <img src="{{asset('public_img/shop_'.$product->shop_id.'/products/colors/'.$color->image)}}">
                                            </div>
                                            <div>
                                                <input type="file" name="colorimage[]" class="hidden">
                                            </div>
                                        </div>
                                        <input class="cd-product-color-name text" type="text" name="color[]" value="{{ $color->value }}" placeholder="Product Color">
                                        <input class="color-id" type="hidden" name="colorid[]" value="{{ $color->productAttributeId }}" placeholder="">
                                        <a href="#" class="btn btn-danger btn-circle remColor"><i class="fa fa-times"></i></a>
                                    </div>
                                        @endif
                                    @endforeach
                             
                            
                        </div>

                        <div class="icon field" id="p_sizes">

                                <label class="cd-label" for="p_scnts">Add Size <a href="#" id="addSize" class="btn btn-success btn-circle "><i class="fa fa-plus"></i></a></label>
                                @if($product->attributes->count())
                                    @foreach($product->attributes as $size)
                                        @if($size->type == 'size')
                                <p><label class="cd-label" for="p_scnts"></label>
                                <input type="text" class="cd-product-size-name text" id="p_scnt" name="size[]" value="{{$size->pivot->value}}" placeholder="Product Size"><a href="#" class="btn btn-danger btn-circle remSize"><i class="fa fa-times"></i></a>
                                </P>
                                        @endif
                                    @endforeach
                                @endif

                        </div>

                        <div class="icon field" id="p_properties">
                            <label class="cd-label" for="p_scnts">Add Specification <a href="#" id="addProperty" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></a></label>
                            @if($product->properties->count())
                                 @foreach($product->properties as $property)
                                    <div class="cd-property-group">
                                    <input class="cd-product-label cd-product-property-name text" type="text" name="label[]" value="{{$property->type}}" id="p_label" placeholder="Property">
                                    <input class="cd-product-value cd-product-property-name text" type="text" name="value[]" value="{{$property->value}}" id="p_value" placeholder="Value">
                                    <a class="btn btn-danger btn-circle property-close"> <i class="fa fa-times fa-x"></i></a> </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{ Form::hidden('shop_id', $shop->id) }}
                    {{-- <input type="button" value="Edit Attribute" id="attributeToggle" class="advanced-toggle" data-toggle="modal" data-target="#chProductFromAttributeChoose"> --}}
                    {{-- <input type="button" value="Edit Properties" id="propertyToggle" class="advanced-toggle"> --}}
                    {{ Form::token()}}
                    <input id="mme-token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div>
                        <input type="submit" value="Ok" name="submit" id="productUpdate" >
                    </div>
                </fieldset>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@include('shops.myshop._partials.attributeSelector')
@include('shops.myshop._partials.attribute')
<script>
        $(document).ready(function(){

            var text_max = 1000;
            $('.char_counter').html(text_max + ' characters remaining');
            var text_length = simplemde.value().length;
            var text_remaining = 0;
            text_remaining = text_max - text_length;
            $('.char_counter').html(text_remaining + ' characters remaining');
            if( text_length > text_max) {
                $('.char_counter').html(text_max+' characters exceeded. '+ ( text_length - text_max)+' extra characters.'); 
            }
            simplemde.codemirror.on("change", function(){
                simplemde.codemirror.save();
                text_length = simplemde.value().length;
                text_remaining = text_max - text_length;
                $('.char_counter').html(text_remaining + ' characters remaining');      
              
                if( text_length > text_max) {
                    $('.error-description').removeClass('hidden').text(text_max+' characters exceeded.');
                    $('.char_counter').html(text_max+' characters exceeded. '+ ( text_length - text_max)+' extra characters.'); 
                }
                else $('.error-description').addClass('hidden').text('');
            });

            $('#images').orakuploader({
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
                orakuploader_attach_images: ["{{implode('" , "',$images)}}"],
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