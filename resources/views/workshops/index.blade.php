@extends('layouts.master')
@section('title', 'Workshops')
@section('content')

@include('partials.header')
        <div class="content">
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Registered Workshops</h4>
                                        <p class="category">Here is a subtitle if required</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="pull-right search">
                                            <div class="from-group">
                                                <i class="ti-search"></i>
                                                <input type="text" class="form-control" placeholder="Search by ID, Name, Location">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear20"></div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>Workshop Name</th>
                                        <th>Owner Name</th>
                                        <th>Area</th>
                                        <th>Balance</th>
                                        <th>Leads</th>
                                        <th>&nbsp;</th>
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
                                        <tr>
                                            <td>1465</td>
                                            <td>Anam Auto</td>
                                            <td>Ali Hassan</td>
                                            <td>Township, LHR</td>
                                            <td>1200</td>
                                            <td>44</td>
                                            <td><a href="#">Details</a></td>
                                        </tr>
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