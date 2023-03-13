@extends('dashboard.mainlayouts')
@section('title', 'Manage Staff')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Staff</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Staff</li>
					</ul>
				</div>
				<div class="panel-heading col-md-2">
					@can('staff.write')
           				 <a href="/add_staff" class="btn btn-block btn-primary">Add Staff</a>
           			@endcan
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
											<th>Staff Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Role</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($staffs))
											@foreach($staffs as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->name}}</td>
											<td>{{$val->email}}</td>
											<td>{{$val->mobile}}</td>
											<td>
												{{$val->roles->pluck('name')[0]}} 
												@if($val->roles->pluck('name')[0] == 'Others')
													( {{$val->department->department_name ?? ''}} )
												@endif

											</td>
											<td class="text-center">
												<div class="actions">
													@can('staff.write')
													<a href="/edit_staff/{{$val->id}}" class="btn btn-sm bg-success-light mr-2">
														 <i class="fa fa-pencil-square-o text-success"></i>
													</a>
													@endcan
													@can('staff.delete')
													<form method="post" action="/delete_staff" style="display: inline-block;">
													@csrf
													<button type="button" name="del" id="del" class="btn btn-sm bg-danger-light dele"><i class="fe fe-trash"></i>  </button>
													<input type="hidden" name="user_id" value="{{$val->id}}">
												</form>
													@endcan
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
