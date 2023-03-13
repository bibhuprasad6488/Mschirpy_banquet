@extends('dashboard.mainlayouts')
@section('title', 'Manage Departments')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Departments</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Departments</li>
					</ul>
				</div>
				
				<div class="panel-heading col-md-2">
			
           				 <a href="/add_department" class="btn btn-block btn-primary">Add Department</a>
           			
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
											<th>Department Name</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($departments))
											@foreach($departments as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->department_name}}</td>
												<td>
												@if($val->status == 'active')
												<a href="#"  class="badge badge-success" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Active</a>
												@else
												<a href="#" class="badge badge-danger" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Inactive</a>
												@endif
											</td>
											<td class="text-center">
												<div class="actions">
													<a href="/edit_department/{{$val->id}}" class="btn btn-sm bg-success-light mr-2">
														
														 <i class="fa fa-pencil-square-o text-success"></i>
													</a>
													<form method="POST" action="/delete_department" style="display: inline-block;">
													@csrf
													<input type="hidden" name="delId" value="{{$val->id}}">
													<button type="button" name="del" id="del" class="btn btn-sm bg-danger-light dele"><i class="fe fe-trash"></i> </button>
													</form>
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

function changestatus_chk(id,sts)
{
	Swal.fire({
	  title: 'Are you sure to change the status !',
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, change it!'
	})

	.then((result) => {
	  if (result.isConfirmed) {
	  	$.ajax({
		type:"POST",
		url:"/department_change_status",
	 	data:{_token:"{{csrf_token()}}",id:id, sts:sts},
	   success:function(data){
        	location.reload();                
			}
		});
	  }
	})
}
</script>

@endsection
