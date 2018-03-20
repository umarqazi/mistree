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
                                <h4 class="title">Customers</h4>
                                <p class="category">List of blocked cutomers.</p>
                            </div>
                        </div>
                        <div class="row">
                         
                            <div class="col-sm-6 col-sm-offset-6 balance-info">
                              
                                <div class="clear10"></div><div class="clear5"></div>
                                <div class="text-right"><a href="{{ url('admin/customers') }}" class="btn btn-header btn-export">Active Customers</a></div>
                            </div>
                        </div>                        
                    </div>
                    <div class="clear20"></div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                            <thead>
                                <tr role="row">                                    
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 150px;">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 156px;">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 153px;">Contact No.</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 107px;">Loyalty Points</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 107px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($customers as $key => $value)
                                 <tr role="row" class="odd">                                    
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->con_number }}</td>                                    
                                    <td>{{ $value->loyalty_points }}</td>  
                                    <td>
                                        <form method="POST" id="customer_unblock_form" action="{{ url('admin/customers/'.$value->id.'/unblock') }}" accept-charset="UTF-8">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        <button class="mistri-icons block_button" data-toggle="tooltip" data-placement="top" title="Unblock" value="submit" type="submit" form="customer_unblock_form"><i class="ti-hand-stop"></i></button>
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