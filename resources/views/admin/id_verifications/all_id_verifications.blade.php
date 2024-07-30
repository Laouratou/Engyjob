@extends('layouts.app_admin')


@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Toutes les demandes de vérification</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">Demandes de vérification</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        {{-- <a href="javascript:void(0);" class="btn add-button me-2" data-bs-toggle="modal"
                            data-bs-target="#add-category">
                            <i class="fas fa-plus"></i>
                        </a> --}}
                        {{-- <a class="btn filter-btn" href="javascript:void(0);" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a> --}}
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Utilisateur</th>
                                            <th>No du document</th>
                                            <th>Type de document</th>
                                            <th>Document</th>
                                            <th>Validé</th>
                                            <th>Rejeté</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($id_verifications as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>
                                                    {{ $item->user->name }} {{ $item->user->first_name }}
                                                    <div>
                                                        <span class="badge bg-success-light">{{ $item->user->email }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($item->path) }}" target="_blank">
                                                        <i class="fa-solid fa-file-contract fa-2x"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($item->is_verified)
                                                        <span class="badge bg-success-light">Oui</span>
                                                    @else
                                                        <span class="badge bg-danger-light">Non</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->is_rejected)
                                                        <span class="badge bg-danger-light">Oui</span>
                                                    @else
                                                        <span class="badge bg-success-light">Non</span>
                                                    @endif

                                                </td>

                                                <td class="text-end">

                                                    <button
                                                        class="btn btn-sm btn-info text-light toggleIdVerificationActive"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fa-solid fa-gears"></i>
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

@section('js')
    <script>
        $(document).ready(function() {
            $(".toggleIdVerificationActive").click(function() {
                var id = $(this).data('id');
                $("#id_verification").val(id);

                //open modal
                $("#idVerificationModal").modal('show');
            });

            $(".btn_validate_verification").click(function() {
                var id = $("#id_verification").val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('change_is_verify_state') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $(".btn_reject_verification").click(function() {
                var id = $("#id_verification").val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('change_is_rejected_state') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
