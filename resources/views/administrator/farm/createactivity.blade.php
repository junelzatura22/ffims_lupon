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

                            {{ Breadcrumbs::render('createActivity', $f2_data) }}
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
                                            </i>&nbsp;Create farm Activity
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="createActivity">
                                {{-- start of the card body  --}}

                                <div class="row mb-3 pt-2">

                                    <div class="col-md-4">
                                        <div class="card" style="font-size: 90%">
                                            <img src="{{ asset('asset/farm/farm.jpg') }}" class="card-img-top mt-1"
                                                alt="...">

                                            <div class="card-body">
                                                <strong>{{ $farmdetails->farm_name }}</strong>

                                                <ul class="list-group">
                                                    <li class="list-group-item p-1">Area:
                                                        <span
                                                            id="actualArea">{{ $farmdetails->total_area }}</span>&nbsp;(has)
                                                    </li>
                                                    <li class="list-group-item p-1">Barangay: {{ $farmdetails->BarName }}
                                                    </li>

                                                </ul>
                                                <div class="mt-2">
                                                    <p class="h6 bg-info p-1 rounded-sm"><small>Claimable Area</small>:
                                                        @php
                                                            $claimable = $farmdetails->total_area - $totalAreaRegistered;   
                                                        @endphp

                                                        <strong><span id="remainingArea">{{ $claimable }}</span></strong>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-md-8">
                                        <div class="card ">
                                            <div class="card-header">


                                                <div class="card-title">

                                                    <span class="float-start">
                                                        <small> <strong class="text-red">All fields (*) are
                                                                required!</strong></small>
                                                    </span>
                                                </div>

                                            </div>

                                            <div class="card-body">

                                                <form action="" method="post" id="saveCreateActivity">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;Commodity</label>
                                                            <select name="program_id" id="program_id"
                                                                class="form-select form-select-sm">
                                                                <option value="">[Select Programs]</option>
                                                                @foreach ($programData as $programs)
                                                                    <option
                                                                        value="{{ route('management.loadprogramcategory', $programs->program_id) . '@' . $programs->program_id }}">
                                                                        {{ $programs->program_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;Sub-Commodity</label>
                                                            <select name="pc_id" id="pc_id"
                                                                class="form-select form-select-sm">
                                                                <option value="">[Sub-Commodity]</option>

                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;Area (Has)</label>
                                                            <input type="text" name="area" id="area"
                                                                placeholder="Enter Area"
                                                                class="form-control form-control-sm">
                                                            <input type="hidden" name="farm_id" id="farm_id"
                                                                value="{{ $farmdetails->id }}">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;Hills</label>
                                                            <input type="text" name="hills" id="hills"
                                                                placeholder="Enter No. of Hills"
                                                                class="form-control form-control-sm">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;No. of
                                                                Heads</label>
                                                            <input type="number" name="no_of_heads" id="no_of_heads"
                                                                placeholder="Enter No. of Heads"
                                                                class="form-control form-control-sm" min="0">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;Farm Type</label>

                                                            <select name="farmtype" id="farmtype"
                                                                class="form-select form-select-sm">
                                                                <option value="">[ Select ]</option>
                                                                <option value="Irrigated">Irrigated</option>
                                                                <option value="Rainfed Upland">Rainfed Upland</option>
                                                                <option value="Rainfed Lowland">Rainfed Lowland
                                                                </option>
                                                                <option value="None">None</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;Is Organic?</label>
                                                            <select name="is_organic" id="is_organic"
                                                                class="form-select form-select-sm">
                                                                <option value="">[ Select ]</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="" class="form-label"><span
                                                                    class="text-red">*</span>&nbsp;Remarks</label>
                                                            <input type="text" name="remarks" id="remarks"
                                                                placeholder="Enter Remarks"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div>
                                                            <p class="text-red float-start"><strong>
                                                                        {{ $claimable <= 0 ? 'No Claimable Area!' : '' }}
                                                                    </strong></p>
                                                            <input type="submit" class="btn btn-sm btn-success float-end"
                                                                value="Save Farm Activity"
                                                                {{ $claimable <= 0 ? 'disabled' : '' }}>
                                                        </div>
                                                    </div>

                                                </form>



                                            </div>

                                        </div>

                                    </div>





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
