
@section('address')
<div class="address-container">

    <dl class="col-md-2 col-md-offset-8">
        <dt>Address:</dt>
        <dd class="shop-address">{{str_limit($shop->address)}}</dd>
        <dt>Phone:</dt>
        <dd class="shop-contact">{{$shop->mobile}}</dd>
        <dt>Email:</dt>
        <dd class="shop-email">{{$shop->email}}</dd>
    </dl>
   
</div>

@show