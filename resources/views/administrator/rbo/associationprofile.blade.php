@extends('layouts.app')

@section('content-details')
    {{-- All start with the row  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="col">
                        <h4 class="m-0 text-gray ">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h4>
                    </div><!-- /.col --> --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 text-info">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h6>
                        </div><!-- /.col -->
                        <div>
                            {{ Breadcrumbs::render('associationProfile') }}
                        </div><!-- /.col -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title text-info">
                                <i class="fa-solid fa-people-roof"></i>
                                </i>&nbsp;Association Profile
                            </h3>
                        </div>
                        <div class="card-body">
                            {{-- start of card body  --}}
                            <div class="row">

                                <div class="col-md-6">
                                    <!-- Box Comment -->
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div>
                                                <h6 class="text-center"><strong>Association Name</strong></h6>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="user-block">
                                                    <img class="img-circle" src="{{ asset('/dist/img/user1-128x128.jpg') }}"
                                                        alt="User Image">
                                                    <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                                                    <span class="description">Association President</span>
                                                </div>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">

                                            <div class="card">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <h3 class="card-title text-primary">List of Officials</h3>

                                                                <div class="card-tools">
                                                                    <a href="" class="btn btn-sm btn-primary "
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Add Member">
                                                                        <i class="fa-solid fa-user-plus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th>Task</th>
                                                                        <th>Progress</th>
                                                                        <th style="width: 40px">Label</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1.</td>
                                                                        <td>Update software</td>
                                                                        <td>
                                                                            <div class="progress progress-xs">
                                                                                <div class="progress-bar progress-bar-danger"
                                                                                    style="width: 55%"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td><span class="badge bg-danger">55%</span></td>
                                                                    </tr>



                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.card-body -->


                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <div class="card-header">
                                                            <h3 class="card-title text-primary">List of Members</h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body p-0">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th>Task</th>
                                                                        <th>Progress</th>
                                                                        <th style="width: 40px">Label</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1.</td>
                                                                        <td>Update software</td>
                                                                        <td>
                                                                            <div class="progress progress-xs">
                                                                                <div class="progress-bar progress-bar-danger"
                                                                                    style="width: 55%"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td><span class="badge bg-danger">55%</span></td>
                                                                    </tr>



                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.card-body -->

                                                    </div>
                                                </div>




                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- end of card body  --}}
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
