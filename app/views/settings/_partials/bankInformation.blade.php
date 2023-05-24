<div class="settings-show">
    <div class="row">

        <div class="col-xs-12">

            {{ Form::model($shop->bank,array('route' => array('admin.accounts.store'),'method'=>'POST','class'=>'cd-form floating-labels')) }}
            {{ Form::token() }}
            <fieldset class="bank-form">
                <legend>Bank Information</legend>
                <div class="field">
                    {{ Form::label('', 'Account Holder Name', array("class"=>'cd-label')) }}
                    {{ Form::text('name', null ,array("class"=>"","id"=>"",'placeholder'=>'')) }}
                </div>
                <div class="field">
                    {{ Form::label('', 'Account Number', array("class"=>'cd-label')) }}
                    {{ Form::text('accountNo', null ,array("class"=>"","id"=>"",'placeholder'=>'')) }}
                </div>

                <div class="field">
                    {{ Form::label('', 'Bank Name', array("class"=>'cd-label')) }}
                    <div class="cd-select">
                        {{ Form::select('bank',[null=>'Please Select']+$bankName,null,array("class"=>"","id"=>"",'placeholder'=>'')) }}
                    </div> 
                </div>

                <div class="field">
                    {{ Form::label('', 'Branch Name', array("class"=>'cd-label')) }}
                    {{ Form::text('branch', null ,array("class"=>"","id"=>"",'placeholder'=>'')) }}
                </div>
            </fieldset>


            <input class="btn btn-primary" type="submit" value="Ok">
            {{ Form::close() }}

        </div>

    </div>


    <div class="row">
        <div class="col-xs-12">

            {{ Form::model($shop->bkash,array('route' => array('admin.accounts.postBkash'),'method'=>'POST','class'=>'cd-form floating-labels')) }}
            {{ Form::token() }}
            <fieldset class="bank-form">
                <legend>bKash Information</legend>
                <div class="field">
                    {{ Form::label('', 'Account Holder Name', array("class"=>'cd-label')) }}
                    {{ Form::text('name', null ,array("class"=>"","id"=>"",'placeholder'=>'')) }}
                </div>
                <div class="field">
                    {{ Form::label('', 'Mobile Number', array("class"=>'cd-label')) }}
                    {{ Form::text('mobile', null ,array("class"=>"","id"=>"",'placeholder'=>'')) }}
                </div>

                <div class="field">
                    {{ Form::label('', 'Account Type', array("class"=>'cd-label')) }}
                    <div class="cd-select">
                    {{ Form::select('type',[null=>'Please Select']+$bkashType,null,array("class"=>"","id"=>"",'placeholder'=>'')) }}
                    </div>
                </div>

            </fieldset>
            <input class="btn btn-primary" type="submit" value="Ok">
            {{ Form::close() }}

        </div>

    </div>
</div>