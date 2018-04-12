@extends('layouts.master')
@section('title', 'Customer Details')
@section('content')

@include('partials.header')

<div class="content">
    
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                	<div class="header">
                        <div class="row">
                            <div class="col-md-10">

	                            <div class="avtar-block">
	                            	@if($customer->profile_pic_url)
	                            		<img src="{{$customer->profile_pic_url}}" class="img-shadow" height="200px">
	                            	@else
	                            		<img src="{{asset('img/default_profile.png')}}" class="img-shadow" height="200px">
	                            	@endif
	                            	<div class="name-info">
	                            		<h3 class="title">Customer Name : {{$customer->name}}</h3>
	                            		@if(!empty($customer->addresses))
		                            		@foreach($customer->addresses as $key => $address)
												<div class="address">Address {{ $address->type }}: {{$address->house_no.', '.$address->street.', '.$address->block.', '.$address->town.', '.$address->city}}</div>
		                                	@endforeach
		                                @endif
	                                	<div class="phone">Email : {{$customer->email}}</div>
	                                	<div class="phone">Mobile : {{$customer->con_number}}</div>
	                                	<div class="phone">Current Loyalty Points : {{$customer->loyalty_points}}</div>
	                                </div>
	                            </div>
								
                            </div>
							<div class="col-md-2">@include('partials.backbtn_customer')</div>
                        </div>                                                
                    </div>
					<div class="content">
					    <div>
					        <div class="row">
					            <div class="col-md-12">
					            	<div class="table-responsive">
					            		<h4>Cars Details</h4>
										<table class="table table-striped dataTable table-bordered no-footer" role="grid" style="padding: 10px;">          	         
											<thead>
												<tr>
													<th class="text-center">S.No </th>
													<th class="text-center">Car </th>
													<th class="text-center">Model </th>
													<th class="text-center">Vehicle No.</th>
													<th class="text-center"h>Millage</th>
													<th class="text-center">Insurance</th>
												</tr>
											</thead>
						                    <tbody>
                    							@if(count($customer->cars) > 0)
							                    	@foreach($customer->cars as $key => $car)
							                        <tr> 
							                        	<td class="text-center">{{$key + 1}}</td>
							                        	<td class="text-center">{{ $car->make ." ". $car->model  }}</td>
							                        	<td class="text-center">{{ $car->pivot->year }}</td>
							                        	<td class="text-center">{{ $car->pivot->vehicle_no }}</td>
							                        	<td class="text-center">{{ $car->pivot->millage }}</td>
							                        	<td class="text-center">
							                        		@if($car->pivot->insurance == 1)
							                        			<i class="ti-check"></i>
					                                        @else
					                                        	<i class="ti-close"></i>
					                                        @endif
							                        	</td>
							                        </tr>        
							                        @endforeach
						                        @else
						                        	 <tr>
							                        	<td colspan="6" class="text-center">No Cars added yet.</td>
							                        </tr>
												@endif
						                    </tbody>
						                </table>
					                </div>
					            </div>
					        </div>

					    </div>
					</div> 
					<div class="content">
					    <div>
					        <div class="row">
					            <div class="col-md-12">
					            	<div class="table-responsive">
					            		<h4>Bookings Details</h4>
										<table class="table table-striped dataTable table-bordered no-footer" role="grid" style="padding: 10px;">          	         
											<thead>
												<tr>
													<th class="text-center">Workshop ID</th>
													<th class="text-center">Workshop</th>
													<th class="text-center">Vehicle No.</th>
													<th class="text-center">Job Date Time</th>
													<th class="text-center">Status</th>
													<th class="text-center">Services</th>
													<th class="text-center">Amount Paid</th>
													<th class="text-center">Request at</th>
													<th class="text-center">Ratings</th>
												</tr>
											</thead>
						                    <tbody>
						                    	@if(count($customer->bookings) > 0)
							                    	@foreach($customer->bookings as $key => $booking)
								                        <tr> 
								                        	<td class="text-center">{{$booking->workshop->workshopId}}</td>
								                        	<td class="text-center">{{$booking->workshop->name}}</td>
															<td class="text-center">{{$booking->vehicle_no  }}</td>
								                        	<td class="text-center">{{\Carbon\Carbon::parse($booking->job_time)->format('g:i A')." ". \Carbon\Carbon::parse($booking->job_date)->format('D d M, Y') }}</td>
								                        	<td class="text-center">{{$booking->job_status }}</td>
								                        	<td class="text-center">{{implode(', ',
								                        	$booking->services->pluck('name')->toArray())}}</td>
															<td class="text-center">{{$booking->billing['paid_amount
															']}} PKR</td>
								                        	<td class="text-center">{{$booking->created_at->format('g:i A D d M, Y') }}</td>
															<td class="text-center">{{$booking->billing['ratings']}}</td>
								                        </tr>        
							                        @endforeach
						                        @else
							                        <tr>
							                        	<td colspan="6" class="text-center">No Bookings created yet.</td>
							                        </tr>
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