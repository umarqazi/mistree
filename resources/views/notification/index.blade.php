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
                                <div class="col-md-12">
                                    @if (session('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="title">Services</h4>
                                    <p class="category">List of all services.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-6 balance-info">
                                    <div class="clear10"></div>
                                    <div class="dropdown pull-right">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            + More Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{url('admin/services/create')}}" class="dropdown-buttons">Add New Service</a>
                                            <a href="{{url('admin/service/inactive')}}" class="dropdown-buttons">Inactive Services</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear20"></div>
                        </div>
                        <div class="clear20"></div>
                        <div class="content table-responsive tbl-contained">
                            <div id="jsTable_wrapper" class="dataTables_wrapper">
                                <table class="table table-striped dataTable" id="jsTable" role="grid" aria-describedby="jsTable_info">
                                    <thead>
                                    <th class="text-center sorting" style="width: 358px;" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1">Image</th>
                                    <th class="text-center sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 325px;">Name</th>
                                    <th class="text-center sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 278px;">Parent Service</th>
                                    <th class="text-center sorting">Category</th>
                                    <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1">Doorstep</th>
                                    <th style="width: 286px">Action</th></tr>
                                    </thead>
                                    <tbody>
                                    {{--@foreach($services as $key => $value)
                                        <tr role="row" class="odd">
                                            <td><img src="{{$value->image}}" alt="No_Image_Found" width="100px" height="100px"></td>
                                            <td class="text-center">{{$value->name}}</td>
                                            <td class="text-center">{{$value->parent($value->service_parent)['name']}}</td>
                                            <td class="text-center">@if($value->category){{$value->category->name}}@endif</td>
                                            <td class="text-center">
                                                @if($value->is_doorstep)
                                                    <i class="ti-check"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ URL::to('admin/services/' . $value->id . '/edit') }}" class="btn btn-header btn-export">Edit</a>
                                                <form method="POST" action="services/{{ $value->id }}" accept-charset="UTF-8">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input class="btn btn-header btn-export" type="submit" value="Deactivate">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach--}}
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