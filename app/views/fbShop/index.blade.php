@extends('shops.myshop._layouts.main')

@section('title')
    Facebook Shop
@stop
@section('page-specific-css')
{{ HTML::style('css/facebookshoppages.css') }}

@stop

@section('content')
<div class="col-sm-6">
{{ HTML::image('img/facebookghoori.png', 'Facebook shop @ Ghoori', array('class' => 'img-responsive fbshopbtncomm')) }}
</div>
	<div class="col-xs-6">
        <h3>Facebook Shop</h3>

	    <a class="btn btn-primary" target="_blank" href="{{$fbShopUrl}}">Go to your Facebook Shop</a>
	    <a class="btn btn-info" href="{{URL::route('fbShop.edit',[$slug])}}">Edit</a>
	</div>
@endsection