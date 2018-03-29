@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
@include('partials.header')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-money"></i>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="numbers">
                                        <p><a href="{{url('/leads')}}">Revenue</a></p>
                                        {{$revenue}}
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="numbers">
                                        <p><a href="{{url('/ledger')}}">Balance</a></p>
                                        {{$balance}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-1">
                                    <div class="icon-big icon-success text-center">
                                        <i class="ti-view-list-alt"></i>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="text-center">
                                        <h4 class="lead-text">Leads</h4>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-xs-offset-1">
                                    <div class="numbers">
                                        <a href="{{url('/leads')}}"><p>Received</p></a>
                                        {{$leads_count}}
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="numbers">
                                        <a href="{{url('/leads/accepted')}}"><p>Accepted</p></a>
                                        {{$accepted_leads}}
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <div class="numbers">
                                        <a href="{{url('/leads/completed')}}"><p>Completed</p></a>
                                        {{$completed_leads}}
                                    </div>
                                </div>
                                <div class="col-xs-2">
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
            <div class="clear20"></div>
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
