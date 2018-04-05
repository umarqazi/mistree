@extends('layouts.master')
@section('title', 'Workshop Gallery')
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
									<div class="row">
										<div class="col-md-11">@include('partials.workshop_profile_info')</div>
										<div class="col-md-1">@include('partials.backbtn_workshop_back')</div>
									</div>
					            </div>
								
					        </div>
					    </div>                                                
					</div>

					<div class="row">
						<div class="col-md-12">							
							<div class="gallery">
								<h3>Gallery</h3>
								@if(!count($workshop->images))
									<h3>No Images Found</h3>
								@else
									<ul class="profile-listing">
										@foreach($workshop->images as $img)
											<li>
												<img src="{{$img->url}}" alt="workshop_images" width="200px" height="150px">
											</li>
										@endforeach
									</ul>
								@endif
								<div class="clear20"></div>

								<div class="image-heading">
									<h3>CNIC Image</h3>
								</div>
								@if(!empty($workshop->cnic_image))
								<div class="cnic-image">
									<img src="{{$workshop->cnic_image}}" alt="workshop_cnic_image" width="200px">
								</div>
								@else
									<h3>No CNIC Image Found</h3>
								@endif
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