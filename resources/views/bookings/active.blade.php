@extends('layouts.master')
@section('title', 'Active Bookings')
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
                                <h4 class="title">Active Bookings</h4>
                                <p class="category">List of all active Bookings.</p>
                            </div>
                            <div class="col-md-12">

                                <div class="avtar-block">
                             
                                    <div class="dropdown pull-right booking-types">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       + More Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <form method="POST" id="bookings-dropdown" action="{{ url(
                                            'admin/booking/') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="list_type" value="pending">
                                                <input class="submit_button" type="submit" value="Pending Bookings">
                                            </form>
                                            <form method="POST" action="{{ url( 'admin/booking/') }}" id="bookings-dropdown">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="list_type" value="cancelled">
                                                <input class="submit_button" type="submit" value="Cancelled Bookings">
                                            </form>
                                            <form method="POST" action="{{ url( 'admin/booking/') }}" id = "bookings-dropdown">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="list_type" value="completed">
                                                <input class="submit_button" type="submit" value="Completed Bookings">
                                            </form>
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
                                @foreach($bookings as $booking)                                
                                    <tr role="row" class="odd">                                    
                                        <td>{{$booking->job_date}}</td>
                                        <td>{{$booking->vehicle_no}}</td>
                                        <td>{{$booking->customer->name}}</td>
                                        <td>{{@implode(', ', $booking->services->pluck('name')->toArray())}}</td>
                                        <td>{{$booking->job_time}}</td>
                                        <td>{{$booking->billing['amount']}}</td>
                                        <td><i class="ti-star"></i> {{$booking->billing['ratings']}}</td>
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
