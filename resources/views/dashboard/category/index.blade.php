@extends('dashboard.mainlayouts')
@section('title', 'Manage Categories')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-10">
                    <h3 class="page-title">Manage Categories</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Categories</li>
                    </ul>
                </div>
                
                <div class="panel-heading col-md-2">
                    @can('categories.write')
                         <a href="{{ route('category.create')}}" class="btn btn-block btn-primary">Add Category</a>
                    @endcan
                </div>
            
            </div>
        </div>
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
                            <div class="table-responsive">
                                <table class="datatable table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Cuisine Name</th>
                                            <th>Type</th>
                                            <th>Tax Type</th>
                                            <th>Tax Percentage</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($categories))
                                            @foreach($categories as $key => $val)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td style="text-transform: capitalize;">{{$val->category_name}}</td>
                                            <td>
                                            <a href="#" class="viewCuisine"
                                                data-id="{{ $val->id }}"><span
                                                    class="badge badge-success">View Cuisines Name</span></a>
                                                    </td>
                                        <!--    <td>{{$val->cuisine->cuisine_name ?? ''}}</td> -->
                                            <td>{{$val->type}}</td>
                                            <td>{{$val->tax_type}}</td>
                                            <td>{{$val->tax_percent}}%</td>
                                            <td>
                                                @if($val->status == 1)
                                                <a href="#"  class="badge badge-success" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Active</a>
                                                @else
                                                <a href="#" class="badge badge-danger" onclick="changestatus_chk('{{$val->id}}','{{$val->status}}')">Inactive</a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="actions">
                                                    @can('categories.write')
                                                    <a href="{{ route('category.edit',$val->id) }}" class="btn btn-sm bg-success-light mr-2" data-toggle="tooltip" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil-square-o text-success"></i>
                                                    </a>
                                                    @endcan
                                                    @can('categories.delete')
                                                    <form method="post" action="{{route('category.destroy',$val->id)}}" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" name="del" id="del" class="btn btn-sm bg-danger-light dele"><i class="fe fe-trash"></i></button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        @else
                                        <tr><td>-- No Records Found --</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    
                        <div id="modalItem" class="row text-center bg-light">
                            
                        </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                </div>
            </div>

        </div>
    </div>
                        </div>
                     </div>
                </div>
            </div>
    </div>
</div>





<script>
$('.dele').on('click',function(){
    var form =  $(this).closest("form");
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    })
});




function changestatus_chk(id,sts)
{
    Swal.fire({
      title: 'Are you sure to change the status !',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, change it!'
    })

    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
        type:"POST",
        url:"/category_change_status",
        data:{_token:"{{csrf_token()}}",id:id, sts:sts},
       success:function(data){
            location.reload();                
            }
        });
      }
    })
}



  $('.viewCuisine').on('click', function(e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: "post",
                url: "/show_Cuisine",
                data: {
                    _token: "{{ csrf_token() }}",
                    dataId: dataId
                },
                success: function(data) {
                    console.log(data);
                    // return false;
                  $('#modalItem').html("");
                    $.each(data, function(key, val) {
                      $('#modalItem').append("<div class='col-md-3  m-auto px-2 py-2'>"+val+"</div>" )});

                    $('#myModal').modal('show');
                }




                    
                });
            });

        
</script>

@endsection
