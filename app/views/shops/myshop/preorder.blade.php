@extends('shops.myshop._layouts.main')


@section('content')
    <?php $statusRev = array('Published' => 'Unpublish', 'Unpublished' => 'Publish'); ?>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-8">
                <h3>Pre-book Products</h3>
            </div>
            <div class="col-xs-4 text-right">
                <a class="btn btn-success pack-shop-button pull-right" id="add-new-preorder" href="#animatedModalPreorder" role="button" ><i class="fa fa-plus"></i> New Pre-book</a>
            </div>
        </div>
        
        
    </div>
    
    <div class="col-xs-12">
            <ul class="cd-gallery">
            {{--show products according to the category of the present shop--}}
            @foreach($all_packages as $v_packages)
             <li class="package package-{{$v_packages->preorder_package_id}} {{strtolower($v_packages->status)}}">
                 <a class="flexslider product-list-thumb-flexslider" href="javascript:" style="">
                     <ul class="slides">

                         <li><img src="{{asset('/public_img/shop_'.$shop->id.'/preorder/'.$v_packages->image)}}" class="img-responsive" alt="" /></li>
                     </ul>
                 </a>
                 <div class="row cd-item-info">
                    <b class="col-xs-8">
                        <a href="{{route('preorder.admin.details', array($shop->getSlug(),$v_packages->preorder_id) )}}">{{$v_packages->name}}</a>
                    </b>
                    <strong class="col-xs-4 cd-price"><span class="pricewithcomma">{{$v_packages->price}}</span> <small>BDT</small></strong>        
                </div>

                <div class="btn-group options" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>{{ link_to_route('shop.preorder.edit','Edit Product',array($shop->getSlug(),$v_packages->preorder_id)) }}</li>
                        <li>{{ link_to_route('shop.package.edit','Edit Packages',array($shop->getSlug(),$v_packages->preorder_key)) }}</li>
                        <li class="test" onclick="return confirm('Are you sure you want to delete this product?')">{{ link_to_route('shop.preorder.delete','Delete Product',array($shop->getSlug(),$v_packages->preorder_id)) }}
                        </li>

                    </ul>
                </div>

                        <div class="packageStatus-{{$v_packages->preorder_id}}"><span class="@if($v_packages->status == 'Published') hidden @endif label label-danger label-as-badge"><i class="fa fa-exclamation-triangle fa-fw"></i>This product is {{$v_packages->status}} </span></div>

                    </li>
            @endforeach
        </ul>
    </div>
    

    

@stop