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
                      {{-- menu start  --}}
                      @include('layouts/farmsidebar')
                      {{-- menu end  --}}


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

                                <form action="" method="post" id="livelihood">
                                    @csrf
                                    <div class="row mb-2 mt-2 p-1">

                                        <div class="col">
                                            <label for="" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Main Activity</label>
                                            <div>

                                                @php
                                                    $mainLivelihood = json_decode($livelihood->main_livelihood);
                                                    $typeOfActivity = json_decode($livelihood->type_of_activity);
                                                    $kindOfWork = json_decode($livelihood->kind_of_work);
                                                    $fishingActivity = json_decode($livelihood->fishing_activity);
                                                    $involvement = json_decode($livelihood->involvement);
                                                @endphp




                                                <div class="form-check form-check-inline ">
                                                    <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                        id="main_livelihood_Farmer" value="Farmer"
                                                        {{ in_array('Farmer', $mainLivelihood) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Farmer</label>
                                                </div>

                                                <div class="form-check form-check-inline ">
                                                    <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                        id="main_livelihood_laborer" value="Farm Worker/Laborer"
                                                        {{ in_array('Farm Worker/Laborer', $mainLivelihood) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Farm
                                                        Worker/Laborer</label>
                                                </div>
                                                <div class="form-check form-check-inline ">
                                                    <input class="form-check-input" type="checkbox" name="main_livelihood[]"
                                                        id="main_livelihood_Fisherfolk" value="Fisherfolk"
                                                        {{ in_array('Fisherfolk', $mainLivelihood) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Fisherfolk</label>
                                                </div>
                                                <div class="form-check form-check-inline col-md-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="main_livelihood[]" id="main_livelihood_Agriyouth"
                                                        value="Agri-Youth"
                                                        {{ in_array('Agri-Youth', $mainLivelihood) ? 'checked' : '' }}>
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
                                            <label for="" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Type of Activity</label>
                                            <div>

                                                <div class="form-check form-check-inline col-md-1">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="type_of_activity[]" id="type_of_activity"
                                                        value="Rice"
                                                        {{ in_array('Rice', $typeOfActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Rice</label>
                                                </div>

                                                <div class="form-check form-check-inline col-md-1">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="type_of_activity[]" id="type_of_activity"
                                                        value="Corn"
                                                        {{ in_array('Corn', $typeOfActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Corn</label>
                                                </div>


                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="type_of_activity[]" id="type_of_activity"
                                                        value="Crops"
                                                        {{ in_array('Crops', $typeOfActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Crops</label>
                                                    <div class="ml-1">
                                                        <input type="text" name="crops_specify"
                                                            value="{{ $livelihood->crops_specify }}"
                                                            placeholder="Please specify"
                                                            class="form-control form-control-sm  {{ $errors->first('crops_specify') ? 'form-error' : '' }}"
                                                            id="crops_specify" readonly />
                                                        @error('crops_specify')
                                                            <span class="text-red"><small>{{ $message }}</small></span>
                                                        @enderror

                                                    </div>

                                                </div>



                                                <div class="form-check form-check-inline col-md-4">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="type_of_activity[]" id="type_of_activity"
                                                        value="Livestock"
                                                        {{ in_array('Livestock', $typeOfActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Livestock</label>

                                                    <div class="ml-1">
                                                        <input type="text" name="livestock_specify"
                                                            value="{{ $livelihood->livestock_specify }}"
                                                            placeholder="Please specify"
                                                            class="form-control form-control-sm  {{ $errors->first('livestock_specify') ? 'form-error' : '' }}"
                                                            id="livestock_specify" readonly />
                                                        @error('livestock_specify')
                                                            <span class="text-red"><small>{{ $message }}</small></span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-check form-check-inline col-md-4">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="type_of_activity[]" id="type_of_activity"
                                                        value="Poultry"
                                                        {{ in_array('Poultry', $typeOfActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Poultry</label>

                                                    <div class="ml-1">
                                                        <input type="text" name="poultry_specify"
                                                            value="{{ $livelihood->poultry_specify }}"
                                                            placeholder="Please specify"
                                                            class="form-control form-control-sm  {{ $errors->first('poultry_specify') ? 'form-error' : '' }}"
                                                            id="poultry_specify" readonly />
                                                        @error('poultry_specify')
                                                            <span class="text-red"><small>{{ $message }}</small></span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            @error('type_of_activity')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- For the kind of work --}}

                                    <div class="row mb-2 mt-2 p-1">

                                        <div class="col-md-12">
                                            <label for="" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Kind of Activity</label>
                                            <div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                        id="kind_of_work" value="Land Preparation"
                                                        {{ in_array('Land Preparation', $kindOfWork) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Land
                                                        Preparation</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                        id="kind_of_work" value="Planting/Transplanting"
                                                        {{ in_array('Planting/Transplanting', $kindOfWork) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="inlineRadio2">Planting/Transplanting</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                        id="kind_of_work" value="Cultivation"
                                                        {{ in_array('Cultivation', $kindOfWork) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Cultivation</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                        id="kind_of_work" value="Harvesting"
                                                        {{ in_array('Harvesting', $kindOfWork) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Harvesting</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="kind_of_work[]"
                                                        id="kind_of_work" value="Others"
                                                        {{ in_array('Others', $kindOfWork) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio2">Others</label>
                                                </div>


                                            </div>

                                            @error('kind_of_work')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="form-label">If others, please
                                                specify</label>
                                            <div class="ml-1">
                                                <input type="text" name="kind_of_work_others"
                                                    value="{{ $livelihood->kind_of_work_others }}"
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
                                            <label for="" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;Fishing Activity</label>
                                            <div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="fishing_activity[]" id="fishing_activity"
                                                        value="Fish Capture"
                                                        {{ in_array('Fish Capture', $fishingActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Fish
                                                        Capture</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="fishing_activity[]" id="fishing_activity"
                                                        value="Fish Processing"
                                                        {{ in_array('Fish Processing', $fishingActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Fish
                                                        Processing</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="fishing_activity[]" id="fishing_activity"
                                                        value="Aquaculture"
                                                        {{ in_array('Aquaculture', $fishingActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Aquaculture</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="fishing_activity[]" id="fishing_activity"
                                                        value="Fish Vending"
                                                        {{ in_array('Fish Vending', $fishingActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Fish
                                                        Vending</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="fishing_activity[]" id="fishing_activity" value="Gleaning"
                                                        {{ in_array('Gleaning', $fishingActivity) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Gleaning</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="fishing_activity[]" id="fishing_activity" value="Others"
                                                        {{ in_array('Others', $fishingActivity) ? 'checked' : '' }}>
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
                                                    value="{{ $livelihood->fishing_activity_others }}"
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
                                            <label for="" class="form-label"><span
                                                    class="text-red">*</span>&nbsp;involvement</label>
                                            <div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="involvement[]"
                                                        id="involvement" value="Part of farming household"
                                                        {{ in_array('Part of farming household', $involvement) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Part of farming
                                                        household</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="involvement[]"
                                                        id="involvement"
                                                        value="Attending/Attended formal agri-fishery related course"
                                                        {{ in_array('Attending/Attended formal agri-fishery related course', $involvement) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Attending/Attended
                                                        formal agri-fishery related course</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="involvement[]"
                                                        id="involvement"
                                                        value="Attending/Attended non-formal agri-fishery related course"
                                                        {{ in_array('Attending/Attended non-formal agri-fishery related course', $involvement) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Attending/Attended
                                                        non-formal agri-fishery related course</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="involvement[]"
                                                        id="involvement"
                                                        value="Participated in any agricultural activity/program"
                                                        {{ in_array('Participated in any agricultural activity/program', $involvement) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio1">Participated in any
                                                        agricultural activity/program</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="involvement[]"
                                                        id="involvement" value="Others"
                                                        {{ in_array('Others', $involvement) ? 'checked' : '' }}>
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
                                                    value="{{ $livelihood->involvement_others }}"
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
                                                    value="{{ $livelihood->income_farming }}"
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
                                                    value="{{ $livelihood->income_non_farming }}"
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
                                            <input type="submit" value="Save Changes"
                                                class="btn btn-warning float-right">
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




    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
