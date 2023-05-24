@section('createPreorder')


    <div id="animatedModalPreorder">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <div class="close-animatedModalPreorder">
                        <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container modal-content_1">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-10 col-lg-10 col-lg-offset-1">

                    <div class="row">

                        <div class="col-md-12">
                            <!-- Product submit -->

                            {{ Form::open(array('route'=>'save-preorder','class'=>'cd-form floating-labels','id'=>'create-preorder','files'=>true,'enctype' => 'multipart/form-data','method'=>'POST')) }}


                                <legend>Add New Product for Pre-book</legend>
                            <input type="hidden" name="preorder_key" id="ch_preorder_key" value="">
                                <div class="icon field">
                                    <label class="cd-label" for="">Name</label>
                                    <input required class="" type="text" name="name" id="name" placeholder="Product Name">
                                    <p class="cd-form-error error-name hidden"></p>
                                </div>
                            <div class="icon field">
                                <label class="cd-label" for="">Images</label>

                                <input type="file" name="files[]" id="filer_input" multiple="multiple">
                            </div>
                            

                            <div class="icon field">
                                <label class="cd-label" for=""></label>

                                <p class="cd-form-error error-name hidden"></p>
                            </div>
                            <div class="field">
                                <label class="cd-label" for="">Description</label>
                                <textarea class="textfield-descripton" id="ProductDescMDE" name="description"></textarea>
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
                                <label class="cd-label" for="">Price</label>
                                <input required class="" type="text" name="price" id="price" placeholder="price">
                                <p class="cd-form-error error-name hidden"></p>
                            </div>

                            <div class="icon field">
                                <label class="cd-label" for="">YouTube Video Link</label>
                                <input class="" type="text" name="product_url" id="product_url" placeholder="URL">
                                <p class="cd-form-error error-name hidden"></p>
                            </div>

                            <div class="icon field">
                                <label class="cd-label" for=""></label>
                                <input type="submit" value="Next" id="productsubmit" >
                                <p class="cd-form-error error-name hidden"></p>
                            </div>
                            {{ Form::hidden('shop_id',Session::get('shop_id')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shops.myshop._partials.attributeSelector')
    @include('shops.myshop._partials.attribute')
<script>


</script>
    <script>
        $(document).ready(function() {
            $('#filer_input').filer({
                limit: 3,
                maxSize: 3,
                extensions: ['jpg', 'jpeg', 'png', 'gif'],
                changeInput: true,
                showThumbs: true,
               // onRemove: function test(){ removeFunction();},
                uploadFile: {
                    url: "{{URL::to('jQuery.filer/php/upload.php')}}", //URL to which the request is sent {String}
                    data: null, //Data to be sent to the server {Object}
                    type: 'POST', //The type of request {String}
                    enctype: 'multipart/form-data', //Request enctype {String}
                    beforeSend: null, //A pre-request callback function {Function}
                    success: function sendlink(response) {
                        // console.log(response);
                        var temp = JSON.parse(response);
                        // console.log(temp.metas[0].name);
                        processImage(temp.metas[0].name);
                        }, //A function to be called if the request succeeds {Function}
                    error: null, //A function to be called if the request fails {Function}
                    statusCode: null, //An object of numeric HTTP codes {Object}
                    onProgress: null, //A function called while uploading file with progress percentage {Function}
                    onComplete: null //A function called when all files were uploaded {Function}

                }
            });

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
            var Rand = generateRandomId();
            $("#ch_preorder_key").val(Rand);

            function processImage(image_name){
                
                var preorder_key = Rand;
                var data = {
                    preorder_key : preorder_key,
                    _token : '{{csrf_token()}}',
                    image_name : image_name
                };
                $.ajax({
                    type: "POST",
                    url : "{{route('save-preorder-image')}}",
                    data : data,
                    success : function(data){
                        console.log(data);
                    }
                },"json");
            }

            function removeFunction(){
             alert('remove testing');

            }


        });
    </script>

@show