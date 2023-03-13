@extends('dashboard.mainlayouts')
@section('title', 'Change password')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body col-md-8">
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
						<form action="/change_password" method="post" autocomplete="off" enctype="multipart/form-data">
							@csrf

							<div class="form-group">
								<label>New Password</label>
								<span class="text-danger">*</span>
								<input id="password" type="password" class="form-control pas" name="new_password" required placeholder="New Password">
							</div>

							<div class="form-group">
								<label>Confirm Password</label>
								<span class="text-danger">*</span>
								<input type="password" class="form-control conpas" name="con_password" required placeholder="Confirm Password">
							</div>

							<div class="form-group">
								<input type="submit" id="submit" class="btn btn-primary" name="submit" value="Save">
								<input type="reset" class="btn btn-secondary" value="Reset">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script>
$('.conpas').on('blur',function(){
	var pas = $('.pas').val();
	var conpas = $('.conpas').val();
	if(conpas != pas){
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
		Toast.fire({
		  icon: 'error',
		  title: 'Confirm password should same as password'
		})
		$('.pas').val('');
		$('.conpas').val('');
	}
});
</script>

@endpush