@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'printing-press.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Printing Press')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
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
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Printing Press</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('printing-press.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Prints</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($prints) }}</h3>
                                <small class="text-primary">(
                                    @if (count($prints) > 0)
                                        {{ number_format((float) ((count($prints) / count($prints)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Total Prints</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                </path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>New Prints</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($prints->where('status', 'new')) }}</h3>
                                <small class="text-warning">(
                                    @if (count($prints) > 0)
                                        {{ number_format((float) ((count($prints->where('status', 'new')) / count($prints)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics </small>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                </path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Completed Prints</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($prints->where('status', 'completed')) }}</h3>
                                <small class="text-success">(
                                    @if (count($prints) > 0)
                                        {{ number_format((float) ((count($prints->where('status', 'completed')) / count($prints)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif% )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                </path>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <div class="card-body">
            {{-- <form action="#" id="design_form" method="get"> --}}
            {{ $dataTable->table() }}
            {{-- </form> --}}
        </div>
    </div>

    {{-- Modal for Details --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button id="close_modal" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 px-sm-3 pt-30" id="modalBody">
                </div>
            </div>
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
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    {{ $dataTable->scripts() }}

    <script>
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

        // Action buttons
        function action_buttons($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()
            $.ajax({
                type: 'post',
                url: "{{ route('printing-press.ajax-action-buttons', ['id' => ':id']) }}".replace(':id', $id),
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

        $(document).on('click', '.detailsModal', function(e) {
            id = $(this).data('id');
            type = $(this).attr('data-modaltype');
            $('#modalBody').html('');
            $.ajax({
                type: "POST",
                url: "{{ route('printing-press.ajax-get-details') }}",
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

        function confirmPrint($id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are You Sure!!!',
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
                    let url = "{{ route('printing-press.ajax-confirm-print', ['id' => ':id']) }}".replace(':id',
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
                                    "Order Confirmed!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#printingpress-table').DataTable().ajax.reload();
                            } else {
                                hideBlockUI();
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
                }
            });
        }

        function completePrint($id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are You Sure!!!',
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
                    let url = "{{ route('printing-press.ajax-complete-print', ['id' => ':id']) }}".replace(':id',
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
                                $('#printingpress-table').DataTable().ajax.reload();
                            } else {
                                hideBlockUI();
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
                }
            });
        }

        function rejectPrinter($id) {
            $('#detailsModal').hide();
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                html: '<textarea id="rejectionDetails" name="rejectionDetails" class="form-control mt-1" placeholder="Enter Details About Distribution." required></textarea>',
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Reject',
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
                    var rejectionDetails = $('#rejectionDetails').val();
                    let url = "{{ route('printing-press.ajax-reject-print', ['print_id' => ':id']) }}".replace(
                        ':id', $id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'id': $id,
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
                                    "Print Rejected!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#close_modal').trigger('click');
                                $('#printingpress-table').DataTable().ajax.reload();
                            } else {
                                setTimeout(function() {
                                    hideBlockUI();
                                }, 4000);
                            }
                        },
                        error: function() {
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
                }
                $('#detailsModal').show();
            });
        }

        function addNewPrinter($id) {
            showBlockUI();
            $('#detailsModal').hide();
            let url = "{{ route('printing-press.ajax-get-print', ['id' => ':id']) }}"
                .replace(':id', $id);
            $.ajax({
                type: "post",
                url: url,
                data: {
                    'id': $id,
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    var printingPressList = response.printingPress;
                    var selectData =
                        '<select id="printingPress" name="printingPress" class="select2 form-select mb-1" required></select>';
                    Swal.fire({
                        html: '<h2 class="swal2-title mb-0">Printing Press</h2><p style=>Select Printing Press</p>' +
                            selectData +
                            '<textarea id="printingDetails" name="printingDetails" class="mt-2 form-control" placeholder="Enter Details For Printing Press." required></textarea>',
                        icon: 'question',
                        cancelButtonText: 'No, Cancel',
                        confirmButtonText: 'Yes, Distribute',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                            cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                        },
                        didOpen: function() {
                            $('#printingPress').wrap('<div class="position-relative"></div>')
                                .select2({});
                            for (let i = 0; i < printingPressList.length; i++) {
                                $('#printingPress').append(new Option(printingPressList[i].name,
                                    printingPressList[i].id)).trigger('change');
                            }
                        }
                    }).then((result) => {
                        showBlockUI();
                        if (result.isConfirmed) {
                            var printingPress = $('#printingPress').val();
                            var printingDetails = $('#printingDetails').val();
                            let url =
                                "{{ route('printing-press.ajax-add-new-print', ['id' => ':id']) }}"
                                .replace(':id', $id);
                            $.ajax({
                                type: "post",
                                url: url,
                                data: {
                                    'id': $id,
                                    'printer_id': printingPress,
                                    'printingDetails': printingDetails,
                                },
                                dataType: "json",
                                success: function(response) {
                                    setTimeout(function() {
                                        hideBlockUI();
                                    }, 4000);
                                    if (response.success == true) {
                                        toastr.success(response
                                            .message,
                                            "New Printing Press Added!", {
                                                showMethod: "slideDown",
                                                hideMethod: "slideUp",
                                                timeOut: 2e3,
                                                closeButton: !0,
                                                tapToDismiss: !1,
                                            });
                                        $('#close_modal').trigger('click');
                                        $('#printingpress-table').DataTable().ajax.reload();
                                    } else {
                                        hideBlockUI();
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Something went wrong!',
                                        });
                                        $('#detailsModal').show();
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


        function partial_paid($id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are You Sure ?',
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes, Partial Paid',
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
                    let url = "{{ route('printing-press.ajax-partial-paid-order', ['id' => ':id']) }}".replace(
                        ':id', $id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            if (response.success == true) {
                                toastr.success(response.message,
                                    'Order "' + response.press_no + '"' + " Partial Paid!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#printingpress-table').DataTable().ajax.reload();
                            } else {
                                hideBlockUI();
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
                }
            });
        }

        function paid($id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are You Sure ?',
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes, Paid',
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
                    let url = "{{ route('printing-press.ajax-paid-order', ['id' => ':id']) }}".replace(':id', $id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            if (response.success == true) {
                                toastr.success(response
                                    .message,
                                    'Order "' + response.press_no + '"' + " Paid!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#printingpress-table').DataTable().ajax.reload();
                            } else {
                                hideBlockUI();
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
                }
            });
        }

        function preview($id) {
            showBlockUI();
            setTimeout(function() {
                hideBlockUI();
            }, 4000);
            var url = '{{ route('printing-press.show', ['id' => ':id']) }}'.replace(':id', $id);
            location.href = url;
        }
    </script>
@endsection
