<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Facebook Shop</title>
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> --}}
    {{--<link rel="stylesheet" href="yamm.css">--}}
    {{HTML::style('css/shop.css')}}
    {{HTML::style('css/product/style.css')}}
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <p class="text-center" style="display:block;height:auto">
                {{HTML::image('img/ghoori_ad.png',null, array('class'=>'img-responsive'))}}
            </p>
        </div>        
    </div>
    <div class="row">
        @foreach($products as $product)
            <div class="col-xs-6 col-sm-3">
                <div class="product-box">
                    <a class="" target="_blank" href="{{URL::route('products.view',array($slug,$product['id']))}}">
                        <div class="product-img-box" style="background-image:url('{{asset("public_img/shop_$shopId/products/{$product->images->first()->imageLink}")}}')">
                        </div>
                
                        <h5 class="product-title">{{substr($product['name'],0,23)}}</h5>
                        <p class="text-success text-center">BDT {{number_format($product['price'],2,'.',',')}}
                            @if(!empty($product->getDiscountRate()))
                                {{$product->getDiscountRate()}}
                            @endif
                        </p>
                    </a>
                    <a class="fb-button" target="_blank" href="{{URL::route('products.view',array($slug,$product['id']))}}">Buy</a>
                </div>
                    
            </div>
        @endforeach
        <div class="clearfix"></div>
        <div class="col-xs-12">
            {{ $products->appends(['shop_id'=>$shopId])->links() }}
        </div>
        
    </div>
    <hr/>
    <div class="row">
        
        <div class="col-xs-6"><p>Powered by <a href="https://ghoori.com.bd">Ghoori.com.bd</a></p></div>
        <div class="col-xs-6"><p class="text-right">A <a href="https://chorki.com">Chorki</a> product</p></div>

    </div>
</div>
</body>
</html>