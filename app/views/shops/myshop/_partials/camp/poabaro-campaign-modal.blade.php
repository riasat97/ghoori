{{Form::open(array('route'=>['campaigns.winterIsHere',$shop->slug],'class'=>'form-horizontal'))}}
<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="discountModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="discountModalLabel">Add Discount for <span class="productnamespan"></span> </h4>
            </div>
            <div class="modal-body">
                <input name="product_id" type="hidden" value="">
                <div class="form-group">
                    <div class="col-sm-10">
                        <label>Select your convenient discount for "পোয়া১২" Campaign.</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="radio radio-inline">
                            <label>
                                <input name="discount" type="radio" value="0" required>Off
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="radio radio-inline">
                            <label>
                                <input name="discount" type="radio" value="15" required>15% Discount
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="radio radio-inline">
                            <label>
                                <input name="discount" type="radio" value="20" required>20% Discount
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="radio radio-inline">
                            <label>
                                <input name="discount" type="radio" value="30" required>30% Discount
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="radio radio-inline">
                            <label>
                                <input name="discount" type="radio" value="40" required>40% Discount
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="radio radio-inline">
                            <label>
                                <input name="discount" type="radio" value="50" required>50% Discount
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="submit">Save Discount</button>
            </div>
        </div>
    </div>
</div>
{{Form::close()}}