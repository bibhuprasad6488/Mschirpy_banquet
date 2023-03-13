@extends('dashboard.mainlayouts')
@section('title', 'Edit Ingredient Item')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Edit Ingredient Item</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Ingredient Item</li>
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
                  <form action="{{route('ingredient-item.update',$ingredientItem->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     @method('PATCH')
                     <div class="row">
                        

                        

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Item Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Item Name" required value="{{$ingredientItem->item_name}}">
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
                                       <option value="{{$k}}" {{$ingredientItem->ingredient_cat_id == $k ? 'selected' : ''}}>{{$cat}}</option>
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
                                 <option value="KG" {{$ingredientItem->unit == 'KG' ? 'selected' : ''}}>KG</option>
                                 <option value="DOZ" {{$ingredientItem->unit == 'DOZ' ? 'selected' : ''}}>DOZ</option>
                                 <option value="LTR" {{$ingredientItem->unit == 'LTR' ? 'selected' : ''}}>LTR</option>
                                 <option value="GALLON" {{$ingredientItem->unit == 'GALLON' ? 'selected' : ''}}>GALLON</option>
                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Department Name</label>
                              <span class="text-danger">*</span>
                              <select name="department[]" id="department_id" class="form-control js-example-basic-multiple js-states" multiple="multiple" placeholder="Select Departments">
                                 @if(!empty($departments))
                                    @foreach($departments as $k=>$department)
                                       <option value="{{$k}}" {{in_array($k,$depArr) ? 'selected' : ''}}>{{$department}}</option>
                                    @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Brand</label>
                              <span class="text-danger">*</span>
                              <select class="js-example-basic-multiple js-states form-control" name="brand[]" id="brand" multiple="multiple" required placeholder="Select Brands" onchange="changebrand();">
                                    @if(!empty($brands))
                                    @foreach($brands as $k=>$v)
                                    <option value="{{$k}}" {{$ingredientItem->brand !='' && in_array($k,$ingredientItem->brand) ? 'selected' : ''}}>{{$v}}</option>
                                    @endforeach
                                    @else
                                    <option value="">No Item Found</option>
                                    @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group" >
                        <p id="show"></p>
                        <p id="hide">
                        @if(!empty($ingredientItem->custom_fields) && array_key_exists('default_brand',$ingredientItem->custom_fields))
                        <label>Set As Default</label>
                           <div class="card" id="hidecard">
                            <div class="card-body" style="padding: 0px;">
                              <table>
                              <thead>
                                 @if(!empty($default_brands))
                                    @foreach($default_brands as $k=>$val)
                                    <tr>
                                       <td style="width:5%" class="mr-3">
                                          <input type="checkbox" name="default_brand_earli[]" id="selectedchk" value="{{$k}}" style="accent-color:green;" checked />
                                       </td>
                                       <td class="text-left">
                                          <span>{{$val}}</span> 
                                       </td>
                                    </tr>
                                    @endforeach
                                @endif
                             </thead>
                           </table>
                            </div>
                           </div>
                           @endif
                        </p>
                        </div>
                       </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Price</label>
                              <span class="text-danger">*</span>
                              <input type="number" id="price" name="price" class="form-control" placeholder="Price" required value="{{$ingredientItem->price}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                              <option value="active" {{$ingredientItem->status == 'active' ? "selected" : ""}}>Active</option>
                              <option value="inactive" {{$ingredientItem->status != 'active' ? "selected" : ""}}>Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Update">
                        <a href="{{route('ingredient-item.index')}}" class="btn btn-secondary">Back</a>
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
       placeholder: "Select Brands",
       allowClear: true
   });
   });
   // $('#department_id').on('change',function(){
   //    var dep_id = $(this).val();
   //    $.ajax({
   //       type:"post",
   //       url:'/change_dept_brand',
   //       data:{_token:"{{csrf_token()}}",dep_id:dep_id},
   //       success:function(data){
   //          console.log(data);
   //          $("#brand").empty();
   //        $.each(data,function(key, value){
   //             $("#brand").append('<option value=' + value.id + '>' + value.brand_name + '</option>');
   //           });
   //       }
   //    });
   // });

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
            if(data !=''){
               $('#show').html(data);
               $('#hide').hide();
               $('#hidecard').hide();
            }
         }
      });
}
</script>
@endpush