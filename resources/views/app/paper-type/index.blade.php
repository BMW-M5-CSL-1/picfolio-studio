@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'paper-type.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Paper Types')

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

        #papertype-table tbody {
            text-transform: capitalize !important;
        }
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Paper Type</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('paper-type.index') }}
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
                            <span>Total Types</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($paper_types) }}</h3>
                                <small class="text-success">(
                                    @if (count($paper_types) > 0)
                                        {{ number_format((float) ((count($paper_types) / count($paper_types)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M9 17h6"></path>
                                <path d="M9 13h6"></path>
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
                                    Paper Type</button>
                            </a>
                            <p class="mb-0 mt-1">Add Paper Type</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        {{-- <div class="card-header">
            <h5 class="card-title mb-0">Search Filter</h5>
        </div> --}}
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>

        <!-- Offcanvas to add paper types -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="create_paper_type" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Paper Type</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post"
                    action="{{ route('paper-type.store') }}">
                    @csrf
                    {{-- <input type="hidden" name="id" id="user_id"> --}}
                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="A4" name="name"
                            value="" aria-label="A4" required />
                        @error('name')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="paper_guage">Paper Guage (mm) <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="paper_guage" placeholder="70mm" name="paper_guage"
                            aria-label="70mm" required />
                        @error('paper_guage')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="type">Paper For <span class="text-danger">*</span></label>
                        <select id="type" name="type" class="select2 form-select" onchange="check_paper_for()"
                            required>
                            <option value="">Please Select</option>
                            <option value="paper_media">Paper Media</option>
                            <option value="vehicle_media">Vehicle Media</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="side">Print Side <span class="text-danger">*</span></label>
                        <select id="side" name="side" class="select2 form-select" required>
                            <option value="">Please Select</option>
                            <option value="one">One Sided</option>
                            <option value="both">Front & Back</option>
                        </select>
                        @error('side')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quality">Paper Quality <span class="text-danger">*</span></label>
                        <select id="quality" name="quality" class="select2 form-select" required>
                            <option value="">Please Select</option>
                            @foreach ($paper_quality as $quality)
                                <option value="{{ $quality->id }}">{{ $quality->name }}</option>
                            @endforeach
                        </select>
                        @error('quality')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Price per sheet <span
                                class="text-danger">*</span></label>
                        <input type="text" id="price" class="form-control" placeholder="100 Rs" aria-label=""
                            name="price" required />
                        @error('price')
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

    {{-- <script src="{{ asset('js/laravel-user-management.js') }}"></script> --}}

    <script>
        // Action buttons
        function action_buttons($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()
            $.ajax({
                type: 'post',
                url: "{{ route('paper-type.ajax-paper-type-action-buttons', ['id' => ':id']) }}".replace(':id',
                    $id),
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
        function editPaperType($id) {
            $('#addNewUserForm').attr('action', "{{ route('paper-type.update', ['id' => ':id']) }}".replace(':id', $id));
            $(document).ready(function() {
                var _token = '{{ csrf_token() }}';
                var url = "{{ route('paper-type.edit', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    data: {
                        '_token': _token,
                        'id': $id,
                    },
                    success: function(response) {
                        if (response.success == true) {
                            $('#name').val(response.name).trigger('change');
                            $('#paper_guage').val(response.guage).trigger('change');
                            $('#quality').val(response.paper_quality_id).trigger('change');
                            $('#side').val(response.side).trigger('change');
                            $('#price').val(response.price).trigger('change');
                            $('#type').val(response.type).trigger('change');
                        } else {
                            $('#name').val('').trigger('change');
                            $('#paper_guage').val('').trigger('change');
                            $('#quality').val('').trigger('change');
                            $('#side').val('').trigger('change');
                            $('#price').val('').trigger('change');
                            $('#type').val('').trigger('change');
                        }
                    }
                });
            });
        }

        function check_paper_for() {
            var check_type = $('#type').val();
            if (check_type == 'vehicle_media') {
                var print_side = $('#side').val('one').trigger('change').attr('disabled', true);
            } else {
                $('#side').attr('disabled', false);
            }
        }

        function clearFields() {
            $('#name').val('').trigger('change');
            $('#paper_guage').val('').trigger('change');
            $('#quality').val('').trigger('change');
            $('#side').val('').trigger('change');
            $('#type').val('').trigger('change');
            $('#price').val('').trigger('change');
            $('#addNewUserForm').attr('action', "{{ route('paper-type.store') }}");
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
    </script>
@endsection
