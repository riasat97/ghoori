<div class="modal fade" id="previous-due-list">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Previous Dues</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    @if(count($dueBillCycleList))
                        <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>From Date</th>
                                <th>Till Date</th>
                                <th>Previous Due</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dueBillCycleList as $dueBillCycle)
                                <tr>
                                    <td>{{ $dueBillCycle['dateRange']['start']->addHours(6)->toDayDateTimeString()}}</td>
                                    <td>{{ $dueBillCycle['dateRange']['end']->addHours(6)->toDayDateTimeString() }}</td>
                                    <td> {{ $dueBillCycle['due'].' BDT'}}</td>
                                    <td>
                                        <a  href="{{$dueBillCycle['link']}}" target="_blank" class="btn btn-xs btn-info "><i class="fa fa-table"></i> Details</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-gayeb">
                                <td>Total Previous Due till Date</td>
                                <td></td>
                                <td>{{ number_format($previousDue,2) }} BDT</td>
                                <td style="border-right : 1px solid #ddd !important;" ></td>
                            </tr>
                            </tbody>
                        </table>
                        @include('orders._partials.orderDetailPopUp')

                    @else
                        <p>No records found.</p>
                    @endif

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->