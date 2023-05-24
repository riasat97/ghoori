@section('dhumketu_second_nav')
<div class="secondary-navbar">
    <div class="container-fluid">
        <div class="row">
                <div class="col-xs-12">
                    @include('_partials.cart')
                </div>
            </div>
    </div>
    <nav class="navbar navbar-default extra-padding">
        <div class="container-fluid secondary-nav-container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand dhumketu-brand-img" href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}">
                    <img src="{{asset('public_img/shop_'.$shop->id.'/logos/'.$shop->logo->logo) }}" alt="">
                </a>
                <a class="dhumketu-shop-name navbar-middle" href="{{GhooriURI::shopurl($shop->subDomain, URL::route('store.shops',$shop->getSlug()))}}">{{$shop->title}}</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>



            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="category-search-box">
                        {{ Form::open(['route'=>['search.category',$shop->slug],'method' => 'GET']) }}
                        <div class="custom-search-input center-search input-group-sm product-search-bar">
                            <div class="input-group">
                                        <span class="input-group-btn">
                                            {{ Form::select('categoryId',[''=>'All Category']+$categories['categories'],null,
                                                ['class'=>'btn select-category-option-field']) }}
                                        </span>

                                {{ Form::text('name',null,
                                        ['class'=>'inputbox form-control','placeholder'=>"I'm shopping for...",'aria-label'=>"..."]) }}

                                <span class="input-group-btn">
                                            <button type="submit" class="btn btn-info search-submit-btn"><i class="fa fa-search"></i> Search</button>
                                        </span>
                            </div>
                        </div>
                        {{Form::close()}}
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
    </nav>
</div>
@show