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
                            {{ !empty(Breadcrumbs::render('import')) ? Breadcrumbs::render('import') : '' }}
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
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col">
                        <div class="card card-outline card-success">

                            {{-- <div class="card-body">
                                <label for="fileImport">Select file to Import</label>
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">

                                                <input type="file" name="file" id="file"
                                                    class="form-control" />
                                            </div>
                                            @error('fileImport')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success" value="Extract" />
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div> --}}

                            <div class="card-body">
                                <div class="row">

                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                        <div>
                                            <h6>Total Data
                                                Unloaded&nbsp;<strong>{{ number_format($entityVer->total(), 2, '.', ',') }}</strong>
                                            </h6>
                                        </div>
                                        <div>
                                            <ul class="pagination pagination-md m-0 float-right">
                                                {!! $entityVer->links() !!}
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="table-responsive fixed-table-body">
                                        <table class="table table-sm text-sm">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>reg_type</th>
                                                    <th>rsbsa_nat</th>
                                                    <th>control_no</th>
                                                    <th>rsbsa_loc</th>
                                                    <th>fishr_nat</th>
                                                    <th>fishr_loc</th>
                                                    <th>fname</th>
                                                    <th>mname</th>
                                                    <th>lname</th>
                                                    <th>extname</th>
                                                    <th>dob</th>
                                                    <th>pob</th>
                                                    <th>gender</th>
                                                    <th>a_barangay</th>
                                                    <th>a_citymun</th>
                                                    <th>a_province</th>
                                                    <th>a_region</th>
                                                    <th>contactno</th>
                                                    <th>is_loaded</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="" method="post">
                                                    @csrf


                                                    @foreach ($entityVer as $item)
                                                        <tr>
                                                            <td><input type="text" name="id[]"
                                                                    value="{{ $item->id }}" readonly></td>
                                                            <td><input type="text" name="reg_type[]"
                                                                    value="{{ $item->reg_type }}" readonly></td>
                                                            <td><input type="text" name="rsbsa_nat[]"
                                                                    value="{{ $item->rsbsa_nat }}" readonly></td>
                                                            <td><input type="text" name="control_no[]"
                                                                    value="{{ $item->control_no }}" readonly></td>
                                                            <td><input type="text" name="rsbsa_loc[]"
                                                                    value="{{ $item->rsbsa_loc }}" readonly></td>
                                                            <td><input type="text" name="fishr_nat[]"
                                                                    value="{{ $item->fishr_nat }}" readonly></td>
                                                            <td><input type="text" name="fishr_loc[]"
                                                                    value="{{ $item->fishr_loc }}" readonly></td>
                                                            <td><input type="text" name="fname[]"
                                                                    value="{{ $item->fname }}" readonly></td>
                                                            <td><input type="text" name="mname[]"
                                                                    value="{{ $item->mname }}" readonly></td>
                                                            <td><input type="text" name="lname[]"
                                                                    value="{{ $item->lname }}" readonly></td>
                                                            <td><input type="text" name="extname[]"
                                                                    value="{{ $item->extname }}" readonly></td>
                                                            <td>
                                                                @php
                                                                    $date = explode("/",$item->dob);
                                                                    $year = $date[2];
                                                                    $month = $date[1];
                                                                    $day = $date[0];

                                                                    $dobs = $year.'-'.$day.'-'.$month;
                                                                @endphp
                                                                <input type="text" name="dob[]"
                                                                    value="{{ $dobs  }}" readonly>

                                                            </td>
                                                            <td><input type="text" name="pob[]"
                                                                    value="{{ $item->pob }}" readonly></td>
                                                            <td><input type="text" name="gender[]"
                                                                    value="{{ $item->gender }}" readonly></td>
                                                            <td><input type="text" name="a_barangay[]"
                                                                    value="{{ $item->a_barangay }}" readonly></td>
                                                            <td><input type="text" name="a_citymun[]"
                                                                    value="{{ $item->a_citymun }}" readonly></td>
                                                            <td><input type="text" name="a_province[]"
                                                                    value="{{ $item->a_province }}" readonly></td>
                                                            <td><input type="text" name="a_region[]"
                                                                    value="{{ $item->a_region }}" readonly></td>
                                                            <td><input type="text" name="contactno[]"
                                                                    value="{{ $item->contactno }}" readonly></td>
                                                            <td><input type="text" name="is_loaded[]"
                                                                    value="{{ $item->is_loaded }}" readonly></td>

                                                        </tr>
                                                    @endforeach
                                                    <input type="submit" class="btn btn-success mb-2 float-right"
                                                        value="Load and Submit">

                                                </form>
                                            </tbody>





                                        </table>
                                    </div>



                                </div>
                            </div>


                            <div style="position: absolute; top:0; right:0; z-index:10">
                                @include('_message')
                            </div>

                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
