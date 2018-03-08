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
				                    	<a href="{{url('admin/workshops/'.$workshop->id.'/')}}" class="btn btn-header export">Back</a>				
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
												<img src="{{$img->url}}" alt="workshop_images" width="200px" height="150px"> 
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