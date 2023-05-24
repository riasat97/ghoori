@extends('admin._layouts.admin')
@section('title')
    Reset Password
@stop
@section('content')
    @include('_layouts.errors')
    @if(Session::has('error'))
        <div class="alert alert-danger error">{{Session::get('error')}}</div>
    @endif
{{ Form::open(array('action' => 'RemindersController@postReset','class'=>'cd-form floating-labels')) }}
{{ Form::hidden('token',$token) }}
<fieldset class="form-group">
    {{Form::label('email','Email')}}
    {{Form::email('email',null,['placeholder'=>'Your User Email','required'])}}
</fieldset>
<fieldset class="form-group">
    {{Form::label('password','Password')}}
    {{Form::password('password',['placeholder'=>'Type your new password','required'])}}
</fieldset>
<fieldset class="form-group">
    {{Form::label('password_confirmation','Retype Password')}}
    {{Form::password('password_confirmation',['placeholder'=>'Re-type your new password','required'])}}
</fieldset>
{{ Form::submit('Reset Password') }}
{{ Form::close() }}
    @stop