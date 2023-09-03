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
                                {{-- start card body  --}}
                                {{-- start form  --}}
                                <form action="" method="post" enctype="multipart/form-data" id="farmerForm">
                                    @csrf
                                    <div class="row mb-2 mt-2 p-1">

                                        <h5 class="mb-2 mt-2  text-info text-uppercase"><b>Personal Information</b></h5>
                                        <div class="col-md-4">
                                            <label for="reg_type" class="form-label">
                                                <span class="text-red">*</span>&nbsp;Registration Type
                                            </label>
                                            <select name="reg_type" id="reg_type" class="form-select form-select-sm {{($errors->first('reg_type') ? "form-error" : "")}}">
                                                <option value="">[Select]</option>
                                                <option value="All" {{ old('reg_type')=="All" ? "selected" : "" }}>All</option>
                                                <option value="Farmer" {{ old('reg_type')=="Farmer" ? "selected" : "" }}>Farmer</option>
                                                <option value="Fisherfolk" {{ old('reg_type')=="Fisherfolk" ? "selected" : "" }}>Fisherfolk</option>
                                            </select>
                                            @error('reg_type')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="rsbsa_nat" class="form-label">RSBSA Nat.&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="rsbsa_nat" id="rsbsa_nat"
                                                value="{{ old('rsbsa_nat') }}" placeholder="RSBSA National"
                                                class="form-control form-control-sm"
                                                data-inputmask='"mask": "99-99-99-999-999999"' data-mask readonly />
                                        </div>
                                        <div class="col-md-2">
                                            <label for="rsbsa_loc" class="form-label">RSBSA Local&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="rsbsa_loc" id="rsbsa_loc"
                                                value="{{ old('rsbsa_loc') }}" class="form-control form-control-sm"
                                                placeholder="RSBSA Loc." data-inputmask='"mask": "99-99-99-999-999999"'
                                                data-mask readonly />
                                        </div>
                                        <div class="col-md-2">
                                            <label for="fishr_nat" class="form-label">FISHR Nat.&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="fishr_nat" id="fishr_nat"
                                                value="{{ old('fishr_nat') }}" placeholder="National RSBSA"
                                                class="form-control form-control-sm" readonly />
                                        </div>
                                        <div class="col-md-2">
                                            <label for="fishr_loc" class="form-label">FISHR Local&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="fishr_loc" id="fishr_loc"
                                                value="{{ old('fishr_loc') }}" placeholder="Local RSBSA"
                                                class="form-control form-control-sm" readonly />
                                        </div>

                                    </div>
                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-3">
                                            <label for="fname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;First
                                                Name</label>
                                            <input type="text" name="fname" value="{{ old('fname') }}"
                                                placeholder="First Name" class="form-control form-control-sm {{($errors->first('fname') ? "form-error" : "")}}"
                                                id="fname" />
                                            @error('fname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="mname" class="form-label">Middle Name&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="mname" value="{{ old('mname') }}"
                                                placeholder="Middle Name" class="form-control form-control-sm"
                                                id="mname" />
                                           
                                        </div>
                                        <div class="col-md-3">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Last
                                                Name</label>
                                            <input type="text" name="lname" value="{{ old('lname') }}"
                                                id="lname" placeholder="Last Name"
                                                class="form-control form-control-sm  {{($errors->first('lname') ? "form-error" : "")}}" />
                                            @error('lname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="extname" class="form-label">Extension Name
                                            </label>
                                            <select name="extname" id="extname" class="form-select form-select-sm">
                                                <option value="">[Select]</option>
                                                <option value="Jr" {{ old('extname')=="Jr" ? "selected" : "" }}>Jr</option>
                                                <option value="Sr" {{ old('extname')=="Sr" ? "selected" : "" }}>Sr</option>
                                                <option value="I" {{ old('extname')=="I" ? "selected" : "" }}>I</option>
                                                <option value="II" {{ old('extname')=="II" ? "selected" : "" }}>II</option>
                                                <option value="III" {{ old('extname')=="III" ? "selected" : "" }}>III</option>
                                            </select>
                                            @error('extname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- getting the current date in Php  --}}
                                    @php
                                        $curdates = date('Y-m-d');
                                        $date = strtotime($curdates.' -12 year');//to accept the agri-youth
                                        $curDate = date('Y-m-d',$date);
                                    @endphp

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-4">
                                            <label for="dob" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Date of Birth</label>
                                            <input type="date" name="dob" value="{{ old('dob') }}"
                                                id="dob" placeholder="" class="form-control form-control-sm  {{($errors->first('dob') ? "form-error" : "")}}"
                                                max="{{ $curDate }}" />
                                            @error('dob')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="pob" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Place of Birth</label>
                                            <input type="text" name="pob" value="{{ old('pob') }}"
                                                placeholder="Municipality, Province" id="pob"
                                                class="form-control form-control-sm  {{($errors->first('pob') ? "form-error" : "")}}" />
                                            @error('pob')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Gender</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="inlineRadio1" value="Male" {{ old('gender')=="Male" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="inlineRadio2" value="Female" {{ old('gender')=="Female" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                                </div>
                                            </div>

                                            @error('gender')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-5">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Civil Status</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Single" {{ old('civilstatus')=="Single" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio1">Single</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Married" {{ old('civilstatus')=="Married" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio2">Married</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Separated" {{ old('civilstatus')=="Separated" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio2">Separated</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Widow/Widower" {{ old('civilstatus')=="Widow/Widower" ? "checked" : "" }}>
                                                    <label class="form-check-label"
                                                        for="inlineRadio2">Widow/Widower</label>
                                                </div>
                                            </div>

                                            @error('civilstatus')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="name_of_spouse" class="form-label">Name of Spouse&nbsp;<span
                                                    class="text-red"><i><small>required if
                                                            married(*)</small></i></span></label>
                                            <input type="text" name="name_of_spouse"
                                                value="{{ old('name_of_spouse') }}" placeholder="Name of Spouse"
                                                class="form-control form-control-sm  {{($errors->first('name_of_spouse') ? "form-error" : "")}}" id="name_of_spouse" readonly />
                                            @error('name_of_spouse')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="mothers_maidenname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Mother's Maiden Name</label>
                                            <input type="text" name="mothers_maidenname"
                                                value="{{ old('mothers_maidenname') }}" placeholder="Name of Spouse"
                                                class="form-control form-control-sm  {{($errors->first('mothers_maidenname') ? "form-error" : "")}}" id="mothers_maidenname" />
                                            @error('mothers_maidenname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-3">
                                            <label for="contactno " class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Mobile Number</label>
                                            <input type="text" name="contactno" value="{{ old('contactno') }}"
                                                placeholder="0000-000-0000" data-inputmask='"mask": "9999-999-9999"'
                                                data-mask class="form-control form-control-sm  {{($errors->first('contactno') ? "form-error" : "")}}" id="contactno" />
                                            @error('contactno')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                placeholder="Enter email" class="form-control form-control-sm" />
                                            @error('email')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="picture" class="form-label">Farmer Image</label>
                                            <input type="file" name="picture" value="{{ old('picture') }}"
                                                placeholder="Enter email" class="form-control form-control-sm"
                                                accept="image/png, image/gif, image/jpeg" />
                                            @error('picture')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-2 mt-2 p-1">
                                        <h6 class="mb-2 mt-2 text-info text-uppercase"><b>Address Information</b></h6>
                                        <div class="col-md-6">
                                            <label for="a_purok" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;House/Lot/Bldg. No/Purok</label>
                                            <input type="type" name="a_purok" value="{{ old('a_purok') }}"
                                                id="a_purok" placeholder="Enter House/Lot/Bldg. No/Purok"
                                                class="form-control form-control-sm  {{($errors->first('a_purok') ? "form-error" : "")}}" />
                                            @error('a_purok')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="a_sitio" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Street/Sition/Subdv</label>
                                            <input type="type" name="a_sitio" value="{{ old('a_sitio') }}"
                                                id="a_sitio" placeholder="Enter Street/Sition/Subdv"
                                                class="form-control form-control-sm  {{($errors->first('a_sitio') ? "form-error" : "")}}" />
                                            @error('a_sitio')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-label">Region</label>
                                                <select name="region_id" id="region_id"
                                                    class="form-select form-select-sm" disabled>
                                                    <option value="">[Select]</option>
                                                    @foreach ($region as $rItem)
                                                        <option value="{{ $rItem->id }}"
                                                            {{ $mylocation->region_id == $rItem->id ? 'selected' : '' }}>
                                                            {{ $rItem->regDesc }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('region_id')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-label">Province</label>
                                                <select name="province_id" id="province_id"
                                                    class="form-select form-select-sm" disabled>
                                                    <option value="">[Select]</option>

                                                    @foreach ($provinceData as $pItem)
                                                        <option value="{{ $pItem->id }}"
                                                            {{ $mylocation->province_id == $pItem->id ? 'selected' : '' }}>
                                                            {{ $pItem->provDesc }}</option>
                                                    @endforeach

                                                </select>
                                                {{-- hiding the location id  --}}
                                                <input type="hidden" value="{{ $mylocation->l_id }}" name="l_id" />
                                            </div>
                                            @error('province_id')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" class="form-label">Municipality</label>
                                                <select name="citymun_id" id="citymun_id"
                                                    class="form-select form-select-sm" disabled>
                                                    <option value="">[Select]</option>
                                                    @foreach ($citymunData as $citymunItem)
                                                        <option value="{{ $citymunItem->id }}"
                                                            {{ $mylocation->citymun_id == $citymunItem->id ? 'selected' : '' }}>
                                                            {{ $citymunItem->citymunDesc }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('citymun_id')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="a_barangay"><span class="text-red">*</span>&nbsp;
                                                    Barangay</label>
                                                <select name="a_barangay" class="form-select form-select-sm  {{($errors->first('a_barangay') ? "form-error" : "")}}">
                                                    <option value="">[Select]</option>
                                                    @foreach ($barangay as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('a_barangay') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->brgyDesc }}</option>
                                                    @endforeach
                                                </select>
                                                @error('a_barangay')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row mb-2 mt-2 p-1 d-flex justify-content-between">
                                        <div class="col">
                                            <a href="{{ route('f2.index') }}" class="btn btn-primary"><b><i
                                                class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to List</b></a>

                                        </div>
                                        <div class="col">
                                            <input type="submit" value="Save and Continue"
                                                class="btn btn-success float-right">

                                        </div>
                                        
                                    </div>
                                </form>
                                {{-- end form  --}}
                                {{-- end card body  --}}
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
