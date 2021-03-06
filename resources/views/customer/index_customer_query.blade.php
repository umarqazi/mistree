@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

@include('partials.header')

<div class="content">           
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    @if (session('success_message'))
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-success">
                                    {{ session('success_message') }}
                                </div>
                        </div>
                    </div>
                    @endif
                    @if (session('error_message'))
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{ session('error_message') }}
                                </div>
                        </div>
                    </div>
                    @endif
                    <div class="header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title">Customer Queries</h4>
                                <p class="category">List of all customers queries.</p>
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info" style="padding: 10px;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-sort="ascending">Email</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Customer Name</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Customer Number</th>
                                    <th class="text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Subject</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Recieved at</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Resolved at</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Status</th>
                                    <th class="text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customerQueries as $key => $value)    
                                <tr role="row" class="odd">
                                    <td class="text-center sorting_1">@if(!is_null($value->customer)){{ $value->customer->email }}@endif</td>
                                    <td class="text-center">@if(!is_null($value->customer)){{ $value->customer->name }}@endif</td>
                                    <td class="text-center">@if(!is_null($value->customer)){{ $value->customer->con_number }}@endif</td>
                                    <td class="text-center">{{ $value->subject }}</td>
                                    <td class="text-center">{{ $value->created_at }}</td>
                                    <td class="text-center">@if($value->is_resolved){{ $value->updated_at }}@endif</td>
                                    <td class="text-center">@if($value->is_resolved)<i class="ti-check"></i>@else Open @endif</td>
                                    <td class="text-center">
                                        <form method="POST" id="resolve_customer_query_{{ $value->id }}" action="{{url('admin/resolve-customer-query/'. $value->id)}}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>

                                        <a class= "mistri-icons ti-eye" href="{{url('admin/customer-queries/'. $value->id)}}" data-toggle="tooltip" data-placement="top" title="View"></a>
                                        @if(!$value->is_resolved)
                                            <button class="mistri-icons block_button" data-toggle="tooltip" data-placement="top" title="Resolve Customer Query" value="submit" type="submit" form="resolve_customer_query_{{ $value->id }}"><i class="ti-check"></i></button>
                                        @endif

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