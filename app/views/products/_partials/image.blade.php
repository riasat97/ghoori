<!-- @todo Not in use 12/2015 -->
 <div class="span5">
        <div id="main-image" >
        </div>


<div class="modal fade" id="product-image-upload-form" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            {{ Form::open(array(/*'route' => 'upload.post',*/'id'=>'product-image-upload','enctype' => 'multipart/form-data','files' => true, 'name' =>'image-uploader')) }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upload Image</h4>
            </div>

            <div class="modal-body">
                <!--Form Body-->
                <li>
                    {{ Form::label('Product-color', 'Color Name/Code') }}
                    {{ Form::text('title') }}
                    {{ $errors->first('name', '<p class="error">:message</p>') }}
                </li>
                {{Form::file('imageLink')}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::submit('upload', array('id'=>'image-to-product','class' => 'btn btn-primary')) }}
                {{ Form::close() }}
                {{--<button type="button" class="btn btn-primary">Save</button>--}}
            </div>
        </div>
    </div>
</div>
<script>
    var form = document.querySelector('#product-image-upload');
    var request = new XMLHttpRequest();

    form.addEventListener('submit', function(e){
        e.preventDefault();
        var formdata = new FormData(form);
        request.open('post', '{{URL::route('uploadProductImage')}}');
        request.send(formdata);
    });

    request.addEventListener('load',function(e){
        $("#product-image-upload-form").modal('hide');
            var response = JSON.parse(e.target.responseText);
            showImage(response);
    },false);


    function showImage(response){


        if(response.status === 'success')
        {
            var data = response.productImage;
             console.log(data);
            if(data.serial === '1'){

            var mainImage = ' <img src="'+data.imageLink+'" alt=""/ width="250" height="70">';
            $('.product-main-image').append(mainImage);
                var imageId = '<input type="hidden" name="image_id[]" value="'+data.id+'" />';
                  $('#create-product').append(imageId);
            }
            else if(data.serial === '2')
            {
                var smallImage = ' <img src="'+data.imageLink+'" alt=""/ width="70" height="70">';
                $('.small-image-1').append(smallImage);
                var imageId = '<input type="hidden" name="image_id[]" value="'+data.id+'" />';
                console.log(imageId);
                $('#create-product').append(imageId);

            }
            else if(data.serial === '3')
            {
                var smallImage = ' <img src="'+data.imageLink+'" alt=""/ width="70" height="70">';
                $('.small-image-2').append(smallImage);
                var imageId = '<input type="hidden" name="image_id[]" value="'+data.id+'" />';
                $('#create-product').append(imageId);
            }
            else if(data.serial === '4')
            {
                var smallImage = ' <img src="'+data.imageLink+'" alt=""/ width="70" height="70">';
                $('.small-image-3').append(smallImage);
                var imageId = '<input type="hidden" name="image_id[]" value="'+data.id+'" />';
                $('#create-product').append(imageId);
            }
            else if(data.serial === '5')
            {
                var smallImage = ' <img src="'+data.imageLink+'" alt=""/ width="70" height="70">';
                $('.small-image-4').append(smallImage);
                var imageId = '<input type="hidden" name="image_id[]" value="'+data.id+'" />';
                $('#create-product').append(imageId);
            }
          /*  var name = $('.product-'+productId+' .title').text();
            $('.edit-product-name input').val(product.name);

            var description = $('.product-'+productId+' .description').text();
            $('.edit-product-description textarea').val(product.description);

            var price = $('.product-'+productId+' .price .amount').text();
            console.log(price);
            $('.edit-product-price input[type=number]').val(product.price);*/
        }
    }
   /* $("#editproduct").on('submit',function(e){
        e.preventDefault();
        var form = $(this);
        var data = $("#editproduct").serialize();

        $.ajax({
            url: '{{--{{URL::route('edit')}}--}}',
            data: data,
            type: "POST",
            success: function(response) {
                var message = form.data('remote-success-message');
                alert(message);
                changeProductView(response);

            },
            error: function(){

            }
        });

    });

    function changeProductView(response){
        console.log(response);
        if (response.status === 'success') {
            $('.edit-product-form').hide();
            var productId = response.product.product_id;
            console.log(response.product.name);
            $('.product-' + productId).show();
            $('.product-'+productId+' .price').text(response.product.price);
            $('.product-'+productId+ ' .title').text(response.product.name);
            $('.product-'+productId+ ' .description').text(response.product.description);


        } else {

        }
    }*/

</script>