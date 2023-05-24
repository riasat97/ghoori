@extends('shops.myshop._layouts.main')

@section('title')
    Edit Facebook Shop
@stop
@section('page-specific-css')
{{ HTML::style('css/facebookshoppages.css') }}

@stop

@section('content')
<div class="col-sm-6">
{{ HTML::image('img/facebookghoori.png', 'a picture', array('class' => 'img-responsive fbshopbtncomm')) }}

</div>
<div class="col-sm-6">
    <h3>Edit Your Facebook Shop</h3>
<p class="description">
	Choose your desire Tab name. You can change it anytime. Catchy tab name can bring more sales. So choose carefully.
</p>
{{Form::open(array('url'=>$url))}}

<fieldset class="form-group">
    {{Form::text('custom_name',$custom_name,array('class'=>'form-control input-lg'))}}
    <br>
    <div class="text-right">{{Form::submit('Save',array('class'=>'btn btn-facebook btn-lg'))}}</div>
    
</fieldset>
{{Form::close()}}
</div>
@endsection