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
                                <h4 class="title">Pending Workshops</h4>
                                <p class="category">List of all pending workshops.</p>
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
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 130px;">Workshop Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 142px;">Owner Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 207px;">Area</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&amp;nbsp;: activate to sort column ascending" style="width: 57px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workshops as $key => $value)    
                                <tr role="row" class="odd">
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->owner_name }}</td>
                                    @if($value->address)
                                    <td>{{ $value->address->town }}</td>
                                    @else
                                    <td></td>
                                    @endif                                   
                                    <td>
                                    <a href="{{ URL::to('admin/workshops/' . $value->id) }}" class="ti-eye"></a>
                                    <a href="{{ URL::to('admin/workshops/' . $value->id . '/approve') }}" class="ti-check"></a>
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