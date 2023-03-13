@extends('dashboard.mainlayouts')
@section('title', 'Edit Tax Sub Category')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Edit Tax Sub Category</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Tax Sub Category</li>
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
                  <form action="/update_subcat" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="hdnid" value="{{$subcat->id}}">
                     <div class="row">
                    
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Percentage</label>
                              <span class="text-danger">* (%)</span>
                              <input type="number" id="subcategory" name="subcategory" class="form-control" placeholder="Sub Category Name" required value="{{$subcat->subcat}}">
                           </div>
                        </div>
                          <div class="col-md-6">
                           <div class="form-group">
                              <label>Category</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="category_id">
                                 <option value="">Select Category</option>
                                 @if(!empty($taxcats))
                                 @foreach($taxcats as $k=>$cat)
                                    <option value="{{$k}}" {{$k == $subcat->category ? 'selected' : ''}}> {{$cat}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                              <option value="active" {{$subcat->status == 'active' ? "selected" : ""}}>Active</option>
                              <option value="inactive" {{$subcat->status == 'inactive' ? "selected" : ""}}>Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Update">
                        <a href="/list_subcat" class="btn btn-secondary">Back</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection