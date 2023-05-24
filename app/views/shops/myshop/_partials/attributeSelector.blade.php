<div class="modal fade" id="chProductFromAttributeChoose" tabindex="-1" role="dialog" aria-labelledby="chProductFromAttributeChooseLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="chProductFromAttributeChooseLabel">Attributes</h4>
            </div>
            <div class="clear"></div>
            <div class="modal-body">

                <form class="" method="">
                    <ul class="attribute-popup">
                        <li class="div-checkbox-container">
                            <input type="checkbox" name="Color" value="1" />
                            <span class="div-properties btn-click">
                                <img src="{{asset('img/form/color.png')}}">
                            </span>
                            <div class="checkbox-name">Color</div>
                        </li>
                        <li class="div-checkbox-container">
                            <input type="checkbox" name="Size" value="2" />
                            <span class="div-properties btn-click">
                                <img src="{{asset('img/form/size.png')}}">
                            </span>
                            <div class="checkbox-name">Size</div>
                        </li>
                        
                    </ul>
                    <p class="show-result"></p>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="okay-btn">Ok</button>
            </div>
        </div>
    </div>
</div>
