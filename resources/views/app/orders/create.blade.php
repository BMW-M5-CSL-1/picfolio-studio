@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'orders.create') }}
        </span>
    </h4>
@endsection

@section('title', 'Create Order')

@section('vendor-style')
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" />
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
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
        }

        .nav-tabs .nav-link.active {
            border: none !important;
            box-shadow: unset !important;
        }

        .nav-tabs .nav-link.active {
            border: 1px solid #7367F0 !important;
            border-radius: 8px !important;
        }

        .c_btns {
            display: flex;
        }

        @media(max-width: 767px) {
            .c_btns {
                display: grid;
                margin-bottom: 0;

            }

            .c_btns li {
                width: 100% !important;
                margin-bottom: 2rem;

            }

            .c_li_2 {
                margin-bottom: 0 !important;
            }
        }

        @media(max-width: 991.98px) {
            .c_col_map {
                width: 100% !important;
            }
        }
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Create Order</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('orders.create') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-12 col-xl-12">
            <div class="card mb-2">
                <div class="card-body" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                    <div class="col-lg-12 col-md-12 col-sm-12 position-relative">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <ul class="c_btns nav-tabs border-0 ps-0" role="tablist">
                                    <li class="d-block nav-item w-50 mx-2" role="presentation">
                                        <div class="card p-0 border-0 h-100">
                                            <input id="selected_media_tab" name="selected_media_tab" type="hidden">
                                            <div class="card-body p-0 border-0">
                                                <button type="button" class="h-100 nav-link active p-4" role="tab"
                                                    data-bs-toggle="tab" data-bs-target="#navs-top-home"
                                                    aria-controls="navs-top-home" aria-selected="true">
                                                    <div class="d-grid text-center">
                                                        <span class="custom-option-header">
                                                            <span class="fw-bolder">Flyer/Brochure</span>
                                                        </span>
                                                        <span class="custom-option-body">
                                                            <small class="d-block">You can place your order for flyer or
                                                                brochure only.</small>
                                                        </span>
                                                    </div>

                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="c_li_2 d-block nav-item w-50 mx-2" role="presentation">
                                        <div class="card p-0 border-0 h-100 ">
                                            <div class="card-body p-0 border-0">
                                                <button type="button" class="h-100 nav-link p-4" role="tab"
                                                    data-bs-toggle="tab" data-bs-target="#navs-top-profile"
                                                    aria-controls="navs-top-profile" aria-selected="false" tabindex="-1">
                                                    <div class="d-grid text-center">
                                                        <span class="custom-option-header">
                                                            <span class="fw-bolder">Vehicle Media</span>
                                                        </span>
                                                        <span class="custom-option-body">
                                                            <small class="d-block">You can place your order for vehicles
                                                                only.</small>
                                                        </span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{ view('app.orders.form-fields', [
                'paper_for_paper_media' => $paper_for_paper_media,
                'paper_for_vehicle_media' => $paper_for_vehicle_media,
                'locations' => $locations,
                'designs_for_flyer' => $designs_for_flyer,
                'designs_for_vehicle' => $designs_for_vehicle,
                'order_no' => $order_no,
                'vehicle_order_no' => $vehicle_order_no,
                'routes' => $routes,
            ]) }}

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
    <script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/maps-leaflet.js') }}"></script> --}}

    <script>
        // Variable declaration for table
        // var dt_user_table = $('.datatables-users'),
        //     select2 = $('.select2'),
        //     userView = baseUrl + 'app/user/view/account',
        //     offCanvasForm = $('#offcanvasAddUser');

        let select2 = $('.select2');
        if (select2.length) {
            var $this = select2;
            $this.wrap('<div class="position-relative"></div>').select2({

            });
        }

        // Check selected custom option
        window.Helpers.initCustomOptionCheck();
    </script>
    {{-- @include('app.orders.map-geojson-scripts') --}}
    @include('app.orders.create-scripts')
@endsection
