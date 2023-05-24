@extends('admin._layouts.admin')

@section('content')

    <h1>Create Tags</h1>
    {{ Form::open(array('route' => 'tags.store')) }}
    @include('admin.tags._partials.form')
    {{ Form::close() }}
@stop