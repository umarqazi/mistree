@extends('layouts.master')
@section('title', 'Blocked Workshops')
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
                                <h4 class="title">Blocked Workshops</h4>
                                <p class="category">List of all blocked workshops.</p>
                            </div>
                            <div class="col-md-2">@include('partials.backbtn_workshop')</div>
                        </div>
                        <div class="clear20"></div>
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
                                    <td class="text-center">@if(!empty($value->workshopId)){{ $value->workshopId }}@endif</td>
                                    <td class="text-center">{{ $value->name }}</td>
                                    <td class="text-center">{{ $value->owner_name }}</td>
                                    @if($value->address)
                                    <td class="text-center">{{ $value->address->town }}</td>
                                    @else
                                    <td class="text-center"></td>
                                    @endif
                                    <td class="text-center">@if(!empty($value->balance)){{ $value->balance['balance'] }}@endif</td>
                                    <td class="text-center">{{ $value->bookings->count() }}</td>
                                    <td class="text-center">
                                        @if($value->is_approved == 0)
                                            Not Approved
                                        @else
                                            Approved
                                        @endif</a> 
                                    </td>                                   
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/workshops/' . $value->id . '/unblock') }}" data-toggle="tooltip" data-placement="top" title="Unblock" class=" mistri-icons ti-hand-stop"></a>
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