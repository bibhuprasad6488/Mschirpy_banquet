@extends('dashboard.mainlayouts')
@section('title', 'Manage Items')
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
.ui-widget-header {
    border: 1px solid #dddddd;
    background: #57c62e;
    color: #0d0d0d;
    font-weight: bold;
}

</style>
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		
				<div class="page-header">
			   <div class="row">
			      <div class="col-sm-12">
               <h3 class="page-title">Supplier Price Chart Report</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Supplier Price Chart Report</li>
               </ul>
							<form action="/report/price_chart_report" class="form-inline" style="float: right;" method="post">
							   	@csrf
							 
							   <select class="form-control form-group mx-sm-3 mb-1 " id="" name="item_id" value=""  >
                     <option value="" selected disabled>Pick a Items...</option>
                     @if(!empty($items))
                        @foreach($items as $k=>$item)
                           <option value="{{$k}}" {{$k == $itemID ? 'selected' : ''}}>{{$item}}</option>
                        @endforeach
                     @endif
                  </select>

					  <div class="form-row">
					    <div class="col">
  					  <input type="text" id="valid_from" name="valid_from"   class="form-control" placeholder="Valid from" >
					    </div>
					    <div class="col">
					  <input type="text" id="valid_to" name="valid_to"  class="form-control" placeholder="valid to" >
					    </div>
                   <div class="col">
					  <button type="submit"  class="btn  btn-primary mb-2"><i class="fa fa-search"></i>Search</button>
					  </div>
			 		  </div>
				  	</form>
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
						   	<div class="table table-responsive">
								<table class="datatable table table-stripped">
									<thead>
										<tr>
											<th>#</th>
											<th>Supplier Name</th>
											<th>Category</th>
											<th>Item</th>
											<th>Mrp</th>
											<th>Qty</th>
											<th>from</th>
											<th>To</th>
											<th>Data</th>
										</tr>
									</thead>
										<tbody>
										@if(!empty($price_chart))	
											@foreach($price_chart as $key => $val)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$val->supplier->supplier_name ?? ''}}</td>
											<td>{{$val->ing_cat->category_name}} </td>
											<td>{{$val->item->item_name}}</td>										
											<td>{{$val->mrp}}</td>
											<td>{{$val->qty}}
											<span class="badge badge-success">({{$val->ing_item->unit}})</span>
											</td>
											<td>{{date('d-m-Y',strtotime($val->supplier->valid_from))}}</td>
											<td>{{date('d-m-Y',strtotime($val->supplier->valid_to))}}</td>
											<td><a href="#" class="badge badge-warning" onclick="show_price_chart_data('{{$val->id}}','{{$key}}')">View</a>
											</td>
										</tr>
											@endforeach
										@else
										<tr><td>-- No Records Found --</td></tr>
										@endif
									</tbody>
								</table>
							</div>
					<div class="modal fade" id="price_chart" tabindex="-1" role="dialog" aria-labelledby="student" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="student">Brand and Price</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							         </div>
								      <table class="table table-bordered table-striped">
								            <thead>
								               <tr>
								                  <th>Brand</th>
								                  <th>Price</th>				                
								               </tr>
								            </thead>
								            <tbody id="report">
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


  function show_price_chart_data(id, key)  {
  	
  	 $('#price_chart').modal('show');
		   	$.ajax({
		           type:"POST",
		           url:'/report/price_chart_show',
		           data:{_token:"{{csrf_token()}}",id:id},
		           success:function(data){

		           		$("#report").empty();

			           	if(data != null){
			           		// console.log(data);
			           		$.each(data, function (key, value) {
			         			$('#report').append("<tr>\
			         				<td>"+key+"</td>\
			         				<td>"+value+"</td>\
			         				</tr>");
			         			});
		           		// $("#report").empty();

			           	}else{
			           		// console.log("Not");
			   			$('#report').append("<tr>\
			   				<td colspan='2' style='text-align:center;'>No record Found..</td>\
			   				</tr>");
		           		// $("#report").empty();

			           	}
		            }    
	           });
           }

 $( function() {
       $("#valid_from" ).datepicker({ dateFormat: 'dd-mm-yy' });
       $("#valid_to" ).datepicker({ dateFormat: 'dd-mm-yy' });
 });

 $(document).ready(function () {
      $('#select').selectize({
          sortField: 'text'
      });
  });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endsection
