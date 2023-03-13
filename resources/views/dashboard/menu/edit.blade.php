@extends('dashboard.mainlayouts')
@section('title', 'Edit Item')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Edit Item</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit</li>
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
                  <form action="{{route('menu.update',$menu->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     @method('PATCH')
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Item Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="name" name="name" class="form-control" placeholder="Item Name" value="{{$menu->name}}" required>
                           </div>
                        </div>
                        
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Item Type</label>
                              <span class="text-danger">*</span>
                             
                              <select class="form-control" name="menu_type">
                                 <option selected disabled>Select Food Type</option>
                                 <option value="Veg" {{$menu->menu_type == 'Veg'? "selected" : ""}}>Veg</option>
                                 <option value="Non-veg" {{$menu->menu_type == 'Non-veg'? "selected" : ""}}>Non-veg</option>
                              </select>
                              </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Category</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="category_id" id="category_id">
                                 <option value="">Select Category</option>
                                 @if(!empty($categories))
                                 @foreach($categories as $category)
                                 <option value="{{$category->id}}" {{ $menu->category_id == $category->id ? "selected" : ""}}>{{$category->category_name}}
                                 </option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cuisine</label>
                                <span class="text-danger">*</span>
                                <select class="form-control" name="cuisine_id" id="cuisine_id">
                                    <option value="">Select Cuisine</option>
                                    @if(!empty($cuisines))
                                       @foreach($cuisines as $k=>$val)
                                          <option value="{{$k}}" {{$menu->cuisine_id == $k ? 'selected' : ''}}>{{$val}}</option>
                                       @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Price</label>
                              <span class="text-danger">*</span>
                              <input type="number" id="price" name="price" class="form-control" placeholder="Price" value="{{$menu->price}}" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Image</label>
                              <input class="form-control" type="file" name="img_file">
                              @if(!empty($menu->image))
                              <a href="/storage/images/items/{{$menu->image}}" target="_blank">
                              <img class="avatar-img mt-2" src="/storage/images/items/{{$menu->image}}" alt="{{$menu->name}}" height="50px"></a>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Description</label>
                              <span class="text-danger">*</span>
                              <textarea rows="5" cols="5" class="form-control" name="description" placeholder="Description" required>{{$menu->description}}</textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                              <option value="1" {{$menu->status == 1 ? "selected" : ""}}>Active</option>
                              <option value="2" {{$menu->status == 2 ? "selected" : ""}}>Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Update">
                        <a href="{{route('menu.index')}}" class="btn btn-secondary">Back</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   // $('#category_id').on('change',function(){
   //    var catId = $(this).val();
   //    $.ajax({
   //            type:"post",
   //            url:"/cat",
   //            data:{_token:"{{csrf_token()}}",catId:catId},
   //            success:function(data){
   //                 if(data){
   //                   $('#subcategory_id').empty();
   //                      $('#subcategory_id').append('<option value="">Select Sub Category</option>');
   //                      $.each(data,function(key,val){
   //                         $('#subcategory_id').append('<option value="'+key+'">'+val+'</option>');
   //                      });
   //                 }else{
   //               $("#subcategory_id").empty();
   //             }
   //            }
   //        })
   // });

   $('#category_id').on('change', function() {
            var catId = $(this).val();
            $.ajax({
                type: "post",
                url: "/cat",
                data: {
                    _token: "{{ csrf_token() }}",
                    catId: catId
                },
                success: function(data) {
                    if (data) {
                        $('#cuisine_id').empty();
                        $('#cuisine_id').append('<option value="">Select Cuisine</option>');
                        $.each(data, function(key, val) {
                            $('#cuisine_id').append('<option value="' + key + '">' + val +
                                '</option>');
                        });
                    } else {
                        $("#cuisine_id").empty();
                    }
                }
            })
        });
</script>
@endsection