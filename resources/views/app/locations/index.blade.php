@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'location.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Location')

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
                <h2 class="content-header-title float-start mb-0">Location</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('location.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Locations</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($locations) }}</h3>
                                <small class="text-success">(
                                    @if (count($locations) > 0)
                                        {{ number_format((float) ((count($locations) / count($locations)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin-filled"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                    stroke-width="0" fill="currentColor"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                    <img src="{{ asset('assets/img/illustrations/faq-illustrations.svg') }}"
                                        class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="">
                                </div>
                            </div>
                        </div>
                        <div class="text-sm-end text-center ps-sm-0">
                            <a href="#offcanvasAddUser" data-bs-toggle="offcanvas" data-bs-target="#create_paper_type">
                                <button class="btn btn-primary mb-2 text-nowrap add-new-role" onclick="clearFields()">Add
                                    Location</button>
                            </a>
                            <p class="mb-0 mt-1">Add Location</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>


        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="create_paper_type" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Location</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post" action="{{ route('location.store') }}">
                    @csrf
                    {{-- <input type="hidden" name="id" id="user_id"> --}}
                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Location Name" name="name"
                            aria-label="A4" required />
                        <small class="text-muted">Location Name</small>
                        @error('name')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="house">Houses <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="house" placeholder="" name="house"
                            required />
                        <small class="text-muted">Number of Houses</small>
                        @error('house')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="shop">Shops <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="shop" placeholder="" name="shop"
                            required />
                        <small class="text-muted">Number of Shops</small>
                        @error('shop')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="school">Educational Institutes <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="school" placeholder="" name="school"
                            required />
                        <small class="text-muted">Number of Educational Institutes</small>
                        @error('school')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="park">Parks <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="park" placeholder="" name="park"
                            required />
                        <small class="text-muted">Number of Parks</small>
                        @error('park')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
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
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    {{ $dataTable->scripts() }}

    <script>
        // Action buttons
        function action_buttons($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()
            $.ajax({
                type: 'post',
                url: "{{ route('location.ajax-location-action-buttons', ['id' => ':id']) }}".replace(':id', $id),
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
        // Edit
        function editLocation($id) {
            $('#addNewUserForm').attr('action', "{{ route('location.update', ['id' => ':id']) }}".replace(':id', $id));
            $(document).ready(function() {
                var _token = '{{ csrf_token() }}';
                var url = "{{ route('location.edit', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    data: {
                        '_token': _token,
                        'id': $id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            $('#name').val(response.name).trigger('change');
                            $('#name').attr('readonly', true);
                            $('#house').val(response.house).trigger('change');
                            $('#shop').val(response.shop).trigger('change');
                            $('#school').val(response.school).trigger('change');
                            $('#park').val(response.park).trigger('change');
                        } else {
                            $('#name').val('').trigger('change');
                            $('#house').val('').trigger('change');
                            $('#shop').val('').trigger('change');
                            $('#school').val('').trigger('change');
                            $('#park').val('').trigger('change');
                        }
                    }
                });
            });
        }

        function clearFields() {
            $('#name').val('').trigger('change');
            $('#house').val('').trigger('change');
            $('#shop').val('').trigger('change');
            $('#school').val('').trigger('change');
            $('#park').val('').trigger('change');
            $('#addNewUserForm').attr('action', "{{ route('location.store') }}");
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

        var dob = $('#dob').flatpickr({
            defaultDate: "01-01-1995",
            maxDate: "today",
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d"
        });
    </script>
@endsection
