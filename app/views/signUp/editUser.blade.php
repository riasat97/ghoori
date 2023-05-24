@extends('admin._layouts.admin')

@section('content')

    {{Form::model($userData,['route'=>'login.update','class'=>'col-md-offset-3 col-md-6','method'=>'put'])}}
    <h1>Edit User</h1>
    <fieldset class="form-group">
        {{Form::label('name','Name:')}}
        {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Your Name','required'])}}
    </fieldset>
    <fieldset class="form-group">
        {{Form::label('mobile','Mobile:')}}
        {{Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Your Mobile Number'])}}
    </fieldset>
    <fieldset class="form-group">
        {{Form::label('birthDay','Birth Day:')}}
        {{Form::input('date', 'birthDay', null, ['class' => 'form-control','min'=>'1900-01-01']); }}
    </fieldset>
    <fieldset class="form-group">
        {{Form::label('gender','Gender:')}}
        <label>{{ Form::radio('gender', 'male') }} Male</label>
        <label>{{ Form::radio('gender', 'female') }} Female</label>
    </fieldset>
    {{Form::submit('Save Edits',['class'=>'btn btn-default'])}}
{{Form::close()}}
@stop
