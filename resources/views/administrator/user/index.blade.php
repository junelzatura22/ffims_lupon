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
                    <div class="col-lg">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    </i>&nbsp;Search Users</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="get" id="searchProductCategory">

                                    <div class="row">
                                        <div class="col-md-4">

                                            <label for="nameKey">Name <small>(First name, Last name)</small></label>
                                            <input type="text" class="form-control form-control-sm" name="nameKey"
                                                id="nameKey" value="{{ Request::get('nameKey') }}" />

                                        </div>
                                        <div class="col-md-3">
                                            <label for="roleKey">Program</label>
                                            <select name="roleKey" class="form-select form-select-sm">
                                                <option value="">[Select]</option>
                                                <option value="Administrator"
                                                    {{ Request::get('roleKey') == 'Administrator' ? 'selected' : '' }}>
                                                    Administrator
                                                </option>
                                                <option value="Technician"
                                                    {{ Request::get('roleKey') == 'Technician' ? 'selected' : '' }}>
                                                    Technician</option>
                                                <option value="Office Head"
                                                    {{ Request::get('roleKey') == 'Office Head' ? 'selected' : '' }}>Office
                                                    Head
                                                </option>
                                                <option value="Guest"
                                                    {{ Request::get('roleKey') == 'Guest' ? 'selected' : '' }}>Guest
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="desKey">Designation</label>
                                            <select name="desKey" id="desKey" class="form-select form-select-sm">
                                                <option value="">[Select]</option>
                                                <option value="MAO/CAO"
                                                    {{ Request::get('desKey') == 'MAO/CAO' ? 'selected' : '' }}>
                                                    MAO/CAO</option>
                                                <option value="Program Coordinator"
                                                    {{ Request::get('desKey') == 'Program Coordinator' ? 'selected' : '' }}>
                                                    Program Coordinator</option>
                                                <option value="Encoder"
                                                    {{ Request::get('desKey') == 'Encoder' ? 'selected' : '' }}>
                                                    Encoder</option>
                                                <option value="Report Officer"
                                                    {{ Request::get('desKey') == 'Report Officer' ? 'selected' : '' }}>
                                                    Report
                                                    Officer</option>
                                                @if (Auth()->user()->role == 'Administrator')
                                                    <option value="Database Admin"
                                                        {{ Request::get('roleKey') == 'Database Admin' ? 'selected' : '' }}>
                                                        Database Admin</option>
                                                @endif
                                            </select>


                                        </div>

                                        <div class="col-md-1">
                                            <label for="" class="d-none d-md-block text-white">DUMMY</label>
                                            <input type="submit" value="Search"
                                                class="form-control form-control-sm  bg-gradient-green " />
                                        </div>
                                        <div class="col-md-1">
                                            <label for="" class="d-none d-md-block text-white">DUMMY</label>
                                            <a href="{{ route('user.index') }}"
                                                class="form-control form-control-sm btn-success text-center">
                                                <i class="fa-solid fa-arrow-rotate-right"></i>&nbsp;Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card card-outline card-success">
                            <div class="card-header">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;List of Users&nbsp; <span class="badge badge-success p-2">
                                                {{ $users->count() }} </span>
                                        </h3>
                                    </div>
                                    <div class="card-tools">
                                        <a href="{{ route('user.createuser') }}" class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-user-plus"></i>&nbsp;New User</a>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-2">
                                <div class="row">
                                    @foreach ($users as $item)
                                        <div class="col-md-4">
                                            <!-- Widget: user widget style 1 -->
                                            <div class="card card-widget widget-user shadow ">
                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                <div
                                                    class="widget-user-header bg-info {{ $item->status == 'Active' ? 'bg-gradient-green' : 'bg-danger' }} ">
                                                    <h3 class="widget-user-username">
                                                        {{ $item->name . ' ' . $item->lastname }}
                                                    </h3>
                                                    <h5 class="widget-user-desc">{{ $item->role }}</h5>
                                                </div>
                                                <div class="widget-user-image">
                                                    <img class="img-circle elevation-2"
                                                        src="{{ asset('asset/user/' . $item->image . '') }}"
                                                        alt="User Avatar">
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <label for="" class="nav-link">
                                                                        <strong>Email</strong> <span
                                                                            class="float-right badge bg-primary text-sm">{{ $item->email }}</span>
                                                                    </label>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <label for="" class="nav-link">
                                                                        <strong>Commodity</strong> <span
                                                                            class="float-right badge bg-info text-sm">RICE</span>
                                                                    </label>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <label for="" class="nav-link">
                                                                        <strong>Designation</strong> <span
                                                                            class="float-right badge bg-purple text-sm">{{ $item->designation }}</span>
                                                                    </label>
                                                                </li>
                                                               
                                                                <li class="nav-item">
                                                                    <label for="" class="nav-link">
                                                                        <strong>Status</strong> <span
                                                                            class="float-right badge bg-warning text-sm">{{ $item->status }}</span>
                                                                    </label>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <label for="" class="nav-link">
                                                                        <strong>Contact</strong> <span
                                                                            class="float-right badge bg-danger text-sm">{{ $item->contact }}</span>
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="d-flex gap-1">
                                                            @if ($item->status == 'Active')
                                                                <a href="{{ route('user.getusertoupdate', ['id' => $item->id]) }}"
                                                                    class="nav-link btn btn-xs p-2 btn-success">
                                                                    <i class="fa-solid fa-user-pen"></i>&nbsp;Edit</a>
                                                                <a href="{{ route('user.getuserstatus', ['id' => $item->id]) }}"
                                                                    class="nav-link btn btn-xs p-2 btn-warning">
                                                                    <i
                                                                        class="fa-solid fa-pen-to-square"></i>&nbsp;Status</a>
                                                                <a href="{{ route('user.getuserstatus', ['id' => $item->id]) }}"
                                                                    class="nav-link btn btn-xs p-2 btn-primary">
                                                                    <i class="fa-solid fa-user-clock"></i>&nbsp;Activity</a>
                                                               
                                                            @else
                                                                <a href="{{ route('user.getuserstatus', ['id' => $item->id]) }}"
                                                                    class="nav-link btn btn-xs p-2 btn-danger">
                                                                    <i
                                                                        class="fa-solid fa-pen-to-square"></i>&nbsp;Status</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                            </div>
                                            <!-- /.widget-user -->
                                        </div>
                                    @endforeach

                                </div>


                            </div>




                            <div style="position: absolute; top:0; right:0; z-index:10">
                                @include('_message')
                            </div>

                            <!-- /.card-body -->
                        </div>
                    </div>

                </div>
            </div><!-- /.container-fluid -->



        </section>
        <!-- /.content -->



    </div>
@endsection
