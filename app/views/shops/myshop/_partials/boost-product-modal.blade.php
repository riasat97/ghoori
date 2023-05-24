<span class="get-occupied-dates-url" hidden="hidden" data-url="{{URL::route('get-occupied-dates')}}"></span>

<div class="modal fade" id="boostProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            {{Form::open(array('route'=>'test-post','id'=>'boost-product-form'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Boost Reach For <span class="productnamespan"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="position" class="control-label">Position</label>
                                <select name="position" class="form-control boost-position">
                                    <option value="" selected disabled="disabled">Select</option>
                                    <option data-height="550" data-width="480" value="large_ad">Large (480 x 550)</option>
                                    <option data-height="255" data-width="380" value="medium_ad">Medium (380 x 255)</option>
                                    <option data-height="195" data-width="180" value="small_ad">Small (180 x 195)</option>
                                </select>

                            </div>
                            <div class="form-group col-sm-6">
                                <label for="group" class="control-label">Group</label>
                                <select name="group" class="form-control boost-group">
                                    <option value="" selected disabled="disabled">Select</option>
                                    <option value="for_her">For her</option>
                                    <option value="for_him">For him</option>
                                    <option value="for_kids">For kids</option>
                                    <option value="gadgets">Gadgets</option>
                                    <option value="home_and_decor">Home and decor</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="title" class="control-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" autocomplete="off" required>
                            </div>
                            <div class="form-group col-xs-12 boost-subtitle">
                                <label for="subtitle" class="control-label">Subtitle</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle" autocomplete="off">
                            </div>
                            <div class="form-group col-xs-12 boost-short-description">
                                <label for="short-description" class="control-label">Short Description</label>
                                <textarea class="form-control" id="short-description" name="short-description" autocomplete="off"></textarea>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="dates" class="control-label">Select Ad Slots</label>
                                <input class="boost-dates form-control" name="boost_dates" type="hidden" required>
                                <div class="boost-dates-picker"></div>
                            </div>
                            
                        </div>
                        <div class="boost-cost">
                            <table class="table">
                                <tr>
                                    <th>Per day charge &times; </th>
                                    <th>Days = </th>
                                    <th>Subtotal</th>
                                </tr>
                                <tr>
                                    <td><span class="perdaycharge">0</span> BDT</td>
                                    <td><span class="days">0</span></td>
                                    <td><span class="totalwovat">0</span> BDT</td>
                                </tr>                                
                                <tr>
                                    <th colspan="2">Total (with 4.5% VAT)</th>
                                    <td><span class="totalwvat">0</span> BDT</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <style>
                                        .cropit-image-preview {
                                            /* You can specify preview size in CSS */
                                            height: 195px;
                                            width: 180px;
                                            border: 1px dashed #aaa;
                                        }
                                        input.cropit-image-input {
                                            visibility: hidden;
                                        }
                                        .cropit-image-preview{
                                            margin: 0 auto;
                                            cursor:move;
                                        }
                                        .cropit-image-zoom-input {
                                            margin-top: 15px;
                                        }
                                    </style>
                                    <div id="image-cropper">
                                        <div class="cropit-image-preview-container">
                                            <div class="cropit-image-preview"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="range" class="cropit-image-zoom-input" />
                                        </div>
                                        <input type="file" class="cropit-image-input" />
                                        <input class="boost-item-image-input form-control" name="image" type="hidden"/>
                                        <div class="text-center">
                                            <div class="btn btn-info boost-item-image-btn">Upload another image</div>
                                            <div class="checkbox">
                                                <label>
                                                  <input id="boost-tnc" name="boost_tnc" type="checkbox" value="tnc" required> I accept <a href="{{route('store.getTerms')}}" target="_blank">Terms &amp; Condtions</a>
                                                </label>
                                                
                                            </div>
                                        </div>                                        
                                    </div><!--image cropper-->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success boost-submit">Boost</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

<div style="display: none">
    <input id="boost-rate-large" value="{{Config::get('boost.large_ad')}}">
    <input id="boost-rate-medium" value="{{Config::get('boost.medium_ad')}}">
    <input id="boost-rate-small" value="{{Config::get('boost.small_ad')}}">
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
                <button type="button" data-dismiss="modal" aria-label="Confirm Later" class="btn btn-default"><span aria-hidden="true">Confirm Later</span></button>
                <a type="submit" href="{{ route('settings.edit', $shop->slug) }}#boost" class="btn btn-success">Confirm Now</a>
            </div>            
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var vatPercent = 4.5;

        function updateCost(){
            var numberOfDates = $('.boost-dates-picker').datepicker('getDates').length;
            var boostPosition = $('.boost-position').val();
            var rate = 0;
            switch(boostPosition){
                case 'large_ad':
                    rate = $('#boost-rate-large').val();
                    break;
                case 'medium_ad':
                    rate = $('#boost-rate-medium').val();
                    break;
                case 'small_ad':
                    rate = $('#boost-rate-small').val();
                    break;
            }

            var totalwovat = numberOfDates*rate;
            var totalvat = ( (totalwovat * vatPercent) / 100).toFixed(2);
            var totalwvat = parseFloat(totalwovat) + parseFloat(totalvat);

            $('.boost-cost span.totalwovat').html(totalwovat);
            $('.boost-cost span.days').html(numberOfDates);
            $('.boost-cost span.perdaycharge').html(rate);
            $('.boost-cost span.totalwvat').html(Math.ceil(totalwvat));
        }

        if ( $.isFunction($.fn.cropit) ) {
            $('#image-cropper').cropit({
                imageBackground: false,
                smallImage: 'allow'
            });
        }

        function updateBoostDates(disabledDates){
            var oldInput = $('.boost-dates-picker').datepicker('getFormattedDate');
            var oldDates = oldInput.split(';');
            var newDates = oldDates.filter(function(x) { return disabledDates.indexOf(x) < 0 });
            $('.boost-dates-picker').datepicker('setDatesDisabled', disabledDates);
            $('.boost-dates-picker').datepicker('setDates',newDates);
            $('.boost-dates').val(
                    $('.boost-dates-picker').datepicker('getFormattedDate')
            );
        }

        $('.boost-item-image-btn').click(function() {
            $('.cropit-image-input').click();
        })

        $(document).on('click', '.boost-product-nav', function(){
            $('#boostProductModal').find('.form-control').val(null).end();

            $('.boost-subtitle').hide().addClass('.ignore');
            $('.boost-short-description').hide().addClass('.ignore');
            $('.boost-submit').attr("disabled", true);

            $('#boostProductModal .productnamespan').text($(this).data('productname'));

            var submitUrl = $(this).data('submit-url');
            $('#boost-product-form').attr('action',submitUrl);
            var image = $(this).data('product-image');


            $('#image-cropper').cropit('previewSize', { width: 180, height: 195 });
            $('#image-cropper').cropit('imageSrc',image);


            $('.boost-dates-picker').datepicker({
                multidate: true,
                format: 'yyyy-mm-dd',
                multidateSeparator: ';',
                clearBtn: true,
                startDate: '{{date("Y-m-d", strtotime('+18 hours') )}}'
            });
            $('.boost-dates-picker').datepicker('clearDates');
            $('.boost-dates-picker').on("changeDate", function() {
                $('.boost-dates').val(
                        $('.boost-dates-picker').datepicker('getFormattedDate')
                );
                updateCost();
            });
        })

        $('.boost-position').change(function(){
            var selected = $(this).find(':selected');
            var width = selected.data('width');
            var height = selected.data('height');
            $('#image-cropper').cropit('previewSize', { width: width, height: height });
            $('#image-cropper').cropit('minZoom', 'fit');
            switch ($(this).val()){
                case 'small_ad':
                    $('.boost-subtitle').show().removeClass('.ignore');
                    $('.boost-short-description').hide().addClass('.ignore');
                    break;
                case 'large_ad':
                    $('.boost-subtitle').hide().addClass('.ignore');
                    $('.boost-short-description').show().removeClass('.ignore');
                    break;
                default:
                    $('.boost-subtitle').hide().addClass('.ignore');
                    $('.boost-short-description').hide().addClass('.ignore');
                    break;
            }
            updateCost();
        })

        $('.boost-position , .boost-group').change(function(){
            $('.boost-submit').attr("disabled", true);
            var boostPosition = $('.boost-position').val();
            var boostGroup = $('.boost-group').val();
            if((!boostPosition)||(!boostGroup)){
                return;
            }

            var token = $('#fbForm input[name="_token"]').val();
            var url = $('.get-occupied-dates-url').data('url');

            var data = {
                _token: token,
                position: boostPosition,
                group: boostGroup
            };

            var success = function(response){
                updateBoostDates(response.occupiedDates);
                $('.boost-submit').attr("disabled", false);
            };

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: success,
                dataType: 'json'
            });
        })//$('.boost-position , .boost-group').change
        /*$('.boost-submit').on('click', function (e){
            // e.preventDefault();
            // console.log('not blocked')
        });*/
        function submitBoostedProduct(form){
            // form.preventDefault();
            var dateCount = $('.boost-dates').val().split(';').length;
            // console.log(dateCount);
            // alert();
            var boostPosition = $('.boost-position').val();
            var boostCarge = 0;
            var freefor = 0;
            // return false;
            var vatPercent = 4.5;
            if (dateCount > freefor) {
                switch(boostPosition) {
                    case 'large_ad':
                        boostCarge = Math.ceil( (dateCount - freefor) * {{$boost_charges['large_ad']}} * ( (100 + vatPercent ) / 100 ) )
                        break;
                    case 'medium_ad':
                        boostCarge = Math.ceil( (dateCount - freefor) * {{$boost_charges['medium_ad']}} * ( (100 + vatPercent ) / 100 ) )
                        break;
                    case 'small_ad':
                        boostCarge = Math.ceil( (dateCount - freefor) * {{$boost_charges['small_ad']}} * ( (100 + vatPercent ) / 100 ) )
                        break;
                    default:
                        break;
                }

            };


            $('.boost-submit').html('<i class="fa fa-spin fa-spinner"></i> Processing').prop('disabled', true);
            var img_data = $('#image-cropper').cropit('export', {
                type: 'image/jpeg',
                quality: .5
            });
            $('.boost-item-image-input').val(img_data);

            var url = $(form).attr('action');
            var data = $(form).serialize();
            var success = function(response){
                if(response.status == 'success'){

                    var showBkashInstructions = function() {
                        $('#bkash_instruction').modal('show');
                        $('#boostProductModal').off('hidden.bs.modal', showBkashInstructions);
                    }

                    $('#boostProductModal').on('hidden.bs.modal', showBkashInstructions);

                    if (dateCount > freefor) {
                        var $bkash_instruction = $('#bkash_instruction');
                        $bkash_instruction.find('.amount').text(boostCarge);
                        $bkash_instruction.find('.counternumber').text(5);
                        $bkash_instruction.find('.refnumber').text({{$shop->id}});
                        
                        $('#boostProductModal').modal('hide');                        

                    }
                    else {
                        bootbox.dialog({
                          title: "Thanks!",
                          message: '<p class="text-center text-success"><i class="fa fa-3x fa-check-circle"></i></p><p class="text-center">Within 24 hours you will be notified and the boost will be started.</p>',
                          backdrop: true,
                          buttons: {
                            success: {
                              label: "Ok",
                              className: "btn-success",
                              callback: function() {
                                return true;
                              }
                            }
                          }
                        });
                    }
                }else{
                    if(response.occupied){
                        updateBoostDates(response.occupied);
                    }
                    alert(response.message);
                }

                    $('.boost-submit').html('Boost').prop('disabled', false);
            };

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: success,
                dataType: 'json'
            });
        }
        $('#boost-product-form').validate({
            ignore: ['.ignore'],
            submitHandler: submitBoostedProduct,
            rules: {
                boost_dates: {
                    required: true
                },
                position: {
                    required:true
                },
                group: {
                    required:true
                }
            },
            messages: {
                boost_dates: "Please select at least one day for boosting"
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },            
            errorElement: 'span',
            errorClass: 'help-block error',
            errorPlacement: function(error, element) {
                    if(element.parent('label').length) {
                        error.insertAfter(element.parent());
                    }
                    else {
                        error.insertAfter(element);
                    }
                }
        });
    })
</script>