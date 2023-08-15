@extends('layouts.app')

@section('content-details')
    {{-- All start with the row  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <h4 class="m-0 text-gray ">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-outline card-success">
                            <div class="card-header">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;Total Farmers/Fisherfolks&nbsp; <span class="badge badge-success p-2">
                                                0 </span>
                                        </h3>
                                    </div>

                                    <div class="btn-group " role="group" aria-label="Basic example">

                                        <a href="{{ route('f2.create') }}" class="btn btn-success shadow" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Register Farmer/Fisherfolk">
                                            <i class="fa-solid fa-plus"></i>&nbsp;Register</a>

                                        <a href="" class="btn btn-primary shadow" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Request for approval">
                                            <i class="fa-solid fa-person-circle-check"></i>&nbsp;Application&nbsp;
                                            <span class="badge badge-warning p-1">0</span></a>



                                    </div>

                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-2">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="card card-success card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                        src="{{ asset('asset/user/' . '' . '') }}"
                                                        alt="User profile picture">
                                                </div>

                                                <h3 class="profile-username text-center">
                                                    Sample Name</h3>

                                                <p class="text-muted text-center">Farmer&nbsp;
                                                    <span class="badge badge-info">Active</span>
                                                </p>
                                                <p class="text-muted text-center">
                                                    <a class="btn btn-md btn-primary" href="{{ route('f2.dashboard') }}"
                                                        data-bs-toggle="tooltip" 
                                                        title="Go to Farmer/Fisherfolk Dashboard">
                                                        <i class="fa-solid fa-gauge-high"></i>&nbsp;Dashboard</a>
                                                </p>


                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                </div>


                            </div>




                            <div style="position: absolute; top:0; right:0; z-index:10">
                                @include('_message')
                            </div>

                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
