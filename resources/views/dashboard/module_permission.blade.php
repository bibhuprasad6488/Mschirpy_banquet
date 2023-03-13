@extends('dashboard.mainlayouts')
@section('title', 'Manage Cuisines')
@section('content')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Permissions</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Permissions</li>
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
								<table class="table table-bordered mb-0">
								<thead>
									<tr>
										<th>Modules</th>
										<th>Staff</th>
										<th>Vendor</th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($permissions))
										@foreach($permissions as $permission)
									<tr>
										<td>{{str_replace('.', ' -- ', strtoupper($permission->name))}}</td>
										<td><input type="checkbox" name="permissions_staff[]" value="{{ $permission->id }}" class="staff_permission" @if(in_array($permission->id,$staffPriv)) checked @endif></td>
										<td>
											<input type="checkbox" name="permissions_vendors[]" value="{{ $permission->id }}" class="vendor_permission" @if(in_array($permission->id,$vendorPriv)) checked @endif>
										</td>
									</tr>
										@endforeach
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
@push('script')
<script>
$('.staff_permission').change(function(){
 if($(this).is(':checked')) {
 		var isChecked = "yes";
    } else {
         var isChecked = "no";
    }
	var permission_id = $(this).val();
	$.ajax({
		type:"post",
        url:"/save_staff_permission",
        data:{_token:"{{csrf_token()}}",permission_id:permission_id,isChecked:isChecked},
        success:function(data){
        	  const Toast = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 3000,
			  timerProgressBar: true,
			  didOpen: (toast) => {
			    toast.addEventListener('mouseenter', Swal.stopTimer)
			    toast.addEventListener('mouseleave', Swal.resumeTimer)
			  }
			})
        	  if(data == "added"){
        	  		Toast.fire({
					  icon: 'success',
					  title: 'Privilige Assigned To Staff'
					})
        	  }else{
        	  		Toast.fire({
					  icon: 'error',
					  title: 'Privilige Removed from Staff'
					})
        	  }
        }
	});
});

$('.vendor_permission').change(function(){
	if($(this).is(':checked')) {
 		var isChecked = "yes";
    } else {
         var isChecked = "no";
    }
	var permission_id = $(this).val();
	$.ajax({
		type:"post",
        url:"/save_vendor_permission",
        data:{_token:"{{csrf_token()}}",permission_id:permission_id,isChecked:isChecked},
        success:function(data){
        const Toast = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 3000,
			  timerProgressBar: true,
			  didOpen: (toast) => {
			    toast.addEventListener('mouseenter', Swal.stopTimer)
			    toast.addEventListener('mouseleave', Swal.resumeTimer)
			  }
			})
        	  if(data == "added"){
        	  		Toast.fire({
					  icon: 'success',
					  title: 'Privilige Assigned To Vendor'
					})
        	  }else{
        	  		Toast.fire({
					  icon: 'error',
					  title: 'Privilige Removed from Vendor'
					})
        	  }
            }
	});
});
</script>

@endpush
@endsection

