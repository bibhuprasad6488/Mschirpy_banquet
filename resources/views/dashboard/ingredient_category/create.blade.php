@extends('dashboard.mainlayouts')
@section('title', 'Add Ingredient Category')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Ingredient Category</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Ingredient Category</li>
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
                  <form action="{{route('ingredient_category.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <!-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        	  <button type="button" class="close" data-dismiss="alert">×</button>
                                @foreach ($errors->all() as $error)
                              			 <strong>{{ $error }}</strong>
                                @endforeach
                        </div>
                        @endif -->
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Category Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category Name" required>
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