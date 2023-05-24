<fieldset>
    <div class="icon">
        {{ Form::token() }}
        {{ Form::label('', 'facebook fan page', array("class"=>'cd-label')) }}
        {{ Form::text('facebook', null ,array("class"=>"","id"=>"",'placeholder'=>'facebook page link')) }}
    </div>
    <!-- <div class="icon"> -->
        {{-- Form::label('', 'facebook group', array("class"=>'cd-label')) --}}
        {{-- Form::text('facebookGroup', null ,array("class"=>"","id"=>"",'placeholder'=>'facebook group link')) --}}
    <!-- </div> -->

    <div class="icon">
        {{ Form::label('', 'twitter page ', array("class"=>'cd-label')) }}
        {{ Form::text('twitter', null ,array("class"=>"","id"=>"","placeholder"=>"twitter page link")) }}
    </div>
    <div class="icon">
        {{ Form::label('', 'youtube page', array("class"=>'cd-label')) }}
        {{ Form::text('youtube', null ,array("class"=>"","id"=>"","placeholder"=>"youtube page link")) }}
    </div>

</fieldset>
<fieldset>
    <div>
        {{ Form::submit('Ok', array("class"=>'btn btn-default')) }}
    </div>
</fieldset>




