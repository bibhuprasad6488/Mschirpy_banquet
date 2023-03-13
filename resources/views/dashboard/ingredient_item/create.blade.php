@extends('dashboard.mainlayouts')
@section('title', 'Add Ingredient Item')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Ingredient Item</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Ingredient Item</li>
               </ul>
            </div>
         </div>
      </div>
      <!-- /Page Header -->
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
                  <form action="{{route('ingredient-item.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Item Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Item Name" required>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Category Name</label>
                              <span class="text-danger">*</span>
                              <select name="ingredient_cat_id" id="ingredient_cat_id" class="form-control">
                                 <option value="">Select Category</option>
                                 @if(!empty($cats))
                                    @foreach($cats as $k=>$cat)
                                       <option value="{{$k}}">{{$cat}}</option>
                                    @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Unit</label>
                              <span class="text-danger">*</span>
                              <select name="unit" id="unit" class="form-control">
                                 <option value="">Select Unit</option>
                                 <option value="KG">KG</option>
                                 <option value="DOZ">DOZ</option>
                                 <option value="LTR">LTR</option>
                                 <option value="GALLON">GALLON</option>
                              </select>
                           </div>
                        </div>

                  <div class="col-md-6">
                           <div class="form-group">
                              <label>Department Name</label>
                              <span class="text-danger">*</span>
                              <select class="js-example-basic-multiple js-states form-control" name="department[]" id="department_id" multiple="multiple" required>
                                    <option value="">Select Department</option>
                                     @if(!empty($departments))
                                    @foreach($departments as $k=>$department)
                                       <option value="{{$k}}">{{$department}}</option>
                                    @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>



                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Brand</label>
                              <span class="text-danger">*</span>
                              <select class="js-example-basic-multiple js-states form-control" name="brand[]" id="brand" multiple="multiple" onchange="changebrand()"  required>
                                    <!-- <option value="">Select Brands</option> -->
                                 @if(!empty($brands))
                                    @foreach($brands as $k=>$brand)
                                       <option value="{{$k}}">{{$brand}}</option>
                                    @endforeach
                                 @endif

                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <p id="show"></p>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Price</label>
                              <span class="text-danger">*</span>
                              <input type="number" id="price" name="price" class="form-control" placeholder="Price" required>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                                 <option value="active">Active</option>
                                 <option value="inactive">Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Save">
                        <input type="reset" class="btn btn-warning" value="Reset">
                        <a href="/ingredient-item" class="btn btn-secondary mx-1">Back</a>

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
   $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
       // placeholder: "Select Brand",
       allowClear: true
   });
   });
function changebrand() {
   var val1=[]; 
  $('select[name="brand[]"] option:selected').each(function() {
   val1.push($(this).val());
  });
 var val2 = JSON.stringify(val1);
   $.ajax({
      type:"post",
      url:'/supplier/item_wise_brand',
      data:{_token:"{{csrf_token()}}",brand_ids:val2},
      success:function (data) {
         $('#show').html(data);
      }
   });
}
   // $('#department_id').on('change',function(){
   //    var dep_id = $(this).val();
   //    $.ajax({
   //       type:"post",
   //       url:'/change_dept_brand',
   //       data:{_token:"{{csrf_token()}}",dep_id:dep_id},
   //       success:function(data){
   //          console.log(data);
   //          $("#brand").empty();
   //          $.each(data,function(key, value){
   //             $("#brand").append('<option value=' + value.id + '>' + value.brand_name + '</option>');
   //           });
   //       }
   //    });
   // });
</script>
@endpush