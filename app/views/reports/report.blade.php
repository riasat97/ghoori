@extends('public.shop._layouts.shop')
@section('title')
   Filter | Report
@stop
@section('sidebar')
@stop

@section('content')
    <div class="container">
        <div class="row">

            <div class="well">
                @include('revenues._partials.search', array('routeName'=>'generateReports','slug'=>null,'lifetime'=>false,'filter'=>true))
            </div>

        </div>

    </div>
@stop
