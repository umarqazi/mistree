@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
@include('partials.header')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="icon-big icon-warning text-center">
                                        <i class="ti-user"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>CUSTOMERS</p>
                                        {{$CustomerCount}}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{ url('admin/customers') }}"><i class="ti-angle-right"></i> VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-view-list-alt"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>WORKSHOPS</p>
                                        {{$WorkshopCount}}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{ url('admin/workshops') }}"><i class="ti-angle-right"></i> VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="icon-big icon-info text-center">
                                        <i class="ti-bar-chart"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>ACTIVE BOOKINGS</p>
                                       {{ $BookingsCount }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{ url( 'admin/booking/') }}"><i class="ti-angle-right"></i> VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            
        </div>          

    </div>
@include('partials.footer')
@endsection
