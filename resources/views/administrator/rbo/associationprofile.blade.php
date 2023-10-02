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
                            {{ Breadcrumbs::render('associationProfile') }}
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
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title text-info">
                                <i class="fa-solid fa-people-roof"></i>
                                </i>&nbsp;Association Profile
                            </h3>
                        </div>
                        <div class="card-body">
                            {{-- start of card body  --}}
                            <div class="row">


                                @foreach ($assProfile as $profile)
                                    <div class="col-md-6">
                                        <!-- Box Comment -->
                                        <div class="card card-widget card-outline card-success">
                                            <div class="card-header">
                                                <div>
                                                    <h5 class="text-center mb-2"><strong>

                                                            {{ $profile->name }}</strong></h5>
                                                </div>

                                                @php
                                                    $presidentName = \App\Models\AssociationProfile::getPresidentDetails($profile->assoc_id);
                                                    
                                                    $image = empty($presidentName->imahe) ? 'avatar.png' : $presidentName->imahe;
                                                @endphp

                                                <div class="d-flex justify-content-between">
                                                    <div class="user-block">
                                                        <img class="img-circle border shadow p-1" src="{{ asset('asset/f2/' . $image . '') }}"
                                                            alt="User Image">


                                                        <span class="username">
                                                            <a href="#">
                                                                {{ empty($presidentName->farmer) ? 'No President Assigned' : $presidentName->farmer }}
                                                            </a></span>
                                                        <span class="description">Association President</span>
                                                    </div>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-body">
                                                @php
                                                    
                                                    $forOfficials = \App\Models\AssociationProfile::loadMembers($profile->assoc_id, 'Sort');
                                                    
                                                    $counter = 1;
                                                @endphp



                                                <div class="card">
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="card-header">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="card-title text-primary">List of Officials
                                                                    </h6>

                                                                    <div class="card-tools">
                                                                        <a href="{{ route('rbo.associationprofiledata',$profile->assoc_id) }}" class="btn btn-sm btn-primary "
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="View Association">
                                                                            <i class="fa-solid fa-building-wheat"></i>&nbsp;View Association
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <table class="table table-sm">
                                                                    <thead>

                                                                        <tr>
                                                                            <th style="width: 10px">#</th>
                                                                            {{-- <th>Image</th> --}}
                                                                            <th>Name</th>
                                                                            <th>Position</th>
                                                                            <th>Member Since</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>


                                                                        @foreach ($forOfficials as $item)
                                                                            <tr>
                                                                                <td>{{ $counter++ }}.</td>
                                                                                {{-- <td>
                                                                                    <div class="user-block">
                                                                                        <img class="img-circle"
                                                                                            src="{{ asset('/dist/img/user1-128x128.jpg') }}"
                                                                                            alt="User Image">
                                                                                    </div>
                                                                                </td> --}}
                                                                                <td>{{ $item->farmer }}</td>
                                                                                <td> {{ $item->assoc_position }}</td>
                                                                                <td>{{ $item->membersince }}</span>
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
                                @endforeach



                                {{-- end of card body  --}}
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
