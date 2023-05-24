@section('createProduct')
<div id="animatedModalProduct">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="close-animatedModalProduct">
                    <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-content">

        <div class="container">
            <div class="">
                <script type="text/javascript">

                    $(document).ready(function(){
                        charSet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                        charSetSize = charSet.length;
                        charCount = parseInt(8);
                        idCount = charCount;
                        generateRandomId = function() {
                            var id = '';
                            for (var i = 1; i <= charCount; i++) {
                                var randPos = Math.floor(Math.random() * charSetSize);
                                id += charSet[randPos];
                            }
                            return id;
                        }
                        var RandForThisPage = generateRandomId();
                        $(".ch_pd_key").val(RandForThisPage);
                        // console.log( $(".ch_pd_key").val());
                        // console.log("Key: "+RandForThisPage);
                        // alert("ding");


                    })
                </script>
                <div class="row">

                    <div class="col-md-12 create-product">

                                <!-- Product submit -->
                        {{ Form::open(array('class'=>'cd-form floating-labels','id'=>'create-product','name'=>'ghuri-product','files'=>true,'enctype' => 'multipart/form-data')) }}
                            <input type="hidden" name="ch_pd_key" class="ch_pd_key">
                            <fieldset>
                                <legend>Create new Product</legend>

                                <!-- <input type="file" name="file" /> -->
                                <div class="icon field">
                                    <label class="cd-label" for="website">Name</label>
                                    <input required class="cd-product-name text" type="text" name="name" id="cd-product-name" placeholder="Product Name">
                                    <p class="cd-form-error error-name hidden"></p>
                                </div>
                                <div class="icon field">
                                    <label class="cd-label" for="">Select Category</label>
                                    <label class="cd-label" id="category-tree"><span id="catspan"></span><i class="fa fa-angle-right"></i><span id="subcatspan"></span><i class="fa fa-angle-right"></i><span id="subsubcatspan"></span></label>
                                    <a class="cd-bouncy-nav-trigger btn btn-info" href="#">Browse categories</a>
                                    <input type="hidden" name="category_id" id="category-id-field">
                                    <input type="hidden" name="subcategory_id" id="subcategory-id-field">
                                    <input type="hidden" name="subSubCategory_id" id="subsubcategory-id-field">

                                </div>
                                <div class="field">
                                    <label class="cd-label" for="cd-textarea">Product Image</label>
                                    <div class="images_wrap"><div id="images" orakuploader="on"></div></div>
                                    <p class="cd-form-error error-image hidden"></p>

                                </div>
                                <div class="icon field">
                                    <label class="cd-label" for="cd-textarea">Description</label><span class="char_counter"></span>
                                    <textarea required class="message" name="description" id="ProductDescMDE" placeholder="Product Description Goes Here"></textarea>
                                    <p class="cd-form-error error-description hidden"></p>
                                </div>

                                <div class="icon field">
                                    <label class="cd-label" for="cd-shop">Price</label>
                                    <input class="cd-product-price" type="text" name="price" id="cd-price" required placeholder="Price">
                                    <p class="cd-form-error error-price hidden"></p>
                                </div>
                                <div class="icon field">
                                    <label class="cd-label" for="cd-shop">No. of Stock</label>
                                    <input class="cd-product-stock" type="text" name="stock" id="" required placeholder="">
                                    <p class="cd-form-error error-stock hidden"></p>
                                </div>
                                <div class="icon field">
                                    <label class="cd-label" for="cd-shop">Weight (including packaging)</label>
                                    <input class="cd-product-weight" type="text" name="weight" id="" required placeholder="Weight">
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
                                    <!-- <label class="cd-label cd-label-underline" for="cd-shop">Advanced</label> -->

                                    {{--Add Attribute Form : Color Box --}}
                                    <div class="icon field" id="p_colors">
                                    <label class="cd-label" for="p_scnts">Add Colors <a href="#" id="addColor" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></a></label>
                                        <div class="color_item">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                              <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                  <img src="{{asset('img/picture-add-128x128.png')}}">
                                              </div>
                                              <div>
                                                <input type="file" name="colorimage[]" class="hidden">
                                              </div>
                                            </div><input class="cd-product-color-name text" type="text" name="color[]" placeholder="Product Color"><a href="#" class="btn btn-danger btn-circle remColor"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>


                                    {{--Add Attribute Form : Size Box --}}
                                    <div class="icon field" id="p_sizes">
                                        <p>
                                            <label class="cd-label" for="p_scnts">Add Size <a href="#" id="addSize" class="btn btn-success btn-circle "><i class="fa fa-plus"></i></a></label>
                                            <input class="cd-product-size-name text" type="text" name="size[]" id="p_scnt" placeholder="Product Size"><a href="#" class="btn btn-danger btn-circle remSize"><i class="fa fa-times"></i></a>

                                            {{--<p class="cd-form-error error-color hidden"></p>--}}
                                        </p>
                                    </div>


                                    <div class="icon field" id="p_properties">
                                        <label class="cd-label" for="p_scnts">Add Specification <a href="#" id="addProperty" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></a></label>
                                    </div>
                                </div>
                                <!-- <input type="button" value="Add Attribute" id="attributeToggle" class="advanced-toggle" data-toggle="modal" data-target="#chProductFromAttributeChoose">
                                <input type="button" value="Add Specification" id="propertyToggle" class="advanced-toggle"> -->
                                {{ Form::hidden('shop_id',$shop->id) }}
                                {{ Form::token()}}
                                <input id="mme-token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="clearfix">
                                    <button name="submit" id="productsubmit" class="" type="submit" value="Ok" disabled>Ok</button>
                                </div>
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('shops.myshop._partials.attributeSelector')
@include('shops.myshop._partials.attribute')
<script type="text/javascript">
    function initOrakUploader () {
            $('#images').orakuploader({
                orakuploader_path              : '{{URL::to('orakuploader')}}/',
                orakuploader_main_path         : '{{URL::to('img_tmp')}}',
                orakuploader_thumbnail_path    : '{{URL::to('img_tmp/thumb')}}',
                orakuploader_add_image         : '{{asset('orakuploader/images/add.png')}}',
                orakuploader_add_label         : 'Browser for images',
                orakuploader_use_sortable      : true,
                orakuploader_resize_to         : 800,
                orakuploader_thumbnail_size    : 200,
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
                orakuploader_finished: function() {
                    // alert("Uploading finished.");
                    $("#productsubmit").prop("disabled", false);
                },
                orakuploader_picture_deleted : function(filename) {

                    if (window.confirm("Do you really want to remove this image?")) {
                        var imageCount = $("#images .multibox.file").length - 1;
                        // console.log(imageCount+" Picture \""+filename+ "\" is deleted.");
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
        }

    $(document).on('click','#add-new-product',function(e){
        e.preventDefault();
        var response = '';
        var productOverFlow="{{ $productOverFlow['status'] }}";
        if($.parseJSON(productOverFlow)){
        response = '<div class="alert alert-danger alert-dismissible @if(!$productOverFlow['status'])hidden @endif" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
           ' <div class="">'+
          ' <p class=""><strong>Maximum product limit exceed!!!</strong>Currently your package ('+
        '{{$shop->package->name}}) supports {{Config::get('productlimit.'.$shop->package->name)}} products..'+
            'But You have total {{ $productOverFlow['count'] }} products..Please {{ link_to_route('pricing','upgrade package') }} to display all'+
            ' of your products on public view..Otherwise these products will be forcefully deleted with in 15 days period.'+
           ' </p>'+
            '</div>'+
            '</div>';
        $('.create-product').html(response);
        }

    });
    $(document).ready(function() {
        var form = document.querySelector('#create-product');
        var request = new XMLHttpRequest();
<<<<<<< HEAD
        var text_max = 600;
        $('.char_counter').html(text_max + ' characters remaining');

        $('.message').keyup(function() {
            var text_length = $('.message').val().length;
            var text_remaining = text_max - text_length;

            $('.char_counter').html(text_remaining + ' characters remaining');


            if( $('.message').val().length > 600) {
                $('.error-description').removeClass('hidden').text('600 characters exceeded.');
            }
            else $('.error-description').addClass('hidden').text('');
        });
=======
        var text_max = 1000;
            $('.char_counter').html(text_max + ' characters remaining');
            var text_length = simplemde.value().length;
            var text_remaining = 0;
            text_remaining = text_max - text_length;
                $('.char_counter').html(text_remaining + ' characters remaining');
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


>>>>>>> 93f68578ceea0618f5af8b8ab0097e911bbbc9de
        form.addEventListener('submit', function(e){
            e.preventDefault();
            $("#productsubmit").prop('disabled', true).html("<i class='fa fa-spin fa-spinner'></i> Ok");
            validateProductForm(e);
        });

        var validateProductForm = function (e) {
            if ($("#images .multibox.file").length == 0) {
                $('.error-image').removeClass('hidden').text('You have to upload minimum one image.');
                $( "body" ).scrollTop( 0 );
            } else if ( text_length > text_max ) {
                $('.error-description').removeClass('hidden').text(text_max+' characters exceeded.');
            } else {
                productSubmit(e);
                $('.error-image').addClass('hidden').text('');
            };
        }

        function productSubmit(e) {
            var formdata = new FormData(form);
            request.open('post', '{{URL::route('products.post')}}');
            request.send(formdata);
            var responseListener = function (event) {
                // console.log(event.target.responseText);
                var data = JSON.parse(event.target.responseText);
                if (!data.success) {
                    $('.cd-form-error').addClass("hidden").parent().find('input, textarea').removeClass('cd-form-input-error');
                    $.each(data.errors,function(index,error){
                        $('.error-'+index).removeClass('hidden').text(error).parent().find('input, textarea').addClass('cd-form-input-error');
                    });

                    request.removeEventListener('load', responseListener, false);
                    var value = $('.cd-form-input-error').first().scrollTop();
                    // alert(value);
                    $("html, body, #animatedModalProduct").animate({
                        scrollTop: value
                    }, 600);
                    $("#productsubmit").prop('disabled', false).html("Ok");
                    return false;
                }
                else{
                    var RandForThisPage = generateRandomId();
                    $(".ch_pd_key").val(RandForThisPage);
                    $.ajax({
                        url:"{{URL::route('getJson')}}",
                        data: {
                            "id": data.products.id
                        },
                        type: "GET",
                        success: function (response) {
                            console.log(response);
                            appeandNewProduct(response);
                            chorkiVerificationMessage(response);
                            appearPublishButton(response);
                            resetForm();
                            location.reload();
                            $('#category-tree').hide();
                            $("#productsubmit").prop('disabled', false).html("Ok");
                            $('.close-animatedModalProduct').click();
                        }
                    });
                    request.removeEventListener('load', responseListener, false);
                }


            };
            request.addEventListener('load', responseListener, false);

        }

        function resetForm() {
            $('#images_to_clone').remove( );
            $('#imagesDDArea').remove( );
            $('#create-product :input').not('#create-product :button, #create-product :submit, #create-product :reset, #create-product :hidden').removeAttr('checked').removeAttr('selected').not('#create-product :checkbox, #create-product :radio, #create-product select').val('');
            $('.images_wrap').html('<div id="images" orakuploader="on"></div>');
            $('#images').unbind().removeData();
            initOrakUploader();
        }

        function appeandNewProduct (response) {
            var data = response.product;
            appendedProduct = '<li class="product product-'+data.id+'">'
            +'<a class="flexslider product-list-thumb-flexslider" href="javascript:">'
            +'<ul class="slides">';

            for (var i = 0; i < data.images.length; i++) {

                appendedProduct += '<li><img src="'+data.url+'/'+data.images[i].imageLink+'" alt="Preview image"></li>'
            };

            appendedProduct += '</ul></a>'
            +'<div class="row cd-item-info">'
            +'<b class="col-xs-8"><a href="'+data.singleurl+'">'+ data.name +'</a></b>'

            +'<em class="col-xs-4 cd-price"><span class="pricewithcomma">'+ data.price+'</span> BDT</em>'
            +'</div>'

            +'<div class="btn-group options" role="group">'
            +'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'
            +'<span class="caret"></span>'
            +'</button>'
            +'<ul class="dropdown-menu" role="menu">'
            +'<li class="disabled"><a href="#">Edit Product</a></li>'
            +'<li><a class="product-status product-status-change-'+data.id+'" href="javascript;" data-id="'+data.id+'">Unpublish</a>'
            +'<li class="disabled"><a href="#" class="disabled">Delete Product</a></li>'
            +'<li><a class="move-cat-menu-nav" data-productid="'+data.id+'" href="#">Move Category</a></li>'
            +'</ul>'
            +'</div>'
            +'</li>';

            $('.cd-gallery').append(appendedProduct);
            renderPriceWithCommas();
            setTimeout(function () { $('.product-list-thumb-flexslider').flexslider({
                animation: "slide",
                slideshow: false
            }); }, 500);

            $('.guidetoaddproduct').find('.guide-circle').addClass('guide-circle-done');
        }

        function  chorkiVerificationMessage(response){
            if(response.chorkiVerified){

                appendChorkVerificationMessage= ' <div class="shop-chorkiVerification-unpublish-alert alert alert-warning alert-dismissible  " role="alert">'
                +' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                +'<strong>Thank You.Your Shop is under review !</strong> It will be published With in 48 hours.'
                +' </div>'
                $('.verify-message').html(appendChorkVerificationMessage);
            }
        }

        function appearPublishButton(response){
            if(response.appearPublishButton){
            $('.shop-status').removeClass('hidden');
            $('.shop-status').text("Unpublish");
            $('.shop-status').removeClass('btn-success').addClass('btn-danger');
            $('.guidetopublish').find('.guide-circle').addClass('guide-circle-done');
            }
        }


    });

    $(document).ready(function(){
        initOrakUploader();
    });

</script>


@show