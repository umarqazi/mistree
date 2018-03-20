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
					                </div>
					                <div class="dropdown pull-right">
					                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					                   + More Options
					                    </button>
					                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					                    	<a href="{{url('admin/workshops/'.$workshop->id.'/')}}" class="dropdown-buttons">Workshop Detials</a>
					                        <a href="{{url('admin/workshop/'.$workshop->id.'/gallery')}}" class="dropdown-buttons">View Gallery</a>
					                    	<a href="{{url('admin/workshops/'.$workshop->id.'/edit')}}" class="dropdown-buttons">Edit Workshop</a>
					                    	<a href="{{ url('admin/add-workshop-service/'.$workshop->id) }}" class="dropdown-buttons">Add Services</a>
					                    	<a href="{{ url('admin/workshop/'.$workshop->id.'/history') }}" class="dropdown-buttons">Workshop History</a>
					                    </div>
					                </div>
					            </div>
								
					        </div>
					    </div>                                                
					</div>

			        <div class="row">
			            <div class="col-md-12"> 
		            		@if(!$workshop->transactions)
		            			<div>
		            				<h3>No transactions found</h3>
		            			</div>
		            		@else
			            	<div class="table-responsive">					            		
								<table class="table table-striped dataTable table-bordered no-footer" role="grid" style="padding: 10px;">          	         
									<thead>
										<tr>
											<th>Transaction Type</th>
											<th>Amount</th>
											<th>Balance Before</th>
											<th>Adjusted Balance</th>
											<th>Date</th>
											<th>Time</th>										
										</tr>
									</thead>
				                    <tbody>
				                    	@foreach($workshop->transactions as $transaction)
				                        <tr> 
				                        	<td>{{ $transaction->transaction_type }}</td>
				                        	<td>{{ $transaction->amount }}</td>
				                        	<td>{{ $transaction->unadjusted_balance }}</td>
				                        	<td>{{ $transaction->adjusted_balance }}</td>
				                        	<td>{{ $transaction->created_at->format('d-m-Y')}}</td>
				                        	<td>{{ $transaction->created_at->format('g:i A')}}</td>
				                        </tr>						
				                        @endforeach
				                        <tr> 
				                        	<td></td>
				                        	<td></td>
				                        	<td></td>
				                        	<td></td>						
				                        	<td>Total Balance</td>
				                        	<td>{{ $workshop->balance->balance }}</td>			
				                        </tr>
				                    </tbody>
				                </table>
			                </div>
			                @endif					                
			            </div>
			        </div>


					



				</div>
			</div>
		</div>
	</div>
</div>




  
@include('partials.footer')
@endsection

