
{{--Single Product View--}}
<div class="product_container">
    <div class="row">
        <div class="single-product-block">
            <div class="col-md-6">
                <div class="single-product-slider">
                    <div class="demo slider-lighter-demo">
                        <ul id="lightSlider">
                            @foreach($product->images as $key => $image)
                                <li data-thumb="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/thumb/'.$image->imageLink ) }}">
                                    <a class="product-image-link" href="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}">
                                        <img src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/'.$image->imageLink ) }}" />
                                    </a>
                                </li>
                            @endforeach
                            @if($attributes)

                                @foreach($attributes as $attribute)
                                    @if($attribute->type== 'color')

                                    <li data-thumb="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/thumb/'.$attribute->image  ) }}">
                                        <a href="#">
                                            <img src="{{ asset( '/public_img/shop_'.$product->shop_id.'/products/colors/'.$attribute->image ) }}" />
                                        </a>
                                    </li>
                                    @endif
                                @endforeach

                            @endif

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="single-product-description">
                    <div class="product-title-view">
                        <h2>{{ $product->name }}</h2>
                    </div>

                    <div class="product-price text-success">
                        <p><small>BDT </small> <span class="pricewithcomma">{{ $product->price }}</span></p>
                    </div>
                    {{ Form::open(array('route'=>'carts.buyNow','id'=>'add-to-cart', 'class' => 'product_buy_form form-horizontal')) }}
                    <div class="product-attributes">

                            
                        @if($attributeCount['color'] >  0)
                            <div class="form-group">
                                <label for="product_color" class="col-sm-4 control-label text-left ">Color</label>
                                <div class="col-sm-8">
                                  <select class="form-control"  name="color" id="product_color">
                                        @foreach($attributes as $attribute)
                                            @if($attribute->type== 'color')
                                                <option data-attid="{{ $attribute->productAttributeId }}" value="{{ $attribute->productAttributeId }}">{{ $attribute->value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                            
                        @endif
                        @if($attributeCount['size'] >  0)
                            <div class="form-group">
                                <label for="product_size" class="col-sm-4 control-label text-left ">Size</label>
                                <div class="col-sm-8">
                                  <select class="form-control"  name="size" id="product_size">
                                        @foreach($attributes as $attribute)
                                            @if($attribute->type == 'size')
                                                <option value="{{ $attribute->productAttributeId }}">{{ $attribute->value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                        @endif
                        <div class="">
                            
                            @if($product->stock > 0)
                                <div class="form-group">
                                    <label for="product_quantity" class="col-sm-4 control-label text-left ">Quantity</label>
                                    <div class="col-sm-8">
                                      {{ Form::number('qty',1,array('class'=>'form-control','id'=>'product_quantity','min'=>1,'max'=>$product->stock)) }}
                                    </div>
                                  </div>
                                
                            @else
                                <p class="alert alert-danger" >Out of Stock</p>
                            @endif
                        </div>

                    </div>
                    {{ Form::hidden('shop_id',$product->shop->id)}}
                    {{ Form::hidden('product_id',$product->id) }}
                    <div class="button-section">

                        @if ($product->shop->id != Session::get('shop_id') && $product->stock > 0)
                            <div class="row">
                                <div class="col-xs-6">
                                    {{ Form::submit('ADD TO CART',array('id'=>'add-cart','class'=>'add-to-cart-button')) }}
                                </div>
                                <div class="col-xs-6">
                                    
                            {{ Form::submit('BUY NOW',array('id'=>'buy-now','class'=>'buy-button')) }}
                                </div>
                            </div>
                            
                        @endif
                    </div>

                    {{ Form::close() }}

                    {{--<div class="product-description-view">--}}
                        {{--<h4>Description</h4>--}}
                        {{--<p>{{ $product->description }}</p>--}}
                    {{--</div>--}}


                    <div class="product-information-view">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                            <li role="presentation"><a href="#specification" aria-controls="profile" role="tab" data-toggle="tab">Specification</a></li>
                            {{-- <li role="presentation"><a href="#reviews" aria-controls="messages" role="tab" data-toggle="tab">Reviews</a></li> --}}

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="description">
                                <p>{{ $product->description }}</p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="specification">
                                <table class="table table-striped table-hover">
                                    @if($product->properties->count())
                                    @foreach($product->properties as $property)
                                        <tr>
                                            <th>{{ $property->type }}</th>
                                            <td>{{ $property->value }}</td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <p> N/A</p>
                                    @endif
                                </table>
                            </div>
                            {{-- <div role="tabpanel" class="tab-pane fade" id="reviews">
                                <p>Coming Soon </p>
                            </div> --}}

                        </div>

                    </div>

                    <!-- <div class="buy-button-box">
                        <a class="buy-button" href="">Buy</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


@section('cart-js')
    @include('carts._partials.addToCart')
@stop