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
                                        <a href="{{ route('f2.livelihood', $f2_data->ff_id) }}"
                                            class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'livelihood') active @endif ">
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
                                            </i>&nbsp;Farmer/Fisherfolk Livelihood&nbsp;
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row mb-2 mt-2 p-1">

                                    <div class="col">
                                        <label for="main_livelihood" class="form-label"><span
                                                class="text-red">*</span>&nbsp;Main Activity</label>
                                        <div>

                                            <div class="form-check form-check-inline col-md-2">
                                                <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                    id="main_livelihood_Farmer" value="Farmer"
                                                    {{ old('main_livelihood') == 'Farmer' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Farmer</label>
                                            </div>

                                            <div class="form-check form-check-inline col-md-2">
                                                <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                    id="main_livelihood_corn" value="Corn"
                                                    {{ old('main_livelihood') == 'Corn' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Corn</label>
                                            </div>
                                            <div class="form-check form-check-inline col-md-3">
                                                <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                    id="main_livelihood_laborer" value="Farm Worker/Laborer"
                                                    {{ old('main_livelihood') == 'Farm Worker/Laborer' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Farm
                                                    Worker/Laborer</label>
                                            </div>
                                            <div class="form-check form-check-inline col-md-2">
                                                <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                    id="main_livelihood_Fisherfolk" value="Fisherfolk"
                                                    {{ old('main_livelihood') == 'Fisherfolk' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Fisherfolk</label>
                                            </div>
                                            <div class="form-check form-check-inline col-md-2">
                                                <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                    id="main_livelihood_Agriyouth" value="Agri-Youth"
                                                    {{ old('main_livelihood') == 'Agri-Youth' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Agri-Youth</label>
                                            </div>



                                        </div>

                                        @error('main_livelihood')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-2 mt-2 p-1">

                                    <div class="col">
                                        <label for="main_livelihood" class="form-label"><span
                                                class="text-red">*</span>&nbsp;Type of Activity</label>
                                        <div>

                                            <div class="form-check form-check-inline col-md-1">
                                                <input class="form-check-input" type="checkbox" name="type_of_activity[]"
                                                    id="main_livelihood_rice" value="Rice"
                                                    {{ old('type_of_activity') == 'Rice' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Rice</label>
                                            </div>

                                            <div class="form-check form-check-inline col-md-1">
                                                <input class="form-check-input" type="checkbox" name="type_of_activity[]"
                                                    id="main_livelihood_corn" value="Corn"
                                                    {{ old('type_of_activity') == 'Corn' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Corn</label>
                                            </div>

                                            <div class="form-check form-check-inline col-md-3">
                                                <input class="form-check-input" type="checkbox" name="type_of_activity[]"
                                                    id="main_livelihood_Crops" value="Crops"
                                                    {{ old('type_of_activity') == 'Crops' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Crops</label>

                                                <div class="ml-1">
                                                    <input type="text" name="crops_specify"
                                                        value="{{ old('crops_specify') }}" placeholder="Please specify"
                                                        class="form-control form-control-sm  {{ $errors->first('crops_specify') ? 'form-error' : '' }}"
                                                        id="crops_specify" readonly />
                                                    @error('crops_specify')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-check form-check-inline col-md-3">
                                                <input class="form-check-input" type="checkbox" name="main_livelihood"
                                                    id="main_livelihood_Livestock" value="Livestock"
                                                    {{ old('main_livelihood') == 'Livestock' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Livestock</label>

                                                <div class="ml-1">
                                                    <input type="text" name="livestock_specify"
                                                        value="{{ old('livestock_specify') }}"
                                                        placeholder="Please specify"
                                                        class="form-control form-control-sm  {{ $errors->first('livestock_specify') ? 'form-error' : '' }}"
                                                        id="livestock_specify" readonly />
                                                    @error('livestock_specify')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-check form-check-inline col-md-3">
                                                <input class="form-check-input" type="checkbox" name="main_livelihood"
                                                    id="main_livelihood_Poultry" value="Poultry"
                                                    {{ old('main_livelihood') == 'Poultry' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Poultry</label>

                                                <div class="ml-1">
                                                    <input type="text" name="poultry_specify"
                                                        value="{{ old('poultry_specify') }}" placeholder="Please specify"
                                                        class="form-control form-control-sm  {{ $errors->first('poultry_specify') ? 'form-error' : '' }}"
                                                        id="poultry_specify" readonly />
                                                    @error('poultry_specify')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>

                                        @error('main_livelihood')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>

                                </div>

                                {{-- For the kind of work --}}

                                <div class="row mb-2 mt-2 p-1">

                                    <div class="col-md-12">
                                        <label for="main_livelihood" class="form-label"><span
                                                class="text-red">*</span>&nbsp;Kind of Activity</label>
                                        <div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                    id="kind_of_work" value="Land Preparation"
                                                    {{ old('kind_of_work') == 'Land Preparation' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Land
                                                    Preparation</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                    id="kind_of_work" value="Planting/Transplanting"
                                                    {{ old('kind_of_work') == 'Planting/Transplanting' ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="inlineRadio2">Planting/Transplanting</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                    id="kind_of_work" value="Cultivation"
                                                    {{ old('kind_of_work') == 'Cultivation' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Cultivation</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                    id="kind_of_work" value="Harvesting"
                                                    {{ old('kind_of_work') == 'Harvesting' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Harvesting</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                    id="kind_of_work" value="Others"
                                                    {{ old('kind_of_work') == 'Others' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Others</label>
                                            </div>


                                        </div>

                                        @error('kind_of_work')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="main_livelihood" class="form-label">If others, please specify</label>
                                        <div class="ml-1">
                                            <input type="text" name="kind_of_work_others"
                                                value="{{ old('kind_of_work_others') }}"
                                                placeholder="Please specify for others"
                                                class="form-control form-control-sm  {{ $errors->first('kind_of_work_others') ? 'form-error' : '' }}"
                                                id="kind_of_work_others" readonly />
                                            @error('kind_of_work_others')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                {{--  Start of fishing activity --}}
                                <div class="row mb-2 mt-2 p-1">

                                    <div class="col-md-12">
                                        <label for="main_livelihood" class="form-label"><span
                                                class="text-red">*</span>&nbsp;Fishing Activity</label>
                                        <div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fishing_activity[]"
                                                    id="fishing_activity" value="Fish Capture"
                                                    {{ old('fishing_activity') == 'Fish Capture' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Fish Capture</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fishing_activity[]"
                                                    id="fishing_activity" value="Fish Processing"
                                                    {{ old('fishing_activity') == 'Fish Processing' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Fish Processing</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fishing_activity[]"
                                                    id="fishing_activity" value="Aquaculture"
                                                    {{ old('fishing_activity') == 'Aquaculture' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Aquaculture</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fishing_activity[]"
                                                    id="fishing_activity" value="Fish Vending"
                                                    {{ old('fishing_activity') == 'Fish Vending' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Fish Vending</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fishing_activity[]"
                                                    id="fishing_activity" value="Gleaning"
                                                    {{ old('fishing_activity') == 'Gleaning' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Gleaning</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="fishing_activity[]"
                                                    id="fishing_activity" value="Others"
                                                    {{ old('fishing_activity') == 'Others' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Others</label>
                                            </div>




                                        </div>

                                        @error('fishing_activity')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="fishing_activity_others" class="form-label">If others, please
                                            specify</label>
                                        <div class="ml-1">
                                            <input type="text" name="fishing_activity_others"
                                                value="{{ old('fishing_activity_others') }}"
                                                placeholder="Please specify for others"
                                                class="form-control form-control-sm  {{ $errors->first('fishing_activity_others') ? 'form-error' : '' }}"
                                                id="fishing_activity_others" readonly />
                                            @error('fishing_activity_others')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                {{--  End of fishing activity --}}
                                {{-- Start of involvement --}}
                                <div class="row mb-2 mt-2 p-1">

                                    <div class="col-md-12">
                                        <label for="main_livelihood" class="form-label"><span
                                                class="text-red">*</span>&nbsp;involvement</label>
                                        <div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="involvement[]"
                                                    id="involvement" value="Part of farming household"
                                                    {{ old('involvement') == 'Part of farming household' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Part of farming
                                                    household</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="involvement[]"
                                                    id="involvement"
                                                    value="Attending/Attended formal agri-fishery related course"
                                                    {{ old('involvement') == 'Attending/Attended formal agri-fishery related course' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Attending/Attended
                                                    formal agri-fishery related course</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="involvement[]"
                                                    id="involvement"
                                                    value="Attending/Attended non-formal agri-fishery related course"
                                                    {{ old('involvement') == 'Attending/Attended non-formal agri-fishery related course' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Attending/Attended
                                                    non-formal agri-fishery related course</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="involvement[]"
                                                    id="involvement"
                                                    value="Participated in any agricultural activity/program"
                                                    {{ old('involvement') == 'Participated in any agricultural activity/program' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Participated in any
                                                    agricultural activity/program</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="involvement[]"
                                                    id="involvement" value="Others"
                                                    {{ old('involvement') == 'Others' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Others</label>
                                            </div>

                                        </div>

                                        @error('involvement')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="involvement_others" class="form-label">If others, please
                                            specify</label>
                                        <div class="ml-1">
                                            <input type="text" name="involvement_others"
                                                value="{{ old('involvement_others') }}"
                                                placeholder="Please specify for others"
                                                class="form-control form-control-sm  {{ $errors->first('involvement_others') ? 'form-error' : '' }}"
                                                id="involvement_others" readonly />
                                            @error('involvement_others')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                {{-- End of involvement --}}
                                {{-- start annual income --}}
                                <div class="row mb-2 mt-2 p-1">
                                    <div class="col-md-6">
                                        <label for="income_farming"><span class="text-red">*</span>&nbsp;
                                             Farming Income</label>
                                        <div class="ml-1">
                                            <input type="number" name="income_farming" min="-1"
                                                value="{{ old('income_farming') }}"
                                                placeholder="Enter farming income"
                                                class="form-control form-control-sm  {{ $errors->first('income_farming') ? 'form-error' : '' }}"
                                                id="income_farming" />
                                            @error('income_farming')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="income_non_farming"><span class="text-red">*</span>&nbsp;
                                            None Farming Income</label>
                                        <div class="ml-1">
                                            <input type="number" name="income_non_farming" min="-1"
                                                value="{{ old('income_non_farming') }}"
                                                placeholder="Enter none-farming income"
                                                class="form-control form-control-sm  {{ $errors->first('income_non_farming') ? 'form-error' : '' }}"
                                                id="income_non_farming" />
                                            @error('income_non_farming')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 mt-2 p-1">
                                    <div class="col ">
                                        <input type="submit" value="Save"
                                            class="btn btn-success float-right">

                                    </div>
                                </div>
                              
                                

                            </div>

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
