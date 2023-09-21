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
                                    <div class="row mb-3 shadow-sm pb-2">

                                        <div class="col-md-3 border border-success rounded">
                                            <div class="card" style="font-size: 90%">
                                                <img src="{{ asset('asset/farm/farm.jpg') }}" class="card-img-top mt-1"
                                                    alt="...">

                                                <div class="card-body">
                                                    <strong>{{ $item->farm_name }}</strong>
                                                    
                                                    <ul class="list-group">
                                                        <li class="list-group-item p-1">Area: {{ $item->total_area }}&nbsp;(has)</li>
                                                        <li class="list-group-item p-1">Location: {{ $item->total_area }}&nbsp;(has)</li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h3 class="card-title">List of activity</h3>
                                                        <a href="#" class="btn btn-sm btn-primary">Add Activity</a>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                    <table class="table table-sm">
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
