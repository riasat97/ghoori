@section('sidebar')
    
    <div class="row no-gutter">
        <div class="col-sm-3 col-xs-6">
            <div class="sidebar-boxes">
                <a href=""><img src="{{ URL::asset('img/home/480x480-1.jpg') }}" alt="" class="img-responsive"></a>
            </div>
        </div>

        <div class="col-sm-3 col-xs-6">
            <div class="sidebar-boxes">
                <a href=""><img src="{{ URL::asset('img/home/480x480-2.jpg') }}" alt="" class="img-responsive"></a>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12">
            <div class="sidebar-boxes">
                <a href=""><img src="{{ URL::asset('img/home/960x480.jpg') }}" alt="" class="img-responsive"></a>
            </div>
        </div>
    </div>

@show