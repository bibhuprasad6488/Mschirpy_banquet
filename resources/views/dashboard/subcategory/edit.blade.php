@extends('dashboard.mainlayouts')
@section('title', 'Edit Sub Category')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Edit Sub Category</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Sub Category</li>
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
                  <form action="{{route('subcategory.update',$subcat->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     @method('PATCH').
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Category</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="category_id">
                                 <option value="">Select Category</option>
                                 @if(!empty($categories))
                                 @foreach($categories as $category)
                                 <option value="{{$category->id}}" {{ $subcat->category_id == $category->id ? "selected" : ""}}>{{$category->category_name}}
                                 @if(!empty($category->cuisine->cuisine_name))
                                 -{{$category->cuisine->cuisine_name}}
                                 @endif
                                 </option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Subcategory Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" placeholder="Sub Category Name" required value="{{$subcat->subcategory_name}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                              <option value="1" {{$subcat->status == 1 ? "selected" : ""}}>Active</option>
                              <option value="2" {{$subcat->status == 2 ? "selected" : ""}}>Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Update">
                        <a href="{{route('subcategory.index')}}" class="btn btn-secondary">Back</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection