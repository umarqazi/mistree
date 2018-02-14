@extends('layouts.master')
@section('title', 'Workshop Details')
@section('content')

@include('partials.header')

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
							</tr>
						</thead>
						@php 
							$specialty = $workshop->specialty 							
						@endphp

	                    <tbody>
	                    	@foreach($specialty as $spec)
	                        <tr> 
	                        	<td>{{ $spec->service->name }}</td>
	                        	<td>{{ $spec->service_rate }}</td>
	                        	<td>{{ $spec->service_time }}</td>	                        	
	                        </tr>
	                        @endforeach	                        
	                    </tbody>
	                </table>
                </div>
            </div>
        </div>
    </div>
</div>            
@include('partials.footer')
@endsection