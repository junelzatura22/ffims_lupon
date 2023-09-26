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
                            {{ Breadcrumbs::render("ProgramCategoryCreate") }}
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="d-flex align-items-center justify-content-center">
                        <!-- jquery validation -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Category Program Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="programCategoryForm" method="post" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="pc_name">*&nbsp;Category Name</label>
                                        <input type="text" name="pc_name" class="form-control" id="pc_name"
                                            placeholder="Ex. Banana-lakatan" value="{{ old('pc_name') }}">
                                        <input type="hidden" name="created_by" id="created_by" placeholder="created_by"
                                            value="{{ Auth::user()->id }}">
                                        @error('pc_name')
                                            <div class="error-message">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="prog_id">*&nbsp;Belongs to Program/Sector/Commodity</label>

                                        <select name="prog_id" class="form-select">
                                            <option value="">[Select]</option>
                                            @foreach ($listOfProgram as $item)
                                                <option value="{{$item->program_id}}" {{ old('prog_id') == $item->program_id ? "selected" : "" }}>{{ $item->program_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('prog_id')
                                            <div class="error-message">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    
                                        <div class="d-flex gap-2 justify-content-between align-items-center">
                                            <a href="{{ route('management.programcategory') }}" class="btn btn-primary"><i
                                                    class="fa-solid fa-arrow-left-long"></i>&nbsp;Back to Program Category
                                                List</a>
                                            <button type="submit" class="btn bg-gradient-green">Save</button>
                                        </div>
                                   
                                </div>


                                
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                   
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
