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

                                                    </ul>

                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-md-9">
                                            <div class="card card-default collapsed-card ">
                                                <div class="card-header">


                                                    <div class="card-tools">

                                                        <a href="{{ route('f2.createActivity', ['id' => $f2_data->ff_id, 'fid' => $item->id]) }}"
                                                            class="btn btn-sm btn-success"><i
                                                                class="fas fa-plus"></i>&nbsp;Add
                                                            Activity
                                                        </a>
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

                                                            @php
                                                                
                                                                $modelData = \App\Models\FarmActivity::showAllFarmActivity($item->id);
                                                                $totalArea = 0;
                                                            @endphp

                                                            @foreach ($modelData as $index => $farmActivity)
                                                                <tr>
                                                                    <td>{{ $index + 1 . '.' }}</td>

                                                                    @php
                                                                        $farmCommodity = $farmActivity->commodity . ', ' . $farmActivity->subcommododity;
                                                                        $farmComName = '';
                                                                        
                                                                        switch ($farmCommodity) {
                                                                            case 'RICE, RICE':
                                                                                $farmComName = 'RICE';
                                                                                break;
                                                                            case 'CORN, CORN':
                                                                                $farmComName = 'CORN';
                                                                                break;
                                                                            default:
                                                                                $farmComName = $farmCommodity;
                                                                                break;
                                                                        }
                                                                        
                                                                    @endphp

                                                                    <td>{{ $farmComName }}
                                                                    </td>
                                                                    <td class="text-center">{{ $farmActivity->area }}</td>

                                                                    @php
                                                                        $totalArea += $farmActivity->area;
                                                                    @endphp

                                                                    <td class="text-center">{{ $farmActivity->farmtype }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        {{ $farmActivity->is_organic }}</td>
                                                                    <td>
                                                                        <a href="{{ route('f2.updateactivity', ['id' => $f2_data->ff_id, 'fid' => $item->id, 'aid' => $farmActivity->id]) }}"
                                                                            class="btn btn-sm btn-success p-1"><i
                                                                                class="fa-solid fa-pen-to-square "
                                                                                title="Edit Program"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>


                                                </div>
                                                <div class="card-footer">
                                                    <h6>Total Area: <strong>{{ $totalArea }}</strong>&nbsp;(has)</h6>
                                                </div>


                                                <!-- /.card-body -->
                                            </div>




                                        </div>





                                    </div>
                                @endforeach

                                <div style="position: absolute; top:0; right:0; z-index:10">
                                    @include('_message')
                                </div>

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
