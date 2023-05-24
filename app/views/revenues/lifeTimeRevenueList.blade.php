@extends('shops.myshop._layouts.main')
@section('title')
    #LifeTime Orders
@stop
@section('order-css')
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <style type="text/css">
        .alert{
            margin: 15px;
        }
    </style>
    {{HTML::style('css/bootstrap-reset.css')}}
@stop
@section('content')
    <div class="container">
        <div class="row">
            @include('revenues._partials.dateRange',['date'=>$lifeTimeRevenueDate])

            <div class="col-sm-12">
                <h2>LifeTime Orders</h2>
            </div>

            <div class="col-sm-12">
                <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Cycle</th>
                        <th>Total Order</th>
                        <th>Total Receivable</th>
                        <th>Total Payable</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lifeTimeRevenueList as $key=>$lifeTimeRevenues)
                        <tr>
                            <td>{{ $lifeTimeRevenues->CharMonth  }}</td>
                            <td>{{$lifeTimeRevenues->numberOfOrder}}</td>
                            <td>{{$lifeTimeRevenues->totalAmount}}</td>
                            <td>{{ $lifeTimeRevenues->totalCommission }}</td>
                            <td> <a  href="{{ $lifeTimeFilteredOrderListLink[$key] }}" class="btn btn-xs btn-info order-detail">
                                 <i class="fa fa-table"></i> Details</a>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Total Orders</th>
                        <th>Total Receivable</th>
                        <th>Total Payable</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="">{{$lifeTimeRevenue[0]->numberOfOrder}}</td>


                        <td class="">{{$lifeTimeRevenue[0]->totalAmount?$lifeTimeRevenue[0]->totalAmount:'0'}} BDT</td>


                        <td class=""> {{$lifeTimeRevenue[0]->totalCommission?$lifeTimeRevenue[0]->totalCommission:'0'}} BDT</td>
                    </tr>
                    </tbody>
                </table>

            </div>


        </div>


    </div>



@stop
@section('order-js')
    @include('orders._partials.orderJs')

@stop

@section('neworderscount')

@stop