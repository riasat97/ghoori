
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                @if($attempt= Session::get('attempt'))
                    <div class="alert alert-danger" role="alert">
                      <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                      <span class="sr-only">Error:</span>
                      Mismatched &amp; remaining attempt left &nbsp; {{ 3-$attempt }}
                    </div>
                @endif
                @if ($shop->isVerified != 0)
                    <div class="alert alert-success" role="alert">
                      <i class="fa fa-check" aria-hidden="true"></i>
                      <span class="sr-only">Success:</span>
                      Your mobile number is verified.
                    </div>
                @else
                    @include('_layouts.errors')
                    {{ Form::open(array('route' => 'mobileVerificationCode.post','class'=>'cd-form floating-labels')) }}
                    @include('verificationCode._partials.form',['route'=>'shops.resendSms','param'=>null])
                    {{ Form::close() }}
                    
                @endif


            
                @if( Session::get('message'))
                    <h4 class="alert-info"></h4>
                    <div class="alert alert-info" role="alert">
                      <i class="fa fa-info" aria-hidden="true"></i>
                      <span class="sr-only">Info:</span>
                      {{ Session::get('message') }}
                    </div>
                @endif

                @if (isEmailVerified($shop))
                    <div class="alert alert-success" role="alert">
                              <i class="fa fa-check" aria-hidden="true"></i>
                              <span class="sr-only">Success:</span>
                              Your email address is verified.
                    </div>
                @else
                    <form class="cd-form">
                        <fieldset>
                            <legend>Email Verification</legend>
                            <div class="alert alert-warning" role="alert">
                              <i class="fa fa-asterisk" aria-hidden="true"></i>
                              <span class="sr-only">Success:</span>
                               Check your inbox for email verification link.
                               <div>  {{ Html::decode(link_to_route('shops.resendMail','<i class="fa fa-fw fa-repeat"></i> Resend',null,array('class'=>'btn btn-default'))) }}</div>
                            </div>
                            
                        </fieldset>
                    </form>
                @endif
                        
                    
                
            </div>
        </div>
