<!-- Modal -->
<div class="modal fade" id="orderCancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Order Cancelation</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'myOrders.rejectForm','class'=>'cd-form floating-labels','id'=>'','style'=>'margin-bottom:0')) }}
                {{-- {{ Form::token() }} --}}
                <fieldset style="margin-bottom:0">

                    <legend>Tell us your canceling reason</legend>
                <div class="order-reject-wrap">
                  @if(!empty($reasons))
                    <ul class="cd-form-list">
                             @foreach($reasons as $reasons)

                                <li class="input-block">
                                  <input id="cd-checkbox-{{$reasons->rejectionReasonId}}" class="group" name="rejectionreason_id" type="radio" value="{{$reasons->rejectionReasonId}}">
                                  <label for="cd-checkbox-{{$reasons->rejectionReasonId}}"><span class="settings-value">{{$reasons->reason}}</span></label>
                                </li>
                             @endforeach
                      </ul>

                    @endif
                </div>
                <div>
                  <ul class="cd-form-list">
                    <li>
                      <input id="cd-checkbox-other" class="other" name="rejectionreason_id" type="radio">
                      <label for="cd-checkbox-other"><span class="settings-value">Others</span></label>
                    </li>
                  </ul>
                </div>
                <div class='other-reason hidden'>
                  {{Form::textarea('reason')}}
                </div>
                <div class="orderId">
                  <input type="hidden" name="order_id" value="">
                </div>
                <div class="field text-right">
                    <input class="btn btn-primary" type="submit" value="Ok">
                </div>
                </fieldset>
                {{ Form::close() }}

      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>
