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
								<div>
									<img src="{{$workshop->profile_pic}}" alt="workshop_logo" width="100px" width="90px" style="padding-top:20px;"> 
								</div>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                         
                            <div class="col-sm-6 col-sm-offset-6 balance-info">
                              
                                <div class="clear10"></div><div class="clear5"></div>
                                <div class="text-right">
                                	<a href="{{url('admin/workshops/'.$workshop->id.'/edit')}}" class="btn btn-header btn-export">Edit Workshop</a>
                                	<a href="{{ url('admin/add-workshop-service/'.$workshop->id) }}" class="btn btn-header btn-export">Add Services</a>
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
						                        	<td>{{ $workshop->owner_name }}</td>
						                        </tr>
						                        <tr> 
						                        	<td>Email</td>
						                        	<td>{{$workshop->email}}</td>
						                        	<td>Type</td>
						                        	<td>{{ $workshop->type}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>CNIC Card Number</td>
						                        	<td>{{$workshop->cnic}}</td>
						                        	<td>Mobile Number</td>
						                        	<td>{{ $workshop->mobile}}</td>
						                        </tr>
												<tr> 
						                        	<td>Landline Number</td>
						                        	<td>{{ $workshop->landline}}</td>
													<td></td>
						                        	<td></td>
						                        </tr>
						                        <tr> 
						                        	<td>Opening Time</td>
						                        	<td>{{ $workshop->open_time}}</td>
						                        	<td>Closing Time</td>
						                        	<td>{{ $workshop->close_time}}</td>
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
						                        	<td>Shop No</td>
						                        	<td>{{ $address->shop }}</td>
						                        	<td>Street No</td>
						                        	<td>{{ $address->street}}</td>
						                        </tr>
						                        <tr> 
													<td>Building No</td>
						                        	<td>{{$address->building}}</td>
						                        
						                        	<td>Block</td>
						                        	<td>{{ $address->block}}</td>
						                        </tr>
						                        <tr> 
													<td>Town</td>
						                        	<td>{{$address->town}}</td>
						                        	<td>City</td>
						                        	<td>{{ $address->city}}</td>
						                        </tr>
						                        <tr> 
						                        	<td>Geo Cord</td>
						                        	<td>{{ $address->geo_cord}}</td>
						                        	<td></td>
						                        	<td></td>
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
												$specialty = $workshop->services							
											@endphp
						                    <tbody>
						                    	@if($specialty)
						                    	@foreach($specialty as $spec)
						                        <tr> 
						                        	<td>{{ $spec->name }}</td>
						                        	<td>{{ $spec->pivot->service_rate }}</td>
						                        	<td>{{ $spec->pivot->service_time }}</td>	
						                        	<td>						                        	
						                        		<a href="{{url('admin/edit-workshop-service/'.$spec->pivot->id)}}" class="btn btn-header">Edit</a>
                                						<a href="{{ url('admin/delete-workshop-service/'. $workshop->id.'/'.$spec->pivot->service_id) }}" class="btn btn-header ">Delete</a>
                                					</td>	                        	
						                        </tr>
						                        @endforeach
						                        @endif                      
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