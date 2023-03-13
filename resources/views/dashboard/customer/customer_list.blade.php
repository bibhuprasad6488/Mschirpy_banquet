@extends('dashboard.mainlayouts')
@section('title', 'Customer List')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Customer List</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Customer List</li>
					</ul>
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
											<th>Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($customers))
											@foreach($customers as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->customer_name}}</td>
											<td>{{$val->email_id}}</td>
											<td>{{$val->mobile}}</td>
											<td class="text-center">
												<div class="actions">
													<a href="" class="btn btn-sm bg-danger-light mr-2">
															<i class="fe fe-trash"></i>  
													</a>
												</div>
											</td>
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

<script>
$('.dele').on('click',function(){
var form =  $(this).closest("form");
Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.isConfirmed) {
	  	form.submit();
	  }
	})
});
</script>

@endsection
