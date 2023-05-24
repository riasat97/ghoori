
{{ Form::open(array('route' => [$routeName,$slug],'class'=>'form-inline', 'method' => 'GET')) }}

  <div class="form-group">
    <label class="sr-only" for="exampleInputAmount">Year</label>
    <div class="input-group">
      <div class="input-group-addon">Year</div>
      {{ Form::select('year',$year,\Carbon\Carbon::now()->year,['id'=>'year','class'=>'form-control date-selector']) }}
    </div>
  </div>
<div class="form-group">
    <label class="sr-only" for="exampleInputAmount">Month</label>
    <div class="input-group">
        <div class="input-group-addon">Month</div>
        {{ Form::select('month',['Month','January','February','March','April','May','June','July',
                                  'August','September','October','November','December']
                   ,\Carbon\Carbon::now()->month,['class'=>'form-control date-selector','id'=>'month']) }}
    </div>
</div>
  @if(!empty($filter))
  <div class="form-group">
      <label class="sr-only" for="exampleInputAmount">Courier</label>
      <div class="input-group">
          <div class="input-group-addon">Courier</div>
          {{ Form::select('courier',$shippingChannel,1,['id'=>'year','class'=>'form-control ']) }}
      </div>
  </div>
  <div class="form-group">
      <label class="sr-only" for="exampleInputAmount">Payment Method</label>
      <div class="input-group">
          <div class="input-group-addon">Payment Method</div>
          {{ Form::select('paymentMethod',$paymentMethodList,1,['id'=>'year','class'=>'form-control']) }}
      </div>
  </div>
  @endif
  @if(!empty($shopHidden))

      {{--{{ Form::hidden('shopIds',$shopId ) }}--}}
      {{ Form::select('shopId',$selectedShopList,$shopId,array('name'=>'shopId[]',"class"=>"multi-select","id"=>"","multiple"=>"multiple")) }}

  @endif
  <div class="form-group">
    <label class="sr-only" for="date">Dates</label>
    <div class="input-group">
      <span class="input-group-addon">Days</span>
      <span class="input-group-btn">
            <button type="submit" value="cycle1" name="type" class="cycle1 btn btn-primary export-btn {{ !empty( Input::get('type') ) && Input::get('type') == 'cycle1' ? 'active' : '' }}">Cycle 1</button>
            <button type="submit" value="cycle2" name="type" class="cycle2 btn btn-primary export-btn {{ !empty( Input::get('type') ) && Input::get('type') == 'cycle2' ? 'active' : '' }}">Cycle 2</button>
            @if(!empty($lifetime))
               <button type="submit" value="lifetime" name="type" class="btn btn-danger export-btn">Lifetime</button>
            @endif
      </span>  
    </div>
  </div>
{{ Form::close() }}
