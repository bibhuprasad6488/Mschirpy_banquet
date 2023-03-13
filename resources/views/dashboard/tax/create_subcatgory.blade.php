@extends('dashboard.mainlayouts')
@section('title', 'Add Tax Subcategory')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Subcategory</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Tax Subcategory</li>
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
                  <form action="/taxcreate_subcategory" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Category</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="category_id">
                                 <option value="">Select Category</option>
                                 @if(!empty($tax_categories))
                                 @foreach($tax_categories as $category_name)
                                 <option value="{{$category_name->id}}">{{$category_name->category_name}}@if(!empty($category_name->taxcreate_subcategory->category_name))-{{$category->taxcreate_subcategory->category_name }} @endif</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Subcategory Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="taxcreate_subcategory" name="taxcreate_subcategory" class="form-control" placeholder="Sub Category Name" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                                 <option value="1">Active</option>
                                 <option value="2">Inactive</option>
                              </select>
                           </div>
                        </div>
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
