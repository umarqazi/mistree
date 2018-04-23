@extends('layouts.master')
@section('title', 'Active Bookings')
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
                                    <h4 class="title">Top-Up Details</h4>
                                    <p class="category">List of all workshop Top-Ups.</p>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        </div>

                        @if(count($transactions))
                            <div class="content table-responsive table-full-width">
                                <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                                    <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Workshop ID</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Workshop Name</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Top-Up Amount</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Time</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $transaction)
                                                <tr role="row" class="odd">
                                                    <td class="text-center">@if(!is_null($transaction->workshop)){{$transaction->workshop->workshopId}} @endif</td>
                                                    <td class="text-center">@if(!is_null($transaction->workshop)){{$transaction->workshop->name }} @endif</td>
                                                    <td class="text-center">{{ $transaction->amount }}</td>
                                                    <td class="text-center">{{\Carbon\Carbon::parse( $transaction->created_at)->format('g:i A')}}</td>
                                                    <td class="text-center">{{\Carbon\Carbon::parse( $transaction->created_at)->format('d M, Y')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="clear20"></div>
                            <div class="clear20"></div>
                            <div>
                                <p>No Top-Ups found yet</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>
    </div>








    @include('partials.footer')
@endsection