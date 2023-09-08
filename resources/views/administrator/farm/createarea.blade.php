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
                    <div class="col">

                        <div class="card card-outline card-primary">

                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;Farm Details&nbsp;
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" id="admin_farmdetails">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Farm Name">Farm Name</label>
                                                <input type="text" name="farm_name" id="farm_name" class="form-control"
                                                    placeholder="Farm Name" readonly>
                                            </div>
                                            @error('farm_name')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="No. of Parcel">No. of Parcel</label>
                                                <input type="text" name="no_of_parcel" id="no_of_parcel"
                                                    class="form-control" placeholder="No. of Parcel">
                                            </div>
                                            @error('no_of_parcel')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Area">Total Area</label>
                                                <input type="number" name="total_area" id="total_area" class="form-control"
                                                    placeholder="Total Area">
                                            </div>
                                            @error('total_area')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Area">Ownership</label>
                                                <select name="ownership_type" id="ownership_type" class="form-select">
                                                    <option value="">[Select Ownership]</option>
                                                    <option value="Registered Owner">Registered Owner</option>
                                                    <option value="Tenant">Tenant</option>
                                                    <option value="Lessee">Lessee</option>
                                                </select>
                                            </div>
                                            @error('ownership_type')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="Area">Name of Farmers<a href="#"
                                                        id="add_name_of_owner" class="">
                                                        <i class="fa-solid fa-plus pointer"></i>Add More
                                                    </a></label>

                                                <div class="row" id="more_owner">

                                                    <div class="col d-flex align-items-center">
                                                        <input type="text" name="name_of_owner[]" id="name_of_owner"
                                                            class="form-control mr-1 mb-1" placeholder="Name of Owner">
                                                        {{-- <a href="#" id="remove_name_of_owner">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </a></label> --}}
                                                    </div>

                                                </div>

                                            </div>

                                            @error('name_of_owner')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="Area">Lattitude</label>
                                                <input type="text" name="lat" id="lat" class="form-control"
                                                    placeholder="Lattitude">
                                            </div>
                                            @error('lat')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="Area">Longitude</label>
                                                <input type="text" name="long" id="long" class="form-control"
                                                    placeholder="Longitude">
                                            </div>
                                            @error('long')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row"></div>
                                    <div class="row">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('f2.farm', $f2_data->ff_id) }}"><i
                                                    class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to Farm Details</a>
                                            <input type="submit" class="col-md-1 form-control btn btn-success"
                                                value="Register">

                                        </div>

                                    </div>


                                </form>

                                <div style="position: absolute; top:0; right:0; z-index:10">
                                    @include('_message')
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <section>
    </div>


    <!-- /.content -->
@endsection
