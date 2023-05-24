@extends('public.shop._layouts.index')
@section('title')
    404 | Ghoori
@stop
@section('staticpagestyles')
    {{HTML::style('css/errorstyle.css')}}
@stop
@section('aboutus')
        <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                <div class="col-md-3 col-md-push-4 col-md-offset-5 col-sm-4 col-sm-push-8 col-xs-4 col-xs-offset-1 logo-position">
                    <div id="logoHolder">
                            <img class="logo" src="{{asset('img/logo.png')}}" alt="">
                            <img class="ghoori-flying" src="{{asset('img/ghoori-flying.png')}}">
                        </div>
                </div>
                <div class="col-md-4 col-md-pull-8 col-sm-4 col-sm-pull-8 col-xs-4 image-position">
                    <p class="error-type"></p>
                </div>
            </div>

            <div class ="row">
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 text-position">
                    <div class="col-md-9 col-md-push-3 col-sm-10 col-sm-push-2 col-xs-12">
                        <header>That's an error</header>
                        <p>
                            The requested URL was not found on this server. <span>That's all we know</span>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop