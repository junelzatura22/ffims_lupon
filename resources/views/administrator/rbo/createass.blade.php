@extends('layouts.app')

@section('content-details')
    {{-- All start with the row  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="col">
                        <h4 class="m-0 text-gray ">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h4>
                    </div><!-- /.col --> --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 text-info">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h6>
                        </div><!-- /.col -->
                        <div>
                            {{ Breadcrumbs::render('createAssociation') }}
                        </div><!-- /.col -->
                    </div>

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <div class="row">

                    <div class="d-flex justify-content-center align-items-center">
                        {{-- add of flex container  --}}
                        <div class="card card-outline card-success">
                            <form action="" method="post" id="associationForm">
                                @csrf
                                <div class="card-header">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h3 class="card-title">
                                                <i class="fa-solid fa-users"></i>
                                                </i>Association Form&nbsp;
                                            </h3>
                                        </div>



                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nameabbr" class="form-label"><span
                                                            class="text-red">*</span>&nbsp;Name
                                                        in Abbrevation</label>
                                                    <input type="text" name="nameabbr" id="nameabbr"
                                                        class="form-control" placeholder="Ex. UBPIA"
                                                        value="{{ old('nameabbr') }}">
                                                    @error('nameabbr')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="namedesc" class="form-label"><span
                                                            class="text-red">*</span>&nbsp;Name
                                                        Description</label>
                                                    <input type="text" name="namedesc" id="namedesc"
                                                        class="form-control"
                                                        placeholder="Ex. UPPER PAGLAUM BAGUMBAYAN IRRIGATORS ASSOCIATION"
                                                        value="{{ old('namedesc') }}">
                                                    @error('namedesc')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="isreg_to" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Register To</label>
                                                    <select class="form-select " name="isreg_to" id="isreg_to">
                                                        <option value="">[Select]</option>
                                                        <option value="DOLE"
                                                            {{ old('isreg_to') == 'DOLE' ? 'selected' : '' }}>DOLE</option>
                                                        <option value="SEC"
                                                            {{ old('isreg_to') == 'SEC' ? 'selected' : '' }}>SEC</option>

                                                    </select>
                                                    @error('isreg_to')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="registration_no" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Registration No.</label>
                                                    <input type="text" name="registration_no" id="registration_no"
                                                        class="form-control" placeholder="Enter Registration No."
                                                        value="{{ old('registration_no') }}">
                                                    @error('registration_no')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="dataregistered" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Date Registered</label>
                                                    <input type="date" name="dataregistered" id="dataregistered"
                                                        class="form-control" placeholder="Enter Registration No."
                                                        value="{{ old('dataregistered') }}" max="{{ date('Y-m-d') }}">
                                                    @error('dataregistered')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="belongs_to_program" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Program/Commodity</label>
                                                    <select class="form-select " name="belongs_to_program"
                                                        id="belongs_to_program">
                                                        <option value="">[Select]</option>
                                                        @foreach ($program as $item)
                                                            <option value="{{ $item->program_id }}"
                                                                {{ old('belongs_to_program') == $item->program_id ? 'selected' : '' }}>
                                                                {{ $item->program_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('belongs_to_program')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror

                                                </div>

                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="region_id" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Region</label>
                                                    <input type="text" name="region_id" id="region_id"
                                                        class="form-control" value="{{ $region }}" readonly>

                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="province_id" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Region</label>
                                                    <input type="text" name="province_id" id="province_id"
                                                        class="form-control" value="{{ $province }}" readonly>

                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="citymun_id" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Region</label>
                                                    <input type="text" name="citymun_id" id="citymun_id"
                                                        class="form-control" value="{{ $citymun }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="barangay_id" class="form-label">
                                                        <span class="text-red">*</span>&nbsp;Barangay</label>
                                                    <select class="form-select " name="barangay_id" id="barangay_id">
                                                        <option value="">[Select]</option>

                                                        @foreach ($barangay as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('barangay_id') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->brgyDesc }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('barangay_id')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col d-flex justify-content-between align-items-center">
                                                <a href="{{ route('rbo.association') }}" class="btn btn-primary"><i
                                                        class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to Association
                                                    List</a>

                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </div>
                            </form>
                        </div>
                        {{-- end of flex container  --}}
                    </div>


        </section>

    </div>
@endsection
