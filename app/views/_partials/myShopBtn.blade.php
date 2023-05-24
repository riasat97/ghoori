@section('myShopBtn')
{{-- 
<div class="col-xs-1 col-sm-1 col-md-1 col-lg-2 text-right">
    @if($shop= Session::get('shop'))
        {{ link_to_route('shops.view','My Shop',$shop->getSlug(),array('class'=>'btn btn-warning myShopButton')) }}
    @else
        {{ link_to_route('shops.create','Create Your Shop',null,array('class'=>'btn btn-warning createShopButton loginButton', 'id'=>'createShopBtn', 'disabled')) }}
    @endif
</div>
--}}
@show