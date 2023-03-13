@extends('dashboard.mainlayouts')
@section('title', 'Customer review')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Customer review</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Customer review</li>
                        </ul>
                    </div>

                    <!-- 	<div class="panel-heading col-md-2">
             @can('items.write')
        <a href="" class="btn btn-block btn-primary">Add Item</a>
    @endcan
                </div> -->

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
                                <table class="datatable table table-responsive table-stripped">
                                    <thead>
                                        <tr style="text-transform: capitalize;">
                                            <th>#</th>
                                            <th>customer_name</th>
                                            <th>room_no</th>
                                            <th>dob</th>
                                            <th>anniversary</th>
                                            <th>staff</th>
                                            <th>service</th>
                                            <th>about_altius</th>
                                            <th>vibe</th>
                                            <th>cleanliness</th>
                                            <th>food_quality</th>
                                            <th>delight_or_disapoint</th>
                                            <th>staff_service_exp</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($reviews))
                                            @foreach ($reviews as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $val->customer_name }}</td>
                                                    <td>{{ $val->room_no }}</td>
                                                    <td>{{ $val->dob }}</td>
                                                    <td>{{ $val->anniversary }}</td>
                                                    <td>{{ $val->staff }}</td>
                                                    <td>{{ $val->service }}</td>
                                                    <td>{{ $val->about_altius }}</td>
                                                    <td>{{ $val->vibe }}</td>
                                                    <td>{{ $val->cleanliness }}</td>
                                                    <td>{{ $val->food_quality }}</td>
                                                    <td>{{ $val->delight_or_disapoint }}</td>
                                                    <td>{{ $val->staff_service_exp }}</td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>-- No Records Found --</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
