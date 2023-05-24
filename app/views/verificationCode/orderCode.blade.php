@extends('public.shop._layouts.shop')
@section('title')
Verify Your Identity
@stop
@section('sidebar')
@stop
@section('order-css')
@stop
@section('content')

    <div class="row">
        <div class="col-xs-12">
        @if( Session::has('message'))
            <h4 class="alert-info"></h4>
            <div class="alert alert-info" role="alert">
                <i class="fa fa-info" aria-hidden="true"></i>
                <span class="sr-only">Info:</span>
                {{ Session::get('message') }}
                <div class="text-left">
                    {{ HTML::decode(link_to_route('carts.index', 'Back To All Carts', array(), ['class' => 'btn btn-success']))}} &nbsp;
                    {{ HTML::decode(link_to_route('home', 'Continue Shopping', array(), ['class' => 'btn btn-info'])) }}
                </div>
            </div>
        @else
        </div>
        <div class="col-xs-12">
            @if($attempt= Session::get('attempt'))
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <span class="sr-only">Error:</span>
                    Code mismatched &amp; only  {{ 3-$attempt }} attempt(s) left.
                </div>
            @endif
                @include('_layouts.errors')
                <div class="" style="max-width:600px;margin:0 auto;">
                    <p class="text">Thanks for placing your order. Your Order id is <strong>#{{ (100000 + $order->id) }}</strong>. We need to verify your phone number to confirm your order. Please check your SMS inbox for the verification code.</p>
                </div>
                
                {{ Form::open(array('route' => ['orders.verify',$order->id],'class'=>'cd-form floating-labels')) }}
                @include('verificationCode._partials.form',['shop'=>$shippingAddress,
                'route'=>'orders.resendSms','param'=>['orderId'=>$order->id]])
                {{ Form::close() }}
        </div>

        @endif
    </div>

@stop
@section('order-js')

@stop