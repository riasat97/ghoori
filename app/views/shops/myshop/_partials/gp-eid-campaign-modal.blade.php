{{Form::open(array('route'=>['gp.sep.15',$shop->slug],'class'=>'form-horizontal'))}}
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
                        <label>Select your convenient discount for Grameenphone Eid Campaign.</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="radio radio-inline">
                            <label>
                                <input name="discount" type="radio" value="1" required>10% Discount
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