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
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('asset/f2/' . $f2_data->picture . '') }}" alt="User profile picture">
                                </div>

                                @php
                                    $extname = $f2_data->extname === '[Select]' ? '' : $f2_data->extname;
                                    $mname = substr($f2_data->mname, 0, 1) . '.';
                                    $fullname = $f2_data->fname . ' ' . ($mname === '..' ? '' : $mname) . ' ' . $f2_data->lname . ' ' . $extname;
                                    
                                @endphp

                                <h3 class="profile-username text-center">{{ $fullname }}</h3>
                                <h6 class="text-muted text-center">
                                    <strong>{{ $f2_data->reg_type === 'All' ? 'Farmer and Fisherfolk' : $f2_data->reg_type }}</strong>
                                </h6>
                                <a href="{{ route('f2.index') }}" class="btn btn-primary btn-block"><b><i
                                            class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to List</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      {{-- menu start  --}}
                      @include('layouts/farmsidebar')
                      {{-- menu end  --}}


                    </div>

                    <div class="col-md-9">

                        <div class="card card-outline card-primary">

                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;Farm Activity&nbsp;
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                This will be the body of farm activity

                                <div style="position: absolute; top:0; right:0; z-index:10">
                                    @include('_message')
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
