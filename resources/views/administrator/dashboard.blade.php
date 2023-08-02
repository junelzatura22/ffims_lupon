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
                        <h4 class="m-0 text-gray " >{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h4>
                    </div><!-- /.col -->
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{Auth::user()->role}} Dashboard</li>
                        </ol>
                    </div><!-- /.col --> --}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-indigo">
                            <div class="inner">
                                <h3>{{ $totalPrograms }}</h3>
                                <p>Programs/Sectors</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-file-contract"></i>
                            </div>
                            <a href="{{ route('management.program') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalProgramCategory }}</h3>
                                <p>Program Categories</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-folder"></i>
                            </div>
                            <a href="{{ route('management.programcategory') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                   
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row p-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Users</strong>&nbsp;<small>Technician, Administrator, Guest, Office Head</small></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-red">
                                        <div class="inner">
                                            <h3>{{ $totalTechnician }}</h3>
            
                                            <p>Technician</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-gradient-fuchsia">
                                        <div class="inner">
                                            <h3>{{ $totalAdministrator }}</h3>
            
                                            <p>Administrator</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-gradient-green">
                                        <div class="inner">
                                            <h3>{{ $totalOfficeHead }}</h3>
            
                                            <p>Office Head</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-gradient-indigo">
                                        <div class="inner">
                                            <h3>{{ $totalGuest }}</h3>
            
                                            <p>Guest</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
