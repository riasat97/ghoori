@extends('public.shop._layouts.index')

@section('title')
    {{$message_title}}
@stop

@section('staticpagestyles')
@stop

@section('metatags')


@stop
@section('content')
<div class="container">
        <div class="row">
	        <div class="col-xs-12">
			    <h1>{{$message_header}}</h1>
			    <p>{{$message_body}}</p>
			</div>
	    </div>
	</div>

@stop