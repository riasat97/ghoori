
{{--Ghoori Default Header--}}
@include('_partials.header')

    <div class="container-fluid search-option-bar">
        <div class="navbar navbar-default navbar-ghoorishop">
            <div class="container shopMenu">
                <div class="row">
                    <div class="col-md-12 shoplist-cart">

                            @include('_partials.cart')
                        </div>
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

                    <!-- <ul class="nav navbar-nav">
                        <li><a href="https://ghoori.com.bd"><i class="fa fa-home"></i> Home </a></li>
                        <li class="" id="shops-link"><a href="https://ghoori.com.bd/shops">Shops</a></li>
                        <li id="get-started-link"><a href="https://ghoori.com.bd/get-started">Get Started</a></li>
                        <li id="pricing-link"><a href="https://ghoori.com.bd/price">Pricing</a></li>
                        <li class="active"><a href=""><i class="fa fa-home"></i> FB Button <span class="sr-only">(current)</span></a></li>
                    </ul> -->

                    <form class="navbar-form navbar-right hidden" role="search">
                        <div class="form-group">
                            <a class="btn btn-transparent shopsearch-trigger"><i class="fa fa-search"></i></a>
                            <input type="text" class="form-control shopsearch" placeholder="Search" name="q">
                        </div>
                        <button type="submit" class="btn btn-default hidden"></button>
                    </form>
                </div>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
