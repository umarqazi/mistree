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
                            <div class="col-md-10">
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
                                
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 184px;">Name</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Area: activate to sort column ascending" style="width: 120px;">Area / Town</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending" style="width: 150px;">Email</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Contact: activate to sort column ascending" style="width: 100px;">Contact No.</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Car: activate to sort column ascending" style="width: 114px;">Car Name</th>
                                    <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 107px;">Vehicle No.</th>
                                </tr>
                            </thead>
                            <tbody>   
                            @foreach($customers as $key => $customer)
                            <tr role="row" class="odd">
                                    <td class="text-center">{{$customer->name}}</td>
                                    <td class="text-center">{{@implode("\n", $customer->addresses->pluck('town')->toArray())}}</td>
                                    <td class="text-center">{{$customer->email}}</td>
                                    <td class="text-center">{{$customer->con_number}}</td>
                                    <td class="text-center">                                        
                                        {{@implode(', ', $customer->cars->pluck('model')->toArray())}}                                        
                                    </td>
                                    <td class="text-center">                                        
                                        {{@implode(', ', $customer->cars->pluck('vehicle_no')->toArray())}}
                                    </td> 
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