@extends('layouts.master')
@section('title', 'Customers')
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
                                <h4 class="title">Customers</h4>
                                <p class="category">List of all customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Customer ID: activate to sort column descending" style="width: 77px;">ID</th
                                        >
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 164px;">Name</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending" style="width: 210px;">Email</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Contact: activate to sort column ascending" style="width: 156px;">Contact No.</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Car: activate to sort column ascending" style="width: 114px;">Car Name</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 107px;">Vehicle No.</th>
                                </tr>
                            </thead>
                            <tbody>   
                            @foreach($bookings as $key => $booking)                          
                            <tr role="row" class="odd">
                                    <td class="text-center">{{$key + 1}}</td>
                                    <td class="text-center">{{$booking->customer->name}}</td>
                                    <td class="text-center">{{$booking->customer->email}}</td>
                                    <td class="text-center">{{$booking->customer->con_number}}</td>
                                    <td class="text-center">{{$booking->car->make}}-{{$booking->car->model}}</td>
                                    <td class="text-center">{{$booking->vehicle_no}}</td> 
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