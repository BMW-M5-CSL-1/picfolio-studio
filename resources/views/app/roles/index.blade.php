@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'roles.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Roles')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />

@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Roles</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('roles.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- <h4 class="fw-semibold mb-4">Roles List</h4>

    <p class="mb-4">A role provided access to predefined menus and features so that depending on <br> assigned role an
        administrator can have access to what user needs.</p> --}}
    <!-- Role cards -->
    <div class="row g-4">

        @foreach ($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">

                                <h4 class="mb-1 text-capitalize ">{{ $role->name }}
                                </h4>
                                @can('roles.edit')
                                    <a href="{{ route('roles.edit', ['id' => $role->id]) }}"><span>Edit Role</span></a>
                                @endcan
                            </div>
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom"
                                @if ($role->slug != 'super_admin') onclick="deleteRole({{ $role->id }})" title="Delete Role" @else title="Cannot Delete Super Admin Role" @endif
                                class="text-muted">
                                <span class="badge bg-label-danger rounded p-2">
                                    <i class="ti ti-trash ti-sm"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="{{ asset('assets/img/illustrations/faq-illustrations.svg') }}"
                                class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a href="{{ route('roles.create') }}">
                                <button class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Role</button>
                            </a>
                            <p class="mb-0 mt-1">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
            <!--/ Role Table -->
        </div> --}}
    </div>
    {{-- <div class="card mb-4">

        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Plan</th>
                        <th>Billing</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div> --}}
    <!--/ Role cards -->

    <!-- Add Role Modal -->
    {{-- @include('app/roles/add-role') --}}
    <!-- / Add Role Modal -->
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/app-access-roles.js') }}"></script> --}}
    {{-- {{ $dataTable->scripts() }} --}}

    <script>
        function deleteRole($id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are You Sure ?',
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn-success',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                },
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('roles.destroy', ['id' => ':id']) }}".replace(':id', $id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response
                                    .message,
                                    "Route Deleted!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                    location.reload();
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
