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
                                    <h4 class="title">Customers</h4>
                                    <p class="category">List of active cutomers.</p>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-6 col-sm-offset-6 balance-info">

                                    <div class="clear10"></div><div class="clear5"></div>
                                    <div class="text-right"><a href="{{ url('admin/blocked-customers') }}" class="btn btn-header btn-export">Blocked Customers</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <div class="content table-responsive table-full-width">
                            <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                                <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 150px;">Name</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Area: activate to sort column ascending" style="width: 150px;">Area / Town</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 156px;">Email</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 153px;">Contact No.</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="jsTable"
                                            rowspan="1" colspan="1" aria-label="Customer Name: activate to sort
                                            column ascending" style="width: 153px;">Total Bookings</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 107px;">Loyalty Points</th>
                                        <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 107px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $key => $value)
                                        <tr role="row" class="odd">
                                            <td class="text-center">{{ $value->name }}</td>
                                            <td class="text-center">{{ $value->addresses[0]['town']}}</td>
                                            <td class="text-center">{{ $value->email }}</td>
                                            <td class="text-center">{{ $value->con_number }}</td>
                                            <td class="text-center">{{ $value->bookings->count() }}</td>
                                            <td class="text-center">{{ $value->loyalty_points }}</td>
                                            <td class="text-center">
                                                <form method="POST" id="customer_block_form_{{ $value->id }}" action="customers/{{ $value->id }}" accept-charset="UTF-8">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                </form>
                                                <a class= "mistri-icons ti-eye" href="{{url('admin/customers/'. $value->id)}}" data-toggle="tooltip" data-placement="top" title="View"></a>
                                                <button class="mistri-icons block_button" data-toggle="tooltip" data-placement="top" title="Block" value="submit" type="submit" form="customer_block_form_{{ $value->id }}"><i class="ti-hand-stop"></i></button>
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