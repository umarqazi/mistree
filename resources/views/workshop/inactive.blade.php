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
                                <h4 class="title">Registered Workshops</h4>
                                <p class="category">List of all blocked workshops.</p>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                         
                            <div class="col-sm-6 col-sm-offset-6 balance-info">
                                <div class="clear10"></div><div class="clear5"></div>
                                <div class="text-right"><a href="{{ url('admin/workshops/') }}" class="btn btn-header btn-export">Active Workshops</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info" style="padding: 10px;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Lead ID: activate to sort column descending" style="width: 77px;">ID</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 130px;">Workshop Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 142px;">Owner Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 207px;">Area</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 156px;">Balance</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Time: activate to sort column ascending" style="width: 114px;">Leads</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&amp;nbsp;: activate to sort column ascending" style="width: 57px;">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&amp;nbsp;: activate to sort column ascending" style="width: 57px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workshops as $key => $value)    
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->owner_name }}</td>
                                    @if($value->address)
                                    <td>{{ $value->address->town }}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td>{{23*($key+1) }}</td>
                                    <td>{{ 2*($key+1) }}</td>
                                    <td>
                                        @if($value->is_approved == 0)
                                            Not Approved
                                        @else
                                            Approved
                                        @endif</a> 
                                    </td>                                   
                                    <td>
                                    <a href="{{ URL::to('admin/workshops/' . $value->id . '/unblock') }}" class="btn btn-header btn-export">Unblock</a>
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