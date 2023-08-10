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
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('asset/user/' . $users->image . '') }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ $users->name . ' ' . $users->lastname }}</h3>

                                <p class="text-muted text-center">{{ $users->role }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li>
                                </ul>

                                <a href="{{ route('user.ascomindex') }}" class="btn btn-primary btn-block"><i
                                        class="fa-solid fa-arrow-left-long"></i>&nbsp;To User Assignment</a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="card card-outline card-danger p-2">
                                @csrf
                                <div class="card-header p-2">
                                    <h3 class="card-title">
                                        <i class="fa-solid fa-users"></i>
                                        </i>&nbsp;Add Program/Commodity Assignment</span>
                                    </h3>

                                </div>
                                <div class="card-body">
                                    <form action="{{ route('user.getcommodity', ['id' => $users->id]) }}" method="POST">
                                        @csrf
                                        <div class="row" id="addProgramRow">

                                            <div class="col-md-10 d-flex justify-content-between align-items-center gap-2">
                                                <label for="program">Program</label>
                                                <select name="ac_program_id" class="form-select form-select-sm">
                                                    <option value="">[Select]</option>
                                                    @foreach ($program as $item)
                                                        <option value="{{ $item->program_id }}"
                                                            {{ Request::get('ac_program_id') == $item->program_id ? 'selected' : '' }}>
                                                            {{ $item->program_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-2">
                                                <input type="submit" name="submit" id="submit"
                                                    class="btn btn-sm btn-success" value="Add Assignment">
                                            </div>
                                        </div>
                                        @error('ac_program_id')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </form>

                                </div>
                                <div class="card-footer">
                                    <div class="table-responsive">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title"><small>
                                                        <strong>List of Assigned Program(s)</strong>
                                                    </small>
                                                    &nbsp;<span id="programCount"
                                                        class="badge badge-primary ">{{ $asPro->count() }}</span>
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <table class="table table-sm" id="ascomcremod">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px" class="text-sm">#</th>
                                                            <th class="text-sm">Program</th>
                                                            <th class="text-sm">Status</th>
                                                            <th style="width: 40px">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                        $counter = 1;
                                                    @endphp
                                                    <tbody>
                                                        @foreach ($asPro as $assignedProgram)
                                                            <tr id="{{ $assignedProgram->ac_id }}"
                                                                class="{{ route('user.updatestatus', $assignedProgram->ac_id) }}">
                                                                <td class="text-sm">{{ $counter++ }}.</td>
                                                                <td class="text-sm">{{ $assignedProgram->program_name }}
                                                                </td>
                                                                <td class="text-sm">
                                                                    <select name="ac_status" id="ac_status"
                                                                        class="form-select form-select-sm">
                                                                        <option value="Active"
                                                                            {{ $assignedProgram->ac_status == 'Active' ? 'selected' : '' }}>
                                                                            Active
                                                                        </option>
                                                                        <option value="Inactive"
                                                                            {{ $assignedProgram->ac_status == 'Inactive' ? 'selected' : '' }}>
                                                                            Inactive
                                                                        </option>
                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteProgramModal"
                                                                        class="deleteProgram"
                                                                        data-url="{{ route('user.deletestatus', $assignedProgram->ac_id) }}"
                                                                        id="deleteProgram"><i
                                                                            class="fa-solid fa-trash-can-arrow-up bg-danger p-1"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>









                            </div>
                        </div>
                        <div class="row">
                            <div class=" card card-outline card-warning p-2">

                                <div class="card-header p-2">

                                    <span class="badge badge-info">Region: {{ $region }}</span>
                                    <span class="badge badge-primary">Province: {{ $province }}</span>
                                    <span class="badge badge-danger">City/Municipality: {{ $citymun }}</span>
                                    <h3 class="card-title col mt-2">
                                        <i class="fa-solid fa-users"></i>
                                        </i>&nbsp;Select Barangay Assignment</span>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('user.storebarassigned', ['id' => $users->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="row" id="addProgramRow">

                                            <div class="col-md-9 d-flex justify-content-between align-items-center gap-2">
                                                <label for="program">Barangay</label>
                                                <select name="ab_bar_id" class="form-select form-select-sm">
                                                    <option value="">[Select]</option>
                                                    @foreach ($barangay as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ Request::get('ab_bar_id') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->brgyDesc }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="col-md-3">
                                                <input type="submit" name="submit" id="submit"
                                                    class="btn btn-sm btn-success" value="Save Barangay Assignment">
                                            </div>
                                        </div>
                                        @error('ab_bar_id')
                                            <span class="text-red"><small>{{ $message }}</small></span>
                                        @enderror
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="table-responsive">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title"><small>
                                                        <strong>List of Assigned Barangay(s)</strong>
                                                    </small>
                                                    &nbsp;<span id="programCount"
                                                        class="badge badge-primary ">{{ $asBar->count() }}</span>
                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <table class="table table-sm" id="ascomcremod">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px" class="text-sm">#</th>
                                                            <th class="text-sm">Barangay</th>
                                                            <th class="text-sm">Status</th>
                                                            <th style="width: 40px">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                        $counter = 1;
                                                    @endphp
                                                    <tbody>
                                                        @foreach ($asBar as $assignedBarangay)
                                                            <tr id="{{ $assignedBarangay->ab_id }}"
                                                                class="{{ route('user.updatestatus', $assignedBarangay->ab_id) }}">
                                                                <td class="text-sm">{{ $counter++ }}.</td>
                                                                <td class="text-sm">{{ $assignedBarangay->brgyDesc }}
                                                                </td>
                                                                <td class="text-sm">
                                                                    <select name="ab_status" id="ab_status"
                                                                        class="form-select form-select-sm">
                                                                        <option value="Active"
                                                                            {{ $assignedBarangay->ab_status == 'Active' ? 'selected' : '' }}>
                                                                            Active
                                                                        </option>
                                                                        <option value="Inactive"
                                                                            {{ $assignedBarangay->ab_status == 'Inactive' ? 'selected' : '' }}>
                                                                            Inactive
                                                                        </option>
                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteProgramModal"
                                                                        class="deleteProgram"
                                                                        data-url="{{ route('user.deletestatus', $assignedBarangay->ab_id) }}"
                                                                        id="deleteProgram"><i
                                                                            class="fa-solid fa-trash-can-arrow-up bg-danger p-1"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
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





        </section>
        <!-- /.content -->



    </div>
@endsection
