@section('address')
<div id="animatedModal">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <div class="close-animatedModal">
                    <a href="" class="btn btn-danger btn-lg"> <i class="fa fa-times fa-x"></i> Close</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-content container-fluid">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

                    {{ Form::open(array('route' => 'updateAddress','class'=>'cd-form floating-labels','id'=>'edit-contact')) }}
                    <fieldset>
                        <legend>Contact Details</legend>

                        <div class="icon field">
                            <label class="cd-label" for="cd-shop">Email Address</label>
                            {{ Form::text('email', Auth::user()->email,array('class'=>'email','id'=>'cd-email','required placeholder'=>'Email Address')  ) }}
                        </div>

                        <div class="icon field">
                            <label class="cd-label" for="website">Website</label>
                            {{ Form::text('website',null,array('class'=>'website','id'=>'cd-website','placeholder'=>' Shop Web address')) }}
                        </div>

                        <div class="icon field">
                            <label class="cd-label" for="cd-textarea">Address</label>
                            {{ Form::text('address','',array('class'=>'message','id'=>'cd-textarea','required placeholder'=>'Address Goes Here')) }}
                        </div>

                        <div class="icon field">
                            <label class="cd-label" for="cd-shop">Mobile Number</label>
                            <div class="row">
                                <div class="col-xs-2">
                                    <h3 class="text-right">+88</h3>
                                </div>
                                <div class="col-xs-10">{{ Form::text('mobile', Auth::user()->mobile,array('class'=>'phone','id'=>'phone','required placeholder'=>'01842246754')) }}</div>
                                
                            </div>
                        </div>



                        <div>
                            {{ Form::submit('Ok',array('id'=>'contact-save','class'=>'close-animatedModal')) }}
                        </div>
                    </fieldset>
                    {{ Form::close() }}

            </div>
        </div>
    </div>
</div>


<script>

    $(document).on('click','#edit-address',function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ URL::route('editAddress') }}",
            type: "GET",

            success: function(msg) {
                if (msg !== 'Error') {
                    console.log(msg);
                    editAddress(msg);
                }
            },
            error: function(){

            }
        });
    });
    function editAddress(msg){
        var shop = msg.shop;
        $('.website').val(shop.website);
        $('.email').val(shop.email);
        $('.phone').val(shop.mobile);
        $('.message').val(shop.address);
    }


    $(document).on('click','#contact-save',function(e) {
        e.preventDefault();
        var info = $('.flash');
        var data = $("#edit-contact").serialize();

        $.ajax({
            url: "{{ URL::route('updateAddress') }}",
            data: data,
            type: "POST",

            success: function(msg) {
                info.empty();
                if (msg.success) {
                    updateAddressBox(msg);
                    appearUnPublishButton(msg);
                }
                else if(!msg.success){

                    $.each(msg.errors,function(index,error){
                        console.log(error);
                        info.append('<li>'+error+'</li>').fadeIn(300);
                    });
                    info.delay(2500).fadeOut(300);
                }

            },
            error: function(){

            }
        });
    });

    function updateAddressBox(msg) {
        // console.log("full shop")
        // console.log(msg);
         var shop = msg.shop;
        if (shop.address) { $('.shop-address').text(shop.address); };
        if (shop.mobile) {
            $('.shop-contact').text(shop.mobile);
            if (msg.mobileVerified != 1) {
                $('.shop-contact').append(' <a href="{{route('settings.edit', array($shop->getSlug()) )}}#verify" class="text-warning" data-toggle="tooltip" data-placement="right" title="Verify your phone number"><i class="fa fa-warning"></i></a>');
            };
        }; 
        if (shop.email) {
            $('.shop-email').text(shop.email);
            if (msg.emailVerified != 1) {
                $('.shop-email').append(' <a href="{{route('settings.edit', array($shop->getSlug()) )}}#verify" class="text-warning" data-toggle="tooltip" data-placement="right" title="Verify your email address"><i class="fa fa-warning"></i></a>');
            };
        };
        if (shop.website) { $('.shop-website').text(shop.website); };
    }
    function appearUnPublishButton(msg){
        console.log(msg);
        if(msg.appearUnpublishButtonIfEmailChanged){
            $('.shop-status').addClass('hidden');
            $('.guidetoverifyemail').find('.guide-circle').removeClass('guide-circle-done');
        }
        if(msg.appearUnpublishButtonIfMobileChanged){
            $('.shop-status').addClass('hidden');
            $('.guidetoverifymobile').find('.guide-circle').removeClass('guide-circle-done');
        }
        if(msg.appearUnpublishButtonIfMobileChanged.error){
                var error= msg.appearUnpublishButtonIfMobileChanged.error;
                var info = $('.flash');
                info.empty();
                info.append('<li>'+error+'</li>').fadeIn(300);
                info.delay(2500).fadeOut(300);
        }

    }

</script>
@show


