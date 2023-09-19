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
                            {{ Breadcrumbs::render('management.getdtoupdate',$programData) }}
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
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Update Program Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="programForm" method="post" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="program_name">*&nbsp;Program Name</label>
                                        <input type="text" name="program_name" class="form-control" id="program_name"
                                            placeholder="Enter Program/Commodity/Sector Name" value="{{$programData->program_name}}">
                                        <input type="hidden" name="created_by" id="created_by" placeholder="created_by"
                                            value="{{ Auth::user()->id }}">
                                    </div>
                                    @error('program_name')
                                        <div class="error-message">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('management.program') }}" class="btn btn-primary"><i
                                                class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to Program List</a>
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
