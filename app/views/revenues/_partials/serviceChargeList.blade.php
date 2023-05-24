<div class="modal fade" id="service-charge-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Service Charges</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                        <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Services </th>
                                <th>Amount</th>
                                <th>Unpaid</th>
                                <th>Paid</th>
                                <th>Total Service Charge</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Subscription Fee</td>
                                    <td> {{number_format($totalSubscriptionFee['cost'],2) }}</td>
                                    <td>{{ number_format($totalSubscriptionFee['unPaid'],2) }}</td>
                                    <td>{{ number_format($totalSubscriptionFee['paid'],2) }}</td>
                                    <td>{{ number_format($totalSubscriptionFee['unPaid'],2) }}</td>
                                </tr>
                                <tr>
                                    <td> Own Shipping Charge</td>
                                    <td> {{ number_format($ownChannelFee['cost'],2) }}</td>
                                    <td> {{ number_format($ownChannelFee['unPaid'],2) }}</td>
                                    <td>{{ number_format($ownChannelFee['paid'],2) }}</td>
                                    <td>{{ number_format($ownChannelFee['unPaid'],2) }}</td>
                                </tr>
                                <tr>
                                    <td>Facebook Shop Charge</td>
                                    <td>{{ number_format($facebookShopFee['cost'],2) }}</td>
                                    <td>{{ number_format($facebookShopFee['unPaid'],2) }}</td>
                                    <td>{{ number_format($facebookShopFee['paid'],2) }}</td>
                                    <td>{{ number_format($facebookShopFee['unPaid'],2) }}</td>
                                </tr>
                            <tr class="border-gayeb">
                                <td>Total Service Cost</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="border-right : 1px solid #ddd !important;" >{{ number_format($totalServiceCost['unPaid'],2) }} BDT</td>
                            </tr>
                            </tbody>
                        </table>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->