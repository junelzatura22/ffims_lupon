@extends('layouts.app')

@section('content-details')
    {{-- All start with the row  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 text-info">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h6>
                        </div><!-- /.col -->
                        <div>
                            {{ !empty(Breadcrumbs::render('Production')) ? Breadcrumbs::render('Production') : '' }}
                        </div><!-- /.col -->
                    </div>


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

                <div class="row p-1">
                    for search
                </div>

                <div class="row p-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h6>List of Farms</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-widget widget-user-2 shadow-sm">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-success">
                                            <h3>Nadia Carmichael</h3>
                                            <h6>Lead Developer</h6>
                                        </div>
                                        <div class="card-footer p-0">
                                            <ul class="nav flex-column">
                                                <li class="nav-item d-flex jus0tify-content-between align-items-center m-1">
                                                    <h6>Rice, 0.5 Hectares</h6>
                                                    <a href="#" class="nav-link btn btn-sm bg-primary">Production</a>
                                                </li>
                                                
                                            </ul>
                                        </div>
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
