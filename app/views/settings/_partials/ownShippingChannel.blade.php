<script type="text/javascript">


    var shippingLocations = {{json_encode($shippingLocations)}}
    // console.log(shippingLocations)
    var shopShippingLocations = {{json_encode($shopShippingLocations)}}
    // console.log(shopShippingLocations);
    // delete shopShippingLocations["1"];
    for (var selkey in shopShippingLocations) {
       var obj = shopShippingLocations[selkey];
       // console.log(key+":"+obj);
       for (var shipkey in shippingLocations) {
           if (obj === shippingLocations[shipkey]) {
                delete shippingLocations[shipkey];
                break;
           };
       };
    }
    // console.log(shippingLocations);
    // console.log(shippingLocations.length);
    // console.log(Object.keys(shippingLocations).length);
    $(function(){
        render_select_division();
    });
    // console.log(shippingLocations);
    function render_select_division () {
        $(".div_selector").html("<option>Select Division</option>");
        for ( var key in shippingLocations){
            $(".div_selector").append("<option value="+key+">"+shippingLocations[key]+"</option>")
        }
        
    }
    function render_select_division_options () {
        // var string  = "<option>Select Division</option>";
        // if(shippingLocations.legend)
        if (Object.keys(shippingLocations).length > 0 ) {
            var string  = "";
            for ( var key in shippingLocations){
                string  += "<option value="+key+">"+shippingLocations[key]+"</option>"
            }
            return string;
        }
        else return false;
    }
    
</script>
<div class="settings-show">

    <div class="row">

        
        <div class="col-xs-12">
            <legend>Manage Delivery Methods</legend>
        </div>
        <div class="col-xs-12">
            <h4>Ghoori Delivery Partners</h4>
            <div class="row">
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <a href=""><img src="https://chorki.com/images/partners/ecourier.png"></a>
                </div>
            </div>
            @include('settings._partials.shippingChannel')
        </div>

        @if($ownChannel)
        <div class="col-xs-12">
            <h4>Your Own Delivery System</h4>
            {{ Form::model($shop,array('route' => array('ownShippingChannels.updateChannel',$shop->getSlug()),'method'=>'PUT','class'=>'floating-labels')) }}
            {{ Form::token() }}
            <!-- <pre>{{ var_dump($shippingLocationsWithCharges->toArray()) }}</pre> -->
            <table class="table table-hover form-table">
                
                <thead>
                    <tr>
                        <th>
                            Division <a class="btn btn-success btn-circle add-row" href="#"><i class="fa fa-plus"></i></a>
                        </th>
                        <th>
                            Unit Charge (BDT/KG)
                        </th>
                        <th></th>
                    </tr>    
                </thead>
                @if($shippingLocationsWithCharges->count())
                    @foreach($shippingLocationsWithCharges as $shippingLocationWithCharge)
                        <tr>
                            <td>
                                {{ $shippingLocationWithCharge->name }}{{ Form::hidden('shippingLocation_id[]',$shippingLocationWithCharge->id) }}
                                
                            </td>
                            <td>
                                {{ Form::number('unitCost[]', $shippingLocationWithCharge->pivot->unitCost ,array("class"=>" form-control","id"=>"",'placeholder'=>'')) }}
                            </td>
                            <td><a class="btn btn-danger btn-circle remove-row" href="#" data-locid="{{$shippingLocationWithCharge->id}}" data-locname="{{$shippingLocationWithCharge->name}}"><i class="fa fa-times"></i></a></td>
                        </tr>
                    @endforeach
                @endif
                
            </table>
            <a class="btn btn-warning add-row" href="#"><i class="fa fa-plus"></i> Add another division</a>
            <input class="btn btn-success" type="submit" value="Update">
            {{ Form::close() }}
        </div>
        @else
        <div class="col-xs-12">
            {{-- <div class="alert alert-danger" role="alert">
                <i class="fa fa-warning" aria-hidden="true"></i>
                <span class="sr-only">:</span>
                Currently you have no access to this feature
            </div> --}}
        </div>
            
        @endif
    </div>
</div>
<script type="text/javascript">
    var newRow = '<tr>'
                    +'<td>'
                        +'<select class="div_selector form-control" name="shippingLocation_id[]">'
                            +'<option disabled="disabled" selected="selected">Select Division</option>'
                        +'</select>'
                    +'</td>'
                    +'<td>'
                        +'<input class=" form-control" id="" placeholder="" name="unitCost[]" value="" type="number">'
                    +'</td>'
                    +'<td><a class="btn btn-danger btn-circle remove-row" href="#"><i class="fa fa-times"></i></a></td>'
                +'</tr>';
    $(function(){
        // alert("yo");
        $("body").on("click",".remove-row", function(e){
            e.preventDefault();
            $(this).parent().parent().fadeOut(400, function(){
                $(this).remove();
            });
            var removedLoc = $(this).data();
            // console.log(removedLoc);
            shippingLocations[removedLoc.locid] = removedLoc.locname;
            
            // render_select_division();
            
        });

        $("body").on("click",".add-row", function(e){
            e.preventDefault();

            if( ! addRowRender() ) {
                alert("All divisions are already set.");
            }
            // render_select_division();
        });

        function addRowRender() {
            var $newrow = $(newRow);
            var optionsString = render_select_division_options();
            if (optionsString) {
                var $options = $(optionsString);

                $newrow.find('select').append( $options );

                $('.form-table').append($newrow);
                return true;
            }
            else {

                return false;
            }
            
        }

        // addRowRender();
    });
    
</script>