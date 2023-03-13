@extends('dashboard.mainlayouts')
@section('title', 'Edit Brand')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Edit Brand</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Brand</li>
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
                  <form action="{{route('brand.update',$brand->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     @method('PATCH')
                     <div class="row">
                    <!--     <div class="col-md-6">
                           <div class="form-group">
                              <label>Department Name</label>
                              <span class="text-danger">*</span>
                              <select name="department_id" class="form-control">
                                 <option value="">Select Departname</option>
                                 @if(!empty($departments))
                                    @foreach($departments as $k=>$department)
                                       <option value="{{$k}}" {{$k == $brand->department_id ? 'selected' : ''}}>{{$department}}</option>
                                    @endforeach
                                 @endif
                              </select>
                           </div>
                        </div> -->
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Brand Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="brand_name" name="brand_name" class="form-control" placeholder="Brand Name" value="{{$brand->brand_name}}" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                              <option value="active" {{$brand->status == 'active' ? "selected" : ""}}>Active</option>
                              <option value="inactive" {{$brand->status != 'active' ? "selected" : ""}}>Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Update">
                        <a href="{{route('brand.index')}}" class="btn btn-secondary">Back</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection