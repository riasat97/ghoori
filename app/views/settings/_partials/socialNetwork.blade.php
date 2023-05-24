
<div class="settings-show">
    <div class="row">
        <div class="col-xs-12">
            <legend>Settings <a id="add-shop-social" href="#animatedModalSocial" class="add-shop-social" data-toggle="tooltip" data-placement="left" title="Edit">
                    <i class="fa fa-pencil"></i></a></legend>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td><label for="" class="cd-label">Facebook</label></td>
                    <td><span class="settings-value">@if (!empty($shop->shopSocialNetwork->facebook)) {{ $shop->shopSocialNetwork->facebook }} @endif</span></td>
                    <td><a href="#animatedModalSocial" class="add-shop-social" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a></td>
                </tr>
                
                <tr>
                    <td><label for="" class="cd-label">Twitter</label></td>
                    <td><span class="settings-value">@if (!empty($shop->shopSocialNetwork->twitter)) {{ $shop->shopSocialNetwork->twitter }}  @endif </span></td>
                    <td><a href="#animatedModalSocial" class="add-shop-social" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <tr>
                    <td><label for="" class="cd-label">Youtube</label></td>
                    <td><span class="settings-value">@if (!empty($shop->shopSocialNetwork->youtube)) {{ $shop->shopSocialNetwork->youtube }}  @endif</span></td>
                    <td><a href="#animatedModalSocial" class="add-shop-social" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>