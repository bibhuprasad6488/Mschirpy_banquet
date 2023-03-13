@extends('dashboard.mainlayouts')
@section('title', 'Price Chart')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Price Chart</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Price Chart</li>
					</ul>
				</div>
				
				<div class="panel-heading col-md-2">
			
           				 <a href="/export_price_chart" class="btn btn-block btn-warning">Export</a>
           			
        		</div>
        	
			</div>
		</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							@if ($message = Session::get('success'))
						        <div class="alert alert-success alert-block">
						            <button type="button" class="close" data-dismiss="alert">×</button>
						            <strong>{{ $message }}</strong>
						        </div>
					   		@endif
					   		@if ($message = Session::get('error'))
						        <div class="alert alert-danger alert-block">
						            <button type="button" class="close" data-dismiss="alert">×</button>
						            <strong>{{ $message }}</strong>
						        </div>
					   		@endif
						   	<div class="table-responsive">
								<table class="datatable table table-stripped">
									<thead>
										<tr>
											<th>#</th>
											<th>Item Name</th>
											<th>SPAT</th>
											<th>MRP Price</th>
											<th>VAT Percentage</th>
											<th>Quantity</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($ingredientItems))
											@foreach($ingredientItems as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->item_name}}</td>
											<td>{{$val->custom_fields['spat'] ?? ''}}</td>
											<td>{{$val->custom_fields['mrp_price'] ?? ''}}</td>
											<td>{{$val->custom_fields['vat_perc'] ?? ''}}</td>
											<td>{{$val->custom_fields['qty'] ?? ''}}</td>
											<td>{{$val->custom_fields['amount'] ?? ''}}</td>
										</tr>
											@endforeach
										@else
										<tr><td>-- No Records Found --</td></tr>
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

@endsection
