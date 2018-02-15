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
                                        540
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="#"><i class="ti-angle-right"></i> VIEW DETAILS</a>
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
                                        <p>HISTORY</p>
                                        39
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="#"><i class="ti-angle-right"></i> VIEW DETAILS</a>
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
                                    <div class="icon-big icon-danger text-center">
                                        <i class="ti-comment-alt"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>REQUESTS</p>
                                        04
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="#"><i class="ti-angle-right"></i> VIEW DETAILS</a>
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
                                        <p>ACTIVE LEADS</p>
                                        87
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="#"><i class="ti-angle-right"></i> VIEW DETAILS</a>
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
                                        <i class="ti-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="numbers">
                                        <p>WORKSHOP CAMPAIGNS</p>
                                        10
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                    <a href="#"><i class="ti-angle-right"></i> VIEW DETAILS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>  
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Caption 1</h4>
                            <p class="category">Small caption</p>
                        </div>
                        <div class="content">

                            <h3>Some Caption</h3>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime minima ipsam repudiandae cum, dolor dolorem doloribus. Quis odit iusto voluptatem totam atque amet, numquam, odio officiis in quia asperiores iste accusamus accusantium rem ut magni quas rerum minima aspernatur. Natus cumque officiis autem nulla, quis eius magnam tempore minus blanditiis sequi voluptatum ut totam! Sunt beatae dolorem obcaecati nemo accusantium molestiae explicabo aspernatur quis, autem quam deserunt officiis expedita fugiat esse, et error dolores. Quibusdam reprehenderit nesciunt quo voluptatum inventore iusto quis enim, tenetur, in veniam vel blanditiis voluptas repellendus fuga ullam! Quos debitis consectetur, nostrum voluptatibus beatae at porro.</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@include('partials.footer')
@endsection
