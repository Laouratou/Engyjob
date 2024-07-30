@extends('layouts.app_admin')


@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Niveaux de freelancers</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Niveaux de freelancers</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="javascript:void(0);" class="btn add-button me-2" data-bs-toggle="modal"
                            data-bs-target="#add-freelancerLevel">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a class="btn filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="card filter-card" id="filter_inputs">
                <div class="card-body pb-0">
                    <form action="#" method="post">
                        <div class="row filter-row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>Ajouter des niveaux de freelancers</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            {{-- <th>Image</th> --}}
                                            <th>Type</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($freelancerLevels as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ ++$key }}
                                                </td>

                                                <td>{{ $item->name }}</td>
                                                <td class="text-end">
                                                    {{-- <a href="javascript:void(0);" class="btn btn-sm btn-secondary me-2"
                                                        data-bs-toggle="modal" data-bs-target="#edit-item"><i
                                                            class="far fa-edit"></i></a> --}}
                                                    <button class="btn btn-sm @if (!$item->is_active)
                                                        btn-danger
                                                    @else
                                                        btn-success
                                                    @endif toggleActive"
                                                        data-model="FreelancerLevel" data-id="{{ $item->id }}">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection