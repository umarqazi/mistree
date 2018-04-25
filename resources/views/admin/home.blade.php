@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
@include('partials.header')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card custom-card dashboard-block">
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
                    <div class="card custom-card dashboard-block">
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
                    <div class="card custom-card dashboard-block">
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
                                       {{ $bookings_active }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{ url( 'admin/booking/active') }}"><i class="ti-angle-right"></i> VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card custom-card dashboard-block">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="icon-big icon-info text-center">
                                        <i class="ti-view-list-alt stack-color"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>TOTAL BOOKINGS</p>
                                        {{ $total_bookings }}
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
                <div class="col-lg-3 col-sm-6">
                    <div class="card custom-card dashboard-block">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="icon-big icon-info text-center">
                                        <i class="ti-view-list-alt stack-color"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>TOTAL TOP-UP</p>
                                        PKR {{ $total_jazzcash }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{ url( 'admin/all-workshops/top-up') }}"><i class="ti-angle-right"></i> VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card custom-card dashboard-block">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="icon-big icon-info text-center">
                                        <i class="ti-view-list-alt stack-color"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>MYSTRI REVENUE</p>
                                        PKR {{ $total_matured_revenue }}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{ url( 'admin/total-revenue') }}"><i class="ti-angle-right"></i> VIEW DETAILS</a>
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
