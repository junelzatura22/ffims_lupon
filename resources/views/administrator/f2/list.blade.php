@extends('layouts.app')

@section('content-details')
    {{-- All start with the row  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="m-0 text-gray ">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h4>
                        </div><!-- /.col -->
                        <div>
                            {{ Breadcrumbs::render() }}
                            {{-- {{ Breadcrumbs::render('management.getdtoupdate',$programData) }} --}}
                        </div><!-- /.col -->
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

                                        <a href="{{ route('f2.create') }}" class="btn btn-success shadow"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Register Farmer/Fisherfolk">
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


                                    @foreach ($f2 as $item)
                                        <div class="col-md-3">
                                            <div class="card card-success card-outline">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                        <img class="profile-user-img img-fluid img-circle"
                                                            src="{{ asset('asset/f2/' . $item->picture . '') }}"
                                                            alt="User profile picture">
                                                    </div>

                                                    @php
                                                        $extname = ( $item->extname === '[Select]' ? '' : $item->extname);
                                                        $mname = substr($item->mname, 0, 1) . '.';
                                                        $fullname = $item->fname . ' ' . ($mname === '..' ? '' : $mname) . ' ' . $item->lname.' '. $extname ;
                                                        $date = date_create($item->dob);
                                                        $dobs = date_format($date, 'F d, Y');
                                                    @endphp

                                                    <h3 class="profile-username text-center">
                                                        {{ $fullname }}</h3>
                                                    <h5 class="text-center"><small><strong>
                                                                {{ $dobs }}</strong></small></h5>

                                                    <p class="text-muted text-center">{{ $item->reg_type==="All" ? "Farmer and Fisherfolk" : $item->reg_type }}&nbsp;
                                                        <span class="badge badge-info">{{ $item->ff_status }}</span>
                                                    </p>
                                                    <p class="text-muted text-center">
                                                        <a class="btn btn-md btn-primary"
                                                            href="{{ route('f2.information', $item->ff_id) }}"
                                                            data-bs-toggle="tooltip"
                                                            title="Go to Farmer/Fisherfolk Dashboard">
                                                            <i class="fa-solid fa-gauge-high"></i>&nbsp;Go to&nbsp;{{$item->fname}}'s Account</a>
                                                    </p>


                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    @endforeach



                                </div>


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
