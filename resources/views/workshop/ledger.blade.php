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
                        
                    </div>

					<div class="content">
					    <div class="container-fluid">
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
													<th>Action</th>
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
						                        	<td><!-- Trigger the modal with a button -->
														<button type="button" class="btn btn-header btn-export " data-toggle="modal" data-target="#ledger-adjustment">Adjust</button>
													</td>
						                        </tr>						
						                        @endforeach
						                        <tr> 
						                        	<td></td>
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
	</div>
</div>




  
@include('partials.footer')
@endsection

<!-- Modal -->
<div id="ledger-adjustment" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>