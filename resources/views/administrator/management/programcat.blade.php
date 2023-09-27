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
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="m-0 text-gray ">{{ !empty($identifier) ? $identifier : 'Dashboard' }}</h4>
                        </div><!-- /.col -->
                        <div>
                            {{ Breadcrumbs::render('ProgramCategory') }}
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
                    <div class="col-lg">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    </i>&nbsp;Search Program Category</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="get" id="searchProductCategory">

                                    <div class="row">
                                        <div class="col-md-5 ">


                                            <input type="text" class="form-control" name="searchKey" id="searchKey"
                                                value="{{ Request::get('searchKey') }}" placeholder="Enter Category" />

                                        </div>
                                        <div class="col-md-5">

                                            <select name="program_id" class="form-select">
                                                <option value="">[Select Progam]</option>
                                                @foreach ($listOfProgram as $item)
                                                    <option value="{{ $item->program_id }}"
                                                        {{ Request::get('program_id') == $item->program_id ? 'selected' : '' }}>
                                                        {{ $item->program_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex gap-1">

                                            <input type="submit" value="Search"
                                                class="form-control   bg-gradient-green " />
                                            <a href="{{ route('management.programcategory') }}"
                                                class="form-control  btn-success text-center">
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
                                            <i class="fa-regular fa-rectangle-list">
                                            </i>&nbsp;List of Program Category&nbsp; <span class="badge badge-success p-2">
                                                {{ $programCatData->total() }} </span>
                                        </h3>
                                    </div>
                                    <div class="card-tools">
                                        <a href="{{ route('management.createprogramcat') }}" class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-plus"></i>&nbsp;Add Program Category</a>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-2">

                                @if ($programCatData->count() == 0)
                                    <div class="col text-center p-2">
                                        <h6>Sorry, no result found!</h6>
                                    </div>
                                @else
                                    <div class="table-responsive-sm">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-sm text-center">#</th>
                                                    <th class="text-sm ">Category</th>
                                                    <th class="text-sm">Program</th>
                                                    <th class="text-sm ">Date Created</th>
                                                    <th class="text-sm ">Created By</th>
                                                    <th class="text-center text-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($programCatData as $index => $dataItem)
                                                    <tr id="{{ $dataItem->pc_id }}" class="{{ $dataItem->pc_name }}">
                                                        <td class="bg-gradient-green text-sm font-weight-bold text-center">
                                                            {{ $programCatData->firstItem() + $index }}</td>
                                                        <td class="">{{ $dataItem->pc_name }}</td>
                                                        <td class="text-sm">{{ $dataItem->program_name }}</td>
                                                        <td class="text-sm ">
                                                            {{ date('F, d Y h:i A', strtotime($dataItem->created_at)) }}
                                                        </td>
                                                        <td class="text-sm">
                                                            {{ $dataItem->name . ' ' . $dataItem->lastname }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('management.getprogramcategory', ['pc_id' => $dataItem->pc_id]) }}"
                                                                data-bs-toggle="tooltip"><i
                                                                    class="fa-solid fa-pen-to-square bg-gradient-green p-1"
                                                                    data-bs-placement="bottom" title="Edit Program"></i></a>


                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#deleteStatusModal"
                                                                class="deleteStatusModal"><i
                                                                    class="fa-solid fa-trash-can-arrow-up bg-danger p-1"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif



                            </div>
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-md m-0 float-right">
                                    {!! $programCatData->links() !!}
                                </ul>
                            </div>

                            <div style="position: absolute; top:0; right:0; z-index:10">
                                @include('_message')
                            </div>

                            <!-- /.card-body -->
                        </div>
                    </div>

                </div>
            </div><!-- /.container-fluid -->

            <div class="modal fade" id="deleteStatusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <form action="{{ route('management.deleteprogramcategory') }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header bg-green">
                                <h5 class="modal-title text-sm" id="staticBackdropLabel">Delete Program Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="">Want to delete&nbsp;<strong id="test"
                                        class="text-red"></strong>&nbsp;(Yes/No)?</label>
                                <input type="hidden" name="pc_id" id="pc_id" />
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-sm btn-success" value="Delete">
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </section>
        <!-- /.content -->



    </div>
@endsection
