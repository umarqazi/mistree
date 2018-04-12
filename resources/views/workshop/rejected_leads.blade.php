@extends('layouts.master')
@section('title', 'Rejected Leads')
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

                                <div class="avtar-block">
                                    <div class="row">
                                        <div class="col-md-11">@include('partials.workshop_profile_info')</div>
                                        <div class="col-md-1">@include('partials.backbtn_workshop_back')</div>
                                    </div>
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       + More Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ url('admin/workshop/'.$workshop->id.'/history') }}" class="dropdown-buttons">All Leads</a>
                                            <a href="{{url('admin/workshop/'.$workshop->id.'/history/completed-leads')}}" class="dropdown-buttons">Completed Leads</a>
                                            <a href="{{url('admin/workshop/'.$workshop->id.'/history/accepted-leads')}}" class="dropdown-buttons">Accepted Leads</a>
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
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 95px;">Job Date</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 107px;">Vehicle No.</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 153px;">Customer Name</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 156px;">Services Booked</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Time: activate to sort column ascending" style="width: 114px;">Job Time</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 54px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>                            
                                @foreach($leads as $lead)                                
                                <tr role="row" class="odd">                                    
                                    <td class="text-center">{{ \Carbon\Carbon::parse($lead->job_date)->format('d M, Y') }}</td>
                                    <td class="text-center">{{$lead->vehicle_no}}</td>
                                    <td class="text-center">@if(!is_null($lead->customer)){{$lead->customer->name}}@endif</td>
                                    <td class="text-center">@if(count($lead->services)){{@implode(', ', $lead->services->pluck('name')->toArray())}} @endif</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($lead->job_time)->format('g:i A')}}</td>
                                    <td class="text-center">@if(!is_null($lead->billing)){{$lead->billing['amount']}} PKR @endif</td>
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
