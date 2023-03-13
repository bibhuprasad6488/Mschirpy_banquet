@extends('dashboard.mainlayouts')
@section('title', 'Tax subcategory')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Tax subcategory</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Tax subcategory</li>
					</ul>
				</div>
				<div class="panel-heading col-md-2">
           			<a href="/taxcreate_subcategory" class="btn btn-block btn-primary">Add Tax subcategory</a>
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
											<th>Category Name</th>
											<th>Percentage</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($subcats))
											@foreach($subcats as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->taxcat->category_name ?? ''}}</td>
											<td>{{$val->subcat}} %</td>
										<td>
												@if($val->status == 'active')
												<a href="#"  class="badge badge-success" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Active</a>
												@else
												<a href="#" class="badge badge-danger" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Inactive</a>
												@endif
											</td>
											<td class="text-center">
												<div class="actions">
													<a href="/edit_subcat/{{$val->id}}" class="btn btn-sm bg-success-light mr-2">
														 <i class="fa fa-pencil-square-o text-success"></i>
													</a>
													<form method="post" action="/dlt_subcat" style="display: inline-block;">
														<input type="hidden" name="hdnid" value="{{$val->id}}">
													@csrf
													
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


function default_check(brand_id, depat_id, def_val){
	$.ajax({
		type:"post",
		url:'/set_brand_default',
		data:{_token:"{{csrf_token()}}",brand_id:brand_id,depat_id:depat_id,def_val:def_val},
		success:function(data){
			if(data == 'exist'){
				Swal.fire('Already default brand set for this department');
			}else{
				location.reload();
			}
			
		}
	});
}
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
		url:"/tax_subcategory_status",
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
