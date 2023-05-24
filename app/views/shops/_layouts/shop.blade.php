<!-- @todo Not in use 12/2015 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$shop->title}}</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    {{HTML::style('css/shop.css')}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
    {{HTML::style('public/css/font.css')}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
    {{HTML::style('public/css/stylenew.css')}}


    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
    {{ HTML::script('public/js/shop.js') }}
    {{ HTML::script('public/js/script.js') }}

    <!-- =========== -->
    <!-- Google Font -->
    <!-- =========== -->

    <script type="text/javascript">

        // Add Google Font name here

        WebFontConfig = { google: { families: [ 'Bangers', 'Lato' ] } };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();

    </script>

    <style type="text/css">

        /* Add Google Font name here */

        .wf-active {font-family: 'Lato',serif; font-size: 14px;}
        .wf-active .logo {font-family: 'Bangers', serif;}

    </style>
</head>
<body>

@include('public.shop._partials.header')

<!-- Main component for a primary marketing message or call to action -->
<div class="container banner-container">
    <div class="row no-gutter">
        <div class="col-sm-4">
            <div class="profile-pic-wrap">
                <div data-toggle="modal" data-target="#imageUploadForm" class="profile-pic-circle" style="background-image:url('@if($shop->logo){{ $shop->logo->logo }}@endif')">
                    <div class="overlay">
                        <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                        <br/>Change Logo
                    </div>
                </div>
                <h3 class="">{{$shop->title}}</h3>
                <p class="address">@include('shops/_partials/address')</p>

            </div>
        </div>
        <div class="col-sm-8 banner_parent hidden-xs">
            <div  style="background-image:url('@if($shop->banner){{ $shop->banner->path }}@else http://cdn.wallwuzz.com/uploads/photos-computer-background-rain-spring-backgrounds-desktop-wallpaper-wallpapers-array-wallwuzz-hd-wallpaper-1475.jpg @endif ')" class=" banner"></div>

        </div>
    </div>
</div>
@include('shops._partials.banner')
<div class="container">
    <?php
    $statusRev = array(
            'Published' => 'Unpublish'
    , 'Unpublished' => 'Publish'
    ); ?>



    <div class="row">
        @include('shops._partials.sidebar')
        <div class="col-md-9">

            @include('shops/_partials/shopTitleUpdate')
            <section class="row" id="product_bed">

                {{--show products according to the category of the present shop--}}
                @if($shop->products)
                @foreach($shop->products as $key=>$product)
                    <div class="product col-md-4 product-container product-{{$product->id}}" data-productId="{{$product->id}}">
                    <div class="thumbnail">
                        <a href="javascript:" class="edit-image"><span class="glyphicon glyphicon-pencil"></span></a>
                        <img src="http://lorempixel.com/300/300/food/" alt="">
                        <div class="caption">
                            <h3 class="title">{{$product->name}}</h3>
                            <p>

                                {{link_to_route('products.show','View',array($product->id),array('class'=>'ch_btn ch_btn_invert','role'=>'button'))}}
                            <div class="product_id_container_productStatus">
                                <a class="ch_btn ch_btn_invert product-status product-status-change-{{$product->id}}"  href="{{ URL::route('status', $product->id) }}" data-id="{{$product->id}}">{{$statusRev[$product->status]}}</a>
                            </div>
                            <div>
                                <a href="javascript:" class="ch_btn ch_btn_invert edit-product-{{$product->id}} edit-product" role="button"  data-id="{{$product->id}}">Edit</a>
                            </div><br>
                            <div>
                                {{ Form::open(array('route' => array('products.destroy', $product->id), 'method' => 'delete', 'class' => 'destroy')) }}
                                {{ Form::submit('Delete',array('class'=>'ch_btn ch_btn_invert','role'=>'button')) }}
                                {{ Form::close() }}

                            </div><br>
                                <p class="description"> {{str_limit($product->description)}}</p>
                            <P class="price"><span class="amount">{{$product->price}}</span> Tk.</p>


                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                @include('products._partials.edit')

                {{--new product-add button--}}
                <div data-toggle="modal" class="product col-md-4 add-new-product-box">
                    <div class="thumbnail">
                        <img src="https://cdn2.iconfinder.com/data/icons/windows-8-metro-style/512/plus-.png" alt="">
                        <div class="caption">
                            <h3>Add New Product</h3>

                            {{--<button class="btn btn-success btn-block">Add New Product</button>--}}
                            <a href="javascript:" class="ch_btn ch_btn_invert" role="button" id="add-new-product">Add New Product</a>

                        </div>
                    </div>
                </div>
                {{--new product add form--}}
              {{--  <div class="product col-md-4 add-new-product-image-form" style="display:none;">--}}




                    {{--{{ Form::close() }}--}}

               {{-- </div>--}}

                <div class="product col-md-4 add-new-product-form" style="display:none;">
                    {{ Form::open(array('route' => 'products.post','id'=>'create-product')) }}
                    @include('products._partials.category')
                    {{--{{ Form::close() }}--}}

                </div>
                <div class="product col-md-4 add-new-product-form-next" style="display:none;">
                    <div class="row product-main-image">
                        <div class="col-md-12  text-center vcenter">
                            <a href="javascript:" class="add-image-1 upload-image" data-imageblock="1">Add Product Image</a>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-3 small-image-1">
                            <a href="javascript:" class="add-image-2 upload-image" data-imageblock="2">+</a>
                        </div>
                        <div class="col-md-3 small-image-2">
                            <a href="javascript:" class="add-image-3 upload-image" data-imageblock="3">+</a>
                        </div>
                        <div class="col-md-3 small-image-3">
                            <a href="javascript:" class="add-image-4 upload-image" data-imageblock="4">+</a>
                        </div>
                        <div class="col-md-3 small-image-4">
                            <a href="javascript:" class="add-image-5 upload-image" data-imageblock="5">+</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                   {{-- <a href="javascript:" class="btn btn-success " role="button" id="add-product-image">ADD Prduct image</a>--}}
                    @include('products._partials.form')
                    {{ Form::close() }}
                </div>
                @include('products._partials.image')
            </section>

            {{--pagination--}}

        </div>
    </div>

    <!-- Image Upload Form -->
    <div class="modal fade" id="imageUploadForm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                    {{ Form::open(array('route' => 'uploadLogo.post', 'files' => true)) }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Upload Logo</h4>
                    </div>
                    <div class="modal-body">
                        <!--Form Body-->

                        {{Form::file('logo')}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{ Form::submit('save', array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                        {{--<button type="button" class="btn btn-primary">Save</button>--}}
                    </div>
            </div>
        </div>
    </div><!--Image Upload form-->



</div> <!-- /container -->

@include('public.shop._partials.footer')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}
<!-- Latest compiled and minified JavaScript -->


{{HTML::script('js/product.js')}}




<script>
    $("#add-new-product").click(function(){
        $(".add-new-product-box").hide(300);
        $(".add-new-product-form").show(300);
    });
    $("#category-to-product").click(function(){
        $(".add-new-product-form").hide(300);
        /*$("#product-image-upload-form").modal('show');*/
        $(".add-new-product-form-next").show(300);

    });
    $(".upload-image").click(function(){

       var serial = $(this).data('imageblock');
        console.log(serial);
        var hiddenImageSerialField = '<input type="hidden" name="serial" value="'+serial+'" />';
        $("#product-image-upload").append(hiddenImageSerialField);
        $("#product-image-upload-form").modal('show');
    });


    /* $("#productsave").click(function(e){
         e.preventDefault();
         var categoryid = $('.categorybreadcrumb-3').attr("data-id");
         var data = $("#newproduct").serialize();
         data = data + '&category_id=' + categoryid;
         console.log(data);
         var formUrl = $(this).attr("action");
         $.ajax({
                 url: formUrl,
                 data: data,
                 type: "POST",
                 success: function(data) {
                     // do something
                     showRecentProduct(data);
                 },
                 error: function(){

                 }
         });
     });*/

    function showRecentProduct() {
    }
    $(document).on('click', '.yamm .dropdown-menu', function(e) {
        e.stopPropagation()
    })
    $("#logo").hover(function(){
        $("#logo .overlay").show();
    },function(){
        $("#logo .overlay").hide();
    });
    $('.clickablelink').click(function(e){
        e.preventDefault();
        var clikedCategoryId = $(this).attr('data-id');
        var clickedCategoryName = $(this).attr('data-name');
        console.log(clickedCategoryName);
        $('.categorybreadcrumb-3').text(clickedCategoryName);
        $('.categorybreadcrumb-3').attr("data-id", clikedCategoryId);
    });
</script>

<script>
    /* $('.edit-address').click(function() {
     $('.address-container').hide();
     $("#contact-edit").show();

     });*/
    $(document).ready(function(){

        var info = $('.info');
        // var msg = $('#product-message');
        $("#create-product").submit(function(e) {
            e.preventDefault();
            console.log('working---!');
            var data = $("#create-product").serialize();
            // msg.html('loading...');


            $.ajax({
                url: '{{URL::route('products.post')}}' ,
                data: data,
                type: "POST",

                success: function(data) {

                    info.hide().find('ul').empty();

                    if (!data.success) {
                        $.each(data.errors,function(index,error){
                            info.find('ul').append('<li>'+error+'</li>');
                        });
                        info.slideDown();


                    }
                    else{
                        //info.find('ul').append('<li>Successfully Created.!!! </li>');
                        //info.slideDown();
                        showProduct(data);
                        //

                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert('Something went to wrong.Please Try again later...');
                }
            });
        });

    });


    function showProduct(data) {
        console.log(data.products);
        product = data.products;
        var revStatus = {Published:"Unpublish", Unpublished:"Publish"};
        console.log(product.status);
        $('input[type="text"],textarea').val('');
        $('input[type="number"],textarea').val('');
        $(".add-new-product-form-next").hide(300);
        var html = '<div class="product col-md-4 product-container product-'+product.id+'" data-productId="'+product.id+'">';
                html += '<div class="thumbnail">';
                    html += '<a href="javascript:" class="edit-image">';
                        html += '<span class="glyphicon glyphicon-pencil"></span>';
                    html += '</a>';
                    html += '<img src="http://lorempixel.com/300/300/food/" alt="">';
                /*html += '</div>';*/

                html += '<div class="caption">';
                    html += '<h3 class="title">';
                        html += product.name;
                    html += '</h3>';
                html += '</div>';

                html += '<div>';
                    html += '<a href="#" class="ch_btn ch_btn_invert" role="button">View Details</a>';
                html += '</div>';

                html += '<div class="product_id_container_productStatus">';
                    html += '<a class="ch_btn ch_btn_invert product-status product-status-change-'+product.id+'"   data-id="'+product.id+'">';
                        html += revStatus[product.status];
                    html += '</a>';
                html += '</div>';

                html += '<div>';
                    html += '<a href="javascript:" class="ch_btn ch_btn_invert edit-product-'+product.id+' edit-product" role="button"  data-id="'+product.id+'">Edit</a>';
                html += '</div>';

                html += '<p class="description">'+product.description+'</p>';
                html += '<P class="price"><span class="amount">'+product.price+'</span> Tk.</p>';

            html += '</div></div>';

        $('section#product_bed').append(html);
        $(".add-new-product-box").show(300);


    }

    $(document).on('click','.product-status',function(e){
        e.preventDefault();
        var productId = $(this).data('id');
        console.log(productId);
        var data = $(this).text();

        var hiddenProductIdField = '<input type="hidden" name="product_id" value="'+productId+'" />';
        $('.product_id_container_productStatus').append(hiddenProductIdField);

        //console.log(hiddenProductIdField);
        /*  if (data === 'Unpublished'){
         var data2 = $(this).text('Published');
         //var productStatus = $('.product-status-change-'+productId+' .product-status').text();
         //$(this).text(productStatus);
         }*/

        $.ajax({
            url: "http://localhost/products/status/"+productId+"",
            //data: { productId :productId} ,
            type: "GET",
            success: function(productStatus) {
                //alert ("successfully loaded");
                changeProductStatus(productStatus);

            },
            error: function(){

            }
        });


    });

    function changeProductStatus(productStatus){
        if (productStatus.status === 'success'){
            var productId = productStatus.product;
            var data = $('.product-status-change-'+productId).text("Unpublish");
        }

        else{
            var productId = productStatus.product;
            var data =  $('.product-status-change-'+productId).text("Publish");

        }


    }

    $(document).on('click','.shop-status',function(e){
        e.preventDefault();
        var shopId = $(this).data('id');
        console.log(shopId);

        $.ajax({
            url: "http://localhost/shops/status/"+shopId+"",
            //data: { productId :productId} ,
            type: "GET",
            success: function(shopStatus) {
                //alert ("successfully loaded");
                changeShopStatus(shopStatus);

            },
            error: function(){

            }
        });


    });

    function changeShopStatus(shopStatus){
        if (shopStatus.status === 'success'){
            var shopId = shopStatus.shop;
            var data = $('.shop-status').text("Unpublish");
            $('.shop-chorkiVerification-unpublish-alert').removeClass('hidden');
        }

        else{
            var shopId = shopStatus.shop;
            var data =  $('.shop-status').text("Publish");
            $('.shop-chorkiVerification-unpublish-alert').addClass('hidden');

        }


    }


</script>
</body>
</html>
