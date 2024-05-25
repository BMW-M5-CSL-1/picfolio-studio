@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'reports.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Reports')

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
                <h2 class="content-header-title float-start mb-0">Reports</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('reports.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    {{-- Modal for Details --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 px-sm-3 pt-30" id="modalBody">
                </div>
            </div>
        </div>
    </div>

    <!-- Users List Table -->
    <div class="modal fade" id="approvalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 px-sm-3 pt-30" id="modalBody">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-9 col-md-9 col-sm-12 position-relative">
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <div class="card-body">
                    <div class="row mb-2 g-1 position-relative">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                            <label class="form-label fs-6" for="type_name">Select filter Type</label>
                            <select class="select2 form-select col-filter" {{-- onchange="showUnitExtendedFilter()" --}} id="type_name"
                                name="type_name">
                                <option value="" selected>Please Select</option>
                                <option value="Orders">Orders</option>
                                <option value="Printing">Printing Press</option>
                                <option value="Distribution">Distribution</option>
                                <option value="Vehicle-Media">Vehicle-Media</option>
                            </select>
                            <small class="text-muted">Select Filter Type</small>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                            <label class="form-label" style="font-size: 15px" for="to_date">Select Date
                                Range</label>
                            <input type="text" id="to_date" name="to_date"
                                class="form-control flatpickr-range flatpickr-input active to_date_ranger"
                                placeholder="YYYY-MM-DD to YYYY-MM-DD" readonly="readonly">
                            <small class="text-muted">Select Date Range</small>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 position-relative">
            <div class="sticky-md-top top-lg-100px top-md-100px top-sm-0px" style="z-index: auto; top: 0 !important;">
                <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                    <div class="card-body">
                        <div class="row g-1 pb-1">
                            <div class="col-md-12">
                                <button type="button" value="asd" name="apply_filter" id="apply_filter"
                                    class="btn btn-outline-success w-100 waves-effect waves-float waves-light buttonToBlockUI me-1">
                                    <i class="ti ti-device-floppy ti-sm"></i>&nbsp;
                                    Apply Filter
                                </button>
                            </div>
                            <div class="col-md-12">
                                <button onclick="resetFilter()"
                                    class="btn btn-outline-danger w-100 waves-effect waves-float waves-light"
                                    type="button">
                                    <i class='ti ti-x ti-sm'></i>&nbsp;Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- {{ $dataTable->table() }} --}}

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
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('page-script')
    {{-- {{ $dataTable->scripts() }} --}}

    {{-- <script src="{{ asset('js/laravel-user-management.js') }}"></script> --}}

    <script>
        // View Image in Modal
        $(document).on('click', '.detailsModal', function(e) {
            id = $(this).data('id');
            $('#modalBody').html('');
            $.ajax({
                type: "POST",
                url: "{{ route('design.ajax-get-design-details') }}",
                data: {
                    id: id,
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
                url: "{{ route('design.ajax-action-buttons', ['id' => ':id']) }}".replace(':id', $id),
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

        var flatpicker_to_date = null;

        flatpicker_to_date = $('#to_date').flatpickr({
            // defaultDate: "01-01-1995",
            // maxDate: "today",
            // altInput: !0,
            // altFormat: "F j, Y",
            // dateFormat: "Y-m-d"

            mode: "range",
            allowInput: !0,
            allowInput: true,
            dateFormat: "Y-m-d",
            // "plugins": [new rangePlugin({
            //     input: "#endDate"
            // })]
        });

        function resetFilter() {
            $('#type_name').val('').trigger('change');
            flatpicker_to_date.clear();
        }
    </script>
@endsection
