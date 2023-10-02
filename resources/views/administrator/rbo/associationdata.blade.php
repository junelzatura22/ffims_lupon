@extends('layouts.app')

@section('content-details')
    {{-- All start with the row  --}}
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 text-info">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h6>
                        </div><!-- /.col -->
                        <div>
                            {{ !empty(Breadcrumbs::render('associationData', $association)) ? Breadcrumbs::render('associationData', $association) : '' }}
                        </div><!-- /.col -->
                    </div>


                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{Auth::user()->role}} Dashboard</li>
                        </ol>
                    </div><!-- /.col --> --}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">
                        <div class="card card-outline card-success">
                            <div class="card-title d-flex align-items-center justify-content-between  p-3">
                                <h6 class="card-title text-info">Association Details</h6>
                                <div class="card-tools">
                                    <a href="{{ route('rbo.registertoassoc', $association->as_id) }}"
                                        class="btn btn-sm btn-primary " data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Add Member">
                                        <i class="fa-solid fa-user-plus"></i>&nbsp;Add Member
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                @php
                                    
                                    $forOfficials = \App\Models\AssociationProfile::loadData($association->as_id, 'Sort');
                                    $forMembers = \App\Models\AssociationProfile::loadData($association->as_id, 'Member');
                                    
                                    $counter = 1;
                                @endphp



                                <div class="card">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-header">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="card-title text-primary">List of Officials
                                                    </h6>


                                                </div>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table class="table table-sm">
                                                    <thead>

                                                        <tr>
                                                            <th style="width: 30px" class="bg-success p-1 text-center">#
                                                            </th>
                                                            {{-- <th>Image</th> --}}
                                                            <th>Name</th>
                                                            <th>Position</th>
                                                            <th>Member Since</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        @foreach ($forOfficials as $item)
                                                            <tr>
                                                                <td style="width: 30px" class="bg-success p-1 text-center">
                                                                    {{ $counter++ }}.</td>

                                                                <td>{{ str_replace('[Select]', '', $item->farmer) }}</td>
                                                                <td>
                                                                    <select name="ass_position" id="ass_position"
                                                                        class="form-select form-select-sm">
                                                                        <option value="President"
                                                                            {{ $item->assoc_position == 'President' ? 'selected' : '' }}>
                                                                            President</option>
                                                                        <option value="Vice President"
                                                                            {{ $item->assoc_position == 'Vice President' ? 'selected' : '' }}>
                                                                            Vice President
                                                                        </option>
                                                                        <option
                                                                            value="Secretary"{{ $item->assoc_position == 'Secretary' ? 'selected' : '' }}>
                                                                            Secretary</option>
                                                                        <option
                                                                            value="Treasurer"{{ $item->assoc_position == 'Treasurer' ? 'selected' : '' }}>
                                                                            Treasurer</option>
                                                                        <option
                                                                            value="Auditor"{{ $item->assoc_position == 'Auditor' ? 'selected' : '' }}>
                                                                            Auditor</option>
                                                                        <option
                                                                            value="Business Manager"{{ $item->assoc_position == 'Business Manager' ? 'selected' : '' }}>
                                                                            Business Manager
                                                                        </option>
                                                                        <option
                                                                            value="P.I.O"{{ $item->assoc_position == 'P.I.O' ? 'selected' : '' }}>
                                                                            P.I.O</option>
                                                                        <option
                                                                            value="BOT"{{ $item->assoc_position == 'BOT' ? 'selected' : '' }}>
                                                                            BOT</option>
                                                                        <option
                                                                            value="Member"{{ $item->assoc_position == 'Member' ? 'selected' : '' }}>
                                                                            Member</option>

                                                                    </select>


                                                                </td>
                                                                <td class="d-flex justify-content-between">
                                                                    {{ $item->membersince }}
                                                                    <button class="btn btn-sm btn-primary"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Edit Member"><i
                                                                            class="fa-regular fa-calendar-days"></i></button>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <Select name="assoc_status" id="assoc_status"
                                                                        class="form-select form-select-sm">
                                                                        <option value="Active"
                                                                            {{ $item->status == 'Active' ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="Inactive"
                                                                            {{ $item->status == 'Inactive' ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </Select>
                                                                </td>

                                                            </tr>
                                                        @endforeach




                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->


                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="card-header">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h6 class="card-title text-primary">List of Members
                                                    </h6>


                                                </div>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table class="table table-sm">
                                                    <thead>

                                                        <tr>
                                                            <th style="width: 30px" class="bg-success p-1 text-center">#
                                                            </th>
                                                            {{-- <th>Image</th> --}}
                                                            <th>Name</th>
                                                            <th>Position</th>
                                                            <th>Member Since</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        @foreach ($forMembers as $item)
                                                            <tr>
                                                                <td style="width: 30px" class="bg-success p-1 text-center">
                                                                    {{ $counter++ }}.</td>
                                                                <td>{{ str_replace('[Select]', '', $item->farmer) }}</td>
                                                                <td>
                                                                    <select name="ass_position" id="ass_position"
                                                                        class="form-select form-select-sm">
                                                                        <option value="President"
                                                                            {{ $item->assoc_position == 'President' ? 'selected' : '' }}>
                                                                            President</option>
                                                                        <option value="Vice President"
                                                                            {{ $item->assoc_position == 'Vice President' ? 'selected' : '' }}>
                                                                            Vice President
                                                                        </option>
                                                                        <option
                                                                            value="Secretary"{{ $item->assoc_position == 'Secretary' ? 'selected' : '' }}>
                                                                            Secretary</option>
                                                                        <option
                                                                            value="Treasurer"{{ $item->assoc_position == 'Treasurer' ? 'selected' : '' }}>
                                                                            Treasurer</option>
                                                                        <option
                                                                            value="Auditor"{{ $item->assoc_position == 'Auditor' ? 'selected' : '' }}>
                                                                            Auditor</option>
                                                                        <option
                                                                            value="Business Manager"{{ $item->assoc_position == 'Business Manager' ? 'selected' : '' }}>
                                                                            Business Manager
                                                                        </option>
                                                                        <option
                                                                            value="P.I.O"{{ $item->assoc_position == 'P.I.O' ? 'selected' : '' }}>
                                                                            P.I.O</option>
                                                                        <option
                                                                            value="BOT"{{ $item->assoc_position == 'BOT' ? 'selected' : '' }}>
                                                                            BOT</option>
                                                                        <option
                                                                            value="Member"{{ $item->assoc_position == 'Member' ? 'selected' : '' }}>
                                                                            Member</option>

                                                                    </select>


                                                                </td>
                                                                <td class="d-flex justify-content-between">
                                                                    {{ $item->membersince }}
                                                                    <button class="btn btn-sm btn-primary"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Edit Member"><i
                                                                            class="fa-regular fa-calendar-days"></i></button>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <Select name="assoc_status" id="assoc_status"
                                                                        class="form-select form-select-sm">
                                                                        <option value="Active"
                                                                            {{ $item->status == 'Active' ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="Inactive"
                                                                            {{ $item->status == 'Inactive' ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </Select>
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
                    </div>

                </div>


              


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
