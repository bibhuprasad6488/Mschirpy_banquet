<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title>Ms Chirpy|Supplier Price Chart</title>
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/logos/fav.png')}}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css')}}">
      <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css')}}">
      <!-- Feathericon CSS -->
      <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css')}}">
      <link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css')}}">
      <link rel="stylesheet" href="{{ asset('admin/assets/plugins/summernote/dist/summernote-bs4.css')}}">
      <!-- Main CSS -->
      <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css')}}">
      <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css')}}">
      <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-datetimepicker.min.css')}}">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <style type="text/css">
         .select2-selection--multiple{
         height:2.4rem;
         }
         .ui-widget-header {
         border: 1px solid #dddddd;
         background: #57c62e;
         color: #0d0d0d;
         font-weight: bold;
         }
         #valid_form { display: flex; }
         #valid_date{ flex-grow: 1; width: 20%;}
         .swal2-title{font-size: 25px !important;}
         #edd:hover{
          border: 1px solid gray;
         }
         input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
      </style>
      <!--[if lt IE 9]>
      <script src="{{ asset('admin/assets/js/html5shiv.min.js')}}"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->
      <!-- Datatables CSS -->
      <link rel="stylesheet" href="{{ asset('admin/assets/plugins/datatables/datatables.min.css')}}">
      <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/select2.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/swal.js')}}"></script>
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
      <script src="{{ asset('admin/assets/ckeditor/ckeditor.js')}}"></script>
      @stack('style')
   </head>
   <body>
      <!-- Main Wrapper -->
      <div class="main-wrapper">
      <!-- Header -->
      <div class="header">
         <!-- Logo -->
         <div class="header-left">
            <a href="#" class="logo">
            <img src="{{asset('admin/assets/logos/logo_mschirpy.png')}}" alt="Logo" height="50px">
            </a>
            <a href="#" class="logo logo-small">
            <img src="{{asset('admin/assets/logos/logo_mschirpy.png')}}" alt="Logo" width="30" height="50">
            </a>
         </div>
         <!-- Header Right Menu -->
         <ul class="nav user-menu">
            <!-- App Lists -->
            <li class="nav-item dropdown app-dropdown">
               <ul class="dropdown-menu app-dropdown-menu">
                  <li>
                     <div class="dropdown-menu">
                        <div class="user-header">
                           <div class="avatar avatar-sm">
                              <img src="{{asset('admin/assets/img/noImage.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
                           </div>
                        </div>
                        <a class="dropdown-item" href="#">My Profile</a>
                     </div>
                  </li>
               </ul>
            </li>
         </ul>
         <!-- /Header Right Menu -->
      </div>
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Supplier</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Supplier</li>
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
                  <form id="valid_form" class="d-flex justify-content-end" action="/supplier/change_validity" method="post">
                    @csrf
                    <input type="hidden" name="supplier_id" id="supplier_id" value="{{$supplier->id}}">
                     <button type="button" class="form-control btn-sm  btn btn-warning mr-2" style="width:10%;color:#fff; cursor: none">Valid For {{$valid_months}} Month(s)</button>
                     <input type="text" id="valid_from" class="form-control datepicker mr-2" name="valid_from" style="width:12%;" placeholder="Valid From"  value="{{date('d-m-Y',strtotime($supplier->valid_from))}}" />
                     <input type="text" id="valid_to" class="form-control datepicker mr-2" name="valid_to" style="width:12%;" placeholder="Valid To" value="{{date('d-m-Y',strtotime($supplier->valid_to))}}">
                     <button type="submit" class="form-control btn-sm  btn btn-primary" style="width:5%;color:#fff;">Change</button>
                  </form>
                  @if($countprice < 1)
                  <button type="button" class="btn btn-primary float-right mt-2" onclick="finalsubmit('{{$supplier->id}}')">Final Submit</button>
                  @endif 
                  <div class="table-responsive">
                     <table class="table" id="customFields">
                        <thead>
                           <tr class="text-center">
                              <th>#</th>
                              <th>Item Name</th>
                              <th>Category</th>
                              <th>Department</th>
                              <th>MRP</th>
                              <th>Quantity</th>
                              <th>Brand</th>
                              <th>Supplier Price</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody>
                           <form action="/supplier/save_sipplier_price" method="post" >
                              @csrf
                              <input type="hidden" name="supplier_id" id="supplier_id" value="{{$supplier->id}}">
                              @if(!empty($cats_with_items))
                              @php
                                $counter = 1;
                              @endphp
                              @foreach($cats_with_items as $catval)
                              @php 
                                $priceChart = \App\http\Controllers\IngredientItemController::check_existing_data($supplier->id, $catval->cat_id, $catval->item_id);
                                $supplierbrands = [];
                                $storeddata = [];
                                if(!empty($priceChart)){
                                  foreach($priceChart->data as $kbrand => $vprice){
                                    $supplierbrands[] = $kbrand;
                                    $storeddata[$kbrand] = $vprice;
                                  }
                                }
                                $cntsecnd = 1; 
                                @endphp
                                @foreach($catval->brands as $kb => $brnd)

                                @php
                                if($cntsecnd == 1){
                                $c = count($catval->brands);
                                }else{
                                $c = ""; 
                                }
                              @endphp
                              <tr class="text-center" id="firstrow{{$catval->id}}">
                                 @if($cntsecnd == 1)
                                 <td rowspan="{{$c}}" style="vertical-align : middle;text-align:center;">
                                    {{$counter}} 
                                    
                                 </td>
                                 <td rowspan="{{$c}}" style="vertical-align : middle;text-align:center;">
                                    <span>{{$catval->ingredient_item->item_name}}</span>
                                    <input type="hidden" name="item_id[]" id="item_id{{$counter}}" value="{{$catval->ingredient_item->id}}">
                                 </td>
                                 <td rowspan="{{$c}}" style="vertical-align : middle;text-align:center;">
                                    <span>{{$catval->ing_cat->category_name}}</span>
                                    <input type="hidden" name="cat_id[]" id="cat_id{{$counter}}" value="{{$catval->cat_id}}">
                                  </td>
                                 <td rowspan="{{$c}}" style="vertical-align : middle;text-align:center;">
                                    <span>{{$catval->department->department_name}}</span>
                                    <input type="hidden" name="department_id[]" id="department_id{{$counter}}" value="{{$catval->department->id}}">
                                  </td>
                                 <td rowspan="{{$c}}" style="vertical-align : middle;text-align:center;">
                                    <span>&#x20b9</span>
                                    <input type="number" name="mrp[]" class=""  style=" border: 1px solid #ada4a469; padding: 7px; border-radius: 5px;" value="{{$catval->ingredient_item->price}}">
                                 </td>
                                 <td rowspan="{{$c}}" style="vertical-align : middle;text-align:center;">
                                    {{$catval->qty}}
                                    <input type="hidden" name="qty[]" value="{{$catval->qty}}">
                                 </td>
                                 @endif
                                 <td >
                                    @if(!in_array($brnd,$supplierbrands))
                                    <select name="brand[{{$catval->ingredient_item->id}}][]" class="form-control" onchange="checkbrand('{{$catval->ingredient_item->id}}','{{$counter}}','{{$cntsecnd}}')" id="brnd{{$counter}}_{{$cntsecnd}}">
                                       <option selected disabled>Select Brand</option>
                                       @if(!empty($brands))
                                         @foreach($brands as $k=>$v)
                                           @if(in_array($k,$catval->brands))
                                            <option value="{{$k}}">{{$v}}</option>
                                           @endif
                                         @endforeach
                                       @endif
                                    </select>
                                    @else
                                      {{App\http\Controllers\IngredientItemController::find_brand_name($brnd)}}
                                    @endif
                                 </td>
                                 <td>
                                  @if(!in_array($brnd,$supplierbrands))
                                    <input type="number" class="form-control" name="supplier_price[{{$catval->ingredient_item->id}}][]">
                                  @else
                                    {{$storeddata[$brnd]}} 
                                  @endif
                                 </td>
                                 <td>
                                   @if(in_array($brnd,$supplierbrands))
                                   <a href="#" onclick="delprice('{{$supplier->id}}','{{$catval->cat_id}}','{{$catval->department->id}}','{{$catval->ingredient_item->id}}','{{$brnd}}')" title="Delete">
                                     <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                   </a>
                                   @endif
                                 </td>
                              </tr>
                                @php
                                  $cntsecnd++;
                                @endphp
                                @endforeach
                                @php
                                  $counter++;
                                @endphp
                                @endforeach
                              @endif
                              <tr>
                                 <td colspan="6">
                                  @if($countprice == 0)
                                    <button type="submit" class="btn btn-primary mr-3">Save</button>
                                  @endif
                                    <button type="button" class="btn btn-warning" style="color:#fff;" onclick="viewall('{{$supplier->id}}')">View</button>
                                 </td>
                              </tr>
                           </form>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog" >
        <div class="modal-dialog modal-lg">
          
       <!-- Modal content-->
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title float-left">History</h4>
            </div>
            <div class="modal-body">
              <div id="his"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
      <!-- Bootstrap Core JS -->
      <script src="{{ asset('admin/assets/js/popper.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/bootstrap.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/moment.min.js')}}"></script>
      <script src="{{ asset('admin/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
      <!-- Slimscroll JS -->
      <script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
      <script src="{{ asset('admin/assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
      <!-- Datatables JS -->
      <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{ asset('admin/assets/plugins/datatables/datatables.min.js')}}"></script>
      <script src="{{ asset('admin/assets/plugins/raphael/raphael.min.js')}}"></script>
      <script src="{{ asset('admin/assets/plugins/morris/morris.min.js')}}"></script>
      <!-- <script src="{{ asset('admin/assets/js/chart.morris.js')}}"></script> -->
      <!-- Custom JS -->
      <script src="{{ asset('admin/assets/js/script.js')}}"></script>
      <script>
         $( function() {
           $( "#valid_from" ).datepicker({ dateFormat: 'dd-mm-yy' });
           $( "#valid_to" ).datepicker({ dateFormat: 'dd-mm-yy' });
         });
         function checkbrand(itemId, cnter, sec_cntr){
            var brand = $('#brnd'+cnter+'_'+sec_cntr).val();
            var vals1=[];
            $('select[name="brand['+itemId+'][]"] option:selected').each(function() {
                vals1.push($(this).val());
             });
            var val1 = vals1.filter(function (el) {
              return el != null && el != "";
            });
             const counts = {};
             val1.forEach((x) => {
              counts[x] = (counts[x] || 0) + 1;
              });
             var msg = "Notexist";
              for (const [key, value] of Object.entries(counts)) {
                  if(value > 1){
                      msg = "Exist";
                      Swal.fire('This brand is already exist for this item');
                      $('#brnd'+cnter+'_'+sec_cntr).prop('selectedIndex',0);
                  }
              }
        }

        function viewall(supplier_id)
        {
          $.ajax({
            type:'post',
            url:'/supplier/view_history',
            data:{_token:"{{csrf_token()}}",supplier_id:supplier_id},
            success:function(data){
              console.log(data);
              $('#myModal').modal('show');
              $('#his').html(data);
            }
          });
        }

        function delprice(supplier_id, cat_id, dep_id, item_id, brnd_id)
        {
          Swal.fire({
            title: 'Are you sure to delete this price',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          })

          .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'/supplier/delete_brand_price',
                    data:{_token:"{{csrf_token()}}",supplier_id:supplier_id,cat_id:cat_id,dep_id:dep_id,item_id:item_id,brnd_id:brnd_id},
                    success:function(data){
                      console.log(data)
                        if(data == 'deleted'){
                          location.reload();
                        }
                    }
                  });
            }
          })
        }

         function finalsubmit(supplier_id)
         {
            Swal.fire({
            title: 'Would You Like to Submit',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Make Changes',
            confirmButtonText: 'Yes, Submit It'
          })

          .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type:'post',
                    url:'/supplier/save_final_price',
                    data:{_token:"{{csrf_token()}}",supplier_id:supplier_id},
                    success:function(data){
                      console.log(data);
                      if(data == 'delete'){
                          location.reload();
                        }
                    }
                  });
            }
          })
         }  
         
      </script>
   </body>
</html>