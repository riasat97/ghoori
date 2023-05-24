@if(!empty($reasons))
<table class="table table-hover">
         @foreach($reasons as $reasons)
        <tr>
            <td><span class="settings-value">{{$reasons->reason}}</span></td>
            <td><input class="group" name="rejectionreason_id" type="checkbox" value="{{$reasons->rejectionReasonId}}"></td>
        </tr>
         @endforeach
</table>

@endif