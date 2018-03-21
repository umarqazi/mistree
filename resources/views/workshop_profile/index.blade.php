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

									<div class="avtar-block">
										<img src="{{$workshop->profile_pic}}" class="img-shadow" width="200px" height="150px">
										<div class="name-info">
											<h4 class="title">Workshop Name : {{$workshop->name}}</h4>
											<h5 class="title">Owner Name : {{$workshop->owner_name}}</h5>
											<div class="address">{{$workshop->address->building.', '.$workshop->address->block.', '.$workshop->address->town.', '.$workshop->address->city}}</div>
											<div class="phone">Mobile : {{$workshop->mobile}}</div>
											<div class="phone">Current Balance : {{$workshop->balance->balance}}</div>
                      @if(!is_null($workshop->jazzcash_id))	                         
										    <div>Jazz Cash ID : {{$workshop->jazzcash_id}}</div>
										  @endif
											<div class="phone"><a href="{{url('profile/'.$workshop->id.'/edit')}}" class=" btn btn-header btn-export">Edit Workshop</a></div>

										</div>
										<div class="dropdown pull-right">
											<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												+ More Options
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a href="{{url('/gallery')}}" class="dropdown-buttons">View Gallery</a>
												<a href="{{ url('profile/add-profile-service/'.$workshop->id) }}" class=" dropdown-buttons">Add Services</a>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>



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
											<td>Team Slots</td>
											<td>{{ $workshop->slots }}</td>
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
											<td>Building</td>
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
											<th>Service Category</th>
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
													<td>@if(!is_null($spec->category)){{ $spec->category->name}}@endif</td>
													<td>{{ $spec->pivot->service_rate }}</td>
													<td>{{ $spec->pivot->service_time.' hr' }} </td>
													<td class="text-center">
														<a href="{{url('profile/edit-profile-service/'.$spec->pivot->id)}}" class="mistri-icons ti-pencil-alt" data-toggle="tooltip" data-placement="top" title="Edit"></a>
														<a href="{{ url('profile/delete-profile-service/'. $workshop->id.'/'.$spec->pivot->service_id) }}" class="mistri-icons ti-close" data-toggle="tooltip" data-placement="top" title="Delete"></a>
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

	@include('partials.footer')
@endsection