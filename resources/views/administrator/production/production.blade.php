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
                            {{ !empty(Breadcrumbs::render('Production')) ? Breadcrumbs::render('Production') : '' }}
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

                <div class="row p-1">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">
                                <h6>Search</h6>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="" method="get">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Farm Name</span>
                                            </div>
                                            <input class="form-control" type="text" name="farm"
                                                placeholder="Enter Farm Name" aria-label="Recipient's text"
                                                value="{{ Request::get('farm') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Program</span>
                                            </div>
                                            <select name="pid" class="form-select">
                                                <option value="">[Select Progam]</option>
                                                @foreach ($listOfProgram as $item)
                                                    <option value="{{ $item->program_id }}"
                                                        {{ Request::get('pid') == $item->program_id ? 'selected' : '' }}>
                                                        {{ $item->program_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Barangay</span>
                                            </div>
                                            <select name="barid" id="barid" class="form-select">
                                                <option value="">[ Barangay ]</option>
                                                @foreach ($barangay as $item)
                                                    <option value={{ $item->id }}
                                                        {{ Request::get('barid') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->brgyDesc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" value="Search" class="btn btn-primary">
                                        <a href="{{ route('production.index') }}" class="btn btn-primary">Reset</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="row p-1">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="card-title">
                                <span>Total Farms:&nbsp;</span>
                                <span class="badge badge-primary">{{ $farmActivity->count() }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                @if ($farmActivity->count() == 0)
                                    <div class="col d-flex gap-3 align-items-center">
                                        <h5>No farm activity found!</h1>
                                        <a href="{{ route('production.index') }}" class="btn btn-primary">Reload</a>
                                    </div>
                                @else
                                    @foreach ($farmActivity as $item)
                                        <div class="col-md-4">
                                            <div class="card card-widget widget-user-2 shadow p-2">
                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                <div class="widget-user-header bg-success">
                                                    <h5>{{ $item->farm }}</h5>
                                                    <h6>Program: {{ $item->commodity }}</h6>
                                                </div>
                                                <div class="card-footer p-0">
                                                    <ul class="nav flex-column">
                                                        <li
                                                            class="nav-item d-flex justify-content-between align-items-center m-1">
                                                            <h6>{{ $item->subcommododity }}, {{ $item->area }} Hectares
                                                            </h6>
                                                            <a href="#"
                                                                class="nav-link btn btn-sm bg-primary">Production</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif



                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-md m-0 float-right">
                                {!! $farmActivity->links() !!}
                            </ul>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
