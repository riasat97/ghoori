@extends('admin._layouts.admin')
@section('title')
User Settings
@stop
@section('content')
    @include('_layouts.errors')
    <div class="container">
        <div class="row">
        	<div class="col-xs-12">
        		<div class="user-box">
	              	<img class="profile-picture" src="{{ Gravatar::imageURL( Auth::user()->email, 96 ) }}">
	              	<h2 class="profile-name">{{ Auth::user()->name }}</h2>
              	</div>
        	</div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                {{Form::open(array('route'=>'user.settings.update','class'=>'cd-form floating-labels'))}}
                <fieldset>
                    <legend>Update Your Profile</legend>
                    <div class="icon field">
                        <label class="cd-label" for="website">Name</label>
                        <div class="row">
                        	<div class="col-xs-12 col-sm-8 col-md-7">
                        		{{ Form::text('name',Auth::user()->name,array('class'=>'cd-product-name','placeholder'=>'Full Name')) }}
                                {{ $errors->first('name', '<p class="error-message">:message</p>') }}
                            </div>
                        </div>
                    </div>
                    <div class="icon field">
                        <label class="cd-label" for="website">Email</label>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-7">
                                {{ Form::text('email',Auth::user()->email,array('class'=>'cd-product-name','placeholder'=>'Email', 'disabled')) }}
                                {{ $errors->first('email', '<p class="error-message">:message</p>') }}
                            </div>
                        </div>
                    </div>
                    <legend>Social Network</legend>
                    <div class="icon field">
                        <label class="cd-label" for="website">Facebook</label>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-7">
                                @if($fbNotConnected)
                                <a class="btn btn-facebook btn-lg fbConnectButton loginpage-loginbutton" href=""><i class="fa fa-fw fa-facebook"></i> connect</a>
                                @else
                                <a class="btn btn-facebook btn-lg" disabled href=""><i class="fa fa-fw fa-facebook"></i> connected</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <legend>Change Password</legend>
                    <div class="icon field">
                        <label class="cd-label" for="website">Old Password</label>
                        <div class="row">
                        	<div class="col-xs-12 col-sm-8 col-md-7">
                                {{ Form::password('old_password',array('class'=>'cd-product-name','placeholder'=>'Old password')) }}
                            </div>
                        	<div class="col-xs-12 col-sm-4 col-md-5">
                        		<p class="field-description">If you haven't set your password yet, leave it blank.</p>
                        	</div>
                        </div>
                    </div>
                    <div class="icon field">
                        <label class="cd-label" for="website">New Password</label>
                        <div class="row">
                        	<div class="col-xs-12 col-sm-8 col-md-7">
                                {{ Form::password('new_password',array('class'=>'cd-product-name','placeholder'=>'New password')) }}
                                {{ $errors->first('new_password', '<p class="error-message">:message</p>') }}
                            </div>
                        </div>
                    </div>
                    <div class="icon field">
                        <label class="cd-label" for="website">Retype New password</label>
                        <div class="row">
                        	<div class="col-xs-12 col-sm-8 col-md-7">
                                {{ Form::password('new_password_confirmation',array('class'=>'cd-product-name','placeholder'=>'Retype New password')) }}
                                {{ $errors->first('new_password_confirmation', '<p class="error-message">:message</p>') }}
                            </div>
                        </div>
                    </div>
                    <!--input id="mme-token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>"-->
                    <div>
                        <input type="submit" value="Update" name="submit" id="productUpdate" >
                    </div>
                </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop