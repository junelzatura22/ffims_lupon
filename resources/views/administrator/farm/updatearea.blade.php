@extends('layouts.app')

@section('content-details')
    {{-- All start with the row  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="row mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="m-0 text-gray ">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h4>
                            </div><!-- /.col -->
                            <div>
                                {{-- {{ Breadcrumbs::render() }} --}}
                                {{ Breadcrumbs::render('updateFarmDetails', $f2_data) }}
                            </div><!-- /.col -->
                        </div>
                    </div>

                    @php
                        $extname = $f2_data->extname === '[Select]' ? '' : $f2_data->extname;
                        $mname = substr($f2_data->mname, 0, 1) . '.';
                        $fullname = $f2_data->fname . ' ' . ($mname === '..' ? '' : $mname) . ' ' . $f2_data->lname . ' ' . $extname;
                        
                        $farmId = $f2_data->fname . '' . $f2_data->ff_id . '' . $f2_data->lname;
                    @endphp
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
                                                    placeholder="Farm Name" readonly value="{{ $farmDetails->farm_name }}">
                                                {{-- validation not used  --}}
                                                @error('farm_name')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                                {{-- hide the owner name to access using jquery  --}}
                                                <input type="hidden" name="farm_owner_name" id="farm_owner_name"
                                                    class="form-control" placeholder="Farm Name" readonly
                                                    value="{{ $fullname }}">

                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="No. of Parcel"><strong class="text-red">*</strong>&nbsp;No. of
                                                    Parcel</label>
                                                <input type="number" name="no_of_parcel" id="no_of_parcel"
                                                    class="form-control" placeholder="No. of Parcel"
                                                    value="{{ $farmDetails->no_of_parcel }}"> @error('no_of_parcel')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Area"><strong class="text-red">*</strong>&nbsp;Total Area
                                                    (hectares)</label>
                                                <input type="text" name="total_area" id="total_area" class="form-control"
                                                    placeholder="Total Area" value="{{ $farmDetails->total_area }}">
                                                @error('total_area')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="Area"><strong
                                                        class="text-red">*</strong>&nbsp;Ownership</label>
                                                <select name="ownership_type" id="ownership_type" class="form-select">
                                                    <option value="">[Select Ownership]</option>
                                                    <option value="Registered Owner"
                                                        {{ $farmDetails->ownership_type == 'Registered Owner' ? 'selected' : '' }}>
                                                        Registered Owner</option>
                                                    <option value="Tenant"
                                                        {{ $farmDetails->ownership_type == 'Tenant' ? 'selected' : '' }}>
                                                        Tenant</option>
                                                    <option value="Lessee"
                                                        {{ $farmDetails->ownership_type == 'Lessee' ? 'selected' : '' }}>
                                                        Lessee</option>
                                                </select> @error('ownership_type')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between">
                                                    <label for="Area"><strong class="text-red">*</strong>&nbsp;Name of
                                                        Farmers</label><a href="#" id="update_add_name_of_owner"
                                                        class="">
                                                        <i class="fa-solid fa-plus pointer"></i>&nbsp;More Names
                                                    </a>
                                                </div>

                                                @php
                                                    $nameOfOwner = json_decode($farmDetails->name_of_owner);
                                                @endphp


                                                @php
                                                    $loopCounter = 0;
                                                @endphp



                                                @foreach ($nameOfOwner as $ownser)
                                                    @php
                                                        $loopCounter++;
                                                    @endphp

                                                    @if ($loopCounter < 2)
                                                        <div class="row" id="">
                                                            <div class="col d-flex align-items-center">
                                                                <input type="text" name="name_of_owner[]"
                                                                    id="name_of_owner" class="form-control mr-1 mb-1"
                                                                    placeholder="Name of Owner"
                                                                    value="{{ $ownser }}">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row" id="row" class="">
                                                            <div class="col d-flex align-items-center">
                                                                <input type="text" name="name_of_owner[]"
                                                                    id="name_of_owner" class="form-control mr-1 mb-1"
                                                                    placeholder="Name of Owner"
                                                                    value="{{ $ownser }}">
                                                                <a href='#' id='update_remove_name_of_owner'> <i
                                                                        class='fa-solid fa-xmark text-red'></i></a>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    {{-- <div class="row" id="">
                                                        <div class="col d-flex align-items-center">
                                                            <input type="text" name="name_of_owner[]" id="name_of_owner"
                                                                class="form-control mr-1 mb-1" placeholder="Name of Owner"
                                                                value="{{ $ownser }}">
                                                            <a href='#' id='remove_name_of_owner'> <i
                                                                    class='fa-solid fa-xmark text-red'></i></a></label>
                                                        </div>
                                                    </div> --}}
                                                @endforeach

                                                <div class="row" id="more_owner">

                                                </div>


                                                @error('name_of_owner')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>


                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="Area">Lattitude</label>
                                                <input type="number" name="lat" id="lat" class="form-control"
                                                    placeholder="Lattitude" value="{{ $farmDetails->lat }}">
                                                {{-- not used  --}}
                                                @error('lat')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="Area">Longitude</label>
                                                <input type="number" name="long" id="long" class="form-control"
                                                    placeholder="Longitude" value="{{ $farmDetails->long }}">
                                                {{-- not used  --}}
                                                @error('long')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="Purok/Sition/Street"><strong
                                                        class="text-red">*</strong>&nbsp;Purok/Sition/Street</label>
                                                <input type="text" name="location_purok" id="location_purok"
                                                    class="form-control" placeholder="Total Area"
                                                    value="{{ $farmDetails->location_purok }}">
                                                @error('location_purok')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Area"><strong
                                                        class="text-red">*</strong>&nbsp;Barangay</label>
                                                <select name="location_bar_id" id="location_bar_id" class="form-select">
                                                    <option value="">[Select Banangay]</option>
                                                    @foreach ($barangay as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $farmDetails->location_bar_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->brgyDesc }}
                                                        </option>
                                                    @endforeach

                                                </select> @error('location_bar_id')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('f2.farm', $f2_data->ff_id) }}"><i
                                                    class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to Farm Details</a>
                                            <input type="submit" class="col-md-1 form-control btn btn-success"
                                                value="Update">

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
