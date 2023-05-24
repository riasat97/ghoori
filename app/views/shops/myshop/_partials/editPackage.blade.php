@extends('shops.myshop._layouts.main')


@section('content')
    <?php $statusRev = array('Published' => 'Unpublish', 'Unpublished' => 'Publish'); ?>
    <div class="col-xs-12">

    </div>
    <div class="col-xs-4">
        <h2>{{$preorder->name}}</h2>
        @foreach($preorder->images as $v_image)
            <img src="{{ asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_image->image)}}" class="img-responsive" alt="product image">
        @endforeach
    </div>
    <div class="col-xs-8">
        <div class="row">

            <div class="col-md-12">
                <!-- Product submit -->
                <div style="color: #00dd00; font-size: 15px;"><?php echo Session::get('msg');?></div>
                @foreach($p_package as $v_package)
                {{ Form::open(array('route'=>'update-preorder-package','class'=>'cd-form floating-labels','files'=>true,'enctype' => 'multipart/form-data','method'=>'POST','name'=>'edit-package-form','role'=>'form')) }}
                <fieldset>
                    <legend>Edit Preorder Package</legend>
                    <div class="icon field">
                        <label class="cd-label" for="">Advanced Payment</label>
                        <input class="text" type="text" name="amount" id="amo" placeholder="amount" value="{{$v_package->amount}}" readonly="readonly">
                        {{--Add Attribute Form : Color Box --}}
                    </div>
                    <div class="icon field">
                        <label class="cd-label" for="">Package Details</label>
                        <textarea class="" name="description" rows="7" cols="15" id="des" placeholder="description">{{$v_package->description}}</textarea>
                    </div>
                    <div class="field">
                        <label class="cd-label">Stock</label>
                        <input class="cd-product-size-name text" type="text" name="quantity" id="qua" placeholder="quantity" value="{{$v_package->quantity}}">
                    </div>
                    <div>
                        <input class="cd-product-size-name text" type="hidden" name="price" id="pri" placeholder="price" value="{{$v_package->price}}">
                    </div>
                    <div class="field">
                        <label class="cd-label">Release Date</label>
                        <input class="datepicker cd-product-size-name text"  type="text" name="delivery_date" placeholder="delivery date" id="" value="{{$v_package->delivery_date}}">
                    </div>
                    <div class="field">
                        <label class="cd-label">Status</label>
                        <select class="cd-product-size-name" name="status">
                            <?php
                            if($v_package->status=="Published"){
                            ?>
                                <option value="Unpublished" selected="selected">Unpublish</option>
                            <?php
                            }
                            ?>
                            <?php
                            if($v_package->status=="Unpublished"){
                            ?>
                                <option value="Published" selected="selected">Publish</option>
                            <?php
                            }
                            ?>
                            <option value="{{$v_package->status}}" selected="selected">
                                {{$v_package->status}}</option>
                        </select>
                    </div>

                    <input type="hidden" name="preorder_key" value="{{$v_package->preorder_key}}"/>
                    <input type="hidden" name="preorder_package_id" value="{{$v_package->preorder_package_id}}"/>
                    <div class="icon field">
                        <label class="cd-label" for="website"></label>
                        <input type="submit" value="Update"/>
                        <p class="cd-form-error error-name hidden"></p>
                    </div>

                    {{ Form::hidden('shop_id',Session::get('shop_id')) }}
                </fieldset>
                {{ Form::close() }}

                @endforeach
            </div>
        </div>

    </div>



    <script type="text/javascript">

        $(document).ready(function() {
            $(function() {
               // var i = $('#packages p').size() +1;

                $('body').on('focus',".datepicker", function(){

                    $(this).datepicker();
                });
               // $('#datepicker').attr('id',i);
             //   i++;
            });
        });

    </script>

@stop