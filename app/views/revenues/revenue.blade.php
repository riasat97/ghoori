@extends('shops.myshop._layouts.main')
@section('title')
Revenues | {{$shop->title}}
@stop
@section('order-css')
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">

    {{-- {{HTML::style('css/bootstrap-reset.css')}} --}}

@stop
@section('content')
    {{--{{ dd(Session::get('hel')) }}--}}
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                    <h2>Revenue</h2>
                    @include('revenues._partials.search', array('routeName'=>'revenue.index','slug'=>$shop->slug))

                <a href="{{ $invoiceDownloadLink }}" target="_blank" class="pdf-download btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-save"></span> Download PDF</a>
            </div>
            <div class="col-xs-12 col-sm-8">
                    <div class="row">

                           @include('revenues._partials.dateRange')
                            <div class="col-sm-6">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        
                                            <h3 class="panel-title pull-left" >Receivable Information</h3>
                                             <a class="pull-right btn btn-xs btn-info" href="{{ $netSalesDetailsLink }}"  target="_blank">
                                                 Details <i class="fa fa-chevron-right "></i>
                                             </a>
                                             <div class="clearfix"></div>

                                    </div>
                                    <div class="panel-body">
                                        <span class="big-text">{{ number_format($netSales,2) }}</span> BDT
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">

                                            <h3 class="panel-title pull-left" >Payable to Ghoori</h3>
                                           {{--  <a class="pull-right" href="{{ $filteredOrderListLink }}">Details <i class="fa fa-chevron-right "></i></a>--}}
                                             <div class="clearfix"></div>

                                    </div>
                                    <div class="panel-body">
                                        <span class="big-text">{{number_format($totalPayable,2)}}</span> BDT
                                    </div>
                                </div>

                            </div>
                           <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <h3 class="panel-title pull-left" >{{ $total['finalStatus'] }}</h3>
                                  {{--  <a class="pull-right" href="{{ $filteredOrderListLink }}">Details <i class="fa fa-chevron-right "></i></a>--}}
                                    <div class="clearfix"></div>

                                </div>
                                <div class="panel-body">
                                    <span class="big-text">{{ number_format($total['total'],2) }}</span> BDT
                                </div>
                            </div>

                           </div>

                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        
                                            <h3 class="panel-title pull-left" >Receivable Information</h3>
                                              <a class="pull-right btn btn-xs btn-info" href="{{ $netSalesDetailsLink }}"  target="_blank">
                                                  Details
                                              <i class="fa fa-chevron-right "></i>
                                              </a>
                                             <div class="clearfix"></div>

                                    </div>
                                    <table class="table">
                                            <tr>
                                                <th>Total Sales</th>
                                              <td class="text-right">{{number_format($totalSales,2)}} BDT</td>
                                            </tr>
                                            <tr>
                                                <th>Total Delivery/Shipping Charge(Own Channel Delivery)</th>
                                                <td class="text-right">{{ ($totalOwnShippingCharge->totalOwnChannelCharge)?
                                                  number_format($totalOwnShippingCharge->totalOwnChannelCharge,2):'0.00'}} BDT</td>
                                            </tr>
                                            <tr>
                                                <th>Total  Revenue</th>
                                                <td class="text-right">{{ number_format($totalMerChantRevenue,2)}} BDT</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2"><h4>Revenue Received</h4></th>
                                            </tr>
                                            <tr>
                                                <th> From Own Channel </th>
                                                <td class="text-right">{{number_format($totalPaymentReceivedFromOwnChannel,2)
                                                    }} BDT</td>
                                            </tr>
                                            <tr>
                                                <th> From Ghoori Courier</th>
                                                <td class="text-right">{{number_format($totalPaymentReceivedFromGhoori,2)
                                                        }} BDT</td>
                                            </tr>
                                            <tr>
                                                <th> Revenue Received</th>
                                                <td class="text-right">{{number_format($totalRevenueReceived,2)
                                                            }} BDT</td>
                                            </tr>
                                           <tr>
                                               <th>Receivable From Ghoori </th>
                                               <td class="text-right">{{ number_format($netSales,2) }} BDT</td>
                                           </tr>

                                        </table>
                                    
                                </div>
                                
                            </div>
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <h3 class="panel-title pull-left" >Payable to  Ghoori</h3>
                                    <div class="clearfix"></div>

                                </div>
                                <table class="table">
                                    <tr>
                                        <th><h4>Transaction Charge
                                        </h4>
                                       </th>
                                        <td> <a class="pull-right btn btn-xs btn-info" href="{{ $transactionChargesLink }}" target="_blank">
                                                Details
                                            <i class="fa fa-chevron-right "></i></a>
                                        </td>
                                    </tr>
                                    <tr><td>Paid</td>
                                        <td class="text-right">{{number_format($totalGhooriCommission['paid'],2)}} BDT</td>
                                    </tr>
                                    <tr>
                                        <td>Unpaid</td>
                                        <td class="text-right">{{ number_format($totalGhooriCommission['unPaid'],2) }} BDT</td>
                                    </tr>
                                    <tr>
                                        <td>Total Transaction Charge</td>
                                        <td class="text-right">{{ number_format($totalGhooriCommission['unPaid'],2) }} BDT</td>
                                    </tr>
                                    <tr>
                                        <th><h4>Service Charge</h4></th>
                                         <td>
                                         <a class="pull-right  see-service-charge  btn btn-xs btn-info" href="#">Details
                                                 <i class="fa fa-chevron-right "></i>
                                         </a>
                                         </td>
                                    </tr>
                                    <tr>
                                        <th>Paid</th>
                                        <td class="text-right">{{ number_format($totalServiceCost['paid'],2) }} BDT</td>
                                    </tr>
                                    <tr>
                                        <th>Unpaid</th>
                                        <td class="text-right">{{ number_format($totalServiceCost['unPaid'],2) }} BDT</td>
                                    </tr>
                                    <tr>
                                        <th><b>Total Service Charge</b></th>
                                        <td class="text-right"> {{ number_format($totalServiceCost['unPaid'],2) }} BDT</td>
                                    </tr>
                                    <tr>
                                        <th><h4>Previous Due
                                        <a href="#" class="btn btn-xs btn-info see-previous-due">Details <i class="fa fa-chevron-right "></i></a></h4>
                                        </th>
                                        <td class="text-right">{{ number_format($previousDue,2) }} BDT</td>
                                    </tr>

                                    <tr>
                                        <th>Total Payable to Ghoori</th>
                                        <td class="text-right">{{ number_format($totalPayable,2) }} BDT</td>
                                    </tr>
                                </table>

                            </div>

                        </div>
                    </div>
                        
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="row">
                    <div class="col-xs-12">
                        <h4>Lifetime</h4>
                    </div>

                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            
                            
                            <table class="table">
                                <tr>
                                    <td>
                                        <h5>Total Order Completed</h5>
                                <h4>{{ $lifeTimeRevenue[0]->numberOfOrder }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>From</h5>
                                <h4>{{ $lifeTimeRevenueDate['start']?$lifeTimeRevenueDate['start']->addHours(6)->toFormattedDateString():'N/A' }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>To</h5> 
                                <h4>{{ $lifeTimeRevenueDate['end']?$lifeTimeRevenueDate['end']->addHours(6)->toFormattedDateString():'N/A' }}</h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('revenues._partials.previousDueList')
    @include('revenues._partials.serviceChargeList')

@stop

@section('order-js')
            <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
            <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
            <script>
                $(document).ready(function() {
                    renderDate();
                    $('#example').dataTable({
                        "order": [],
                        "oLanguage": {
                            "sInfo": "Showing _START_ to _END_ of _TOTAL_ orders",
                            "sInfoEmpty": "Showing 0 to 0 of 0 orders",
                            "sEmptyTable": "No information available"
                        }
                    });
                });

                $('#example').on( 'draw.dt', function () {
                    console.log('draw fired');
                    $(".order-detail").animatedModal({
                        modalTarget:'animatedModalOrderDetails',
                        'color': '#fff'
                    });
                    $(".order-reject").animatedModal({
                        modalTarget:'animatedModalOrderReject',
                        'color': '#fff'
                    });
                } );



                $(document).on('click','.see-previous-due',function(e) {

                    $('#previous-due-list').modal('show');

                });
                $(document).on('click','.see-service-charge',function(e) {

                    $('#service-charge-list').modal('show');

                });

                $(document).on('click','.date-selector',function(e) {

                renderDate();

                });


                function processMonth(value){
                    var integer= parseInt(value);
                    return integer-1;

                }
                function renderDate(){
                    var year=  $('#year').val();
                    var month = processMonth($('#month').val());
                    var dateObject=  moment([year,month]);
                    var lastDay=  dateObject.daysInMonth();
                    var cycle1= '1-15';
                    var cycle2= '16-'+lastDay;
                    if(!isNaN(lastDay)){
                        $('.cycle1').text(cycle1);
                        $('.cycle2').text(cycle2);
                    }
                }

            </script>

@stop
