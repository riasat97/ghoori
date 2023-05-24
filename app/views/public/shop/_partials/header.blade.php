@include ('_partials.header')

<div class="container-fluid search-option-bar">

<nav class="navbar navbar-default navbar-ghoorishop">
  <div class="container shopMenu">
    <div class="row">
                <div class="col-md-12 shoplist-cart">
                    @include('_partials.cart')
                </div>
            </div>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#secondnav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse nopaddingleftright" id="secondnav">
      
      <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home',null,array('class'=>'current', 'id'=>'shops-link')) }}"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
            {{-- Required later for native discount --}}
            {{-- <li class="">
                <a href="{{route('deals')}}" style="padding:0px">
                    <img src="{{asset('img/hot-deals-logo.png')}}" style="height:50px;">
                </a>
            </li> --}}
            <li class="" id="shops-link"><a href="{{route('store.index')}}">Shops</a></li>

                        @if(Auth::user()&&($shop = Auth::user()->shop))
                            {{-- link_to_route('shops.show','My Shop',$shop->getSlug(),array('class'=>'', 'id'=>'my-shop-link')) --}}
                        @else
                            <li id="get-started-link"><a href="{{ route('store.getStarted', null) }}">Get Started</a></li>
                        @endif
                        <li id="pricing-link"><a href="{{ route('pricing', null) }}">Pricing</a></li>
                        <li id="fshop-link"><a href="{{route('fshop')}}"><i class="fa fa-facebook"></i> Shop</a></li>
                        <li id="faq-link"><a href="{{route('faq')}}">FAQ</a></li>

            <li id="photography-link"><a href="{{route('photography')}}">Photography</a></li>

        </ul>
        <form class="navbar-form navbar-right hidden" role="search">
            <div class="form-group">
                <a class="btn btn-transparent shopsearch-trigger"><i class="fa fa-search"></i></a>
                <input type="text" class="form-control shopsearch" placeholder="Search" name="q">
            </div>
            <button type="submit" class="btn btn-default hidden"></button>
        </form>
      
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>

        

</div>