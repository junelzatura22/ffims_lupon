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
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;Farmers and Fisherfolk Registration Form&nbsp;
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-2">
                                <div class="row mb-2 mt-2 p-1">

                                    <h5 class="mb-2 mt-2"><i><b>Personal Information</b></i></h5>
                                    <div class="col-md-4">
                                        <label for="reg_type" class="form-label">
                                            <span class="text-red">*</span>&nbsp;Registration Type
                                        </label>
                                        <select name="reg_type" id="reg_type" class="form-select form-select-sm">
                                            <option value="">[Select]</option>
                                            <option value="All">All</option>
                                            <option value="Farmer">Farmer</option>
                                            <option value="Fisherfolk">Fisherfolk</option>
                                        </select>
                                        @error('reg_type')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="fishr_nat" class="form-label">RSBSA Nat.&nbsp;<i
                                                class="text-red"><small>Optional</small></i></label>
                                        <input type="text" name="fishr_nat" value="{{ old('fishr_nat') }}"
                                            placeholder="FishR National" class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="fishr_loc" class="form-label">RSBSA Local&nbsp;<i
                                                class="text-red"><small>Optional</small></i></label>
                                        <input type="text" name="fishr_loc" value="{{ old('fishr_loc') }}"
                                            placeholder="FishR Local" class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="rsbsa_nat" class="form-label">FISHR Nat.&nbsp;<i
                                                class="text-red"><small>Optional</small></i></label>
                                        <input type="text" name="rsbsa_nat" value="{{ old('rsbsa_nat') }}"
                                            placeholder="National RSBSA" class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="rsbsa_loc" class="form-label">FISHR Local&nbsp;<i
                                                class="text-red"><small>Optional</small></i></label>
                                        <input type="text" name="rsbsa_loc" value="{{ old('rsbsa_loc') }}"
                                            placeholder="Local RSBSA" class="form-control form-control-sm" />
                                    </div>

                                </div>
                                <div class="row mb-2 mt-2 p-1">
                                    <div class="col-md-3">
                                        <label for="fname" class="form-label"><span class="text-red">*</span>&nbsp;First
                                            Name</label>
                                        <input type="text" name="fname" value="{{ old('fname') }}"
                                            placeholder="First Name" class="form-control form-control-sm" />
                                        @error('fname')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mname" class="form-label">Middle Name&nbsp;<i
                                                class="text-red"><small>Optional</small></i></label>
                                        <input type="text" name="mname" value="{{ old('mname') }}"
                                            placeholder="Middle Name" class="form-control form-control-sm" />
                                        @error('mname')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="lname" class="form-label"><span class="text-red">*</span>&nbsp;Last
                                            Name</label>
                                        <input type="text" name="lname" value="{{ old('lname') }}"
                                            placeholder="Last Name" class="form-control form-control-sm" />
                                        @error('lname')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="extname" class="form-label">
                                            <span class="text-red">*</span>&nbsp;Extension Name
                                        </label>
                                        <select name="extname" id="extname" class="form-select form-select-sm">
                                            <option value="">[Select]</option>
                                            <option value="JR">JR</option>
                                            <option value="SR">SR</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                        </select>
                                        @error('extname')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- getting the current date in Php  --}}
                                @php
                                    $curDate = date('Y-m-d');
                                @endphp

                                <div class="row mb-2 mt-2 p-1">
                                    <div class="col-md-4">
                                        <label for="lname" class="form-label"><span
                                                class="text-red">*</span>&nbsp;Date of Birth</label>
                                        <input type="date" name="lname" value="{{ old('lname') }}"
                                            placeholder="Last Name" class="form-control form-control-sm"
                                            max="{{ $curDate }}" />
                                        @error('lname')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="mname" class="form-label"><span
                                                class="text-red">*</span>&nbsp;Place of Birth</label>
                                        <input type="text" name="mname" value="{{ old('mname') }}"
                                            placeholder="Municipality, Province" class="form-control form-control-sm" />
                                        @error('mname')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label for="lname" class="form-label"><span
                                                class="text-red">*</span>&nbsp;Gender</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio1" value="Male">
                                                <label class="form-check-label" for="inlineRadio1">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                    id="inlineRadio2" value="Female">
                                                <label class="form-check-label" for="inlineRadio2">Female</label>
                                            </div>
                                        </div>

                                        @error('lname')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>


                                </div>



                            </div>




                            <div style="position: absolute; top:0; right:0; z-index:10">
                                @include('_message')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
