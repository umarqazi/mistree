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
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title">Cars</h4>
                                <p class="category">List of all active cars.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-6 balance-info">
                                <div class="dropdown pull-right">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   + More Options
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ url('admin/cars/create') }}" class="dropdown-buttons">Add New Car</a>
                                        <a href="{{url('admin/inactive-cars')}}" class="dropdown-buttons">Inactive Cars</a>    
                                        <a href="{{url('admin/unpublished/cars')}}" class="dropdown-buttons">Unpublished Cars</a>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="clear20"></div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info" style="padding: 10px;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Car Make: activate to sort column descending" style="width: 77px;">Car Make</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Car Model: activate to sort column ascending" style="width: 142px;">Car Model</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Car Type: activate to sort column ascending" style="width: 130px;">Car Type</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&nbsp;&nbsp;: activate to sort column ascending" style="width: 57px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cars as $key => $value)
                                <tr role="row" class="odd">
                                    <td class="text-center">{{ $value->make }}</td>
                                    <td class="text-center">{{ $value->model }}</td>
                                    <td class="text-center">@if(!is_null($value->category)){{ $value->category->name }}@endif</td>
                                    <td class="text-center">

                                        <form method="POST" id="cars_deactivate_form_{{ $value->id }}" action="cars/{{ $value->id }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        <a href="{{url('admin/cars/'. $value->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Edit" class="mistri-icons ti-pencil-alt"></a>
                                        <button class="mistri-icons block_button" data-toggle="tooltip" data-placement="top" title="Deactivate" value="submit" type="submit" form="cars_deactivate_form_{{ $value->id }}"><i class="ti-power-off"></i></button>
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