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
									@include('partials.workshop_profile_info')
	                            </div>
								
                            </div>
                        </div>                                                
                    </div>

			        <div class="row">
			            <div class="col-md-12">
							@if(!count($workshop->transactions))
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
												<td>{{ $transaction->created_at->format('H:i:s')}}</td>
											</tr>
											@endforeach
											@if(!is_null($workshop->balance))
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>Total Balance</td>
												<td>{{ $workshop->balance->balance }}</td>
											</tr>
											@endif
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
