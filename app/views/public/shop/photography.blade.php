@extends('public.shop._layouts.index')

@section('title')
    Photography | Ghoori
@stop

@section('staticpagestyles')
    {{HTML::style('css/stylePhotography.css')}}
@stop

@section('metatags')
    <link rel="canonical" href="{{URL::route('photography')}}">
    <meta property="og:title" content="Ghoori Photography" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('photography')}}" />
    <meta property="og:description" content="Ghoori with the partnershio with L'Fotto is presenting product photography services. We have total 5 packages for the merchants. Choose one and make your shop and products desirable foe sales." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{ asset('img/photography/photography-banner-1.jpg')  }}" />
{{-- 
    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" /> --}}
@stop
@section('content')
    <!-- ************************ Page Banner Image Section ********************** -->
    <div class="container-fluid">
        <div class="row">
            <div class="fbShopButtonPageBanner">
                <img class="img-responsive" style="width:100%" src="{{ asset('img/photography/photography-banner-1.jpg')  }}" alt="">
            </div>
        </div>
    </div>

    <!-- ************************ Page Content Section ********************* -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <div class="container"> --}}
                    <!-- ****************** How to Place an Order Section ****************** -->
                    <section class="about-photography">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Ghoori with the partnership with <span><a href="https://www.facebook.com/lfotto">L'Fotto</a></span> is presenting product photography services. We have total 5 packages for the merchants. Choose one and make your shop and products desirable for sales.</p>
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
                                            @if($shop)
                                            <p class="book-button"><button data-toggle="modal" data-target="#bKashInstructionModal" data-amount="800" data-counternumber="6" data-refnumber="{{$shop->id}}" data-package="1" data-url="{{route('photography-service-request',[$shop->slug,1])}}">Book Now!</button></p>
                                            
                                            @elseif(Auth::user())
                                                <p class="book-button"><a class="loginButton" href="{{route('pricing')}}">Book Now!</a></p>
                                            @else
                                                <p class="book-button"><a class="loginButton" href="">Book Now!</a></p>
                                            @endif
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
                                            @if($shop)
                                            <p class="book-button"><button data-toggle="modal" data-target="#bKashInstructionModal" data-amount="1400" data-counternumber="6" data-refnumber="{{$shop->id}}" data-package="2" data-url="{{route('photography-service-request',[$shop->slug,2])}}">Book Now!</button></p>
                                            @elseif(Auth::user())
                                                <p class="book-button"><a class="loginButton" href="{{route('pricing')}}">Book Now!</a></p>
                                            @else
                                                <p class="book-button"><a class="loginButton" href="">Book Now!</a></p>
                                            @endif
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
                                            @if($shop)
                                            <p class="book-button"><button data-toggle="modal" data-target="#bKashInstructionModal" data-amount="2200" data-counternumber="6" data-refnumber="{{$shop->id}}" data-package="3" data-url="{{route('photography-service-request',[$shop->slug,3])}}">Book Now!</button></p>
                                            @elseif(Auth::user())
                                                <p class="book-button"><a class="loginButton" href="{{route('pricing')}}">Book Now!</a></p>
                                            @else
                                                <p class="book-button"><a class="loginButton" href="">Book Now!</a></p>
                                            @endif
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
                                            @if($shop)
                                            <p class="book-button"><button data-toggle="modal" data-target="#bKashInstructionModal" data-amount="2600" data-counternumber="6" data-refnumber="{{$shop->id}}" data-package="4" data-url="{{route('photography-service-request',[$shop->slug,4])}}">Book Now!</button></p>
                                            @elseif(Auth::user())
                                                <p class="book-button"><a class="loginButton" href="{{route('pricing')}}">Book Now!</a></p>
                                            @else
                                                <p class="book-button"><a class="loginButton" href="">Book Now!</a></p>
                                            @endif
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
                                            @if($shop)
                                            <p class="book-button"><button data-toggle="modal" data-target="#bKashInstructionModal" data-amount="4500" data-counternumber="6" data-refnumber="{{$shop->id}}" data-package="5" data-url="{{route('photography-service-request',[$shop->slug,5])}}">Book Now!</button></p>
                                            @elseif(Auth::user())
                                                <p class="book-button"><a class="loginButton" href="{{route('pricing')}}">Book Now!</a></p>
                                            @else
                                                <p class="book-button"><a class="loginButton" href="">Book Now!</a></p>
                                            @endif
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
                                <p><i class="fa fa-phone fa-lg"></i> 09612000888</p>
                                <p>Need help? Feel free to contact with Ghoori.</p>
                            </div>
                        </div>
                    </section>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="bKashInstructionModal" tabindex="-1" role="dialog" aria-labelledby="bKashInstructionModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="bKashInstructionModalLabel">Pay via bKash for package #<span class="package"></span></h4>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-6 col-sm-4 background-img add-border-right">
                        <img class="img-responsive" src="{{asset('img/bg-img---Copy-5.png')}}" alt="">

                        <img class="dialog-img img-responsive" src="{{asset('img/heading-text-4.png')}}" alt="dialog">

                        <p class="ghoori-site">www.ghoori.com.bd</p>
                    </div>

                    <div class="col-xs-6 col-sm-4 col-sm-offset-4">
                        <img class="img-responsive" src="{{asset('img/BKash_logo.png')}}" alt="">
                    </div>
                </div>
                @include('_partials.bkashinstruction')

            </div>
          </div>
          <div class="modal-footer">
            {{Form::open(array('route'=>array('photography-service-request',null,1),'method' => 'put','class'=>'loginBeforeSubmitForm bKashPayForm'))}}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" value="Book Now">Pay &amp; Book Now!</button>
            {{Form::close()}}
            
          </div>
        </div>
      </div>
    </div>
@stop


@section('page-specific-css')
{{HTML::style('css/bkashpay.css')}}
@stop

@section('page-specific-js')

<script type="text/javascript">
    $(document).ready(function(){
        $('#bKashInstructionModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data();
          var modal = $(this);
          console.log(recipient);

          modal.find('.bKashPayForm').attr('action', recipient.url);
          modal.find('.amount').text(recipient.amount);
          modal.find('.counternumber').text(recipient.counternumber);
          modal.find('.refnumber').text(recipient.refnumber);
          modal.find('.package').text(recipient.package);
        })
    });
</script>

@stop