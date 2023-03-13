@extends('dashboard.mainlayouts')
@section('title', 'Edit department')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Edit department</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit department</li>
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
                  <form action="/update_department" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="id" value="{{$department->id}}">
                     <div class="row">    
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Department Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="department_name" name="department_name" class="form-control" placeholder="Department Name" value="{{$department->department_name}}" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                              <option value="active" {{$department->status == 'active' ? "selected" : ""}}>Active</option>
                              <option value="inactive" {{$department->status != 'active' ? "selected" : ""}}>Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Update">
                        <a href="/department_list" class="btn btn-secondary">Back</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection