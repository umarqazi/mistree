@extends('layouts.master')
@section('title', 'Workshop Details')
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
                                <h4 class="title">Workshop Name : {{$workshop->name}}</h4>
                                <h5 class="title">Owner Name : {{$workshop->owner_name}}</h5>
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
                         
                            <div class="col-sm-6 col-sm-offset-6 balance-info">
                              
                                <div class="clear10"></div><div class="clear5"></div>
                                <div class="text-right">
                                	<a href="{{url('admin/workshops/'.$workshop->id.'/edit')}}" class="btn btn-header btn-export">Edit Workshop</a>
                                	<a href="{{ url('admin/workshops/create') }}" class="btn btn-header btn-export">Add Services</a>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="content">
					    <div class="container-fluid">
					        <div class="row">
					            <div class="col-md-12">
					            	<div class="table-responsive">
										<table class="table table-striped dataTable table-bordered no-footer" role="grid" style="padding: 10px;">          	         
											<thead>
												<tr>
													<th>Workshop Details</th>
													<th></th>
													<th></th>
													<th></th>
												</tr>
											</thead>
						                    <tbody>
						                        <tr> 
						                        	<td>Workshop Name</td>
						                        	<td>{{ $workshop->name }}</td>
						                        	<td>Owner Name</td>
						                        	<td>{{ $workshop->owner_name}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>Email</td>
						                        	<td>{{$workshop->email}}</td>
						                        	<td>Type</td>
						                        	<td>{{ $workshop->type}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>CNIC Card Number</td>
						                        	<td>{{$workshop->card_number}}</td>
						                        	<td>Contact Number</td>
						                        	<td>{{ $workshop->con_number}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>Opening Time</td>
						                        	<td>{{ $workshop->open_time}}</td>
						                        	<td>Closing Time</td>
						                        	<td>{{ $workshop->close_time}}</td>
						                        </tr>  
						                        <tr> 
						                        	<td>Geo Cord</td>
						                        	<td>{{ $workshop->geo_cord}}</td>
						                        	<td>Team Slot</td>
						                        	<td>{{ $workshop->team_slot}}</td>
						                        </tr>                               
						                    </tbody>
						                </table>
					                </div>
					            </div>
					        </div>

					        <div class="row">
					            <div class="col-md-12">
					            	<div class="table-responsive">
										<table class="table table-striped dataTable table-bordered no-footer" role="grid" style="padding: 10px;">          	         
											<thead>
												<tr>
													<th>Address Details</th>
													<th></th>
													<th></th>
													<th></th>
												</tr>
											</thead>
											@php $address = $workshop->address @endphp
						                    <tbody>
						                        <tr> 
						                        	<td>House No</td>
						                        	<td>{{ $address->house_no }}</td>
						                        	<td>Street No</td>
						                        	<td>{{ $address->street_no}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>Town</td>
						                        	<td>{{$address->town}}</td>
						                        	<td>Block</td>
						                        	<td>{{ $address->block}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>Area</td>
						                        	<td>{{$address->area}}</td>
						                        	<td>City</td>
						                        	<td>{{ $address->city}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>Geo Cord</td>
						                        	<td>{{ $address->geo_cord}}</td>
						                        	<td>Type</td>
						                        	<td>{{ $address->type}}</td>
						                        </tr>  	                        
						                    </tbody>
						                </table>
					                </div>
					            </div>
					        </div>

					        <div class="row">
					            <div class="col-md-12">
					            	<div class="table-responsive">
										<table class="table table-striped dataTable table-bordered no-footer" role="grid" style="padding: 10px;">          	         
											<thead>
												<tr>
													<th>Service Name</th>
													<th>Service Rate</th>
													<th>Service Time</th>
													<th>Actions</th>								
												</tr>
											</thead>
											@php 
												$specialty = $workshop->service 							
											@endphp						

						                    <tbody>
						                    	@foreach($specialty as $spec)
						                        <tr> 
						                        	<td>{{ $spec->name }}</td>
						                        	<td>{{ $spec->pivot->service_rate }}</td>
						                        	<td>{{ $spec->pivot->service_time }}</td>	
						                        	<td>						                        	
						                        		<a href="{{url('admin/edit-workshop-service/'.$spec->pivot->id)}}" class="btn btn-header">Edit</a>
                                						<a href="{{ url('admin/workshops/create') }}" class="btn btn-header ">Delete</a>
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
			</div>
		</div>
	</div>
</div>
  
@include('partials.footer')
@endsection