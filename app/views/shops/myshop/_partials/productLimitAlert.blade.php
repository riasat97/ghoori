
<div class="alert alert-danger alert-dismissible @if(!$productOverFlow['status'])hidden @endif" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="">
        <p class=""><strong>Maximum product limit exceed!!!</strong>Currently your package ({{

         $shop->package->name}}) supports {{Config::get('productlimit.'.$shop->package->name)}} products..
            But You have total {{ $productOverFlow['count'] }} products..Please {{ link_to_route('pricing','upgrade package') }} to display all
            of your products on public view..Otherwise these products will be forcefully deleted with in 15 days period.
        </p>
    </div>
</div>
