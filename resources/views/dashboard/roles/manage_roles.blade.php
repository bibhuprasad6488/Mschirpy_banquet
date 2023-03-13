@extends('dashboard.mainlayouts')
@section('title', 'Manage Roles')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Roles</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Roles</li>
					</ul>
				</div>
			
				<div class="panel-heading col-md-2">
					@can('role.write')
           				 <a href="/add_roles" class="btn btn-block btn-primary">Add Role</a>
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
											<th>Role Name</th>
											<th>Permission</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($roles))
											@foreach($roles as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->name}}</td>
											<td></a><span class="badge badge-pill bg-danger inv-badge viewper"  data-id="{{$val->id}}" style="cursor: pointer;">View Permission</span></td>
											<td class="text-center">
												<div class="actions">
													<a href="/edit_privilige/{{$val->id}}" class="btn btn-sm bg-warning-light mr-2">
														<i class="fa fa-edit mr-1"></i>Edit Priviliges
													</a>
													@can('role.write')
													<a href="/role_edit/{{$val->id}}" class="btn btn-sm bg-success-light mr-2">
														 <i class="fa fa-pencil-square-o text-success"></i>
													</a>
													@endcan
													@can('role.delete')
													<form method="post" action="/delete_roles" style="display: inline-block;">
													@csrf
													<input type="hidden" value="{{$val->id}}" name="hiddenId">
													<button type="button" name="del" id="del" class="btn btn-sm bg-danger-light dele"><i class="fe fe-trash"></i>  </button>
													</form>
													@endrole
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-body">
        	<div id="modalBody" class="row">
        		
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
	$('.viewper').on('click',function(){
		var id = $(this).data("id");
		$.ajax({
			type:"post",
			url:"/showpermission",
			data:{_token:"{{csrf_token()}}",id:id},
			success:function(data){
				$('#modalBody').html("");
				if(data !=''){
				$.each(data,function(key, val){
					$('#modalBody').append('<div class="col-md-6 col-sm-6 col-12"><div class="badge badge-success">'+val.replace(/\./g,' - ').toUpperCase()+'</div></div>');
    		});
				}else{
					$('#modalBody').append('<span class="col-12 text-danger text-center">No Roles Found</span>');
				}
				
    		$('#myModal').modal('show'); 
			}
		});
	});
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
