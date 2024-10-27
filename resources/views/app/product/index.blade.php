@extends('layouts/layoutMaster')

@section('title', 'Products')

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
                    {{ Breadcrumbs::render('product.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
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
            let url = '{{ route('product.create') }}';
            location.href = url;
        }
    </script>
@endsection
