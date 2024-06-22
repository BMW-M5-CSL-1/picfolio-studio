@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'gallery.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Gallery')

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

        .dataTables_filter label {
            font-size: 0;
        }

        .modal-img {
            width: 300px;
            /* Adjust the width as needed */
            height: auto;
            /* Maintain aspect ratio */
        }
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Gallery</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('gallery.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements">
            {{-- <span class=" me-2">Card Header</span> --}}

            <div class="card-header-elements ms-auto">
                <a href="{{ route('gallery.create') }}" type="button" class="btn btn-sm btn-primary"><span
                        class="tf-icon ti ti-plus ti-sm me-1"></span>Add</a>
            </div>
        </div>
        <div class="card-body">
            {{-- {{ $dataTable->table() }} --}}

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('assets/img/backgrounds/4.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Photo description 1</p>
                                <button class="btn btn-success btn-md btn-outline-success showPicDetails">Buy</button>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span class="price">$100</span>
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('assets/img/backgrounds/6.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Photo description 2</p>
                                <button class="btn btn-success btn-md btn-outline-success showPicDetails">Buy</button>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span class="price">$150</span>
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="assets/img/backgrounds/7.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Photo description 3</p>
                                <button class="btn btn-success btn-md btn-outline-success showPicDetails">Buy</button>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span class="price">$200</span>
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="assets/img/backgrounds/1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Photo description 4</p>
                                <button class="btn btn-success btn-md btn-outline-success showPicDetails">Buy</button>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span class="price">$200</span>
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal for Details --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button id="close_modal" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 px-sm-3 pt-30" id="modalBody">
                    <div class="card">
                        <img width="50" src="assets/img/backgrounds/4.jpg" class="card-img-top modal-img"
                            alt="...">
                        <div class="card-body">
                            <p class="card-text">Photo description 4</p>
                            <button class="btn btn-success btn-md btn-outline-success showPicDetails">Buy</button>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <span class="price">$200</span>
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar"
                                    class="rounded-circle">
                            </div>
                        </div>
                    </div>
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
    {{-- {{ $dataTable->scripts() }} --}}

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

        $(".showPicDetails").on('click', function() {
            $('#detailsModal').modal('show');
        })

        $(document).on('click', '.detailsModal', function(e) {
            id = $(this).data('id');
            type = $(this).attr('data-modaltype');
            $('#modalBody').html('');
            $.ajax({
                type: "POST",
                url: "{{ route('gallery.ajax-details') }}",
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
    </script>
@endsection
