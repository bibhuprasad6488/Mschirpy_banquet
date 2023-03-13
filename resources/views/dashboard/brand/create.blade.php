@extends('dashboard.mainlayouts')
@section('title', 'Add Brand')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Brand</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Brand</li>
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
                  <form action="{{route('brand.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <!-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        	  <button type="button" class="close" data-dismiss="alert">×</button>
                                @foreach ($errors->all() as $error)
                              			 <strong>{{ $error }}</strong>
                                @endforeach
                        </div>
                        @endif -->
                  <div class="table-responsive">
                        <table class="datatable table" id="customFields">
                           <tbody>
                              <tr>
                               <!--   <td>
                                    <select class="form-control" name="department_id[]" >
                                       <option value="">Select Department</option>
                                       @if(!empty($departments))
                                          @foreach($departments as $k=>$department)
                                             <option value="{{$k}}">{{$department}}</option>
                                          @endforeach
                                       @endif
                                    </select>
                                 </td>
 -->                                 <td>
                                    <input type="text" id="brand_name" name="brand_name[]" class="form-control" placeholder="Brand Name" required>
                                 </td>
                                 <td>
                                    <button type="button" name="add" id="add" class="addCF btn btn-success">+</button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Save">
                        <input type="reset" class="btn btn-warning" value="Reset">
                        <a href="/brand" class="btn btn-secondary mx-1">Back</a>
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
$(".addCF").click(function(){
      $("#customFields").append('<tr><td><input type="text" id="brand_name" name="brand_name[]" class="form-control" placeholder="Brand Name" required></td><td><button type="button" name="remove" id="remove" class="remCF btn btn-danger">-</button></td></tr>');
   });
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
</script>
@endpush