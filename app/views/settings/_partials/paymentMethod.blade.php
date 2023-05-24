<div class="settings-show">
    <div class="row">
        <div class="col-xs-12">
            <legend>Payment Method</legend>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">

            {{ Form::model($shop,array('route' => array('settings.updatePaymentMethods',$shop->getSlug()),'method'=>'PUT','class'=>' floating-labels')) }}
            {{ Form::token() }}
            <table class="table table-hover">
                @foreach($paymentMethods as $paymentMethod)
                <tr>
                    <td><span class="settings-value">{{$paymentMethod->label}}</span></td>
                    @if(in_array($paymentMethod->id,$shop->paymentMethods->lists('id')))
                        <td> {{ Form::checkbox('paymentMethod_id[]',$paymentMethod->id, true) }}</td>
                    @else
                        <td> {{ Form::checkbox('paymentMethod_id[]',$paymentMethod->id, false) }}</td>
                    @endif
                </tr>
                @endforeach
            </table>
            <input class="btn btn-primary" type="submit" value="Ok">
            {{ Form::close() }}

        </div>

    </div>
</div>