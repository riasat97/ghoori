@extends('admin._layouts.admin')
@section('title')
    Reset Password
@stop
@section('content')
    @include('_layouts.errors')
@if(Session::has('error'))
<div class="alert alert-danger error">{{Session::get('error')}}</div>
@endif
@if(Session::has('status'))
<div class="alert alert-success">{{Session::get('status')}}</div>
@endif
{{ Form::open(array('action' => 'RemindersController@postRemind','class'=>'cd-form floating-labels')) }}
<fieldset class="form-group">
    {{Form::label('email','Email:')}}
    {{Form::email('email',null,['placeholder'=>'Your User Email','required'])}}
</fieldset>
{{ Form::submit('Send Reminder') }}
{{ Form::close() }}
@stop