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
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                         
                            <div class="col-sm-6 col-sm-offset-6 balance-info">
                              
                                <div class="clear10"></div><div class="clear5"></div>                                
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
						                        	<td>{{ $transaction->created_at->format('H:i:s')}}</td>			
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
