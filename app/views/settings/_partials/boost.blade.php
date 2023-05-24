<div class="settings-show">
    <div class="row">
        <div class="col-xs-12">
            <h3>Product Boosts</h3>
            <div class="table-responsive">
                <table class="table table-condensed table-striped">
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Product</th>
                        <th>Position</th>
                        <th>Group</th>
                        <th>Days</th>
                        <th>Status</th>
                        <th>Cost</th>            
                        <th>Payment Status</th>
                    </tr>
                
                    @foreach($SponsoredItems as $key => $boost)
                    <tr>
                        <td>{{date('d M y h:s:i A', strtotime($boost->created_at))}}</td>
                        <td>{{$boost->title}}</td>
                        <td>{{$boost->product->name}}</td>
                        <td>{{ str_replace( '_', ' ', $boost->position) }}</td>
                        <td>{{ str_replace( '_', ' ', $boost->group ) }}</td>
                        <td>
                        {{count($boost->dates)}} days<br>
                        @foreach($boost->dates as $date)
                            {{-- {{$date->date}},  --}}
                        @endforeach
                        </td>
                        <td>{{$boost->reviewStatus}}</td>
                        <td>{{$boost->cost}} BDT</td>            
                        <td>
                            @if($boost->paymentStatus=='Unpaid')
                                <button type="button" data-toggle="modal" data-target="#bkash_instruction" data-href="{{$boost->getPaymentUrl('bkash')}}" data-amount="{{$boost->cost}}" class="btn btn-sm btn-primary boost-pay">Pay &amp; Confirm</button>
                                <!--button type="button" data-toggle="modal" data-target="#boostPaymentModal" data-boostid="{{$boost->id}}" class="btn btn-sm btn-primary boost-pay">Pay &amp; Confirm</button-->
                            @else
                                {{$boost->paymentStatus}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    
                </table>
            </div>
                
        </div>
    
        

    </div>


    
</div>




<div class="modal fade" id="bkash_instruction" tabindex="-1" role="dialog" aria-labelledby="bkash_instructionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Pay &amp; Confirm</h4>
            </div>
            <div class="modal-body">
                <p>
                <ul>
                    <li>To confirm the boost request please pay <strong class="amount">XXX</strong> BDT (Including VAT) via bKash.<br>Here are the steps-</li>
                </ul>
                </p>
                @include('_partials.bkashinstruction')
                <p>
                
                </p>
            </div>
            <div class="modal-footer">
                
                <a type="submit" href="{{ route('settings.edit', $shop->slug) }}#boost" class="btn btn-lg btn-success boostpaynow">Confirm Now</a>
            </div>            
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){
      $('#bkash_instruction').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var boostCarge = button.data('amount') // Extract info from data-* attributes
        var payurl = button.data('href') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var $bkash_instruction = $(this)
        $bkash_instruction.find('.amount').text(parseInt(boostCarge));
        $bkash_instruction.find('.counternumber').text(5);
        $bkash_instruction.find('.refnumber').text({{$shop->id}});
        $bkash_instruction.find('.boostpaynow').attr('href', payurl);
      })
    });
</script>