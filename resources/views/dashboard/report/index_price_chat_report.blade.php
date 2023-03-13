@extends('dashboard.mainlayouts')
@section('title', 'Manage Items')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">Manage Price Chat Report</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Price Chat Report</li>
					</ul>
				</div>
				
			</div>
		</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							
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
											<th>Category</th>
											<th>Sub Category</th>
											<th>Image</th>
											<th>Price</th>
											<th>Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@if(!empty($datas))
											@foreach($datas as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->name}}</td>
											<td>{{$val->category->category_name}}
												@if(!empty($val->category->cuisine->cuisine_name))
												-{{$val->category->cuisine->cuisine_name}}
												@endif
											</td>
											<td>{{!empty($val->subcategory->subcategory_name) ? $val->subcategory->subcategory_name : "N/A"}}</td>
											<td>
												@if(!empty($val->mediacollection))
												<a href="{{$val->mediacollection}}" target="_blank">
												<img class="avatar-img rounded-circle" src="{{$val->mediacollection}}" alt="{{$val->name}}" height="50px" title="{{$val->name}}"></a>
												@endif
											</td>
											<td>&#x20b9; {{$val->price}}</td>
													<td>
												@if($val->status == 1)
												<a href="#"  class="badge badge-success" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Active</a>
										 		@else
												<a href="#" class="badge badge-danger" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Inactive</a>
												@endif
											</td>
											<td >
												<div class="actions">
													@can('items.write')
													<a href="{{ route('menu.edit',$val->id) }}" class="btn btn-sm bg-success-light mr-2 text-left">
													 <i class="fa fa-pencil-square-o text-success"></i>
													</a>
													@endcan
													@can('items.delete')
													<form method="post" action="" style="display: inline-block;">
													@csrf
													@method('DELETE')
													<a type="button" name="del" id="del" class="btn btn-sm bg-danger-light dele text-right"><i class="fe fe-trash"></i>  </a>
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


@endsection
