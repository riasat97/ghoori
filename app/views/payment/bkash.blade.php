@extends('public.shop._layouts.index')

@section('title')
    bKash Payment | Ghoori
@stop

@section('staticpagestyles')
@stop

@section('metatags')


@stop

@section('content')
<div class="container">
        <div class="row">
	        <div class="col-xs-12">
	        	{{Form::open(array('class'=>'cd-form floating-labels'))}}
					<fieldset>
					    <legend>bKash Payment</legend>
					    <div class="">
					        {{ Form::label('trx_id', 'Transaction ID', array("class"=>'cd-label')) }}
					        {{ Form::text('trx_id', null ,array("class"=>"",'required' , 'placeholder'=>'Transaction ID','autocomplete'=>'off')) }}
					        {{ $errors->first('trx_id', '<p class="error-message">:message</p>') }}
					        <p class="field-description">Put your bKash Transaction ID here and click confirm.</p>
					    </div>
					</fieldset>
					<div>
					    {{ Form::submit('Confirm', array("class"=>'btn btn-default')) }}
					</div>
				{{Form::close()}}

	        </div>
	    </div>
	</div>

@stop