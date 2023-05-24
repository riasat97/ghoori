
@extends('public.shop._layouts.index')

@section('title')
    Photography | Ghoori
@stop

@section('staticpagestyles')
    {{HTML::style('css/stylePhotography.css')}}
@stop

@section('metatags')
    <link rel="canonical" href="{{URL::route('faq')}}">
    <meta property="og:title" content="Ghoori #FAQ" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('faq')}}" />
    <meta property="og:description" content="To visit Ghoori Platform you need to have internet connection in your Laptop/PC or Mobile/Tab." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/faq_og.jpg')}}" />

    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop


<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=467566360069175";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


@section('photography')
    <!-- ************************ Page Banner Image Section ********************** -->
    <div class="container-fluid">
        <div class="row">
            <div class="fbShopButtonPageBanner">
                <img class="img-responsive" src="{{ asset('img/photography/photography-banner-1.jpg')  }}" alt="">
            </div>
        </div>
    </div>

    <!-- ************************ Page Content Section ********************* -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <!-- ****************** How to Place an Order Section ****************** -->
                    <section class="about-photography">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Ghoori with the partnershio with <span><a href="https://www.facebook.com/lfotto">L'Fotto</a></span> is presenting product photography services. We have total 5 packages for the merchants. Choose one and make your shop and products desirable foe sales.</p>
                            </div>

                            <div class="col-md-12 photo-partner">
                                <p>Photography Partner</p>
                                <p><img src="{{ asset('img/photography/LPhotto-logo.png')  }}" alt="L'PHOTO"></p>
                            </div>
                        </div>
                    </section>

                    <section class="packages-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-1">
                                        <div class="package-box-1">
                                            <p>
                                                <img class="" src="{{ asset('img/photography/package-1-new.png')  }}" alt="">
                                            </p>
                                            <p class="package-1-heading">Package 1</p>
                                            <p class="photo-quantity">25</p>
                                            <p class="photo-text">Photos</p>

                                            <p class="package-price">800</p>
                                            <p class="package-price-currency">BDT+VAT</p>

                                            <p class="book-button"><a href="">Book Now</a></p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="package-box-2">
                                            <p>
                                                <img class="" src="{{ asset('img/photography/package-2-new.png')  }}" alt="">
                                            </p>
                                            <p class="package-2-heading">Package 2</p>
                                            <p class="photo-quantity">50</p>
                                            <p class="photo-text">Photos</p>

                                            <p class="package-price">1400</p>
                                            <p class="package-price-currency">BDT+VAT</p>

                                            <p class="book-button"><a href="">Book Now</a></p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="package-box-3">
                                            <p>
                                                <img class="" src="{{ asset('img/photography/package-3-new.png')  }}" alt="">
                                            </p>
                                            <p class="package-3-heading">Package 3</p>
                                            <p class="photo-quantity">75</p>
                                            <p class="photo-text">Photos</p>

                                            <p class="package-price">2200</p>
                                            <p class="package-price-currency">BDT+VAT</p>

                                            <p class="book-button"><a href="">Book Now</a></p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="package-box-4">
                                            <p>
                                                <img class="" src="{{ asset('img/photography/package-4-new.png')  }}" alt="">
                                            </p>
                                            <p class="package-4-heading">Package 4</p>
                                            <p class="photo-quantity">100</p>
                                            <p class="photo-text">Photos</p>

                                            <p class="package-price">2600</p>
                                            <p class="package-price-currency">BDT+VAT</p>

                                            <p class="book-button"><a href="">Book Now</a></p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="package-box-5">
                                            <p>
                                                <img class="" src="{{ asset('img/photography/package-5-new.png')  }}" alt="">
                                            </p>
                                            <p class="package-5-heading">Package 5</p>
                                            <p class="photo-quantity">200</p>
                                            <p class="photo-text">Photos</p>

                                            <p class="package-price">4500</p>
                                            <p class="package-price-currency">BDT+VAT</p>

                                            <p class="book-button"><a href="">Book Now</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ******************Instruction Image Section**************** -->
                    <section class="contact-info-box">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p><span class="contact-logo"><img src="{{ asset('img/photography/phone-icon.png')  }}" alt="Phone Icon"></span>09612000888</p>
                                <p>Need help? Feel free to contact with Ghoori.</p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@stop

