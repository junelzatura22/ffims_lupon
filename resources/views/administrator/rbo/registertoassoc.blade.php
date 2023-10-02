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
                            {{ !empty(Breadcrumbs::render('associationReg', $association)) ? Breadcrumbs::render('associationReg', $association) : '' }}
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
                        <div class="card card-outline card-success shadow-sm">
                            <div class="card-header">
                                <div class="card-title">
                                    <h6>Load Farmer/Fisherfolk</h6>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="" method="get">
                                    <div class="row">

                                        <div class="col-md-4 d-flex align-items-center gap-1">
                                            <label>Barangay</label>
                                            <select name="barid" id="barid" class="form-select">
                                                <option value="">[ Select ]</option>
                                                @foreach ($barangay as $item)
                                                    <option value={{ $item->id }}
                                                        {{ Request::get('barid') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->brgyDesc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center gap-1">
                                            <label>Index</label>
                                            <select name="" id="" class="form-select">
                                                <option value="">[ Select ]</option>
                                                <option value="">[ A ]</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex gap-1 align-items-center">
                                            <input type="submit" class="btn btn-success" value="Load">
                                            <a href="{{ route('rbo.registertoassoc', $association->as_id) }}"
                                                class="form-control btn-success text-center">
                                                <i class="fa-solid fa-arrow-rotate-right"></i>&nbsp;Reset</a>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Bootstrap Duallistbox</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Select List of Farmer/Fisherfolk</label>
                                            <select class="duallistbox" multiple="multiple" size="12" name="farmerFisherfolk[]">

                                                @foreach ($f2 as $item)
                                                    <option value="{{ $item->ff_id . ':' . $item->fname }}">
                                                        {{ $item->ff_id . ':' . $item->fname }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" 
                                       class="btn btn-primary float-right" value="Save to {{ $association->nameabbr }}">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
