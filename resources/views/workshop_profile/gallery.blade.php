@extends('layouts.master')
@section('title', 'Workshop Details')
@section('content')

	@include('partials.header')

	<div class="content">

		<div>
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
										</div>

										<div class="pull-right">
											<a href="{{url('profile')}}" class="btn btn-header export">Back</a>
										</div>

									</div>

								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="gallery">
									<h3>Gallery</h3>
									<ul class="profile-listing">
										@if($workshop->images)
											@foreach($workshop->images as $img)
												<li>
													<a class="thumbnail info-icon" href="#" data-image-id="" data-toggle="modal" data-title="Sans verres" data-image="{{$img->url}}" data-target="#image-gallery">
														<img src="{{$img->url}}" alt="workshop_images" width="200px" height="150px">
													</a>
												</li>
											@endforeach
										@endif
										<div class="clear"></div>
										<li>
											<div class="image-heading">
												<h3>CNIC Image</h3>
											</div>
											<div class="cnic-image">
												<img src="{{$workshop->cnic_image}}" alt="workshop_cnic_image">
											</div>
										</li>
									</ul>
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


<div class="modal fade gallery-modal" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				{{--<h4 class="modal-title" id="image-gallery-title"></h4>--}}
				<button type="button" class="close close2" data-dismiss="modal" style="position: relative; top: -7px;">
					<span aria-hidden="true">×</span><span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<img id="image-gallery-image" class="img-responsive" src="">
			</div>
		</div>
	</div>
</div>