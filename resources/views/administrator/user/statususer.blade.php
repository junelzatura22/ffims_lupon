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
                                    <i class="fa-solid fa-users"></i>
                                    </i>&nbsp;User Status</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" id="userForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name">First Name</label>

                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Ex. John" value="{{ $userRecord->name }}" readonly />

                                        </div>
                                        <div class="col-md-4">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname"
                                                placeholder="Ex. Doe" value="{{ $userRecord->lastname }}" readonly />

                                        </div>
                                        <div class="col-md-4">
                                            <label for="email">Email</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="johndoe@gmail.com" value="{{ $userRecord->email }}"
                                                    readonly />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mt-1 mb-1">
                                        <div class="col-md-4">
                                            <label for="role">Role</label>
                                            <input type="text" class="form-control" name="role" id="role"
                                                value="{{ $userRecord->role }}" readonly />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="designation">Designation</label>
                                            <input type="text" class="form-control" name="designation" id="designation"
                                                value="{{ $userRecord->designation }}" readonly />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" name="contact" id="contact"
                                                value="{{ $userRecord->contact }}" readonly />
                                        </div>
                                    </div>
                                    <div class="row mt-2">

                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <small class="text-red"><strong>NOTE: once the user is inactive, he/she will no longer have access to FFIMS</strong></small>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <select name="status" id="status" class="form-select">
                                                    <option value="">[Select]</option>
                                                    <option value="Active"
                                                        {{ $userRecord->status == 'Active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="Inactive"
                                                        {{ $userRecord->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-red"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md">
                                            <a href="{{ route('user.index') }}" class="btn btn-primary">
                                                <i class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to user list</a>
                                            <input type="submit" value="Save Changes" class="btn btn-danger float-right" />
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
