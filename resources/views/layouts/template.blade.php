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
                            {{ !empty(Breadcrumbs::render("Production")) ? Breadcrumbs::render("Production") : "" }}
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
               

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
