@extends('dashboard.mainlayouts')
@section('title', 'Manage Sub Categories')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Sub Categories</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Sub Categories</li>
					</ul>
				</div>
				
				<div class="panel-heading col-md-2">
						@can('sub_categories.write')
           				 <a href="{{ route('subcategory.create')}}" class="btn btn-block btn-primary">Add Sub Category</a>
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
											<th>Category Name</th>
											<th>Sub Category Name</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($datas))
											@foreach($datas as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->category->category_name}}
											 @if(!empty($val->category->cuisine->cuisine_name))
											 -{{$val->category->cuisine->cuisine_name}}
											 @endif
											</td>
											<td>{{$val->subcategory_name}}</td>
													<td>
												@if($val->status == 1)
												<a href="#"  class="badge badge-success" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Active</a>
												@else
												<a href="#" class="badge badge-danger" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Inactive</a>
												@endif
											</td>
											<td class="text-center">
												<div class="actions">
												@can('sub_categories.write')
													<a href="{{ route('subcategory.edit',$val->id) }}" class="btn btn-sm bg-success-light mr-2">
														<i class="fe fe-pencil"></i> Edit
													</a>
													@endcan
													@can('sub_categories.delete')
													<form method="post" action="{{route('subcategory.destroy',$val->id)}}" style="display: inline-block;">
													@csrf
													@method('DELETE')
													<button type="button" name="del" id="del" class="btn btn-sm bg-danger-light dele"><i class="fe fe-trash"></i> Delete </button>
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
		url:"/subcategory_change_sts",
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
