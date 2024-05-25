@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'distributor.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Distributor Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('page-style')
    <style>
        .select2-container {
            z-index: 100000;
        }

        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
        }

        .dataTables_filter label {
            font-size: 0;
        }
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Distribution Dashboard</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('distributor.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    {{-- Modal for Details --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button id="close" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 px-sm-3 pt-30" id="modalBody">
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>{{ count(Auth::user()->roles->where('slug', 'super_admin')) == 1 ? 'Total Distributons' : 'Total Orders' }}</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($distributions) }}</h3>
                                <small class="text-primary">( 100% )</small>
                            </div>
                            <small>Total Orders</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-shopping-cart-filled" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z"
                                    stroke-width="0" fill="currentColor"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>{{ count(Auth::user()->roles->where('slug', 'super_admin')) == 1 ? 'New Distributons' : 'Pending Orders' }}</span>
                            <div class="d-flex align-items-end mt-2">
                                @if (count(Auth::user()->roles->where('slug', 'super_admin')) == 1)
                                    <h3 class="mb-0 me-2">{{ count($distributions->where('status', 'new')) }}</h3>
                                    <small class="text-info">(
                                        @if (count($distributions) > 0)
                                            {{ number_format((float) ((count($distributions->where('status', 'new')) / count($distributions)) * 100), 2, '.', '') }}
                                        @else
                                            0
                                        @endif
                                        % )
                                    </small>
                                @else
                                    @php
                                        if (count($distributions) > 0) {
                                            foreach ($distributions as $row) {
                                                $data = $row->distributerUsers->where('id', Auth::user()->id);
                                                foreach ($data as $value) {
                                                    $pendingStatus = $value->pivot->where('status', 'new')->get();
                                                }
                                            }
                                        } else {
                                            $pendingStatus = [];
                                        }
                                    @endphp
                                    <h3 class="mb-0 me-2">
                                        {{ count($pendingStatus) }}
                                    </h3>
                                    <small class="text-warning">(
                                        @if (count($pendingStatus) > 0)
                                            {{ number_format((float) ((count($pendingStatus) / count($distributions)) * 100), 2, '.', '') }}
                                        @else
                                            0
                                        @endif
                                        % )
                                    </small>
                                @endif

                            </div>
                            <small>Recent analytics </small>
                        </div>
                        <span
                            class="badge {{ count(Auth::user()->roles->where('slug', 'super_admin')) == 1 ? 'bg-label-info' : 'bg-label-warning' }} rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-plus"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M12.5 17h-6.5v-14h-2"></path>
                                <path d="M6 5l14 1l-.86 6.017m-2.64 .983h-10.5"></path>
                                <path d="M16 19h6"></path>
                                <path d="M19 16v6"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>{{ count(Auth::user()->roles->where('slug', 'super_admin')) == 1 ? 'Pending Distributons' : 'Rejected Orders' }}</span>
                            <div class="d-flex align-items-end mt-2">
                                @if (count(Auth::user()->roles->where('slug', 'super_admin')) == 1)
                                    <h3 class="mb-0 me-2">
                                        {{ count($distributions->where('status', '!=', 'completed')) }}
                                    </h3>
                                    <small class="text-warning">(
                                        @if (count($distributions) > 0)
                                            {{ number_format((float) ((count($distributions->where('status', '!=', 'completed')) / count($distributions)) * 100), 2, '.', '') }}
                                        @else
                                            0
                                        @endif
                                        % )
                                    </small>
                                @else
                                    @php
                                        if (count($distributions) > 0) {
                                            foreach ($distributions as $row) {
                                                $data = $row->distributerUsers->where('id', Auth::user()->id);
                                                foreach ($data as $value) {
                                                    $rejectedStatus = $value->pivot->where('status', 'rejected')->get();
                                                }
                                            }
                                        } else {
                                            $rejectedStatus = [];
                                        }
                                    @endphp
                                    <h3 class="mb-0 me-2">
                                        {{ count($rejectedStatus) }}
                                    </h3>
                                    <small class="text-danger">(
                                        @if (count($rejectedStatus) > 0)
                                            {{ number_format((float) ((count($rejectedStatus) / count($distributions)) * 100), 2, '.', '') }}
                                        @else
                                            0
                                        @endif
                                        % )
                                    </small>
                                @endif
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span
                            class="badge {{ count(Auth::user()->roles->where('slug', 'super_admin')) == 1 ? 'bg-label-warning' : 'bg-label-danger' }} rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-shopping-cart-exclamation" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M15 17h-9v-14h-2"></path>
                                <path d="M6 5l14 1l-.854 5.976m-2.646 1.024h-10.5"></path>
                                <path d="M19 16v3"></path>
                                <path d="M19 22v.01"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>{{ count(Auth::user()->roles->where('slug', 'super_admin')) == 1 ? 'Completed Distributons' : 'Completed Orders' }}</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">
                                    {{ count($distributions->where('status', 'completed')) }}
                                </h3>
                                <small class="text-success">(
                                    @if (count(Auth::user()->roles->where('slug', 'super_admin')) == 1)
                                        @if (count($distributions) > 0)
                                            {{ number_format((float) ((count($distributions->where('status', 'completed')) / count($distributions)) * 100), 2, '.', '') }}
                                        @else
                                            0
                                        @endif
                                    @else
                                        @php
                                            if (count($distributions) > 0) {
                                                foreach ($distributions as $row) {
                                                    $data = $row->distributerUsers->where('id', Auth::user()->id);
                                                    foreach ($data as $value) {
                                                        $completedStatus = $value->pivot->where('status', 'completed')->get();
                                                    }
                                                }
                                            } else {
                                                $completedStatus = [];
                                            }
                                        @endphp
                                        @if (count($completedStatus) > 0)
                                            {{ number_format((float) ((count($completedStatus) / count($distributions)) * 100), 2, '.', '') }}
                                        @else
                                            0
                                        @endif
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            {{-- <i class="ti ti-shopping-cart-check ti-sm"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-shopping-cart-copy" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M11.5 17h-5.5v-14h-2"></path>
                                <path d="M6 5l14 1l-1 7h-13"></path>
                                <path d="M15 19l2 2l4 -4"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    {{ $dataTable->scripts() }}

    {{-- <script src="{{ asset('js/laravel-user-management.js') }}"></script> --}}

    <script>
        // View Data in Modal
        $(document).on('click', '.detailsModal', function(e) {
            id = $(this).data('id');
            type = $(this).attr('data-modaltype');
            $('#modalBody').html('');
            $.ajax({
                type: "POST",
                url: "{{ route('distributor.ajax-get-details') }}",
                data: {
                    id: id,
                    type: type,
                },
                dataType: 'json',
                success: function(response) {
                    $('#modalBody').html(response.view);
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }
            });
        });

        // Action buttons
        function action_buttons($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()
            $.ajax({
                type: 'post',
                url: "{{ route('distributor.ajax-action-buttons', ['id' => ':id']) }}".replace(':id', $id),
                // data: $('#floor_form').serialize(),
                success: function(data) {
                    $('#dropDownMenu_' + $id).html(data)
                    $('#loader_' + $id).hide();
                    // console.log(data);
                },
                error: function(data) {
                    $('#loader_' + $id).hide();
                    console.log('An error occurred.');
                },
            });
        }
        // Variable declaration for table
        var dt_user_table = $('.datatables-users'),
            select2 = $('.select2'),
            userView = baseUrl + 'app/user/view/account',
            offCanvasForm = $('#offcanvasAddUser');

        if (select2.length) {
            var $this = select2;
            $this.wrap('<div class="position-relative"></div>').select2({

            });
        }

        function confirmOrder($id) {
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
                showBlockUI();
                if (result.isConfirmed) {
                    let url = "{{ route('distributor.ajax-confirm-order', ['id' => ':id']) }}".replace(':id', $id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                setTimeout(function() {
                                    hideBlockUI();
                                }, 4000);
                                toastr.success(response
                                    .message,
                                    "Order Confirmed!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#distributor-table').DataTable().ajax.reload();
                            } else {
                                setTimeout(function() {
                                    hideBlockUI();
                                }, 4000);
                            }
                        },
                        error: function(error) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                message: 'Something Went Wrong!',
                            });
                        }
                    });
                } else {
                    hideBlockUI();
                }
            });
        }

        function completeOrder($id) {
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
                showBlockUI();
                if (result.isConfirmed) {
                    let url = "{{ route('distributor.ajax-complete-order', ['id' => ':id']) }}".replace(':id',
                        $id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                setTimeout(function() {
                                    hideBlockUI();
                                }, 4000);
                                toastr.success(response
                                    .message,
                                    "Order Completed!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#distributor-table').DataTable().ajax.reload();
                            } else {
                                setTimeout(function() {
                                    hideBlockUI();
                                }, 4000);
                            }
                        },
                        error: function(error) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                        }
                    });
                } else {
                    hideBlockUI();
                    $('#detailsModal').show();
                }
            });
        }

        function payDistributor($user_id, $distribution_id) {
            $('#detailsModal').hide();
            Swal.fire({
                title: 'Pay Distributor',
                text: 'Are you sure you want to pay ?',
                icon: 'question',
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes, Pay',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                },
                didOpen: function() {
                    // $('#distributor').wrap('<div class="position-relative"></div>').select2({});
                }
            }).then((result) => {
                showBlockUI();
                if (result.isConfirmed) {
                    let url =
                        "{{ route('distributor.ajax-pay-distributor', ['user_id' => ':user_id', 'distribution_id' => ':distribution_id']) }}"
                        .replace(':user_id', $user_id).replace(':distribution_id', $distribution_id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'user_id': $user_id,
                            'distribution_id': $distribution_id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                setTimeout(function() {
                                    hideBlockUI();
                                }, 4000);
                                toastr.success(response
                                    .message,
                                    "Paid!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#distributor-table').DataTable().ajax.reload();
                                $('#close').trigger('click');
                            } else {
                                hideBlockUI();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong!',
                                });
                                $('#close').trigger('click');
                            }
                        },
                        error: function(error) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                            $('#detailsModal').show();
                        }
                    });
                } else {
                    hideBlockUI();
                    $('#detailsModal').show();
                }
            });
        }

        function rejectDistributor($user_id, $distribution_id) {
            $('#detailsModal').hide();
            Swal.fire({
                html: '<h2 class="swal2-title mb-0 mt-0">Reject Distributor</h2><p style=>Rejection Details</p><textarea id="rejectionDetails" name="rejectionDetails" class="form-control mt-1" placeholder="Enter Details" required></textarea>',
                icon: 'question',
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Reject Distributor',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                },
                didOpen: function() {
                    // $('#distributor').wrap('<div class="position-relative"></div>').select2({});
                }
            }).then((result) => {
                showBlockUI();
                if (result.isConfirmed) {
                    var rejectionDetails = $('#rejectionDetails').val();
                    let url =
                        "{{ route('distributor.ajax-reject-distributor', ['user_id' => ':user_id', 'distribution_id' => ':distribution_id']) }}"
                        .replace(':user_id', $user_id).replace(':distribution_id', $distribution_id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'user_id': $user_id,
                            'distribution_id': $distribution_id,
                            'rejectionDetails': rejectionDetails,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                setTimeout(function() {
                                    hideBlockUI();
                                }, 4000);
                                toastr.success(response
                                    .message,
                                    "Distributor Rejected!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#close').trigger('click');
                            } else {
                                hideBlockUI();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong!',
                                });
                                $('#close').trigger('click');
                            }
                        },
                        error: function(error) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                            $('#detailsModal').show();
                        }
                    });
                } else {
                    hideBlockUI();
                    $('#detailsModal').show();
                }
            });
        }

        function addMoreDistributors($distribution_id) {
            showBlockUI();
            $('#detailsModal').hide();
            let url = "{{ route('distributor.ajax-get-distributors', ['distribution_id' => ':distribution_id']) }}"
                .replace(':distribution_id', $distribution_id);
            $.ajax({
                type: "post",
                url: url,
                data: {
                    'distribution_id': $distribution_id,
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    var distributorList = response.distributors;
                    var selectData =
                        '<select id="distributor" name="distributor[]" class="select2 form-select mb-1" required multiple></select>';
                    Swal.fire({
                        html: '<h2 class="swal2-title mb-0">Distribute</h2><p style=>Select Distributors</p>' +
                            selectData,
                        icon: 'question',
                        cancelButtonText: 'No, Cancel',
                        confirmButtonText: 'Yes, Distribute',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                            cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                        },
                        didOpen: function() {
                            $('#distributor').wrap('<div class="position-relative"></div>')
                                .select2({});
                            for (let i = 0; i < distributorList.length; i++) {
                                $('#distributor').append(new Option(distributorList[i].name,
                                    distributorList[i].id)).trigger('change');
                            }
                        }
                    }).then((result) => {
                        showBlockUI();
                        if (result.isConfirmed) {
                            var distributor = $('#distributor').val();
                            let url =
                                "{{ route('distributor.ajax-add-more-distributors', ['distribution_id' => ':id']) }}"
                                .replace(':id', $distribution_id);
                            $.ajax({
                                type: "post",
                                url: url,
                                data: {
                                    'distribution_id': $distribution_id,
                                    'distributor': distributor,
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.success == true) {
                                        setTimeout(function() {
                                            hideBlockUI();
                                        }, 4000);
                                        toastr.success(response
                                            .message,
                                            "New Distributor Added!", {
                                                showMethod: "slideDown",
                                                hideMethod: "slideUp",
                                                timeOut: 2e3,
                                                closeButton: !0,
                                                tapToDismiss: !1,
                                            });
                                        $('#close').trigger('click');
                                    } else {
                                        hideBlockUI();
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Something went wrong!',
                                        });
                                        $('#close').trigger('click');
                                    }
                                },
                                error: function(error) {
                                    setTimeout(function() {
                                        hideBlockUI();
                                    }, 4000);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Something went wrong!',
                                    });
                                    $('#detailsModal').show();
                                }
                            });
                        } else {
                            hideBlockUI();
                            $('#detailsModal').show();
                        }
                    });
                },
                error: function(error) {
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                    $('#detailsModal').show();
                }
            });
        }
    </script>
@endsection
