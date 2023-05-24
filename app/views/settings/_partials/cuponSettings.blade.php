<div class="settings-show">
    <div class="row">
        <div class="col-xs-12">
            <legend>Cupon</legend>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="mytoken" value="{{ csrf_token() }}"></div>
            <table class="table table-hover">
                    <tr>
                        <td>Camapign Name</td>
                        <td>Duration</td>
                        <td>Discount</td>
                        <td>Active Status</td>
                    </tr>
                @foreach($cuponCampaignList as $item)
                    <tr data-campaignid="{{$item['id']}}" data-shopid="{{$shop->id}}" data-name="{{$item['name']}}">
                        <td><span>{{$item['name']}}</span></td>
                        <td><span>{{$item['startDate']}} to {{$item['endDate']}}</span></td>
                        <td><span>{{$item['discount']}}%</span></td>
                        @if($item['couponType']!=1)
                            @if(array_key_exists('active',$item) && $item['active']==1)
                                <td> {{ Form::checkbox('cupon',$item['active'], true, array('class' => 'cuponCheckbox')) }}</td>
                            @else
                                <td> {{ Form::checkbox('cupon',0, false, array('class' => 'cuponCheckbox')) }}</td>
                            @endif
                        @else
                            <td>Activated By Ghoori</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>