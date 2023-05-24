<fieldset>
    <legend>Enter mobile verification code</legend>
    <div class="icon field">
        {{ Form::label('mobile-code', 'Verification Code', array("class"=>'cd-label')) }}
        {{ Form::text('code','',array('class'=>'code','placeholder'=>'Enter code here', 'required'=>'required')) }}
        {{ $errors->first('code', '<p class="error-message">:message</p>') }}
    </div>

    <div>
        {{ Form::submit('Ok') }}
    </div>
    <div>
        <br>
        @if( $shop->code == null || $shop->code->resendCount != 3)
        If you haven't received your code yet, press
        {{ HTML::decode(link_to_route($route,'<i class="fa fa-repeat"></i> Resend',
        $param,array('class'=>'btn btn-default btn-sm'))) }}
        <p></p>
        @else
        
        @endif
        <p>Still having problem? <span class="">Call <i class="fa fa-phone"></i> 09612000888 to confirm your order.</span></p>
    </div>
</fieldset>