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
                                    <h4 class="title">Expired Leads</h4>
                                    <div class="clear20"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="avtar-block">
                                        @include('partials.workshop_profile_info')
                                        <div class="dropdown pull-right">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                + More Options
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{url('/leads/')}}" class="dropdown-buttons">All Leads</a>
                                                <a href="{{url('/leads/completed')}}" class="dropdown-buttons">Completed Leads</a>
                                                <a href="{{url('/leads/accepted')}}" class="dropdown-buttons">Accepted Leads</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>




                        <div class="content table-responsive table-full-width">
                            <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                                <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 95px;">Job Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 107px;">Vehicle No.</th>
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 153px;">Customer Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 156px;">Services Booked</th>
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Time: activate to sort column ascending" style="width: 114px;">Job Time</th>
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 54px;">Total</th>
                                        <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Rating: activate to sort column ascending" style="width: 69px;">Rating</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expired_leads as $lead)
                                        <tr role="row" class="odd">
                                            <td>{{$lead->job_date}}</td>
                                            <td>{{$lead->vehicle_no}}</td>
                                            <td>{{$lead->customer->name}}</td>
                                            <td>{{@implode(', ', $lead->services->pluck('name')->toArray())}}</td>
                                            <td>{{$lead->job_time}}</td>
                                            <td>{{$lead->billing['amount']}}</td>
                                            <td><i class="ti-star"></i> {{$lead->billing['ratings']}}</td>
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
