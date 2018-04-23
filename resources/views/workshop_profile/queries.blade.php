@extends('layouts.master')
@section('title', 'Customers')
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
                                    <h4 class="title">Queries</h4>
                                    <p class="category">List of all queries.</p>
                                </div>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <div class="content table-responsive table-full-width">
                            <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                                <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending" >Received at</th>
                                        <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Email: activate to sort column ascending" >Resolved at</th>
                                        <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" >Subject</th>
                                        <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Area: activate to sort column ascending" >Message</th>
                                        <th class="sorting  text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Contact: activate to sort column ascending" >Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($queries as $key => $query)
                                        <tr role="row" class="odd">
                                            <td class="text-center">{{$query->created_at}}</td>
                                            <td class="text-center">@if($query->is_resolved){{$query->updated_at}}@endif</td>
                                            <td class="text-center">{{$query->subject}}</td>
                                            <td class="text-center">{{substr($query->message , 0, 200)}}</td>
                                            <td class="text-center">@if($query->is_resolved)<i class="ti-check"></i>@else Open @endif</td>
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