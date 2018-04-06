@extends('layouts.master')
@section('title', 'Services')
@section('content')

@include('partials.header')

    
<div class="content">           
    <div class="container-fluid">
    @if (session('status'))
    <div class="row">
         <p>{{ session('message') }}</p>
    </div>
    @endif 
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="title">Inactive Services</h4>
                                <p class="category">List of all inactive services.</p>
                            </div>
                            <div class="col-md-2">@include('partials.backbtn_services')</div>
                        </div>
                        <div class="clear20"></div>
                    </div>
                    <div class="clear20"></div>
                    <div class="content table-responsive tbl-contained">
                        <div id="jsTable_wrapper" class="dataTables_wrapper">
                            <table class="table table-striped dataTable" id="jsTable" role="grid" aria-describedby="jsTable_info">
                                <thead>
                                    <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Date: activate to sort column descending" style="width: 178px;">ID</th>
                                    <th class="sorting" style="width: 358px;" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Image</th>
                                    <th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 325px;">Name</th>
                                    <th class="text-center sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 278px;">Parent</th>
                                    <th style="width: 286px">Action</th></tr>
                                </thead>
                            <tbody>
                            @foreach($services as $key => $value)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$value->id}}</td>
                                    <td><img src="{{$value->image}}" alt="No_Image_Found" width="100px" height="100px"></td>
                                    <td>{{$value->name}}</td>
                                    <td class="text-center">@if(!is_null($value->parent)){{$value->parent->name}}@endif</td>
                                    <td>
                                        <form id="reactivate_service" method="POST" action="{{ URL::to('admin/services/restore/'. $value->id) }}" accept-charset="UTF-8">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        <button class="mistri-icons block_button" data-toggle="tooltip" data-placement="top" title="Reactivate" value="submit" type="submit" form="reactivate_service"><i class="ti-plug"></i></button>
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