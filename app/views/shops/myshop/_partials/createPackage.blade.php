@extends('shops.myshop._layouts.main')


@section('content')

    <div class="col-xs-12">
        <!--h2 style="color: #0080FF;">Create new package</h2-->
    </div>
    <div class="col-xs-4">
        <h2>{{$preorder->name}}</h2>
        @foreach($preorder->images as $v_image)
        <img src="{{ asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_image->image)}}" class="img-responsive" alt="product image" id="myImage">
        @endforeach
    </div>
    <div class="col-xs-8">
        
                <!-- Product submit -->

                {{ Form::open(array('route'=>'save-package','class'=>'cd-form floating-labels','files'=>true,'enctype' => 'multipart/form-data','method'=>'POST')) }}
                <fieldset>
                    <legend>Create Package</legend>

                    <div class="icon field">
                        <label class="cd-label" for="">Advanced Payment</label>
                        <input class="text" type="text" name="amount[]" id="amo" placeholder="amount" value="{{$preorder->price}}" readonly>
                        {{--Add Attribute Form : Color Box --}}
                    </div>
                    <div class="icon field">
                        <label class="cd-label" for="">Package Details</label>
                        <textarea class="" name="description[]" rows="7" cols="15" id="ProductDescMDE" placeholder="description"></textarea>
                    </div>
                    <div class="field">
                        <label class="cd-label">Stock</label>
                        <input class="cd-product-size-name text" type="text" name="quantity[]" id="qua" placeholder="quantity" value="">
                    </div>
                    <div>
                        <input class="cd-product-size-name text" type="hidden" name="price[]" id="pri" placeholder="price" value="{{$preorder->price}}">
                    </div>
                    <div class="field">
                        <label class="cd-label">Release Date</label>
                        <input class="datepicker text cd-product-size-name" type="text" name="delivery_date[]" placeholder="delivery date" id="">
                    </div>
                    <p>
                        
                        
                        
                        
                        
                        {{-- <a href="#" id="addPackage" class="btn btn-success btn-circle "><i class="fa fa-plus"></i></a> <a href="#" class="btn btn-danger btn-circle rem"><i class="fa fa-times"></i></a> --}}
                    </p>
                

                    

                    <div class="icon field">
                        <label class="cd-label" for="website"></label>
                        <input type="submit" value="Save"/>
                        <p class="cd-form-error error-name hidden"></p>
                    </div>

                    {{ Form::hidden('shop_id',Session::get('shop_id')) }}
                </fieldset>
                {{ Form::close() }}
            

    </div>


    <script type="text/javascript">

        $(document).ready(function() {

          //  var imgSource = document.getElementById('myImage').src ;
          //  document.getElementById("myImage").style.visibility="hidden";

            $(function() {
                //   var scntDiv = $('#packages');
                var i = $('#packages p').size() +1;
                $('body').on('focus','.datepicker', function(){

                    $(this).datepicker();
                });
                $('#packages').on('click','#addPackage',function() {
                    if(i<=6) {
                        $('<p><label class="cd-label" for="pre_scnts"></label>' +
                                '<input class="cd-product-size-name text" type="text" name="amount[]" id="amo" placeholder="amount" value="">'+
                                '<textarea class="cd-product-size-name text" name="description[]" id="test" rows="10" cols="20" placeholder="description"></textarea>'+
                                '<input class="cd-product-size-name text" type="text" name="quantity[]" id="qua" placeholder="quantity" value="">'+
                                '<input class="cd-product-size-name text" type="text" name="price[]" id="pri" placeholder="price" value="">'+
                                '<input class="datepicker" type="text" name="delivery_date[]" placeholder="delivery date" id="">'+
                                '<a href="#" id="addPackage" class="btn btn-success btn-circle "><i class="fa fa-plus"></i></a> <a href="#" class="btn btn-danger btn-circle rem"><i class="fa fa-times"></i></a>'+
                                '</p>').clone().appendTo("#packages");

                        $('#datepicker').attr('id',i);
                        i++;
                    }
                    return false;
                });

                $('#packages').on('click','.rem', function() {
                    if( i > 2 ) {
                        $(this).parent().remove();
                        i--;
                    }
                    return false;
                });
            });

           /* $.notify("<h4><strong>Create Package For This Product</strong></h4>"+"<img src='{{ asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_image->image)}}' width=350px; height=250px/>"

                    ,{
                        type: 'success',
                        animate: {
                            enter: 'animated zoomInDown',
                            exit: 'animated zoomOutUp'
                        },
                        offset: {
                            x: 850,
                            y: 200
                        },
                        delay :5000,
                        allow_dismiss: true,

                    }); */

        });

    </script>


@stop