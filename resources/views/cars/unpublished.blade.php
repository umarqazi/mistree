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
                            <div class="col-md-10">
                                <h4 class="title">Unpublished Cars</h4>
                                <p class="category">List of all unpublished cars.</p>
                            </div>
                            <div class="col-md-2">
                                @include('partials.backbtn_cars')
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
                                        <a href="{{url('admin/cars/'. $value->id.'/edit')}}" class="btn btn-header btn-export">Edit</a>
                                        <form method="POST" action="{{ url('admin/car/publish/') }}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="PATCH">                                             
                                            <input type="hidden" name="car_id" value="{{$value->id }}"> 
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                            <button type="submit" class="btn btn-header btn-export">Publish</button>
                                        </form>
                                        <form method="POST" action="{{url('admin/car/'.$value->id)}}" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                            <button type="submit" class="btn btn-header btn-export">Delete</button>
                                        </form>
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