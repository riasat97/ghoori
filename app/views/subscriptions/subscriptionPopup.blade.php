<div class="modal fade" id="subscription-pop-up" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="color: green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>You are almost done and going to get started by this Email</h4>
                <div class="email-print" style="color: blue"><b></b></div>
                <br>
            </div>

            <div class="modal-body">

                {{ Form::open(array('route'=>'subscribePost', 'class'=>'confirmation-form', 'data-remote', 'data-remote-success-message'=>'Well done!')) }}

                <h4 class="modal-title" id="myModalLabel">Please fill up these to go ahead</h4><br>

                <div class="form-group">
                    {{ Form::label('Name', 'Your Email Address') }}<br>
                    {{ Form::label('Name', '', array('id' => 'email-hidden')) }}<br>
                </div>

                <div class="form-group" >
                    {{ Form::label('Name', 'Enter Your Name:') }}<br>
                    {{ Form::text('name') }}
                </div><br>

                <div class="form-group" >
                    {{ Form::label('Mobile', 'Mobile Your Number:') }}<br>
                    {{ Form::text('mobile') }}
                </div><br>

                <div class="form-group">
                    {{ Form::submit('Start Now', array('class'=>'btn btn-primary btn-lg subscription-confirmation', 'data-toggle'=>'modal', 'data-target'=>'#confirmation-pop-up')) }}
                </div>

                {{ Form::close() }}
            </div>

            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
                {{--<button type="button" class="btn btn-primary">Submit</button>--}}
            </div>

        </div>
    </div>
</div>