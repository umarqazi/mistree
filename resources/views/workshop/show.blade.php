@extends('layouts.master')
@section('title', 'Workshop Details')
@section('content')

	@include('partials.header')

	<div class="content">
		@if (session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif
		<div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="header">
							<div class="row">
								<div class="col-md-12">
									<div class="avtar-block">
										<div class="row">
											<div class="col-md-11">@include('partials.workshop_profile_info')</div>
											<div class="col-md-1">@include('partials.backbtn_workshop')</div>
										</div>
										<div class="dropdown pull-right">
											@if(!$workshop->is_approved)
												<a href="{{ url( 'admin/approve-workshop/'.$workshop->id ) }}" class="btn btn-secondary dropdown-toggle pull-right" type="button">
													Approve
												</a>
											@endif
											<div class="clear10"></div>
											<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												+ More Options
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a href="{{url('admin/workshop/'.$workshop->id.'/gallery')}}" class="dropdown-buttons">View Gallery</a>
												<a href="{{url('admin/workshop/'.$workshop->id.'/ledger')}}" class="dropdown-buttons">View Ledger</a>
												<a href="{{url('admin/workshops/'.$workshop->id.'/edit')}}" class="dropdown-buttons">Edit Workshop</a>
												<a href="{{ url('admin/add-workshop-service/'.$workshop->id) }}" class="dropdown-buttons">Add Services</a>
												<a href="{{ url('admin/workshop/'.$workshop->id.'/history') }}" class="dropdown-buttons">Workshop History</a>
											</div>
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
													<td>{{ \Carbon\Carbon::parse($workshop->open_time)->format('g:i A') }}</td>
													<td>Closing Time</td>
													<td>{{ \Carbon\Carbon::parse($workshop->close_time)->format('g:i A') }}</td>
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
												<tbody>
												@if(!is_null($workshop->address))
													@php $address = $workshop->address @endphp
													<tr>
														<td>Shop No</td>
														<td>{{ $address->shop }}</td>
														<td>Street</td>
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
												@else
													<tr>
														<td>No Address Details Found</td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
												@endif
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
												<tbody>
												@if(count($workshop->services))
													@foreach($workshop->services as $spec)
														<tr>
															<td>{{ $spec->name }}
																@if($spec->is_doorstep){{ " at doorstep" }}@endif
															</td>
															<td>@if(!is_null($spec->category)){{ $spec->category->name}}@endif</td>
															<td>{{ $spec->pivot->service_rate }}</td>
															<td>{{$spec->pivot->service_time}}</td>
															<td>
																<a href="{{url('admin/edit-workshop-service/'.$spec->pivot->id)}}" class="mistri-icons ti-pencil-alt"></a>
																<a href="{{ url('admin/delete-workshop-service/'. $workshop->id.'/'.$spec->pivot->service_id) }}" class="mistri-icons ti-close"></a>
															</td>
														</tr>
													@endforeach
												@else
													<tr>
														<td>No Services Found</td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
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