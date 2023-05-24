
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger flash " style="display: none;">

            </div>
            @if ( Session::has('flash_message') )

                <div class="alert {{ Session::get('flash_type') }}">
                    <p>{{ Session::get('flash_message') }}</p>
                </div>

            @endif
            @if ( Session::has('error_message') )

                <div class="alert {{ Session::get('flash_type') }}">
                    <ul>
                        @foreach(Session::get('error_message') as $key=>$error)
                           <li>{{$key}} has {{ $error['stock'] }} item{{$error['stock']>1?'s':''}} left only. But you have chosen {{ $error['qty'] }}  </li>
                        @endforeach
                    </ul>
                    
                </div>

            @endif
            <div class="container alert alert-danger  error-cart-qty" style="display: none;">

            </div>
        </div>
        
    </div>


