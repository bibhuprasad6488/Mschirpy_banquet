@extends('dashboard.mainlayouts')
@section('title', 'Manage Ingredient Categories')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Ingredient Item</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Ingredient Item</li>
					</ul>
				</div>
				
				<div class="panel-heading col-md-2">
           				 <a href="{{ route('ingredient-item.create')}}" class="btn btn-block btn-primary">Add Item</a>
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
											<th>Item Name</th>
											<th>Category Name</th>
											<th>Department Name</th>
											<th>Unit</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($items))
											@foreach($items as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->item_name}}</td>
											<td>{{$val->ingredient_category->category_name}}</td>
<td><span class="badge badge-success" onclick="showdepartment('{{json_encode($val->department_id)}}')" style="cursor:pointer;">View all Department</span></td>
											<td>{{$val->unit}}</td>
											<td>
											@if($val->status == 'active')
											<a href="#"  class="badge badge-success" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Active</a>
											@else
											<a href="#" class="badge badge-danger" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Inactive</a>
											@endif
											</td>
											<td class="text-center">
												<div class="actions">
													<a href="{{ route('ingredient-item.edit',$val->id) }}" class="btn btn-sm bg-success-light mr-2">
													 <i class="fa fa-pencil-square-o text-success"></i>
													</a>
													<form method="post" action="{{route('ingredient-item.destroy',$val->id)}}" style="display: inline-block;">
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


						<div class="modal fade" id="department_show" tabindex="-1" role="dialog" aria-labelledby="department_show" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <!-- <h5 class="modal-title" id="cat_show">Category name</h5> -->
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							         </div>
								      <table class="table table-bordered table-striped">
								            <thead>
								               <tr>
								                <th>Department</th>		                
								               </tr>
								            </thead>
								             <tbody id="department">
								             </tbody>
								        </table>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			   	 						  </div>
									  </div>
					 	 		 </div>
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
		url:"/ingredient_change_status",
	 	data:{_token:"{{csrf_token()}}",id:id, sts:sts},
	   success:function(data){
        	location.reload();                
			}
		});
	  }
	})
}


function showdepartment(department_id)
{
	// alert(department_id);
	// return false;
 $('#department_show').modal('show');
$.ajax({
	type:"POST",
	url:"/supplier/show_department",
 	data:{_token:"{{csrf_token()}}",department_id:department_id},
    success:function(data){
    	console.log(data);
   	  		if(data !=''){
   	  		 var i = 1;
    	     $('#department').empty();
    	     $.each(data, function (key, val) {
     			$('#department').append(
     				"<tr>\
     				<td>"+i+"</td>\
     				<td>"+val.department_name+"</td>\
     				</tr>"
     				); 
     			 i++;
	         	});
   	  		}else{
   	  			$('#department').append(
   	  				"<tr>\
     				<td colspan='2'>No records Found</td>\
     				</tr>"
     			);
   	  		}
		}
	});
}
</script>

@endsection
