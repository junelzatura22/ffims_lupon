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
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search</h3>
                        </div>
                        <div class="card-body">


                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="card card-outline card-success">
                        <div class="card-header">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h3 class="card-title">
                                        <i class="fa-solid fa-users"></i>
                                        </i>&nbsp;List of Association&nbsp; <span class="badge badge-success p-2"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Total Association">
                                            {{ $association->total() }} </span>
                                    </h3>
                                </div>
                                <div class="card-tools">
                                    <a href="{{ route('rbo.createassociation') }}" class="btn btn-sm btn-success"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Register New Association">
                                        <i class="fa-solid fa-user-plus"></i>&nbsp;New Association</a>
                                </div>


                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="table table-hover" id="associationTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-sm bg-gradient-green font-weight-bold">#</th>
                                            <th class="text-sm">Name</th>
                                            <th class="text-sm">Description</th>
                                            <th class="text-sm">President</th>

                                            <th width="130px" class="text-center text-sm">Status</th>
                                            <th class="text-sm">Program</th>
                                            <th class="text-center text-sm">Members</th>
                                            <th class="text-sm">Barangay</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($association as $index => $item)
                                            <tr id="{{ route('rbo.updatestatus', $item->as_id) }}">
                                                <td class="text-center text-sm bg-gradient-green font-weight-bold">
                                                    {{ $association->firstItem() + $index }}
                                                </td>
                                                <td class="text-sm"> {{ $item->nameabbr }} </td>
                                                <td class="text-sm"> {{ $item->namedesc }} </td>
                                                <td class="text-sm"></td>

                                                <td class="text-center text-sm">
                                                    <select name="as_status" id="as_status"
                                                        class="form-select form-select-sm">
                                                        <option value="Active"
                                                            {{ $item->as_status == 'Active' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="Inactive"
                                                            {{ $item->as_status == 'Inactive' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>

                                                </td>
                                                <td class="text-sm">{{ $item->pName }}</td>
                                                <td class="text-center text-sm"><a href=""
                                                        class="text-danger text-lg">0</a></td>
                                                <td class="text-sm">{{ $item->barName }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="" class="btn btn-sm btn-primary "
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add Member">
                                                            <i class="fa-solid fa-user-plus"></i>
                                                        </a>
                                                        <a href="{{ route('rbo.update', $item->as_id) }}"
                                                            class="btn btn-sm btn-warning " data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Edit Association">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </div>

                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <div style="position: absolute; top:0; right:0; z-index:10">
                                @include('_message')
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-md m-0 float-right">
                                {!! $association->links() !!}
                            </ul>
                        </div>



                    </div>

                    {{-- display message in this row  --}}



                </div>
        </section>

    </div>
@endsection
