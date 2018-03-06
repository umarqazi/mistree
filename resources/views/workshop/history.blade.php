@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

@include('partials.header')
<div class="content">           
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title">Work History</h4>
                                <p class="category">Here is a subtitle if required.</p>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                            <div class="col-sm-6 profile-detail">
                                <img src="{{asset('img/car-logo2.png')}}" class="company-logo">
                                <h3>ANAM AUTO <a href="#" class="btn btn-header btn-edit">Edit Profile</a></h3>
                                <div class="address">380, Block AA, Township, Lahore</div>
                                <div class="phone">PH: 042 359 284 541</div>
                                <div class="rating">
                                    <span class="stars">
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                    </span>
                                    <span class="points">4.5</span>
                                </div>
                            </div>
                            <div class="col-sm-6 balance-info">
                                <div class="current text-right">Current Balance: PKR 550</div>
                                <div class="total text-right">Total Earnings: PKR 38,700</div>
                                <div class="clear10"></div><div class="clear5"></div>
                                <div class="text-right">
                                <a href="{{ url('leads/accepted') }}" class="btn btn-header btn-export">Accepted Leads</a>
                                <a href="{{ url('leads/rejected') }}" class="btn btn-header btn-export">Rejected Leads</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Lead ID: activate to sort column descending" style="width: 77px;">Lead ID</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 95px;">Date</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 107px;">Vehicle No.</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 153px;">Customer Name</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 156px;">Services Booked</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Time: activate to sort column ascending" style="width: 114px;">Time</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 54px;">Total</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Rating: activate to sort column ascending" style="width: 69px;">Rating</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&amp;nbsp;: activate to sort column ascending" style="width: 57px;">&nbsp;</th></tr></thead>
                            <tbody>

                  @foreach($bookings as $value)                           
                            <tr role="row" class="odd">
                                    <td class="sorting_1">{{$value->id}}</td>
                                    <td>{{$value->job_date}}</td>
                                    <td>{{$value->vehicle_no}}</td>
                                    <td>{{$value->customer->name}}</td>                                    
                                    <td>
                                    @foreach($value->services as $service)
                                        {{$service->name}},
                                    @endforeach
                                    </td>
                                    <td>{{$value->job_time}}</td>
                                    <td>{{$value->billing['amount']}}</td>
                                    <td><i class="ti-star"></i>{{$value->billing['ratings']}}</td>
                                </tr>
                  @endforeach              
                                </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
@include('partials.footer')
@endsection