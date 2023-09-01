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
                                <h6 class="text-muted text-center">
                                    <strong>{{ $f2_data->reg_type === 'All' ? 'Farmer and Fisherfolk' : $f2_data->reg_type }}</strong>
                                </h6>
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
                                            </i>&nbsp;More Information&nbsp;
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data" id="farmerDetails">
                                    @csrf
                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Highest Formal Education</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="Pre-School"
                                                        {{ $f2_details->education == 'Pre-School' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Pre-School</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="Elementary"
                                                        {{ $f2_details->education == 'Elementary' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Elementary</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="High-School (non K-12)"
                                                        {{ $f2_details->education == 'High-School (non K-12)' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">High-School (non
                                                        K-12)</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="JR High-School (K-12)"
                                                        {{ $f2_details->education == 'JR High-School (K-12)' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">JR High-School
                                                        (K-12)</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="SR High-School (K-12)"
                                                        {{ $f2_details->education == 'SR High-School (K-12)' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">SR High-School
                                                        (K-12)</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="College"
                                                        {{ $f2_details->education == 'College' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">College</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="Post-Graduate"
                                                        {{ $f2_details->education == 'Post-Graduate' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">Post-Graduate</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="education"
                                                        id="education" value="None"
                                                        {{ $f2_details->education == 'None' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">None</label>
                                                </div>

                                            </div>

                                            @error('education')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-5">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Religion</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="religion"
                                                        id="religion" value="Christianity"
                                                        {{ $f2_details->religion == 'Christianity' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">Christianity</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="religion"
                                                        id="religion" value="Islam"
                                                        {{ $f2_details->religion == 'Islam' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Islam</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="religion"
                                                        id="religion" value="Others"
                                                        {{ $f2_details->religion == 'Others' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Others</label>
                                                </div>
                                            </div>

                                            @error('religion')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-7">
                                            <label for="name_of_spouse" class="form-label">
                                                If religion is Others - Please specify</label>
                                            <input type="text" name="others_religion"
                                                value="{{ $f2_details->others_religion }}" placeholder="Enter Religion"
                                                class="form-control form-control-sm  {{ $errors->first('others_religion') ? 'form-error' : '' }}"
                                                id="others_religion" readonly />

                                            @error('others_religion')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-3">
                                            <label for="lname" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Household Head?</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_house_head"
                                                        id="is_house_head" value="Yes"
                                                        {{ $f2_details->is_house_head == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_house_head"
                                                        id="is_house_head" value="No"
                                                        {{ $f2_details->is_house_head == 'No' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">No</label>
                                                </div>
                                            </div>
                                            @error('is_house_head')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <label for="name_househead" class="form-label">
                                                <span class="text-red">*</span>&nbsp; Name of Household Head</label>
                                            <input type="text" name="name_househead"
                                                value="{{ $f2_details->name_househead }}"
                                                placeholder="Enter Name of Household head"
                                                class="form-control form-control-sm  {{ $errors->first('name_househead') ? 'form-error' : '' }}"
                                                id="name_househead" readonly />

                                            @error('name_househead')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="relationship" class="form-label">
                                                <span class="text-red">*</span>&nbsp;Relationship</label>

                                            <select name="relationship" id="relationship"
                                                class="form-select form-select-sm {{ $errors->first('relationship') ? 'form-error' : '' }}">
                                                <option value="">[Select]</option>
                                                <option
                                                    value="Father"{{ $f2_details->relationship === 'Father' ? 'selected' : '' }}>
                                                    Father</option>
                                                <option
                                                    value="Mother"{{ $f2_details->relationship === 'Mother' ? 'selected' : '' }}>
                                                    Mother</option>
                                                <option
                                                    value="Guardian"{{ $f2_details->relationship === 'Guardian' ? 'selected' : '' }}>
                                                    Guardian</option>
                                                <option
                                                    value="Relative"{{ $f2_details->relationship === 'Relative' ? 'selected' : '' }}>
                                                    Relative</option>
                                                <option
                                                    value="Brother"{{ $f2_details->relationship === 'Brother' ? 'selected' : '' }}>
                                                    Brother</option>
                                                <option
                                                    value="Sister"{{ $f2_details->relationship === 'Daugther' ? 'selected' : '' }}>
                                                    Sister</option>
                                                <option
                                                    value="Relative"{{ $f2_details->relationship === 'Relative' ? 'selected' : '' }}>
                                                    Relative</option>
                                                <option
                                                    value="Acquintance"{{ $f2_details->relationship === 'Acquintance' ? 'selected' : '' }}>
                                                    Acquintance</option>
                                                <option
                                                    value="Others"{{ $f2_details->relationship === 'Others' ? 'selected' : '' }}>
                                                    Others</option>
                                            </select>

                                            @error('relationship')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                    </div>



                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-3">
                                            <label for="num_of_household" class="form-label">
                                                <span class="text-red">*</span>&nbsp;No. of Household</label>
                                            <input type="number" name="num_of_household"
                                                value="{{ $f2_details->num_of_household }}"
                                                placeholder="Enter No. of Household"
                                                class="form-control form-control-sm  {{ $errors->first('num_of_household') ? 'form-error' : '' }}"
                                                id="num_of_household" min="0"/>
                                            @error('num_of_household')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="no_male" class="form-label">
                                                <span class="text-red">*</span>&nbsp;No. of Male</label>
                                            <input type="number" name="no_male" value="{{ $f2_details->no_male }}"
                                                placeholder="No. of Male"
                                                class="form-control form-control-sm  {{ $errors->first('no_male') ? 'form-error' : '' }}"
                                                id="no_male" min="0"/>
                                            @error('no_male')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="no_female" class="form-label">
                                                <span class="text-red">*</span>&nbsp;No. of Female</label>
                                            <input type="number" name="no_female" value="{{ $f2_details->no_female }}"
                                                placeholder="No. of Female"
                                                class="form-control form-control-sm  {{ $errors->first('no_female') ? 'form-error' : '' }}"
                                                id="no_female" readonly />
                                            @error('no_female')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="is_pwd" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Is PWD?</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_pwd"
                                                        id="is_pwd" value="Yes"
                                                        {{ $f2_details->is_pwd == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_pwd"
                                                        id="is_pwd" value="No"
                                                        {{ $f2_details->is_pwd == 'No' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">No</label>
                                                </div>
                                            </div>
                                            @error('is_pwd')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>





                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-2">
                                            <label for="is_4ps" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Is 4P's?</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_4ps"
                                                        id="is_4ps" value="Yes"
                                                        {{ $f2_details->is_4ps == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_4ps"
                                                        id="is_4ps" value="No"
                                                        {{ $f2_details->is_4ps == 'No' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">No</label>
                                                </div>
                                            </div>
                                            @error('is_4ps')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="is_ip" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Is IP?</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_ip"
                                                        id="is_ip" value="Yes"
                                                        {{ $f2_details->is_ip == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_ip"
                                                        id="is_ip" value="No"
                                                        {{ $f2_details->is_ip == 'No' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">No</label>
                                                </div>
                                            </div>
                                            @error('is_ip')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="col-md-8">
                                            <label for="name_of_group" class="form-label">
                                                If IP is yes, Please specify</label>
                                            <input type="text" name="name_of_group"
                                                value="{{ $f2_details->name_of_group }}" placeholder="Enter tribe/group"
                                                class="form-control form-control-sm  {{ $errors->first('name_of_group') ? 'form-error' : '' }}"
                                                id="name_of_group"  />
                                            @error('name_of_group')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-2">
                                            <label for="with_gov_id" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;With ID?</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="with_gov_id"
                                                        id="with_gov_id" value="Yes"
                                                        {{ $f2_details->with_gov_id == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="with_gov_id"
                                                        id="with_gov_id" value="No"
                                                        {{ $f2_details->with_gov_id == 'No' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">No</label>
                                                </div>
                                            </div>
                                            @error('with_gov_id')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-7">
                                            <label for="with_gov_id" class="form-label"><span
                                                class="text-red">*</span>&nbsp;ID Type</label>
                                            <select name="id_type" id="id_type"
                                                class="form-select form-select-sm {{ $errors->first('id_type') ? 'form-error' : '' }}">
                                                <option value="">[Select]</option>
                                                <option
                                                    value="Passport"{{ $f2_details->id_type === 'Passport' ? 'selected' : '' }}>
                                                    Passport</option>
                                                <option
                                                    value="Driver's License"{{ $f2_details->id_type === "Driver's License" ? 'selected' : '' }}>
                                                    Driver's License</option>
                                                <option
                                                    value="Voter's ID"{{ $f2_details->id_type === "Voter's ID" ? 'selected' : '' }}>
                                                    Voter's ID</option>
                                                <option value="UMID"{{ $f2_details->id_type === 'UMID' ? 'selected' : '' }}>
                                                    UMID</option>
                                                <option
                                                    value="PhilHealth ID"{{ $f2_details->id_type === 'PhilHealth ID' ? 'selected' : '' }}>
                                                    PhilHealth ID</option>
                                                <option
                                                    value="TIN ID"{{ $f2_details->id_type === 'TIN ID' ? 'selected' : '' }}>
                                                    TIN ID</option>
                                                <option
                                                    value="Postal ID"{{ $f2_details->id_type === 'Postal ID' ? 'selected' : '' }}>
                                                    Postal ID</option>
                                                <option
                                                    value="NBI Clearance"{{ $f2_details->id_type === 'NBI Clearance' ? 'selected' : '' }}>
                                                    NBI Clearance</option>
                                                <option
                                                    value="PRC ID"{{ $f2_details->id_type === 'PRC ID' ? 'selected' : '' }}>
                                                    PRC ID</option>
                                                <option
                                                    value="OWWA OFW e-Card"{{ $f2_details->id_type === 'OWWA OFW e-Card' ? 'selected' : '' }}>
                                                    OWWA OFW e-Card</option>
                                                <option
                                                    value="Senior Citizen ID"{{ $f2_details->id_type === 'Senior Citizen ID' ? 'selected' : '' }}>
                                                    Senior Citizen ID</option>
                                                <option
                                                    value="National ID"{{ $f2_details->id_type === 'National ID' ? 'selected' : '' }}>
                                                    National ID</option>
                                                <option
                                                    value="PWD ID"{{ $f2_details->id_type === 'PWD ID' ? 'selected' : '' }}>
                                                    PWD ID</option>
                                                <option
                                                    value="Employee ID"{{ $f2_details->id_type === 'Employee ID' ? 'selected' : '' }}>
                                                    Employee ID</option>
                                                <option
                                                    value="Barangay ID"{{ $f2_details->id_type === 'Barangay ID' ? 'selected' : '' }}>
                                                    Barangay ID</option>
                                                <option
                                                    value="Barangay Certificate"{{ $f2_details->id_type === 'Barangay Certificate' ? 'selected' : '' }}>
                                                    Barangay Certificate</option>
                                                <option
                                                    value="No ID"{{ $f2_details->id_type === 'No ID' ? 'selected' : '' }}>No
                                                    ID</option>
                                            </select>
                                            @error('id_type')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label for="id_number" class="form-label">
                                                <span
                                                    class="text-red">*</span>&nbsp;ID Number</label>
                                            <input type="number" name="id_number" value="{{ $f2_details->id_number }}"
                                                placeholder="ID Number"
                                                class="form-control form-control-sm  {{ $errors->first('id_number') ? 'form-error' : '' }}"
                                                id="id_number" />
                                            @error('id_number')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-4">
                                            <label for="is_assoc_member" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Member to IA/Cooperative?</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_assoc_member"
                                                        id="is_assoc_member" value="Yes"
                                                        {{ $f2_details->is_assoc_member == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="is_assoc_member"
                                                        id="is_assoc_member" value="No"
                                                        {{ $f2_details->is_assoc_member == 'No' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">No</label>
                                                </div>
                                            </div>
                                            @error('is_assoc_member')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-8">
                                            <label for="assoc_id" class="form-label"><span
                                                class="text-red">*</span>&nbsp;If member is Yes, Please 
                                                select Association/Cooperative</label>
                                            <select name="assoc_id" id="assoc_id"
                                                class="form-select form-select-sm {{ $errors->first('assoc_id') ? 'form-error' : '' }}">
                                                <option value="">[Select]</option>

                                                @foreach ($association as $item)
                                                    <option value="{{ $item->as_id }}"
                                                        {{ $f2_details->assoc_id == $item->as_id ? "selected" : "" }}>
                                                        {{ $item->namedesc }}</option>
                                                @endforeach


                                            </select>
                                            @error('assoc_id')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col-md-4">
                                            <label for="contact_person" class="form-label">
                                                <span
                                                    class="text-red">*</span>&nbsp;Contact Person</label>
                                            <input type="text" name="contact_person"
                                                value="{{ $f2_details->contact_person }}" placeholder="Contact Person"
                                                class="form-control form-control-sm  {{ $errors->first('contact_person') ? 'form-error' : '' }}"
                                                id="contact_person" />
                                            @error('contact_person')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="contact_number" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Mobile Number</label>
                                            <input type="text" name="contact_number"
                                                value="{{ $f2_details->contact_number }}" placeholder="0000-000-0000"
                                                data-inputmask='"mask": "9999-999-9999"' data-mask
                                                class="form-control form-control-sm  {{ $errors->first('contact_number') ? 'form-error' : '' }}"
                                                id="contactno" />
                                            @error('contact_number')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact_relation" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Relationship</label>
                                            <select name="contact_relation" id="contact_relation"
                                                class="form-select form-select-sm {{ $errors->first('contact_relation') ? 'form-error' : '' }}">
                                                <option value="">[Select]</option>
                                                <option value="Parent"{{$f2_details->contact_relation==="Parent"? "selected":""}}>Parent</option>
                                                <option value="Guardian"{{$f2_details->contact_relation==="Guardian"? "selected":""}}>Guardian</option>
                                                <option value="Relative"{{$f2_details->contact_relation==="Relative"? "selected":""}}>Relative</option>
                                                <option value="Son"{{$f2_details->contact_relation==="Son"? "selected":""}}>Son</option>
                                                <option value="Daughter"{{$f2_details->contact_relation==="Daughter"? "selected":""}}>Daughter</option>
                                                <option value="Brother"{{$f2_details->contact_relation==="Brother"? "selected":""}}>Brother</option>
                                                <option value="Sister"{{$f2_details->contact_relation==="Sister"? "selected":""}}>Sister</option>
                                                <option value="Acquintance"{{$f2_details->contact_relation==="Acquintance"? "selected":""}}>Acquintance</option>
                                                <option value="None"{{$f2_details->contact_relation==="None"? "selected":""}}>None</option>
                                            </select>
                                            @error('contact_relation')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2 mt-2 p-1">
                                        <div class="col ">
                                            <input type="submit" value="Save Changes"
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
