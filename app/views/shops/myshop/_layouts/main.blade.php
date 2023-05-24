<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@section('title'){{ $shop->title }}@show</title>
    @yield('metatags')

    {{HTML::style('orakuploader/orakuploader.css')}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/css/bootstrap-select.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    

    {{HTML::style('css/magnific-popup.css')}}
    <!-- Pushed to global!!! This style is specific for modal -->
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" type="text/css" /> -->
    {{HTML::style('public/css/font.css?v=1')}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
    {{HTML::style('public/css/stylenew.css?v=1')}}
    {{HTML::style('public/css/chorki.css?v=1')}}
    <!-- This style is specific for form -->
    {{HTML::style('css/form_style.css?v=1')}}
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'> -->

    <!-- This style is specific for my shop -->
    {{HTML::style('css/my_shop.css?v=1')}}

    <!-- This style is specific for my pagination -->
    {{HTML::style('css/pagination.css?v=1')}}

    <!-- This style is for addAttribute and addProducts -->
    {{HTML::style('css/add_products.css?v=1')}}
    {{ HTML::style('css/printstyle.css?v=1', array('media' => 'print')) }}

    <!-- This style is for banner and logo upload -->
    <!-- {{HTML::style('css/closify_uploader.css')}} -->
    {{HTML::style('css/bkashpay.css')}}


    @yield('settings-css')
    @yield('order-css')

    @yield('page-specific-css')
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">
    <!-- =========== -->
    <!-- Google Font -->
    <!-- =========== -->
    @if($shop->banner)
                <?php $banner = asset('public_img/shop_'.$shop->id.'/banners/'.$shop->banner->path) ?>
                @else
                <?php $banner = asset('img/shopbanner-default.jpg'); ?>
                @endif
    <style type="text/css">
                .shop-banner-container{
                    background:  linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0) 50%), url('{{$banner}}') no-repeat center center;
                    
                }
            </style>
    <script type="text/javascript">

        // Add Google Font name here

        // WebFontConfig = { google: { families: [ 'Bangers', 'Lato' ] } };
        // (function() {
        //     var wf = document.createElement('script');
        //     wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        //     '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        //     wf.type = 'text/javascript';
        //     wf.async = 'true';
        //     var s = document.getElementsByTagName('script')[0];
        //     s.parentNode.insertBefore(wf, s);
        // })();
    </script>
    <style type="text/css">
        /* Add Google Font name here */
        /*.wf-active {font-family: 'Lato',sans-serif; font-size: 14px;}
        .wf-active .logo {font-family: 'Bangers', serif;}*/
    </style>

    {{HTML::style('jQuery.filer/css/jquery.filer.css')}}
    {{HTML::style('jQuery.filer/css/themes/jquery.filer-dragdropbox-theme.css')}}

    @include('_partials.globalstyles')
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/ie7.css" />
    <![endif]-->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
    <!-- for simple image upload -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

    {{HTML::script('jQuery.filer/js/jquery.filer.min.js')}}
    <script src="http://momentjs.com/downloads/moment.min.js"></script>

    {{HTML::script('orakuploader/orakuploader.js')}}
    
    <!-- For banner and logo upload Closify plugin  -->
    <!-- {{HTML::script('js/closify.js')}} -->

@if (App::environment() == 'production')
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '807173902734072');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=807173902734072&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

@endif

</head>
<body class="wf-active">
<div class="loader-wrap">
    <div class="loader">
        <img class="wheeler" src="{{asset('img/wheels.png')}}">
    </div>
</div>
<?php /*
<!-- <div class="slide_in_modal">

        <div class="gh-whats-new">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="slide-in-modal-content">
                            <div class="text-center">
                                <a href="" class="slide-in-modal-close">
                                    <i class="fa fa-times-circle"></i>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><h2 class="s-i-m-title text-center">What's new in Ghoori</h2>   </div>
                                <div class="col-xs-6 col-sm-3">
                                    <a href="{{route('settings.edit',$shop->slug)}}#shipping" class="s-i-m-feature-box">
                                        <i class="fa fa-truck"></i>
                                        <h4>Delivery</h4>   
                                    </a>
                                    <div class="s-i-m-feature-content hidden-xs">
                                        <p>Use your own delivery channel to deliver your own customer only at BDT 99 +VAT monthly. Premium pack users will enjoy this service for free.</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <a href="{{route('settings.edit',$shop->slug)}}#fbshop" class="s-i-m-feature-box">
                                        <i class="fa fa-facebook-square"></i>
                                        <h4><i class="fa fa-facebook"></i>Shop</h4>
                                    </a>
                                    <div class="s-i-m-feature-content hidden-xs">
                                        <p>Make your facebook page fans into your customer. Use fShop feature only at BDT 99 +VAT monthly. Basic and Premium pack users will enjoy fShop for free.</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <a href="{{route('settings.edit',$shop->slug)}}#payment" class="s-i-m-feature-box">
                                        <i class="fa fa-credit-card"></i>
                                        <h4>Card Payment</h4>
                                    </a>
                                    <div class="s-i-m-feature-content hidden-xs">
                                        <p>Use any debit or credit card to pay in Ghoori. All merchants of Ghoori can avail this service for free. To know more check ghoori.com.bd/faq</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <a href="{{route('revenue.index', $shop->slug)}}" class="s-i-m-feature-box">
                                        <i class="fa fa-money"></i>
                                        <h4>Revenue</h4>
                                    </a>
                                    <div class="s-i-m-feature-content hidden-xs">
                                        <p>Check your revenue status now from your shop admin panel.</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>

</div> --> */
?>
<div class="body_main">

    <!-- =========== -->
    <!-- Top section -->
    <!-- =========== -->
    <!-- <div class="header-container">
        <header>

        </header>
    </div> -->
    <?php $statusRev = array('Published' => 'Unpublish', 'Unpublished' => 'Publish'); ?>
    @include('_partials.header')
    <div class="container">
        <div class="mt68">
            {{--logo/banner/address view goes here--}}
            @include('shops.myshop._partials.header')
            <div class="clearfix"></div>
            <!-- <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-info whats-new mt20" style="">
                        <div class="row">
                            <div class="col-xs-9">
                                <p class="">Welcome back! Meanwhile we have introduced some new features in Ghoori.</p>
                            </div>
                            <div class="col-xs-3 text-right">
                                <a href="" class="btn btn-info btn-sm slide-in-modal-show">Learn more</a>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> -->
            @include('flash')
            {{--main content goes here--}}
            <div class="row shop-content">
                @include('_layouts.errors')
                    
                    
                @yield('content')
                <div class="clearfix"></div>
            </div>

            <!-- pagination -->
            <!-- @include('shops.myshop._partials.pagination') -->
            <!-- category selector modal -->
            <div class="cd-bouncy-nav-modal" id="cat_selector">
                <nav>
                    <ul class="cd-bouncy-nav">
                        <li><a data-catid="cat1" href="#">Category 1</a></li>
                    </ul>
                </nav>

                <a href="#" class="cd-close">Close modal</a>
            </div>
            <!--Add Product, Move this to Add product partial-->
            @include('shops.myshop._partials.createProduct')
            @include('shops.myshop._partials.createPreorder')

            <!--Edit Address, Move this to edit address partial-->
            @include('shops.myshop._partials.addressEdit')

            {{--Product Status change--}}
            @include('shops.myshop._partials.productStatus')
             @include('shops.myshop._partials.shopStatus')
             {{-- @include('shops.myshop._partials.packageStatus') --}}
            @include('pages.edit.about')
            @include('pages.edit.privacy')
            @include('pages.edit.term')
        </div>
    
    </div>
    <!-- Move category -->
    <div class="hidden">
        <form>
            <input type="hidden" name="nonce" id="nonce-field">
            <input type="hidden" name="product-id" id="move-product-id-field">
            <input type="hidden" name="category-id" id="move-category-id-field">
            <input type="hidden" name="subcategory-id" id="move-subcategory-id-field">
            <input type="hidden" name="subsubcategory-id" id="move-subsubcategory-id-field">
        </form>
    </div>
</div>
<!-- ============== -->
<!-- Footer section -->
<!-- ============== -->
@include('public.shop._partials.footer')


@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/elevatezoom/3.0.8/jqueryElevateZoom.js"></script>
{{ HTML::script('public/js/shop.js') }}
{{ HTML::script('public/js/script.js') }}
<!-- Animate Modal -->
{{ HTML::script('public/js/animatedModal.min.js') }}
<!-- Product Gallery -->
{{ HTML::script('public/js/productsgallery.js') }}
<!-- Bouncy Navigation -->
<script>
    var cattreejson = "{{URL::route('categoryTree')}}";
    var shopcattreejson = "{{URL::route('categorytreebyid', array('shopID' => $shop->id))}}";
    var moveCatUrl = "{{URL::route('moveCategory')}}";
    var getProductsByCategories = "{{URL::route('getproductsbycategories')}}";

</script>
{{ HTML::script('public/js/bouncy-navigation.js') }}
{{HTML::script('js/jquery.cropit.js')}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
{{ HTML::script('public/js/chorki.js') }}
{{ HTML::script('public/js/preorder.js') }}
@show

@include('_partials.globalscripts')
{{ HTML::script('js/jquery.magnific-popup.min.js') }}
{{HTML::script('https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js')}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

@yield('settings-js')
@yield('order-js')
<script>
    $(document).ready(function() {
      $('.product-image-link').magnificPopup({
          type: 'image',
          mainClass: 'mfp-with-zoom', // this class is for CSS animation below

          zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function 

            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
              // openerElement is the element on which popup was initialized, in this case its <a> tag
              // you don't need to add "opener" option if this code matches your needs, it's defailt one.
              return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
          }

      });
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.10.0/simplemde.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.10.0/simplemde.min.js"></script>

<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("ProductDescMDE")
    });


    
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.5/marked.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if ($('.mdtextraw').length > 0) {
            var mdtohtml = marked( $('.mdtextraw').val(), {  
              breaks: true          
            });
            $('.markdowntext').html(mdtohtml);
            $('.mdtextraw').remove();
        }
        
    })
</script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                        <script type="text/javascript">
                        tinymce.init({
                            selector: "textarea.addedtinymce",
                            plugins: [
                                "advlist autolink lists link image charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        });
                        tinymce.init({
                            menubar:false,
                          //statusbar: false,
                            selector: '#mytextarea'
                        });
                        </script>
<script>

    $("#add-new-banner").animatedModal({
        modalTarget:'animatedModalBanner',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });
    $("#edit-address").animatedModal({
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });
    $("#add-new-product").animatedModal({
        modalTarget:'animatedModalProduct',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });
    $("#add-new-preorder").animatedModal({
        modalTarget:'animatedModalPreorder',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });
    $("#add-new-logo").animatedModal({
        modalTarget:'animatedModalLogo',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });
    $("#add-new-about").animatedModal({
        modalTarget:'animatedModalAbout',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });
    $("#add-new-privacy").animatedModal({
        modalTarget:'animatedModalPrivacy',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });
    $("#add-new-term").animatedModal({
        modalTarget:'animatedModalTerm',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });

    $("#add_theme_banner").animatedModal({
        modalTarget:'animatedModalThemeBanner',
        'color': 'rgba(248,248,248,0.97)',
        'animatedIn': 'bounceInDown',
        'animatedOut':'zoomOutDown'
    });

//    $('#add_theme_banner').on('click', function() {
//       console.log('hello');
//    });
    $(function(){
        // $.fn.editable.defaults.mode = 'inline';

        $('#tagline').on('shown', function(e, editable) {
            $('#edittagline').fadeOut();
        });
        $('#tagline').on('hidden', function(e, reason) {
            $('#edittagline').fadeIn();
        });

        $('#tagline').editable({
            mode: 'inline',
            type: 'text',
            pk: {{$shop->id}},
            url: '{{route('update_tag_line',[$shop->slug])}}',
            title: 'Enter tagline',
            emptytext: 'Click to add tagline',
            ajaxOptions: {
                type: 'put'
            },
            params: function(params) {
                //originally params contain pk, name and value
                params._token = '{{csrf_token()}}';
                return params;
            },
            success: function(response, newValue) {
                // if(!response.success) return response.msg;
                console.log(response);
            },
            error: function(response, newValue) {
                return 'Cannot be saved right now.'
                // console.log(response);
                // if(response.status === 500) {
                //     return 'Service unavailable. Please try later.';
                // } else {
                //     return response.status;
                // }
            }
        });

        $('#edittagline').on('click', function(e) {
            e.stopPropagation();
            $('#tagline').editable('toggle');
        })

    })

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>
<script type="text/javascript">
    $(function () {
        var conn = io.connect("https://notification.ghoori.com.bd:9002");
        // console.log(conn);
        conn.on('data', function(data) {
            // console.log(data);
            // console.log('hi');
        });
        // console.log('hello');
        $('#question').change(function() {
            if($(this).val() === 'others') {
                $('#reason-box').show();
                $('.put-custom-reason').val("true");
            } else {
                $('#reason-box').hide();
                $('.put-custom-reason').val("false");
            }
        });

        $('#requestForCall').click(function () {
            var rfcData = {
                user_name : "{{Auth::user()->name}}",
                shop_name : "{{$shop->title}}",
                shop_id : {{$shop->id}},
                preferred_time : $("#preferredTime :selected").val(),
                question : $("#question :selected").val(),
                mobile_no : $('#mobileNo').val(),
                reason : $("#reason").val(),
                email : '{{$shop->email}}'
            };
            // console.log(rfcData);

            var user_name = "{{Auth::user()->name}}";
            var email   = "{{$shop->email}}";

            var callReq = conn.send(JSON.stringify({
                user_name : user_name,
                email    : email,
                mt: "{{microtime()}}", 
                content : rfcData
            }));
            // console.log(callReq);
            $('#rfcModal').modal('hide');
            setTimeout(function() {
                
                bootbox.dialog({
                          title: "Thanks!",
                          message: '<p class="text-center text-success"><i class="fa fa-3x fa-check-circle"></i></p><p class="text-center">Our Customer Care representative will contact you shortly. Thank you.</p>',
                          backdrop: true,
                          buttons: {
                            success: {
                              label: "Ok",
                              className: "btn-success",
                              callback: function() {
                                return true;
                              }
                            }
                          }
                        });
            }, 500);



        });
    });
</script>
@if (App::environment() == 'production') @include('analytics') @endif
</body>
</html>