@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'orders.show') }}
        </span>
    </h4>
@endsection

@section('title', 'Orders')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('page-style')

@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Preview Order</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('orders.show') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card mb-2" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
        <h2 class="card-header text-uppercase">Order Details
            <small>
                @if (isset($orders->status) && $orders->status == 'created')
                    <span class="badge rounded-pill bg-label-warning text-capitalize">created</span>
                @elseif(isset($orders->status) && $orders->status == 'confirmed')
                    <span class="badge rounded-pill bg-label-secondary text-capitalize">confirmed</span>
                @elseif(isset($orders->status) && $orders->status == 'printing')
                    <span class="badge rounded-pill bg-label-info text-capitalize">printing</span>
                @elseif(isset($orders->status) && $orders->status == 'printed')
                    <span class="badge rounded-pill bg-label-info text-capitalize">ready to distribute</span>
                @elseif(isset($orders->status) && $orders->status == 'distribution')
                    <span class="badge rounded-pill bg-label-primary text-capitalize">distribution</span>
                @elseif(isset($orders->status) && $orders->status == 'distributed')
                    <span class="badge rounded-pill bg-label-primary text-capitalize">distributed</span>
                @elseif(isset($orders->status) && $orders->status == 'completed')
                    <span class="badge rounded-pill bg-label-success text-capitalize">completed</span>
                @elseif(isset($orders->status) && $orders->status == 'rejected')
                    <span class="badge rounded-pill bg-label-danger text-capitalize">rejected</span>
                @endif
            </small>
        </h2>
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Order Number <span class="text-danger">*</span></label>
                    <input type="text" disabled class="form-control form-control-md "
                        value="{{ isset($orders->order_no) ? $orders->order_no : '' }}" />
                    <small class="text-muted">Order Number</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Order Type <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md text-capitalize" disabled
                        value="{{ isset($orders->type) ? $orders->type : '' }}" />
                    <small class="text-muted">Order Type</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Paper Type <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md" disabled
                        value="{{ isset($orders->paper_type_id) ? $orders->paper_types->name : '' }}" />
                    <small class="text-muted">Paper Type</small>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Paper Quality <span class="text-danger">*</span></label>
                    <input type="text" disabled class="form-control form-control-md "
                        value="{{ isset($orders->paper_type_id) ? $orders->paper_types->paper_qualities->name : '' }}" />
                    <small class="text-muted">Paper Quality</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Printing Sides <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md" disabled
                        value="{{ isset($orders->paper_type_id) ? $orders->paper_types->side : '' }}" />
                    <small class="text-muted">Printing Sides</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Total Copies <span class="text-danger">*</span></label>
                    <input type="text" class="cp_cnic form-control form-control-md" disabled
                        value="{{ isset($orders->total_copies) ? $orders->total_copies : '' }}" />
                    <small class="text-muted">Total Copies</small>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Distribution Type <span class="text-danger">*</span></label>
                    <input type="text" disabled class="form-control form-control-md "
                        value="{{ isset($orders->distribution_type) ? $orders->distribution_type : '' }}" />
                    <small class="text-muted">Distribution Type</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Distribution Duration <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md" disabled
                        value="{{ isset($orders->duration) ? $orders->duration : '' }}" />
                    <small class="text-muted">Distribution Duration</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Primary Color <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md" disabled
                        value="{{ isset($orders->primary_color) ? $orders->primary_color : '' }}" />
                    <small class="text-muted">Primary Color</small>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Secondary Color <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md" disabled
                        value="{{ isset($orders->secondary_color) ? $orders->secondary_color : '' }}" />
                    <small class="text-muted">Secondary Color</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Tertiary Color <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-md" disabled
                        value="{{ isset($orders->tertiary_color) ? $orders->tertiary_color : '' }}" />
                    <small class="text-muted">Tertiary Color</small>
                </div>
                <div class="col-lg-4 col-md-4 position-relative">
                    <label class="form-label fs-6">Total Price <span class="text-danger">*</span></label>
                    <input type="text" disabled class="form-control form-control-md "
                        value="{{ isset($orders->price) ? $orders->price : '' }}" />
                    <small class="text-muted">Total Price</small>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-lg-12 col-md-12 position-relative">
                    <label class="form-label fs-6">Details <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="" cols="30" rows="5" disabled>
                        {{ isset($orders->comments) ? $orders->comments : '' }}
                    </textarea>
                    <small class="text-muted">Details</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-2" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
        <h2 class="card-header text-uppercase">Locations</h2>
        <div class="card-body">
            @foreach ($orders->locations as $location)
                <h4 class="text-center">{{ $location->name }}</h4>
            @endforeach
        </div>
    </div>

    <div class="card mb-2" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
        <h2 class="card-header text-uppercase">Design Template</h2>
        <div class="card-body">
            <a href="{{ $orders->designs->getFirstMediaUrl() }}" target="_blank">
                <img class="" src="{{ $orders->designs->getFirstMediaUrl() }}" height="250px" width="250px"
                    style="vertical-align: 0%;" alt="Design Template" />
            </a>
        </div>
    </div>

    <div class="card mb-2" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
        <h2 class="card-header text-uppercase">Attachments</h2>
        <div class="card-body">
            @foreach ($orders->getMedia('order_attachments') as $order)
                <a href="{{ $order->getUrl() }}" target="_blank">
                    <img class="" src="{{ $order->getUrl() }}" height="250px" width="250px"
                        style="vertical-align: 0%;" alt="User Attachments" />
                </a>
            @endforeach
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
@endsection

@section('page-script')

@endsection
