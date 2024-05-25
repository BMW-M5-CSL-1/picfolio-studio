@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 "><span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'permissions.index') }} </span></h4>
@endsection

@section('title', 'Permissions')

@section('page-vendor')
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/theme-default.css')) }}" />
@endsection

@section('page-style')
    <style>
        .customDstsTbl .dataTables_scrollHeadInner,
        .customDstsTbl table {
            width: 100% !important;
        }

        .pagination {
            justify-content: end;
        }

        #permissions-table_length label {
            display: flex;
            align-items: center;
            width: 50%;
        }

        #permissions-table_length label select {
            display: flex;
            align-items: center;
            width: 25%;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .dataTables_filter {
            text-align: end;
        }

        .dataTables_filter label {
            font-size: 0;
        }

        .dataTables_scrollHeadInner,
        .dataTable {
            width: 100% !important;
        }
    </style>
@endsection



@section('breadcrumbs')
    <div class="content-header-left col-md-9">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Permissions
                </h2>
                <div class="breadcrumb-wrapper">
                    {{ Breadcrumbs::render('permissions.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="#" id="permissions-table-form customDstsTbl" method="get">
                {{ $dataTable->table() }}
            </form>
        </div>
    </div>

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    {{-- <script src="{{ asset(mix('assets/js/dataTables.responsive.min.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/responsive.bootstrap5.min.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/datatables.checkboxes.min.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/datatables.buttons.min.js')) }}"></script> --}}
    {{-- <script src="{{ asset(mix('assets/js/dataTables.select.min.js')) }}"></script> --}}
    {{-- <script src="{{ asset(mix('assets/js/buttons.colVis.min.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/jszip.min.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/pdfmake.min.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/vfs_fonts.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/buttons.print.min.js')) }}"></script>
            <script src="{{ asset(mix('assets/js/dataTables.rowGroup.min.js')) }}"></script> --}}
@endsection


@section('page-script')
    {{ $dataTable->scripts() }}
    <script>
        function deleteSelected() {
            var selectedCheckboxes = $('.dt-checkboxes:checked').length;
            if (selectedCheckboxes > 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: '{{ __('lang.commons.are_you_sure_you_want_to_delete_the_selected_items') }}',
                    showCancelButton: true,
                    cancelButtonText: '{{ __('lang.commons.no_cancel') }}',
                    confirmButtonText: '{{ __('lang.commons.yes_delete') }}',
                    confirmButtonClass: 'btn-danger',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#permissions-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: '{{ __('lang.commons.please_select_at_least_one_item') }}',
                });
            }
        }

        function deleteByID(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: '{{ __('lang.commons.are_you_sure') }}',
                showCancelButton: true,
                cancelButtonText: '{{ __('lang.commons.no_cancel') }}',
                confirmButtonText: '{{ __('lang.commons.yes_delete') }}',
                confirmButtonClass: 'btn-danger',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = '{{ route('permissions.destroy', ['id' => ':id']) }}'.replace(':id', id);
                }
            });
        }

        function changeRolePermission(role_id, permission_id) {
            // showBlockUI();

            var checkBoxState = $('#chkRolePermission_' + role_id + '_' + permission_id).is(':checked');
            var url = "";
            if (checkBoxState) {
                url = '{{ route('permissions.assign-permission') }}';
            } else {
                url = '{{ route('permissions.revoke-permission') }}';
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    role_id: role_id,
                    permission_id: permission_id,
                },
                success: function(response) {
                    // console.log(response);
                    if (response.success) {
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Success',
                        //     text: response.message,
                        // });
                        toastr.success(response.message,
                            "Success!", {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 2e3,
                                closeButton: !0,
                                tapToDismiss: !1,
                            });
                        // hideBlockUI();

                        // $('#permissions-table').DataTable().ajax.reload();
                    } else {
                        // hideBlockUI();

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(response) {
                    // hideBlockUI();voke-perm

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "Something went wrong!",
                    });
                }

            });
        }

        function permissionCheck(roles) {
            console.log(roles);
        }
    </script>
@endsection
