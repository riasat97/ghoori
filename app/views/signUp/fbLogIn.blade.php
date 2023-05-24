@extends('admin._layouts.admin')
@section('title')
    Login to Ghoori
@stop
@section('content')
    <div class="login-back" style="background: transparent url('{{asset("img/log_in_page.png")}}') repeat scroll 0% 0% / cover">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-sm-offset-1">
                    <div id="logoHolder">
                        <img class="logo" src="{{ asset('img/logo-white.png') }}" alt=""/>
                        <img class="ghoori-flying" src="{{ asset('img/ghoori-flying-white.png') }}">
                    </div>

				<div class="login-message">
					<h2>Sign up for 15 days free trial now!</h2>
				</div>
				<div class="row no-gutter">
					<div class="col-xs-2">
						<img src="{{asset('img/picture1.png')}}" class="img-responsive">
					</div>
                        <div class="col-xs-2">
                            <img src="{{asset('img/picture2.png')}}" class="img-responsive">
                        </div>
                        <div class="col-xs-2">
                            <img src="{{asset('img/picture3.png')}}" class="img-responsive">
                        </div>
                        <div class="col-xs-2">
                            <img src="{{asset('img/picture4.png')}}" class="img-responsive">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5">
                
                    <div class="loginform-back">
                        @if ( Session::has('auth_flash_message') )

                            <div class="alert {{ Session::get('flash_type') }}">
                                <p>{{ Session::get('auth_flash_message') }}</p>
                            </div>

                        @endif
                        <div class="loginform-wrap">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tablogin" aria-controls="tablogin" role="tab" data-toggle="tab">Login</a></li>
                                <li role="presentation"><a href="#tabsignup" aria-controls="tabsignup" role="tab" data-toggle="tab">Create new account</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tablogin">
                                    {{Form::open(array('route'=>'emailLogin','class'=>'form'))}}
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></div>
                                                {{Form::email('email',null,array('class'=>'form-control','placeholder'=>'Email Address','required'))}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-key"></i></div>
                                                <input type="password" name="password" class="form-control"  placeholder="Password" required>
                                            </div>
                                        </div>
                                        {{Form::hidden('redirectUrl',Input::get('redirectUrl'))}}
                                        <button type="submit" class="btn btn-success">Login</button>
                                    {{Form::close()}}
                                    <a href="{{action('RemindersController@getRemind')}}">Forgot Password</a>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tabsignup">
                                    {{Form::open(array('route'=>'emailSignUp','class'=>'form', 'id'=>"signUpForm"))}}
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                                                {{Form::text('name',null,array('required','class'=>'form-control', 'placeholder'=>'Full Name'))}}
                                            </div>
                                            {{ $errors->first('name', '<p class="error-message">:message</p>') }}
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></div>
                                                {{Form::email('email',null,array('required','class'=>'form-control', 'placeholder'=>'Email Address'))}}
                                            </div>
                                            {{ $errors->first('email', '<p class="error-message">:message</p>') }}
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-key"></i></div>
                                                {{Form::password('password',array('required','class'=>'form-control', 'placeholder'=>'Password', 'id'=> 'signuppassword'))}}
                                            </div>
                                            {{ $errors->first('password', '<p class="error-message">:message</p>') }}
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-key"></i></div>
                                                {{Form::password('password_confirmation',array('required','class'=>'form-control', 'placeholder'=>'Re-type Password','id'=> 'signuprepassword'))}}
                                            </div>
                                            {{ $errors->first('password_confirmation', '<p class="error-message">:message</p>') }}
                                        </div>
                                        {{Form::hidden('redirectUrl',Input::get('redirectUrl'))}}
                                        <button type="submit" class="btn btn-success">Sign Up</button>
                                    {{Form::close()}}
                                </div>

                            </div>
                            <h4>Or,</h4>
                            <a class="btn btn-facebook btn-lg fbLoginButton loginpage-loginbutton" href=""><i class="fa fa-fw fa-facebook"></i> Login</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(function(){
        // alert("yo")
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
                // console.log(e);
                // window.location.hash = e.target.hash;
            });
        var logInErrors = $("#tablogin").find('.error-message').length;
        var signUpErrors = $("#tabsignup").find('.error-message').length;
        if (signUpErrors > 0) {
            // $("#tabsignup").tab('show');
            $('.nav-tabs a[href="#tabsignup"]').tab('show');

        };
        // console.log('logInErrors: '+logInErrors);
        // console.log('signUpErrors: '+signUpErrors);
        $( "#signUpForm" ).validate({
          rules: {
            password: {
                required:true,
                minlength: 8,
            },
            password_confirmation: {
              equalTo: "#signuppassword"
            }
          },
          errorElement: 'p',
            errorClass: 'error-message',
            errorPlacement: function(error, element) {
                if(element.parent('.form-group').length) {
                    error.insertAfter(element.parent('.input-group'));
                } else {
                    error.insertAfter(element.parent('.input-group'));
                }
            }
        });
    });
</script>
@stop