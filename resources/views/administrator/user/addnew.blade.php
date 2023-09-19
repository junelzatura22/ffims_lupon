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
                                    </i>&nbsp;Create User Form</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" id="userForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name">*&nbsp;First Name</label>

                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Ex. John" value="{{ old('name') }}" />
                                            @error('name')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="lastname">*&nbsp;Last Name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname"
                                                placeholder="Ex. Doe" value="{{ old('lastname') }}" />
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
                                                    placeholder="johndoe@gmail.com" value="{{ old('email') }}" />
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
                                                    {{ old('role') == 'Administrator' ? 'selected' : '' }}>Administrator
                                                </option>
                                                <option value="Technician"
                                                    {{ old('role') == 'Technician' ? 'selected' : '' }}>Technician</option>
                                                <option value="Office Head"
                                                    {{ old('role') == 'Office Head' ? 'selected' : '' }}>Office Head
                                                </option>
                                                <option value="Guest" {{ old('role') == 'Guest' ? 'selected' : '' }}>Guest
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
                                                    {{ old('designation') == 'MAO/CAO' ? 'selected' : '' }}>
                                                    MAO/CAO</option>
                                                <option value="Program Coordinator"
                                                    {{ old('designation') == 'Program Coordinator' ? 'selected' : '' }}>
                                                    Program Coordinator</option>
                                                <option value="Encoder"
                                                    {{ old('designation') == 'Encoder' ? 'selected' : '' }}>
                                                    Encoder</option>
                                                <option value="Report Officer"
                                                    {{ old('designation') == 'Report Officer' ? 'selected' : '' }}>Report
                                                    Officer</option>
                                                @if (Auth()->user()->role == 'Administrator')
                                                    <option value="Database Admin"
                                                        {{ old('designation') == 'Database Admin' ? 'selected' : '' }}>
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
                                                    placeholder="0000-000-0000" value="{{ old('contact') }}" />
                                            </div>
                                            @error('contact')
                                                <span class="text-red"><small>{{ $message }}</small></span>
                                            @enderror
                                            {{-- this is for the hidden fixed location  --}}
                                            <input type="hidden" value="{{ $mylocation->region_id }}" name="region_id" />
                                            <input type="hidden" value="{{ $mylocation->province_id }}"
                                                name="province_id" />
                                            <input type="hidden" value="{{ $mylocation->citymun_id }}"
                                                name="citymun_id" />


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
                                            <input type="submit" value="Save User Details"
                                                class="btn btn-success float-right" />
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
