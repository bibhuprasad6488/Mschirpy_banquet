@extends('dashboard.mainlayouts')
@section('title', 'Add Subcategory')
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
                  <li class="breadcrumb-item active">Add Subcategory</li>
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
                  <form action="{{route('subcategory.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Category</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="category_id">
                                 <option value="">Select Category</option>
                                 @if(!empty($categories))
                                 @foreach($categories as $category)
                                 <option value="{{$category->id}}">{{$category->category_name}}@if(!empty($category->cuisine->cuisine_name))-{{$category->cuisine->cuisine_name }} @endif</option>
                                 @endforeach
                                 @endif
                              </select>
                  
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Subcategory Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" placeholder="Sub Category Name" required>
                             
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