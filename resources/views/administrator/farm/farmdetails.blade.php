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
                            {{-- {{ Breadcrumbs::render() }} --}}

                            {{ Breadcrumbs::render('f2.farm', $f2_data) }}
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
                    <div class="col-md-3">


                        <!-- /.card -->
                        {{-- menu start  --}}
                        @include('layouts/farmsidebar')
                        {{-- menu end  --}}


                    </div>

                    <div class="col-md-9 ">


                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                       
                                        <h3 class="card-title"> <i class="fa-solid fa-users"></i>&nbsp;List of Farm</h3>
                                    </div>
                                    <a href="{{ route('f2.registerfarmdetails', $f2_data->ff_id) }}"
                                        class="btn btn-primary">Register New Area</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">

                                <div class="row m-2">

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-primary"><i class="far fa-envelope"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Area (has)</span>
                                                <span class="info-box-number">{{ $sum_area }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-red"><i class="far fa-envelope"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Parcels</span>
                                                <span class="info-box-number">{{ $sum_parcel }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">No. of Active Farm</span>
                                                <span class="info-box-number">{{ $count_farm_active }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <table class="table table-md" id="update_farmdetails_status">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Farm Name</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($farmdetails as $index => $item)
                                            <tr id="{{ route('f2.updatefarmstatus', $item->id) }} ">
                                                <td>{{ $index + 1 }}.</td>
                                                <td>{{ $item->farm_name }}</td>
                                                <td>{{ $item->location_purok . ', ' . strtoupper($item->BarName) }}
                                                </td>
                                                <td>
                                                    <select name="farm_status" id="farmdetails_status"
                                                        class="form-select form-select-sm">
                                                        @if ($item->farm_status == 'Active')
                                                            <option value="Active" selected>Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        @else
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive" selected>Inactive</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="{{ route('f2.getfarmdetails', $item->id) }}"
                                                        class="btn btn-sm btn-success p-1"><i
                                                            class="fa-solid fa-pen-to-square " title="Edit Program"></i></a>
                                                    <a href="" class="btn btn-sm btn-primary p-1"><i
                                                            class="fa-solid fa-pen-to-square"
                                                            title="Edit Program"></i>&nbsp;Add Activity</a>

                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
