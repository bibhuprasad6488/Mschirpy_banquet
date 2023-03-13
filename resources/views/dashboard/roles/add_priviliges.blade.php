@extends('dashboard.mainlayouts')
@section('title', 'Manage Priviliges')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Priviliges</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Priviliges</li>
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
										<th>Read</th>
										<th>Write</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($datas))
									 @foreach($datas as $key => $data)
									<tr>
										<td>{{$key}}</td>

										<td>
											<input type="checkbox" name="privilige[]" value="{{$data[0]}}" class="givePrivilige" @if(in_array($data[0],$staffPriv)) checked @endif>
										</td>
										<td>
											<input type="checkbox" name="privilige[]" value="{{$data[1]}}" class="givePrivilige" @if(in_array($data[1],$staffPriv)) checked @endif>
										</td>
										<td>
											<input type="checkbox" name="privilige[]" value="{{$data[2]}}" class="givePrivilige" @if(in_array($data[2],$staffPriv)) checked @endif>
										</td>
									</tr>
									@endforeach
									@endif
									<input type="hidden" name="role_id" id="role_id" value="{{$id}}">
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
@push('script')
<script>
$('.givePrivilige').on('change',function(){
	var role_id = $('#role_id').val();
	if($(this).is(':checked')) {
		var isChecked = "yes";
	} else {
	     var isChecked = "no";
	}
	var permission_id = $(this).val();
	$.ajax({
		type:"post",
	    url:"/save_staff_permission",
	    data:{_token:"{{csrf_token()}}",role_id:role_id,permission_id:permission_id,isChecked:isChecked},
	    success:function(data){
	    	console.log(data);
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
</script>


@endpush

