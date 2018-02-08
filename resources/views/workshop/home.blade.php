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
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title">Work History</h4>
                                <p class="category">Here is a subtitle if required.</p>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="pull-right search">
                                    <div class="from-group">
                                        <i class="ti-search"></i>
                                        <input type="text" class="form-control" placeholder="Search by ID, Name, Location">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                            <div class="col-sm-6 profile-detail">
                                <img src="{{asset('img/car-logo2.png')}}" class="company-logo">
                                <h3>ANAM AUTO <a href="#" class="btn btn-header btn-edit">Edit Profile</a></h3>
                                <div class="address">380, Block AA, Township, Lahore</div>
                                <div class="phone">PH: 042 359 284 541</div>
                                <div class="rating">
                                    <span class="stars">
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                    </span>
                                    <span class="points">4.5</span>
                                </div>
                            </div>
                            <div class="col-sm-6 balance-info">
                                <div class="current text-right">Current Balance: PKR 550</div>
                                <div class="total text-right">Total Earnings: PKR 38,700</div>
                                <div class="clear10"></div><div class="clear5"></div>
                                <div class="text-right"><a href="#" class="btn btn-header btn-export">Export</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <div class="content table-responsive table-full-width">
                        <div id="jsTable_wrapper" class="dataTables_wrapper no-footer">
                       <!--  <div class="dataTables_length" id="jsTable_length">
                        <label>Show <select name="jsTable_length" aria-controls="jsTable" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div> -->

                      <!--   <div id="jsTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="jsTable"></label></div> -->
                        <table class="table table-striped dataTable no-footer" id="jsTable" role="grid" aria-describedby="jsTable_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Lead ID: activate to sort column descending" style="width: 77px;">Lead ID</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 95px;">Date</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Vehicle No.: activate to sort column ascending" style="width: 107px;">Vehicle No.</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 153px;">Customer Name</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Services Booked: activate to sort column ascending" style="width: 156px;">Services Booked</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Time: activate to sort column ascending" style="width: 114px;">Time</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 54px;">Total</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="Rating: activate to sort column ascending" style="width: 69px;">Rating</th><th class="sorting" tabindex="0" aria-controls="jsTable" rowspan="1" colspan="1" aria-label="&amp;nbsp;: activate to sort column ascending" style="width: 57px;">&nbsp;</th></tr></thead>
                            <tbody>
                         
                                
                            <tr role="row" class="odd">
                                    <td class="sorting_1">443</td>
                                    <td>15 Nov 2017</td>
                                    <td>LOM-142</td>
                                    <td>Umar Qadir</td>
                                    <td>Tuning, Break Shoes</td>
                                    <td>1:00 to 3:00pm</td>
                                    <td>6700</td>
                                    <td><i class="ti-star"></i> 4.5</td>
                                    <td><a href="#">Details</a></td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1">443</td>
                                    <td>15 Nov 2017</td>
                                    <td>LOM-142</td>
                                    <td>Umar Saif</td>
                                    <td>Tuning, Break Shoes</td>
                                    <td>1:00 to 3:00pm</td>
                                    <td>6700</td>
                                    <td><i class="ti-star"></i> 4.5</td>
                                    <td><a href="#">Details</a></td>
                                </tr><tr role="row" class="odd">
                                    <td class="sorting_1">443</td>
                                    <td>15 Nov 2017</td>
                                    <td>LOM-142</td>
                                    <td>Umar Saif</td>
                                    <td>Tuning, Break Shoes</td>
                                    <td>1:00 to 3:00pm</td>
                                    <td>6700</td>
                                    <td><i class="ti-star"></i> 4.5</td>
                                    <td><a href="#">Details</a></td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1">443</td>
                                    <td>15 Nov 2017</td>
                                    <td>LOM-142</td>
                                    <td>Umar Saif</td>
                                    <td>Tuning, Break Shoes</td>
                                    <td>1:00 to 3:00pm</td>
                                    <td>6700</td>
                                    <td><i class="ti-star"></i> 4.5</td>
                                    <td><a href="#">Details</a></td>
                                </tr><tr role="row" class="odd">
                                    <td class="sorting_1">443</td>
                                    <td>15 Nov 2017</td>
                                    <td>LOM-142</td>
                                    <td>Umar Saif</td>
                                    <td>Tuning, Break Shoes</td>
                                    <td>1:00 to 3:00pm</td>
                                    <td>6700</td>
                                    <td><i class="ti-star"></i> 4.5</td>
                                    <td><a href="#">Details</a></td>
                                </tr><tr role="row" class="even">
                                    <td class="sorting_1">443</td>
                                    <td>15 Nov 2017</td>
                                    <td>LOM-142</td>
                                    <td>Umar Saif</td>
                                    <td>Tuning, Break Shoes</td>
                                    <td>1:00 to 3:00pm</td>
                                    <td>6700</td>
                                    <td><i class="ti-star"></i> 4.5</td>
                                    <td><a href="#">Details</a></td>
                                </tr><tr role="row" class="odd">
                                    <td class="sorting_1">443</td>
                                    <td>15 Nov 2017</td>
                                    <td>LOM-142</td>
                                    <td>Umar Saif</td>
                                    <td>Tuning, Break Shoes</td>
                                    <td>1:00 to 3:00pm</td>
                                    <td>6700</td>
                                    <td><i class="ti-star"></i> 4.5</td>
                                    <td><a href="#">Details</a></td>
                                </tr></tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
@include('partials.footer')
@endsection