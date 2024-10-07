@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'event.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Event')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
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
                {{-- <h2 class="content-header-title float-start mb-0">Bookings</h2> --}}
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('event.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Orders</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($orders) }}</h3>
                                <small class="text-primary">(
                                    @if (count($orders) > 0)
                                        {{ (count($orders) / count($orders)) * 100 }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
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
                            <span>New Orders</span>
                            <div class="d-flex align-items-end mt-2">
                                @php
                                    $newOrders = count($orders->where('status', 'created')) + count($orders->where('status', 'confirmed'));
                                @endphp
                                <h3 class="mb-0 me-2">{{ $newOrders }}</h3>
                                <small class="text-secondary">(
                                    @if (count($orders) > 0)
                                        {{ number_format((float) (($newOrders / count($orders)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics </small>
                        </div>
                        <span class="badge bg-label-secondary rounded p-2">
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
                            <span>Confirmed Orders</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">
                                    {{ !is_null($orders) ? count($orders->where('status', 'confirmed')) : 0 }}</h3>
                                <small class="text-info">(
                                    @if (count($orders) > 0)
                                        {{ number_format((float) ((count($orders->where('status', 'confirmed')) / count($orders)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics </small>
                        </div>
                        <span class="badge bg-label-info rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-copy"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Vehicle Media Orders</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">
                                    {{ !is_null($orders) ? count($orders->where('type', 'vehicle_media')) : 0 }}</h3>
                                <small class="text-secondary">(
                                    @if (count($orders) > 0)
                                        {{ number_format((float) ((count($orders->where('type', 'vehicle_media')) / count($orders)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics </small>
                        </div>
                        <span class="badge bg-label-secondary rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-car" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
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
                            <span>Pending Orders</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">
                                    {{ count($orders->where('status', '!=', 'created')->where('status', '!=', 'confirmed')->where('status', '!=', 'completed')->where('status', '!=', 'rejected')) }}
                                </h3>
                                <small class="text-warning">(
                                    @if (count($orders) > 0)
                                        {{ number_format((float) ((count($orders->where('status', '!=', 'created')->where('status', '!=', 'completed')->where('status', '!=', 'rejected')) /count($orders)) *100),2,'.','') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
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
                            <span>Completed Orders</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($orders->where('status', 'completed')) }}</h3>
                                <small class="text-success">(
                                    @if (count($orders) > 0)
                                        {{ number_format((float) ((count($orders->where('status', 'completed')) / count($orders)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M9 12l2 2l4 -4" />
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
                            <span>Rejected Orders</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($orders->where('status', 'rejected')) }}</h3>
                                <small class="text-danger">(
                                    @if (count($orders) > 0)
                                        {{ number_format((float) ((count($orders->where('status', 'rejected')) / count($orders)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-x"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M13 17h-7v-14h-2"></path>
                                <path d="M6 5l14 1l-1 7h-13"></path>
                                <path d="M22 22l-5 -5"></path>
                                <path d="M17 22l5 -5"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between p-2">
                        <div class="content-left">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                    <img src="{{ asset('assets/img/illustrations/faq-illustrations.svg') }}"
                                        class="img-fluid mt-sm-4 mt-md-0" alt="Create New Order">
                                </div>
                            </div>
                        </div>
                        <div class="text-sm-end text-center ps-sm-0">
                            <a href="{{ route('orders.create') }}">
                                <button class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Order</button>
                            </a>
                            <p class="mb-0 mt-1">Create New Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="card">
        <div class="card-body">
            {{-- <form action="#" id="design_form" method="get"> --}}
            {{ $dataTable->table() }}
            {{-- </form> --}}
        </div>
    </div>

    {{-- Modal for Details --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-enable-otp modal-dialog-centered" style="max-width: 90%;">
            <div class="modal-content p-0">
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
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
    {{ $dataTable->scripts() }}

    <script>
        function create() {
            let url = '{{ route('event.create') }}';
            location.href = url;
        }

        function publishEvent($id) {
            Swal.fire({
                title: "Publish This Event !",
                icon: 'question',
                confirmButtonText: 'Proceed',
                text: "Once Proceeded, You Won't Edit !",
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('event.publish', ['id' => ':id']) }}".replace(':id', $id);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message ?? "Event Published Successfully !", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                                datatableCustomReload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message ?? 'Something Went Wrong !',
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An Error Occured!',
                            });
                        }
                    });
                }
            });
        }

        function raiseOffer($id) {
            Swal.fire({
                title: "Reason !",
                html: `<input id="offer" type="number" step="1" min="1" placeholder="Your Offer Amount" name="offer" class="form-control form-control-md" required /><br><span class="text-muted fs-6">Are You Sure, You'll Not Be Able To Raise Another Offer For This Event !</span>`,
                icon: 'question',
                text: `Are You Sure, You'll Not Be Able To Raise Another Offer FOr This Event !`,
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Proceed',
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let offer = $('#offer').val();
                    if (!offer) {
                        Swal.fire('Offer amount is required')
                    } else {
                        let url = "{{ route('event.raise-offer', ['id' => ':id']) }}".replace(':id', $id);
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                'id': $id,
                                'offer': offer
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                    toastr.success(response.message ?? "Offer Raised Successfully !", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                    // datatableCustomReload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message ?? 'Something Went Wrong !',
                                    });
                                }
                            },
                            error: function(xhr) {
                                let response = JSON.parse(xhr.responseText);
                                let errorMessage = response.errors?.offer ? response.errors.offer[0] :
                                    'An Error Occurred!';
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: errorMessage,
                                });
                            }
                        });
                    }
                }
            });
        }

        function hirePhotographer(event_id, photographer_id, name, amount) {
            Swal.fire({
                title: "Sure !",
                icon: 'question',
                confirmButtonText: 'Proceed',
                text: "Hire Photographer (" + name + ") At " + amount + "/- Rs !",
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('event.hire-photographer') }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'event_id': event_id,
                            'photographer_id': photographer_id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message ??
                                    "Photographer Hired Successfully !", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#detailsModal').modal('hide');
                                datatableCustomReload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message ?? 'Something Went Wrong !',
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An Error Occured!',
                            });
                        }
                    });
                }
            });
        }

        function cancelPhotographer(event_id, photographer_id, name, amount) {
            Swal.fire({
                title: "Sure !",
                icon: 'question',
                confirmButtonText: 'Proceed',
                text: "Cancel Hiring of Photographer (" + name + ") At " + amount + "/- Rs !",
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('event.cancel-photographer') }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'event_id': event_id,
                            'photographer_id': photographer_id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message ??
                                    "Photographer Hired Successfully !", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#detailsModal').modal('hide');
                                datatableCustomReload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message ?? 'Something Went Wrong !',
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An Error Occured!',
                            });
                        }
                    });
                }
            });
        }

        function lockEvent($id) {
            Swal.fire({
                title: "Lock This Event !",
                icon: 'question',
                confirmButtonText: 'Proceed',
                text: "Once Proceeded, You Won't Hire/Cancel Photographer !",
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('event.lock', ['id' => ':id']) }}".replace(':id', $id);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message ?? "Event Locked Successfully !", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                                datatableCustomReload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message ?? 'Something Went Wrong !',
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An Error Occured!',
                            });
                        }
                    });
                }
            });
        }

        function closeEvent($id) {
            Swal.fire({
                title: "Close This Event !",
                icon: 'question',
                confirmButtonText: 'Proceed',
                text: "Event Completed ?",
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('event.close', ['id' => ':id']) }}".replace(':id', $id);
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message ?? "Event Closed Successfully !", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                                datatableCustomReload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message ?? 'Something Went Wrong !',
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An Error Occured!',
                            });
                        }
                    });
                }
            });
        }

        function listOffers($id) {
            let url = "{{ route('event.ajax-details', ['id' => ':id']) }}".replace(':id', $id);
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'id': $id,
                    'query_for': 'offer_list'
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#modalBody').empty();
                        $('#modalBody').append(response.view);
                        $('#detailsModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message ?? 'Something Went Wrong !',
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An Error Occured!',
                    });
                }
            });
        }

        // Variable declaration for table
        // var dt_user_table = $('.datatables-users'),
        //     select2 = $('.select2'),
        //     userView = baseUrl + 'app/user/view/account',
        //     offCanvasForm = $('#offcanvasAddUser');

        // if (select2.length) {
        //     var $this = select2;
        //     $this.wrap('<div class="position-relative"></div>').select2({

        //     });
        // }
    </script>

    {{-- @include('app.orders.index-scripts') --}}
@endsection
