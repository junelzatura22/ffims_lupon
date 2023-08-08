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

                    <div class="col-md">
                        <div class="row">
                            <div class="card card-outline card-danger p-2">
                                @csrf
                                <div class="card-header p-2">
                                    <h3 class="card-title">
                                        <i class="fa-solid fa-users"></i>
                                        </i>&nbsp;Book Mark User Location</span>
                                    </h3>
                                </div>
                                <div class="card-body">

                                    @if (empty($mylocation->region))
                                        <form action="" method="post" id="fixedlocationForm">
                                            @csrf
                                            <div class="row" id="addProgramRow">

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">*&nbsp;Region</label>
                                                        <select name="region_id" id="region_id" class="form-select">
                                                            <option value="">[Select]</option>
                                                            @foreach ($region as $rItem)
                                                                <option value="{{ $rItem->id }}"
                                                                    id="{{ route('location.showprovincebyregion', $rItem->id) }}">
                                                                    {{ $rItem->regDesc }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('region_id')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">*&nbsp;Province</label>
                                                        <select name="province_id" id="province_id" class="form-select">
                                                            <option value="">[Select]</option>
                                                        </select>
                                                    </div>
                                                    @error('province_id')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">*&nbsp;Municipality</label>
                                                        <select name="citymun_id" id="citymun_id" class="form-select">
                                                            <option value="">[Select]</option>
                                                        </select>
                                                    </div>
                                                    @error('citymun_id')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- not used  --}}



                                            <div class="row">

                                                <div class="col-md">
                                                    <input type="submit" name="submit" id="submit"
                                                        class="float-right btn btn-md btn-success"
                                                        value="Book Mark Location">
                                                </div>
                                            </div>

                                        </form>
                                    @else
                                        <form action="{{ route('location.update') }}" method="post" id="">
                                            @csrf
                                            <div class="row" id="">

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">*&nbsp;Region</label>
                                                        <select name="region_id" id="region_id" class="form-select">
                                                            <option value="">[Select]</option>
                                                            @foreach ($region as $rItem)
                                                                <option value="{{ $rItem->id }}"
                                                                    {{ $mylocation->region_id == $rItem->id ? 'selected' : '' }}>
                                                                    {{ $rItem->regDesc }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('region_id')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">*&nbsp;Province</label>
                                                        <select name="province_id" id="province_id" class="form-select">
                                                            <option value="">[Select]</option>

                                                            @foreach ($provinceData as $pItem)
                                                                <option value="{{ $pItem->id }}"
                                                                    {{ $mylocation->province_id == $pItem->id ? 'selected' : '' }}>
                                                                    {{ $pItem->provDesc }}</option>
                                                            @endforeach

                                                        </select>
                                                        {{-- hiding the location id  --}}
                                                        <input type="hidden" value="{{ $mylocation->l_id }}"
                                                            name="l_id" />
                                                    </div>
                                                    @error('province_id')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="" class="form-label">*&nbsp;Municipality</label>
                                                        <select name="citymun_id" id="citymun_id" class="form-select">
                                                            <option value="">[Select]</option>
                                                            @foreach ($citymunData as $citymunItem)
                                                                <option value="{{ $citymunItem->id }}"
                                                                    {{ $mylocation->citymun_id == $citymunItem->id ? 'selected' : '' }}>
                                                                    {{ $citymunItem->citymunDesc }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('citymun_id')
                                                        <span class="text-red"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- not used  --}}



                                            <div class="row">

                                                <div class="col-md">
                                                    <input type="submit" name="submit" id="submit"
                                                        class="float-right btn btn-md btn-danger" value="Update Location">
                                                </div>
                                            </div>

                                        </form>
                                    @endif



                                </div>
                                <div class="card-footer">
                                    <div class="table-responsive">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title"><small>
                                                        <strong>Your Fixed Location</strong>
                                                    </small>

                                                </h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <table class="table table-sm" id="ascomcremod">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-sm">Region</th>
                                                            <th class="text-sm">Province</th>
                                                            <th class="text-sm">City/Municipality </th>


                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td>{{ empty($mylocation->region) ? 'Not Set' : $mylocation->region }}
                                                            </td>
                                                            <td>{{ empty($mylocation->province) ? 'Not Set' : $mylocation->province }}
                                                            </td>
                                                            <td>{{ empty($mylocation->citymun) ? 'Not Set' : $mylocation->citymun }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                                <div style="position: absolute; top:0; right:0; z-index:10">
                                    @include('_message')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
