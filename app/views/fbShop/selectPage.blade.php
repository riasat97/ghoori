@extends('shops.myshop._layouts.main')

@section('title')
    Select page for Facebook Shop
@stop
@section('page-specific-css')
{{ HTML::style('css/facebookshoppages.css')  }}

@stop

@section('content')
<div class="col-sm-6">
{{ HTML::image('img/facebookghoori.png', 'a picture', array('class' => 'img-responsive fbshopbtncomm')) }}
</div>
<div class="col-sm-6">
<h3>Facebook Shop</h3>
	{{Form::open(array('url'=>$url))}}
	<h4>Select a page for installing Facebook shop</h4>
	<p class="description">
Adding a Facebook Shop button is really easy. Anyone with a laptop/mobile can do it within 5/10 minutes time. Call us at 09612000888 if you face any difficulty.
	</p>
	<fieldset class="form-group">
	    {{Form::select('pageId',$pages,null, array('class'=>'form-control input-lg'))}}
	    <br>
	    <div class="text-right">
	    	{{Form::submit('Install',array('class'=>'btn btn-lg btn-facebook '))}}
	    </div>
	    
	    
	</fieldset>

	{{Form::close()}}
	
</div>

@endsection