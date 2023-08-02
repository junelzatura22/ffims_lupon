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
                                    </i>&nbsp;Update User Form</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" id="userForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name">*&nbsp;First Name</label>

                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Ex. John" value="{{ $userRecord->name }}" />
                                            @error('name')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lastname">*&nbsp;Last Name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname"
                                                placeholder="Ex. Doe" value="{{ $userRecord->lastname }}" />
                                            @error('lastname')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email">*&nbsp;Email</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="johndoe@gmail.com" value="{{ $userRecord->email }}" />
                                            </div>
                                            @error('email')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-1 mb-1">
                                        <div class="col-md-4">
                                            <label for="role">*&nbsp;Role</label>
                                            <select name="role" id="role" class="form-select">
                                                <option value="">[Select]</option>
                                                <option value="Administrator"
                                                    {{ $userRecord->role == 'Administrator' ? 'selected' : '' }}>Administrator
                                                </option>
                                                <option value="Technician"
                                                    {{ $userRecord->role == 'Technician' ? 'selected' : '' }}>Technician</option>
                                                <option value="Office Head"
                                                    {{  $userRecord->role == 'Office Head' ? 'selected' : '' }}>Office Head
                                                </option>
                                                <option value="Guest" {{  $userRecord->role == 'Guest' ? 'selected' : '' }}>Guest
                                                </option>
                                            </select>
                                            @error('role')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="designation">*&nbsp;Designation</label>

                                            <select name="designation" id="designation" class="form-select">
                                                <option value="">[Select]</option>
                                                <option value="MAO/CAO"
                                                    {{  $userRecord->designation == 'MAO/CAO' ? 'selected' : '' }}>
                                                    MAO/CAO</option>
                                                <option value="Program Coordinator"
                                                    {{ $userRecord->designation == 'Program Coordinator' ? 'selected' : '' }}>
                                                    Program Coordinator</option>
                                                <option value="Encoder"
                                                    {{ $userRecord->designation == 'Encoder' ? 'selected' : '' }}>
                                                    Encoder</option>
                                                <option value="Report Officer"
                                                    {{ $userRecord->designation == 'Report Officer' ? 'selected' : '' }}>Report
                                                    Officer</option>
                                                @if (Auth()->user()->role == 'Administrator')
                                                    <option value="Database Admin"
                                                        {{ $userRecord->designation == 'Database Admin' ? 'selected' : '' }}>
                                                        Database Admin</option>
                                                @endif
                                            </select>

                                            @error('designation')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact">*&nbsp;Contact</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa-solid fa-square-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="contact"
                                                    data-inputmask='"mask": "9999-999-9999"' data-mask id="contact"
                                                    placeholder="0000-000-0000" value="{{ $userRecord->contact }}" />
                                            </div>
                                            @error('contact')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-1 mb-1">
                                        <div class="col-md">
                                            <label for="image">Image&nbsp;<small
                                                    class="text-red"><i>Optional</i></small></label>
                                            <input type="file" class="form-control" name="image" id="image"
                                                value="{{ old('image') }}" accept="image/png, image/gif, image/jpeg" />
                                            @error('image ')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md">
                                            <a href="{{ route('user.index') }}" class="btn btn-primary">
                                                <i class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to user list</a>
                                            <input type="submit" value="Save Changes"
                                                class="btn btn-danger float-right" />
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
