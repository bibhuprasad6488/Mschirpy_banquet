@extends('dashboard.mainlayouts')
@section('title', 'Manage Business')
@section('content')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Business</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Business</li>
					</ul>
				</div>
				
				<div class="panel-heading col-md-2">
					
           				 <a href="{{ route('business.create')}}" class="btn btn-block btn-primary">Add Business</a>
           			
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
											<th>Vendor Name</th>
											<th>Business Name</th>
											<th>State</th>
											<th>City</th>
											<th>Contact</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($businesses))
											@foreach($businesses as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->vendor_user->name}}</td>
											<td>{{$val->business_name}}</td>
											<td>{{$val->states->name}}</td>
											<td>{{$val->cities->city_name}}</td>
											<td>{{$val->primary_contact}}</td>
											<td>
											   @if ($val->status == 1)
	                                                <a href="#" class="badge badge-success"
	                                                    onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Active</a>
	                                            @else
	                                                <a href="#" class="badge badge-danger"
	                                                    onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Inactive</a>
	                                            @endif

											</td>
											<td class="text-center">
												<div class="actions">
													
													<a href="{{ route('business.edit',$val->id) }}" class="btn btn-sm bg-success-light mr-2">
														<i class="fe fe-pencil"></i> 
													</a>
													
													<form method="post" action="{{route('business.destroy',$val->id)}}" style="display: inline-block;">
													@csrf
													@method('DELETE')
													<button type="button" name="del" id="del" class="btn btn-sm bg-danger-light dele"><i class="fe fe-trash"></i>  </button>
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



function changestatus_chk(id, sts) {
            Swal.fire({
                title: 'Are you sure to change the status !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/change_status",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            sts: sts
                        },
                        success: function(data) {
                        	if(data == 1){
                            location.reload();
                        }
                    }
                    });
                }
            })
        }
</script>

@endsection
