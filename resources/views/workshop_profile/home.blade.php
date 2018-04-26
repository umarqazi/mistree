@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
@include('partials.header')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <div class="card custom-card">
                        <div class="content">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="numbers">
                                        <p><a href="{{url('/leads')}}">Revenue</a></p>
                                        PKR {{$revenue}}
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="numbers">
                                        <p><a href="{{url('/ledger')}}">Balance</a></p>
                                        PKR {{$balance}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-12">
                    <div class="card custom-card">
                        <div class="content">
                            <div class="row">
                                <div class="col-sm-1 col-xs-12">
                                    <div class="icon-big icon-success text-center lead-icon">
                                        <i class="ti-view-list-alt"></i>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    <div class="text-center">
                                        <h4 class="lead-text">Leads</h4>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-12 col-sm-offset-1">
                                    <div class="numbers">
                                        <a href="{{url('/leads')}}"><p>Total</p></a>
                                        {{$leads_count}}
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    <div class="numbers">
                                        <a href="{{url('/leads/accepted')}}"><p>Accepted</p></a>
                                        {{$accepted_leads}}
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    <div class="numbers">
                                        <a href="{{url('/leads/completed')}}"><p>Completed</p></a>
                                        {{$completed_leads}}
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                    <div class="numbers">
                                        <a href="{{url('/leads/expired')}}"><p>Expired</p></a>
                                        {{$expired_leads}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                        {{$customer_count}}
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="{{url('/customers')}}"><i class="ti-angle-right"></i> VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

    </div>
@include('partials.footer')
@endsection
