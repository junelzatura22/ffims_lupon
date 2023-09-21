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

                            {{ Breadcrumbs::render('farmactivity', $f2_data) }}
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


                        @include('layouts/farmsidebar')


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
                                {{-- start of the card body  --}}
                                @foreach ($farmdetails as $item)
                                    <div class="row mb-3 shadow pb-2 pt-2">

                                        <div class="col-md-3 border border-success rounded">
                                            <div class="card" style="font-size: 90%">
                                                <img src="{{ asset('asset/farm/farm.jpg') }}" class="card-img-top mt-1"
                                                    alt="...">

                                                <div class="card-body">
                                                    <strong>{{ $item->farm_name }}</strong>

                                                    <ul class="list-group">
                                                        <li class="list-group-item p-1">Area:
                                                            {{ $item->total_area }}&nbsp;(has)</li>
                                                        <li class="list-group-item p-1">Barangay: {{ $item->BarName }}</li>
                                                        <li class="list-group-item p-1"> {{ $item->id }}</li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-md-9">
                                            <div class="card card-default collapsed-card ">
                                                <div class="card-header">


                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-card-widget="collapse"><i class="fas fa-plus"></i>&nbsp;Add
                                                            Activity
                                                        </button>
                                                    </div>

                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" class="form-label">Commodity</label>
                                                            <select name="program_id" id="program_id"
                                                                class="form-select form-select-sm">
                                                                <option value="">[Select Programs]</option>
                                                                @foreach ($programData as $programs)
                                                                    <option value="{{ $programs->program_id }}">
                                                                        {{ $programs->program_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="" class="form-label">Sub-Commodity</label>
                                                            <select name="pc_id" id="pc_id"
                                                                class="form-select form-select-sm">
                                                                <option value="">[Sub-Commodity]</option>

                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="" class="form-label">Area (Has)</label>
                                                            <input type="text" name="area" id="area"
                                                                placeholder="Enter Area" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="card">

                                                <!-- /.card-header -->
                                                <div class="card-body p-0">

                                                    <table class="table table-sm ">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Activity</th>
                                                                <th class="text-center">Area</th>
                                                                <th class="text-center">Farm Type</th>
                                                                <th class="text-center">Is organic</th>
                                                                <th>Label</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1.</td>
                                                                <td>Rice</td>
                                                                <td class="text-center">O.5</td>
                                                                <td class="text-center">Irrigated</td>
                                                                <td class="text-center">No</td>


                                                                <td>
                                                                    <a href="" class="btn btn-sm btn-success p-1"><i
                                                                            class="fa-solid fa-pen-to-square "
                                                                            title="Edit Program"></i></a>


                                                                </td>
                                                            </tr>



                                                        </tbody>
                                                    </table>


                                                </div>
                                                <div class="card-footer">
                                                    <h6>Total Area: <strong>0</strong>&nbsp;(has)</h6>
                                                </div>


                                                <!-- /.card-body -->
                                            </div>
                                        </div>




                                    </div>
                                @endforeach



                                {{-- end of the card body  --}}




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
