<fieldset>
    <legend>User Info</legend>
    <div class="icon">
        {{ Form::label('name', 'Full Name', array("class"=>'cd-label')) }}
        {{ Form::text('name', null ,array("class"=>"shop",'required' , 'placeholder'=>'Full Name')) }}
        {{ $errors->first('name', '<p class="error-message">:message</p>') }}
    </div>
</fieldset>
<fieldset>
    <legend>Shop Info</legend>
    <div class="icon">
        {{ Form::label('title', 'Your Shop Name', array("class"=>'cd-label')) }}
        {{ Form::text('title', null ,array("class"=>"shop","id"=>"cd-shop",'required','placeholder'=>'Shop Name')) }}
        {{ $errors->first('title', '<p class="error-message">:message</p>') }}
    </div>
    <div class="icon">
        {{ Form::label('package', 'Package', array("class"=>'cd-label')) }}
        {{ Form::select('package', $packages)}}
    </div>
    <div class="icon">
        {{ Form::label('subDomain', 'Choose a sub domain Name', array("class"=>'cd-label')) }}
        {{ Form::text('subDomain', null ,array('required','placeholder'=>'Sub domain'))}}<label class="half cd-label">.ghoori.com.bd</label>
        {{ $errors->first('subDomain', '<p class="error-message">:message</p>') }}
    </div>
    <div class="icon">
        {{ Form::label('description', 'Shop Description', array("class"=>'cd-label')) }}
        {{ Form::textarea('description', null ,array("class"=>"message","id"=>"cd-textarea","required placeholder"=>"Description goes here")) }}
        {{ $errors->first('description', '<p class="error-message">:message</p>') }}
    </div>
    <div class="icon">
        {{ Form::label('address', 'Address', array("class"=>'cd-label')) }}
        {{ Form::text('address', null ,array("class"=>"address","id"=>"shop-address","required placeholder"=>"Address goes here")) }}
        {{ $errors->first('address', '<p class="error-message">:message</p>') }}
    </div>

    <div class="icon">
        {{ Form::label('', 'Pickup Address', array("class"=>'cd-label')) }}
        <ul class="cd-form-list">
            <li>
                <div class="input-group">
                    {{Form::checkbox('sameAsAddress', 1, true ,array("class"=>"same-as-address",'id'=> 'sameAsAddress'))}}
                    {{ Form::label('sameAsAddress', 'Pickup address same as shop address', array("class"=>'cd-label')) }}
                </div>
                {{ $errors->first('sameAsAddress', '<p class="error-message">:message</p>') }}
            </li>
        </ul>
        {{ Form::text('pickUpAddress', null ,array("class"=>"pickup-address address hidden","id"=>"pickup-address","required placeholder"=>"Pickup Address")) }}
        {{ $errors->first('pickUpAddress', '<p class="error-message">:message</p>') }}
    </div>

</fieldset>

<fieldset>
    <legend>Contact Info</legend>
    <div class="icon">
        {{ Form::label('email', 'Email Address', array("class"=>'cd-label')) }}
        {{ Form::email('email', null ,array("class"=>"email","id"=>"cd-email",'required' , 'placeholder'=>"Email Address")) }}
        {{ $errors->first('email', '<p class="error-message">:message</p>') }}
    </div>
    <div class="icon">
        {{ Form::label('mobile', 'Mobile number', array("class"=>'cd-label')) }}
        {{ Form::text('mobile', null , array("class"=>"phone","id"=>"phone","required placeholder" => "01XXXXXXXXX")) }}
        {{ $errors->first('mobile', '<p class="error-message">:message</p>') }}
    </div>
    <legend>Verify with</legend>
    <div class="icon">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="input-group">
                    {{Form::radio('verifywith', 'nid', true ,array('required', 'id'=> 'verifywithnid'))}}
                    <label class="cd-label" for="verifywithnid">National ID</label>
                </div>
                <div class="input-group">
                    {{Form::radio('verifywith', 'driving', false ,array('required', 'id'=> 'verifywithdriving'))}}
                    <label class="cd-label" for="verifywithdriving">Driving License</label>
                </div>
                <div class="input-group">
                    {{Form::radio('verifywith', 'passport', false ,array('required', 'id'=> 'verifywithpassport'))}}
                    <label class="cd-label" for="verifywithpassport">Passport</label>
                </div>
                <div class="input-group">
                    {{Form::radio('verifywith', 'birth', false ,array('required', 'id'=> 'verifywithbirth'))}}
                    <label class="cd-label" for="verifywithbirth">Birth Certificate</label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <div class="verifywithbox fadeInRight verifywithnidbox">
                    {{ Form::label('nidfield', 'National ID Number', array("class"=>'cd-label')) }}
                    {{ Form::text('nationalId', null ,array("class"=>"nid verifynumberfield","id"=>"cd-shop",'required','placeholder'=>'National ID Number')) }}
                    {{ $errors->first('nationalId', '<p class="error-message">:message</p>') }}
                </div>
                <div class="verifywithbox fadeInRight verifywithdrivingbox">
                    {{ Form::label('drivingfield', 'Driving License Number', array("class"=>'cd-label')) }}
                    {{ Form::text('drivingLicense', null ,array("class"=>"driving verifynumberfield","id"=>"cd-shop",'required','placeholder'=>'Driving License Number')) }}
                    {{ $errors->first('drivingLicense', '<p class="error-message">:message</p>') }}
                </div>
                <div class="verifywithbox fadeInRight verifywithpassportbox">
                    {{ Form::label('passportfield', 'Passport Number', array("class"=>'cd-label')) }}
                    {{ Form::text('passport', null ,array("class"=>"passport verifynumberfield","id"=>"cd-shop",'required','placeholder'=>'Passport Number')) }}
                    {{ $errors->first('passport', '<p class="error-message">:message</p>') }}
                </div>
                <div class="verifywithbox fadeInRight verifywithbirthbox">
                    {{ Form::label('birthfield', 'Birth Certificate', array("class"=>'cd-label')) }}
                    {{ Form::text('birthCertificate', null ,array("class"=>"birth verifynumberfield","id"=>"cd-shop",'required','placeholder'=>'Birth Certificate Number')) }}
                    {{ $errors->first('birthCertificate', '<p class="error-message">:message</p>') }}
                </div>
            </div>
        </div>
                

        {{ $errors->first('verifywith', '<p class="error-message">:message</p>') }}
    </div>
    <div class="icon">
        <ul class="cd-form-list">
            <li>
                <div class="input-group">
                    {{Form::checkbox('agreeWithTerms', 'agree', false ,array('required', 'id'=> 'agreeWithTerms'))}}
                <label class="cd-label" for="agreeWithTerms">I agree to the <a href="{{URL::route('store.getTerms')}}" target="_blank">Terms and Conditions</a></label>
                </div>
            </li>
        </ul>
        
        {{ $errors->first('agreeWithTerms', '<p class="error-message">:message</p>') }}
    </div>
    <div>

        
    </div>
    {{ Form::hidden('user_id',Auth::user()->id) }}
</fieldset>

<div>
    {{ Form::submit('Ok', array("class"=>'btn btn-default')) }}
</div>




