<div class="{{--settings-show--}}">
    <div class="row">
        <div class="col-xs-12">
            <legend>Shipping Method</legend>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">


            {{ Form::model($shop,array('route' => array('settings.updateShippingChannels',$shop->getSlug()),'method'=>'PUT','class'=>'floating-labels')) }}
            {{ Form::token() }}
                <table class="table table-hover">
                    @foreach($shippingChannels as $shippingChannel)
                        <tr>
                            <td>
                                <span class="settings-value">{{ $shippingChannel->name }} </span>
                            </td>
                                @if(in_array($shippingChannel->id,$shop->shippingChannels->lists('id')))
                                <td> {{ Form::checkbox('shippingChannel_id[]',$shippingChannel->id, true) }}</td>
                                @else
                                <td> {{ Form::checkbox('shippingChannel_id[]',$shippingChannel->id, false) }}</td>
                                @endif
                        </tr>
                    @endforeach
                        <tr>
                            <td>
                                <span class="settings-value">own delivery system </span>
                            </td>

                            <td> {{ Form::checkbox('ownChannel', 1, $ownChannel? true:false,
                                [ 'class'=>'own-channel-box','data-toggle'=>"modal", 'data-target'=>"#own-channel"]) }}
                            </td>

                        </tr>
                </table>
            <input class="btn btn-success" type="submit" value="Ok">
            {{ Form::close() }}

        </div>

    </div>
</div>