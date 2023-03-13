@extends('dashboard.mainlayouts')
@section('title', 'Request Form')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Request Form</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Request Form</li>
               </ul>
            </div>
         </div>
      </div>
      <!-- /Page Header -->
      <div class="row">
         <div class="col-sm-12">
            <div class="card">

               <div class="card-body">
                  <div class="h5 mb-9 text-primary">Department : {{$departmentnm->department_name ?? ''}}</div>
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
                  <form action="/save_department_request" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="department_id" value="{{$departmentnm->id}}" />
                     <div class="row">
                        <div class="col-md-2 mb 5">Categories</div>
                        <div class="col-md-2 mb 5">Items</div>
                        <div class="col-md-6 mb 5">Brands</div>
                        <div class="col-md-1 mb 5">Quantities</div>
                        <div class="col-md-1 mb 5">Unit</div>
                     </div>

                     <div class="row">
                        @if(!empty($items))
                                 @foreach($items as $key => $val)

                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text" id="category" name="category[]" class="form-control" placeholder="Category"  value="{{$val->ingredient_category->category_name}}" readonly>
                              <input type="hidden" name="cat_id[]" value="{{$val->ingredient_category->id}}">

                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text" id="item" name="item[]" class="form-control" placeholder="Item" value="{{$val->item_name}}" readonly>
                              <input type="hidden" name="item_id[]" value="{{$val->id}}">
                           </div>
                        </div>
                        @php
                        if(!empty($val->brand)){
                           $arrBrand = $val->brand;
                        }else{
                           $arrBrand = [];
                        }
                         @endphp

                        <div class="col-md-6">
                          
                           <div class="form-group">
                                <select class="js-example-basic-multiple js-states form-control" name="brand[{{$key}}][]" id="brand[]" multiple="multiple">
                                 @if(!empty($val->selectedbrands))
                                     @foreach($val->selectedbrands as $k=>$v)
                                       <option value="{{$v->id}}" {{!empty($val->custom_fields) && array_key_exists('default_brand',$val->custom_fields) && in_array($v->id,$val->custom_fields['default_brand']) ? 'selected' : ''}}>{{$v->brand_name}}</option>
                                     @endforeach
                                  @endif
                                </select>
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <input type="text" id="qty" name="qty[]" class="form-control" placeholder="Qty">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <span class="badge badge-success">{{$val->unit}}</span>
                           </div>
                        </div>
                        @endforeach
                        @endif

                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <input type="submit" id="submit" class="btn btn-primary btn-block" name="submit" value="Save">
                           </div>
                     </div>
                     </div>
                     
                      <!-- <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary " name="submit" value="Save" style="width:200px;">
                     </div> -->
                    
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
</script>
@endpush
