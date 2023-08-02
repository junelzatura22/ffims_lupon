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
                                <form action="{{ route('user.getcommodity', ['id' => $users->id]) }}" method="POST">
                                    @csrf
                                    <div class="card-header p-2">
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;Program/Commodity Assignment</span>
                                        </h3>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            @foreach ($program as $programItem)
                                                <div class="col-md-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckChecked" name="commodity[]"
                                                            value="{{ $programItem->program_id }}">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">
                                                            {{ $programItem->program_name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @error('commodity')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror

                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <input type="submit" name="submit" id="submit"
                                            class="float-right btn btn-sm btn-success" value="Save Program Assignment">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" card card-outline card-warning p-2">
                                <form action="">
                                    <div class="card-header p-2">
                                        <h3 class="card-title">
                                            <i class="fa-solid fa-users"></i>
                                            </i>&nbsp;Barangay Assignment</span>
                                        </h3>

                                    </div>
                                    <div class="card-body">
                                        Ok
                                    </div>
                                    <div class="card-footer">
                                        <input type="submit" name="submit" id="submit"
                                            class="float-right btn btn-sm btn-success" value="Save Barangay Assignment">
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>

                <div style="position: absolute; top:0; right:0; z-index:10">
                    @include('_message')
                </div>



        </section>
        <!-- /.content -->



    </div>
@endsection
