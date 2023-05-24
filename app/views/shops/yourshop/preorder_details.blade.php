@extends('shops.yourshop._layouts.master')
@section('title')
    Preorder {{$preorder->name}} | Ghoori
@stop
@section('address-edit')
@overwrite
@section('content')

<section class="single">
    <div class="container">

        <!-- ====================== -->
        <!-- Single Product Section -->
        <!-- ====================== -->
        
        <div style="color: #0033DD; font-size: 20px;"><?php echo Session::get('message');?></div>
        <div class="row">
            <header class="col-sm-12 prime">
                <h3 id="ptitle" data-type="text" data-pk="1" data-url="post.php" data-title="Enter title">{{$preorder->name}}</h3>
            </header>
            {{-- <header class="col-sm-4">
                <h4 id="ptitle" data-type="text" data-pk="1" data-url="" data-title="Enter title"><div style="height: 35.5px; background-color: rgba(127, 239, 245, 0.73);">Packages</div></h4>
            </header> --}}
        </div>
        <div class="row">
            <div class="col-sm-7">
                @if($preorder->product_url!= NULL)
                <?php

                $var=$preorder->product_url;
                $url = $var;
                preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                $id = $matches[1];
                $width = '750px';
                $height = '400px';
                ?>
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe id="ytplayer" type="text/html" class="embed-responsive-item"
                        src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
                        frameborder="0" allowfullscreen></iframe>
                </div>
                
                @endif

                

                <!-- Product Images -->
                <div class="wrap">
                    <div id="flexslider-product" class="flexslider">
                        <ul class="slides">
                            @foreach($preorder->images as $key => $image)
                                <li><a href="{{ asset( '/public_img/shop_'.$shop->id.'/preorder/'.$image->image ) }}" class="product-image-link"><img src="{{ asset( '/public_img/shop_'.$shop->id.'/preorder/'.$image->image ) }}" /></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div id="flexcarousel-product" class="flexslider visible-desktop">
                        <ul class="slides">
                            @foreach($preorder->images as $v_image)
                                <li><img class="img-slider-thumb" src="{{ asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_image->image)}}"/></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
               
            </div>
          {{--  {{ dd($packages[0]->toArray()) }}--}}
            
            <div class="col-sm-5">
                <div class="details wrapper">
                    <div class="accordion" id="accordion2">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#description">
                                    <i class="icon-layout theme"></i> Product Description
                                </a>
                            </div>
                            <div id="description" class="accordion-body">
                                <div class="accordion-inner" id="prodesc" data-type="textarea" data-pk="1" data-url="post.php" data-title="Enter title">
                                    {{$preorder->description}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($packages[0]->packages as $v_package)
                    <div class="details wrapper">
                        <p class="price">
                            <i class="icon-tag"></i>
                            <span class="pricewithcomma">{{$v_package->price}}</span> BDT
                        </p>

                    <p>{{$v_package->description}}</p>
                    <table class="table">
                        <tr>
                            <th>Remaining</th>
                            <td>{{$v_package->quantity}}</td>
                        </tr>
                        <tr>
                            <th>Estimated Delivery</th>
                            <td>{{ \Carbon\Carbon::createFromFormat( 'Y-m-d',$v_package->delivery_date )->toFormattedDateString('d M Y') }} to {{ \Carbon\Carbon::createFromFormat( 'Y-m-d',$v_package->delivery_date )->addDays(10)->toFormattedDateString('d M Y') }}</td>
                        </tr>
                    </table>
                    
                    <a class="btn btn-success loginButton pack-shop-button" id="" href="{{ route('preorder.checkout',array($shop->getSlug(),$v_package->preorder_package_id)) }}" role="button" >Pre-order Now!</a>
                   </div>
               @endforeach
            </div>
            
        </div>

        

    </div>
</section>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background: #bce8f1;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign In </h4>
                </div>
                {{Form::open(array('url'=>'preorder-login','role'=>'form','method'=>'POST','id'=>'frm'))}}
                <div class="modal-body" style="background: #28a4c9;">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-at"></i></div>
                            <input type="email" class="form-control" id="remail" placeholder="Email" name="email">
                        </div>
                        <span class="help-block has-error" data-error='0' id="remail-error"></span>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                            <input type="password" class="form-control" id="repassword" placeholder="Password" name="password">
                        </div>
                        <span class="help-block has-error" data-error='0' id="remail-error"></span>
                    </div>
                    <button type="submit" class="btn btn-success pack-shop-button" id="login_btn_1" >Login</button>
                </div>
                {{Form::close()}}
                <div class="modal-footer" style="background:greenyellow; ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@stop
