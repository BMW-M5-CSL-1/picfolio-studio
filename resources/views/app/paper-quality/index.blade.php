@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'paper-quality.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Paper Quality')

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
                <h2 class="content-header-title float-start mb-0">Paper Quality</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('paper-quality.index') }}
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
                                <h3 class="mb-0 me-2">{{ count($paper_qualities) }}</h3>
                                <small class="text-success">(
                                    @if (count($paper_qualities) > 0)
                                        {{ number_format((float) ((count($paper_qualities) / count($paper_qualities)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            {{-- <i class="ti ti-shopping-cart ti-sm"></i> --}}
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
                                    Paper Quality</button>
                            </a>
                            <p class="mb-0 mt-1">Add Paper Quality</p>
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

        {{-- <div class="card-datatable table-responsive">
              <table class="datatables-users table">
                  <thead class="border-top">
                      <tr>
                          <th></th>
                          <th>Id</th>
                          <th>User</th>
                          <th>Email</th>
                          <th>Verified</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
              </table>
        </div> --}}


        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="create_paper_type" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Paper Quality</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post"
                    action="{{ route('paper-quality.store') }}">
                    @csrf
                    {{-- <input type="hidden" name="id" id="user_id"> --}}
                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Paper Quality" name="name"
                            aria-label="A4" required />
                        <small class="text-muted">Paper Quality</small>
                        @error('name')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="slug">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="slug" placeholder="paper_quality" name="slug"
                            required />
                        <small class="text-muted">Slug must not contain space</small>
                        @error('slug')
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
                url: "{{ route('paper-quality.ajax-paper-quality-action-buttons', ['id' => ':id']) }}".replace(
                    ':id', $id),
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
        function editPaperQuality($id) {
            $('#addNewUserForm').attr('action', "{{ route('paper-quality.update', ['id' => ':id']) }}".replace(':id',
                $id));
            $(document).ready(function() {
                var _token = '{{ csrf_token() }}';
                var url = "{{ route('paper-quality.edit', ['id' => ':id']) }}".replace(':id', $id);
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
                            $('#slug').val(response.slug).trigger('change');
                        } else {
                            $('#name').val('').trigger('change');
                            $('#slug').val('').trigger('change');
                        }
                    }
                });
            });
        }

        function clearFields() {
            $('#name').val('').trigger('change');
            $('#slug').val('').trigger('change');
            $('#addNewUserForm').attr('action', "{{ route('paper-quality.store') }}");
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
