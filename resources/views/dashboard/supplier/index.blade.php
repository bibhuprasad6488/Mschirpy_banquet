@extends('dashboard.mainlayouts')
@section('title', 'Manage Suppliers')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Manage Suppliers</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Suppliers</li>
                        </ul>
                    </div>

                    <div class="panel-heading col-md-2">

                        <a href="{{ route('supplier.create') }}" class="btn btn-block btn-primary">Add Supplier</a>

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
                                <table class="datatable table  table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier Name</th>
                                            <th>Category</th>
                                            <th>Bank Details</th>
                                            <th>Rate Valid from</th>
                                            <th>Rate Valid To</th>
                                            <th>Url</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($suppliers))
                                            @foreach ($suppliers as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $val->supplier_name }}</td>
                                                    <td>
                                                        <span class="badge badge-success"
                                                            onclick="showcatsname('{{ $val->id }}')"
                                                            style="cursor:pointer;">View all Category</span>
                                                    </td>


                                                    <td><a href="#" class="badge badge-warning" data-toggle="modal"
                                                            data-target="#myModal{{ $key }}">View</a></td>

                                                    <td>{{ date('d-m-Y', strtotime($val->valid_from)) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($val->valid_to)) }}</td>
                                                    <td>
                                                        @if (!empty($val->bank_details) && array_key_exists('supplier_url', $val->bank_details))
                                                            @php  $ur = $val->bank_details['supplier_url'];  @endphp
                                                            <span class="badge badge-warning" style="cursor: pointer"
                                                                onclick="viewUrl('{{ $ur }}')">View Url</span>
                                                        @else
                                                            <span class="badge badge-info urlshw" style="cursor: pointer"
                                                                onclick="showUrl('{{ $val->id }}')">Generate
                                                                Url</span>
                                                        @endif

                                                    </td>

                                                    <td class="d-flex">
                                                        @if ($val->status == 'active')
                                                            <a href="#" class="badge badge-success d-flex"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Active</a>
                                                        @else
                                                            <a href="#" class="badge badge-danger"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Inactive</a>
                                                        @endif
                                                    </td>


                                                    <td class="text-center">
                                                        <div class="actions">
                                                            <a href="{{ route('supplier.edit', $val->id) }}"
                                                                class="btn btn-sm bg-success-light mr-2">
                                                               <i class="fa fa-pencil-square-o text-success"></i>
                                                            </a>
                                                            <form method="post"
                                                                action="{{ route('supplier.destroy', $val->id) }}"
                                                                style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" name="del" id="del"
                                                                    class="btn btn-sm bg-danger-light dele"><i
                                                                        class="fe fe-trash"></i> </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <div id="myModal{{ $key }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 style="padding-left:28%;font-weight:bold;">BANK DETAILS
                                                                </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <div class="col-sm-12,col-md-12,col-xs-12">
                                                                        <div class="row">
                                                                            <div class="col-md-4 col-6">
                                                                                <p>BANK NAME:</p>
                                                                                <p>ACCOUNT N0:</p>
                                                                                <p>IFSC CODE:</p>
                                                                                <p>GSTIN:</p>
                                                                            </div>
                                                                            <div class="col-md-8 col-6">
                                                                                <p>{{ $val->bank_details['bank_name'] ?? '' }}
                                                                                </p>
                                                                                <p>{{ $val->bank_details['account_no'] ?? '' }}
                                                                                </p>
                                                                                <p>{{ $val->bank_details['ifsc_code'] ?? '' }}
                                                                                </p>
                                                                                <p>{{ $val->bank_details['gstin'] ?? '' }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>-- No Records Found --</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="cat_show" tabindex="-1" role="dialog" aria-labelledby="cat_show"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <h5 class="modal-title" id="cat_show">Category name</h5> -->
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th colspan="2">Category</th>

                                                </tr>
                                            </thead>
                                            <tbody id="catname">
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="url_show" tabindex="-1" role="dialog"
                                aria-labelledby="cat_show" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cat_show">Supplier URL</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/supplier/save_supplier_url" method="post">
                                            @csrf
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <input type="text" name="url" class="form-control urlfield"
                                                        required />
                                                    <input type="hidden" name="hdnSup_id" id="hdnSup_id">
                                                </div>
                                                <input type="submit" id="submit" class="btn btn-primary"
                                                    name="submit" value="Save">
                                            </div>
                                        </form>
                                        <div class="modal-footer mt-3">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="url_view" tabindex="-1" role="dialog"
                                aria-labelledby="cat_show" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cat_show">Supplier URL</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">

                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <span id="viewUr" style="font-size:13px;"></span>
                                        </div>
                                        <div class="modal-footer mt-3">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
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
        $('.dele').on('click', function() {
            var form = $(this).closest("form");
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



        function changestatus_chk(id, sts) {
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
                            type: "POST",
                            url: "/supplier_change_status",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                                sts: sts
                            },
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                })
        }

        function showUrl(supp_id) {
            $('#url_show').modal('show');
            $.ajax({
                type: "POST",
                url: "/supplier/url_generate",
                data: {
                    _token: "{{ csrf_token() }}",
                    supp_id: supp_id
                },
                success: function(data) {
                    console.log(data);
                    $('.urlfield').val(data.encodeurl);
                    $('#hdnSup_id').val(data.sup_id);
                }
            })
        }

        function viewUrl(url) {
            $('#url_view').modal('show');
            $('#viewUr').html(url);
        }


        function showcatsname(supp_id) {
            $('#cat_show').modal('show');
            $.ajax({
                type: "POST",
                url: "/supplier/show_supplier_cats",
                data: {
                    _token: "{{ csrf_token() }}",
                    supp_id: supp_id
                },
                success: function(data) {
                    if (data != '') {
                        var i = 1;
                        $('#catname').empty();
                        $.each(data, function(key, val) {
                            $('#catname').append("<tr>\
                                                 				<td>" + i + "</td>\
                                                 				<td>" + val.category_name + "</td>\
                                                 				</tr>");
                            i++;
                        });
                    } else {
                        $('#catname').append("<tr>\
                                                 				<td colspan='2'>No records found</td>\
                                                 				</tr>");
                    }
                }
            });
        }
    </script>

@endsection
