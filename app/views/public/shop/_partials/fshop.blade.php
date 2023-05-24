@extends('public.shop._layouts.index')
@section('title')
    fShop | Ghoori
@stop
@section('staticpagestyles')
    {{HTML::style('css/fbshopstaticstyle.css')}}
    {{HTML::style('css/magnific-popup.css')}}
@stop
@section('staticpagescripts')
{{HTML::script('js/fshopButton.js')}}
{{HTML::script('js/jquery.magnific-popup.min.js')}}
    <script type="text/javascript">
        $(function(){
            $('#contact-form').submit(function(e){
                e.preventDefault();
                $("#productsubmit").prop('disabled', true);
                if(checkForm(this)){
                    var form = $(this).serializeArray();
                    var token = $('#contact-form > input[name="_token"]').val();
                    $.ajax({
                        url: "{{route('store.contactUsAjax')}}",
                        type: 'post',
                        dataType: 'json',
                        data: { _token: token, form: form },
                        beforeSend: function(request) {
                            // return request.setRequestHeader("X-CSRF-Token", $("meta[name='token']").attr('content'));
                        },
                        success: function(ev) {
                            // console.log(ev);
                            if (ev.success){
                                $("#contact-form").get(0).reset();
                                $('#contact-form > input[name="_token"]').val(token);
                                $('.close-animatedModalContact').find('a.btn').click();
                                alert('Thanks for your opinion.');
                                $("#productsubmit").prop('disabled', false);
                            }
                        },
                        error: function(xhr, error, status) {
                            $("#productsubmit").prop('disabled', false);
                        }
                    });
                }

            });
        });
        function checkForm(form) {
            // if(this.name.value == "") {
            //   alert("Please enter your Name in the form");
            //   this.name.focus();
            //   return false;
            // }
            // if(this.email.value == "" || !this.valid_email.checked) {
            //   alert("Please enter a valid Email address");
            //   this.email.focus();
            //   return false;
            // }
            // if(this.age.value == "" || !this.valid_age.checked) {
            //   alert("Please enter an Age between 16 and 100");
            //   this.age.focus();
            //   return false;
            // }
            // console.log(form);
            return true;
        }
    </script>
@stop
@section('metatags')
    <link rel="canonical" href="{{URL::route('fshop')}}">
    <meta property="og:title" content="Ghoori Facebook Shop" />
    <meta property="og:site_name" content="ghoori.com.bd"/>
    <meta property="og:url" content="{{URL::route('fshop')}}" />
    <meta property="og:description" content="To visit Ghoori Platform you need to have internet connection in your Laptop/PC or Mobile/Tab." />
    <meta property="fb:app_id" content="{{Config::get('facebook.appId')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="{{asset('img/ghoori_cloud.jpg')}}" />

    <meta property="article:author" content="{{URL::route('home')}}" />
    <meta property="article:publisher" content="{{URL::route('home')}}" />
@stop

@section('static')


    <!-- **********************************************Page Banner Image Section************************************** -->
    <div class="container-fluid">
        <div class="row">
            <div class="fbShopButtonPageBanner">
                <img class="" style="width:100%;display:block;height:auto;" src="{{asset('img/fbshop/fbShopButtonPageBanner.png')}}" alt="Banner Image">
            </div>
        </div>
    </div>

    <!-- **********************************************Page Content Section************************************** -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <!-- *******************************What is FB Button Section****************************** -->
                    <section class="aboutFbBtn">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h1 class="whatIsFbBtn">What is fShop</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="whatIsFbBtnContent">
                                    fShop is the unique feature of Ghoori Platform. You can showcase and sale all your products through this feature. This is the best way you can turn your Facebook Fan page into an e-commerce shop. Connect with billions of users to grow your business was never been easy before. All you need to do is choose a right <a href="{{route('pricing')}}">package</a> and start your own business in Facebook.
                                </p>
                                <p class="whatIsFbBtnContent">
                                    Adding fShop is really easy. Anyone with a laptop/mobile can do it within 5/10 minutes time. Follow the instructions below and you will be all good to launch your fShop in your desire Facebook Page. Call us at <a href="tel:+8809612000888">09612000888</a> if you face any difficulty. 
                                </p>
                            </div>
                        </div>
                    </section>


                    <section class="aboutFbBtn">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h1 class="whatIsFbBtn">Why fShop</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="whatIsFbBtnContent">
                                    There are multiple reasons you should have fShop in your Facebook Fan Page. Firstly, Customers can easily browse your products and collections using the new, always visible, Shop section on your Facebook Page. You are investing a lot in Facebook marketing. Using fShop you can convert the awareness into actual sales. Your fShop is integrated with your Ghoori eShop so purchasing is safe and secure. Also all other Ghoori eShop features like: cart management, payment system will be integrated. Adding product details, images, and inventory etc. are automatic and will sync as soon as you make an update in your Ghoori eShop.
                                </p>
                                <!-- <p class="whatIsFbBtnContent">
                                    You can create and manage a Page from your personal account.
                                </p> -->
                            </div>
                        </div>
                    </section>
                    
                    <!-- *******************************How to Add FB Button Section************************** -->
                    <section class="aboutFbBtn FbBtnInstruction">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h1 class="howToAddFbBtn">How to Add fShop</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="howToAddFbBtnContent">
                                    Adding a fShop is as easy as drinking a coffee. It’s simple and effective. Just follow the instructions below and convert your own Facebook Fan Page to a complete e-commerce website with all awesome Ghoori features intact.
                                </p>
                                <p class="howToAddFbBtnContent">
                                    You can create and manage a Page from your personal account.
                                </p>
                            </div>
                        </div>
                    </section>
                    

                    <!-- *******************************Instruction Image Section************************** -->
                    <section class="fbBtnIsntructionImgBlock">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <img class="img-responsive fbBtnIsntructionImg animation-element slide-bottom" src="{{asset('img/fbshop/instructionImage.png')}}" alt="Instruction Image">
                            </div>
                        </div>
                    </section>

                    <!-- *******************************Instruction Step 1 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <a class="img-link-1" href="{{asset('img/fbshop/step-1.png')}}">
                                    <img id="open-popup-1" class="img-responsive img" src="{{asset('img/fbshop/step-1.png')}}" alt="Step 1">
                                </a>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <div class="text-center text-container-OddContent">
                                    <p>Go to <a href="https://ghoori.com.bd/">https://ghoori.com.bd/</a> and</p>
                                    <p>Click 'Login' from upper right cornerof the website</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- *******************************Instruction Step 2 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <div class="text-center text-container-EvenContent">
                                    <p>Click on 'f Login' button</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <a class="img-link-2" href="{{asset('img/fbshop/step-2.png')}}">
                                    <img id="open-popup-2" class="img-responsive" src="{{asset('img/fbshop/step-2.png')}}" alt="Step 2">
                                </a>
                            </div>
                        </div>
                    </section>

                    <!-- *******************************Instruction Step 3 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <a class="img-link-3" href="{{asset('img/fbshop/step-3.png')}}">
                                    <img id="open-popup-3" class="img-responsive" src="{{asset('img/fbshop/step-3.png')}}" alt="Step 3">
                                </a>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <div class="text-center text-container-OddContent">
                                    <p>Click 'My Shop' button</p>
                                </div>
                            </div>
                        </div>
                    </section>






                    <!-- *******************************Instruction Step 4 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <div class="text-center text-container-EvenContent">
                                    <p>Click 'FB Shop' button floating above the banner image</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <a class="img-link-4" href="{{asset('img/fbshop/step-4.png')}}">
                                    <img id="open-popup-4" class="img-responsive" src="{{asset('img/fbshop/step-4.png')}}" alt="Step 4">
                                </a>
                            </div>
                        </div>
                    </section>

                     <!-- *******************************Instruction Step 5 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <a class="img-link-5" href="{{asset('img/fbshop/step-5.png')}}">
                                    <img id="open-popup-5" class="img-responsive" src="{{asset('img/fbshop/step-5.png')}}" alt="Step 5">
                                </a>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <div class="text-center text-container-OddContent">
                                    <p>Monthly subscription fee for fShop is BDT 99 + VAT. For Basic and Premium shops fShop is free</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- *******************************Instruction Step 6 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <div class="text-center text-container-OddContent">
                                    <p>Select the desired page (e.g. Ghoori) where you want to install fShop, from the drop down list and Click ‘Install’</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <a class="img-link-5" href="{{asset('img/fbshop/step-6.png')}}">
                                    <img id="open-popup-5" class="img-responsive" src="{{asset('img/fbshop/step-6.png')}}" alt="Step 5">
                                </a>
                            </div>

                            
                        </div>
                    </section>

                    <!-- *******************************Instruction Step 7 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <a class="img-link-6" href="{{asset('img/fbshop/step-7.png')}}">
                                    <img id="open-popup-6" class="img-responsive" src="{{asset('img/fbshop/step-7.png')}}" alt="Step 6">
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <div class="text-center text-container-EvenContent">
                                    <p>Give a name of your page tab and Click ‘Save'</p>
                                </div>
                            </div>

                        </div>
                    </section>

                    <!-- *******************************Instruction Step 8 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <div class="text-center text-container-OddContent">
                                <p>Click on 'Go to your Facebook Shop' button</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <a class="img-link-7" href="{{asset('img/fbshop/step-8.png')}}">
                                    <img id="open-popup-7" class="img-responsive" src="{{asset('img/fbshop/step-8.png')}}" alt="Step 7">
                                </a>
                            </div>

                        </div>
                    </section>

                    <!-- *******************************Instruction Step 9 Section************************** -->
                    <section class="fbBtnInstruction">
                        <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-left">
                                <a class="img-link-8" href="{{asset('img/fbshop/step-9.png')}}">
                                    <img id="open-popup-8" class="img-responsive" src="{{asset('img/fbshop/step-9.png')}}" alt="Step 8">
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 animation-element slide-right">
                                <div class="text-center text-container-EvenContent">
                                    <p>View your fShop in Your facebook Page</p>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- *******************************Shop Create Button Section************************** -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2">
                <!-- <a class="btn btn-primary" style="margin-left:190px;" href="">Create Your Shop</a> -->
                <!-- <a id="createShopBtn" class="btn btn-link createShopButton" href="http://ghoori.com.bd/login?redirectUrl=http%3A%2F%2Fghoori.com.bd%2Fadmin%2Fshops%2Fcreate">Create Your Shop</a> -->
                <div class="shop-button">
                    <a class="btn btn-default pack-shop-button pack-shop-button-comming" href="http://ghoori.com.bd/login?redirectUrl=http%3A%2F%2Fghoori.com.bd%2Fadmin%2Fshops%2Fcreate" role="button">Create Your Shop</a>
                </div>
            </div>
        </div>
    </div>



@stop