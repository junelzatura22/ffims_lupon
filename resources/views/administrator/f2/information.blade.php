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

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('asset/f2/' . $f2_data->picture . '') }}" alt="User profile picture">
                                </div>

                                @php
                                    $extname = $f2_data->extname === '[Select]' ? '' : $f2_data->extname;
                                    $mname = substr($f2_data->mname, 0, 1) . '.';
                                    $fullname = $f2_data->fname . ' ' . ($mname === '..' ? '' : $mname) . ' ' . $f2_data->lname . ' ' . $extname;
                                    
                                @endphp

                                <h3 class="profile-username text-center">{{ $fullname }}</h3>
                                <h6 class="text-muted text-center"><strong>{{ $f2_data->reg_type==='All' ? "Farmer and Fisherfolk" : $f2_data->reg_type }}</strong></h6>
                                <a href="{{ route('f2.index') }}" class="btn btn-primary btn-block"><b><i
                                            class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to List</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Profile</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item active">
                                        <a href="{{ route('f2.information', $f2_data->ff_id) }}"
                                            class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'information') active @endif ">
                                            <i class="fas fa-inbox"></i>&nbsp;Personal Information
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('f2.details', $f2_data->ff_id) }}"
                                            class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'details') active @endif ">
                                            <i class="far fa-envelope"></i>&nbsp;More Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('f2.livelihood',$f2_data->ff_id)}}" class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'livelihood') active @endif ">
                                            <i class="far fa-file-alt"></i> Livelihood
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Activity</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item active">
                                        <a href="#" class="nav-link mr-2 ml-2">
                                            <i class="fas fa-inbox"></i>&nbsp;Farm Parcel
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link mr-2 ml-2">
                                            <i class="far fa-envelope"></i>&nbsp;Activity
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-9">

                        <div class="card card-outline card-primary">

                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;Personal Information&nbsp;
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data" id="farmerForm">
                                    @csrf
                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-8">
                                            <label for="reg_type" class="form-label">
                                                <span class="text-red">*</span>&nbsp;Registration Type
                                            </label>
                                            <select name="reg_type" id="reg_type"
                                                class="form-select form-select-sm {{ $errors->first('reg_type') ? 'form-error' : '' }}">
                                                <option value="">[Select]</option>
                                                <option value="All" {{ $f2_data->reg_type == 'All' ? 'selected' : '' }}>
                                                    All
                                                </option>
                                                <option value="Farmer"
                                                    {{ $f2_data->reg_type == 'Farmer' ? 'selected' : '' }}>
                                                    Farmer</option>
                                                <option value="Fisherfolk"
                                                    {{ $f2_data->reg_type == 'Fisherfolk' ? 'selected' : '' }}>Fisherfolk
                                                </option>
                                            </select>
                                            @error('reg_type')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ff_status" class="form-label">
                                                <span class="text-red">*</span>&nbsp;Status
                                            </label>
                                            <select name="ff_status" id="ff_status"
                                                class="form-select form-select-sm {{ $errors->first('ff_status') ? 'form-error' : '' }}">
                                                <option value="">[Select]</option>
                                                <option value="Active" {{ $f2_data->ff_status == 'Active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="Inactive"
                                                    {{ $f2_data->ff_status == 'Inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('ff_status')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-3">
                                            <label for="rsbsa_nat" class="form-label">RSBSA Nat.&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="rsbsa_nat" id="rsbsa_nat"
                                                value="{{ $f2_data->rsbsa_nat }}" placeholder="RSBSA National"
                                                class="form-control form-control-sm"
                                                data-inputmask='"mask": "99-99-99-999-999999"' data-mask />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="rsbsa_loc" class="form-label">RSBSA Local&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="rsbsa_loc" id="rsbsa_loc"
                                                value="{{ $f2_data->rsbsa_loc }}" class="form-control form-control-sm"
                                                placeholder="RSBSA Loc." data-inputmask='"mask": "99-99-99-999-999999"'
                                                data-mask />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="fishr_nat" class="form-label">FISHR Nat.&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="fishr_nat" id="fishr_nat"
                                                value="{{ $f2_data->fishr_nat }}" placeholder="National RSBSA"
                                                class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="fishr_loc" class="form-label">FISHR Local&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="fishr_loc" id="fishr_loc"
                                                value="{{ $f2_data->fishr_loc }}" placeholder="Local RSBSA"
                                                class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-3">
                                            <label for="fname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;First
                                                Name</label>
                                            <input type="text" name="fname" value="{{ $f2_data->fname }}"
                                                placeholder="First Name"
                                                class="form-control form-control-sm {{ $errors->first('fname') ? 'form-error' : '' }}"
                                                id="fname" />
                                            @error('fname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="mname" class="form-label">Middle Name&nbsp;<i
                                                    class="text-red"><small>Optional</small></i></label>
                                            <input type="text" name="mname" value="{{ $f2_data->mname === "." ? "" : $f2_data->mname }}"
                                                placeholder="Middle Name" class="form-control form-control-sm"
                                                id="mname" />

                                        </div>
                                        <div class="col-md-3">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Last
                                                Name</label>
                                            <input type="text" name="lname" value="{{ $f2_data->lname }}"
                                                id="lname" placeholder="Last Name"
                                                class="form-control form-control-sm  {{ $errors->first('lname') ? 'form-error' : '' }}" />
                                            @error('lname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="extname" class="form-label">Extension Name
                                            </label>
                                            <select name="extname" id="extname" class="form-select form-select-sm">
                                                <option value="">[Select]</option>
                                                <option value="Jr" {{ $f2_data->extname == 'Jr' ? 'selected' : '' }}>
                                                    Jr
                                                </option>
                                                <option value="Sr" {{ $f2_data->extname == 'Sr' ? 'selected' : '' }}>
                                                    Sr
                                                </option>
                                                <option value="I" {{ $f2_data->extname == 'I' ? 'selected' : '' }}>I
                                                </option>
                                                <option value="II" {{ $f2_data->extname == 'II' ? 'selected' : '' }}>
                                                    II
                                                </option>
                                                <option value="III" {{ $f2_data->extname == 'III' ? 'selected' : '' }}>
                                                    III
                                                </option>
                                            </select>
                                            @error('extname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        @php
                                            $curDate = date('Y-m-d');
                                        @endphp
                                        <div class="col-md-4">
                                            <label for="dob" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Date of Birth</label>
                                            <input type="date" name="dob" value="{{ $f2_data->dob }}"
                                                id="dob" placeholder="" class="form-control form-control-sm  {{($errors->first('dob') ? "form-error" : "")}}"
                                                max="{{ $curDate }}" />
                                            @error('dob')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="col-md-5">
                                            <label for="pob" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Place of Birth</label>
                                            <input type="text" name="pob" value="{{ $f2_data->pob }}"
                                                placeholder="Municipality, Province" id="pob"
                                                class="form-control form-control-sm  {{($errors->first('pob') ? "form-error" : "")}}" />
                                            @error('pob')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Gender</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="inlineRadio1" value="Male" {{ $f2_data->gender=="Male" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="inlineRadio2" value="Female" {{ $f2_data->gender=="Female" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                                </div>
                                            </div>

                                            @error('gender')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <h6 class="mb-2 mt-2 text-info text-uppercase"><b>Civil Status, Spouse and Mothers Maiden Name</b></h6>
                                        <div class="col-md-5">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Civil Status</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Single" {{ $f2_data->civilstatus=="Single" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio1">Single</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Married" {{ $f2_data->civilstatus=="Married" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio2">Married</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Separated" {{ $f2_data->civilstatus=="Separated" ? "checked" : "" }}>
                                                    <label class="form-check-label" for="inlineRadio2">Separated</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="civilstatus"
                                                        id="civilstatus" value="Widow/Widower" {{ $f2_data->civilstatus=="Widow/Widower" ? "checked" : "" }}>
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
                                                value="{{ $f2_data->name_of_spouse }}" placeholder="Name of Spouse"
                                                class="form-control form-control-sm  {{($errors->first('name_of_spouse') ? "form-error" : "")}}" id="name_of_spouse" readonly />
                                            @error('name_of_spouse')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="mothers_maidenname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Mother's Maiden Name</label>
                                            <input type="text" name="mothers_maidenname"
                                                value="{{ $f2_data->mothers_maidenname }}" placeholder="Name of Spouse"
                                                class="form-control form-control-sm  {{($errors->first('mothers_maidenname') ? "form-error" : "")}}" id="mothers_maidenname" />
                                            @error('mothers_maidenname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <h6 class="mb-2 mt-2 text-info text-uppercase"><b>Contact and Image</b></h6>
                                        <div class="col-md-3">
                                            <label for="contactno " class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Mobile Number</label>
                                            <input type="text" name="contactno" value="{{ $f2_data->contactno }}"
                                                placeholder="0000-000-0000" data-inputmask='"mask": "9999-999-9999"'
                                                data-mask class="form-control form-control-sm  {{($errors->first('contactno') ? "form-error" : "")}}" id="contactno" />
                                            @error('contactno')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" name="email" value="{{ $f2_data->email==="." ? "" : $f2_data->email }}"
                                                placeholder="Enter email" class="form-control form-control-sm" />
                                            @error('email')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="picture" class="form-label">Farmer Image</label>
                                            <input type="file" name="picture" value="{{ $f2_data->picture }}"
                                                placeholder="Enter email" class="form-control form-control-sm"
                                                accept="image/png, image/gif, image/jpeg" />
                                                <input type="hidden" name="imageHolder" value="{{ $f2_data->picture }}">
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
                                            <input type="type" name="a_purok" value="{{ $f2_data->a_purok }}"
                                                id="a_purok" placeholder="Enter House/Lot/Bldg. No/Purok"
                                                class="form-control form-control-sm  {{($errors->first('a_purok') ? "form-error" : "")}}" />
                                            @error('a_purok')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="a_sitio" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Street/Sition/Subdv</label>
                                            <input type="type" name="a_sitio" value="{{ $f2_data->a_sitio }}"
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
                                                            {{ $f2_data->a_barangay == $item->id ? 'selected' : '' }}>
                                                            {{ $item->brgyDesc }}</option>
                                                    @endforeach
                                                </select>
                                                @error('a_barangay')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col ">
                                            <input type="submit" value="Update"
                                                class="btn btn-warning float-right">
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>


                        <div style="position: absolute; top:0; right:0; z-index:10">
                            @include('_message')
                        </div>
                    </div>





                </div>




            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
