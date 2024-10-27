@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'stakeholders.index') }}
        </span>
    </h4>
@endsection

@section('title', 'User Management')

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
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                {{-- <h2 class="content-header-title float-start mb-0">Stakeholders</h2> --}}
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('stakeholders.index') }}
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
                            <span>Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($users) }}</h3>
                                {{-- <small class="text-success">(100%)</small> --}}
                            </div>
                            <small>Total Users</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="ti ti-user ti-sm"></i>
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
                            <span>Verified Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">750</h3>
                                {{-- <small class="text-success">(+95%)</small> --}}
                            </div>
                            <small>Recent analytics </small>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class="ti ti-user-check ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Duplicate Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">100</h3>
                                <small class="text-success">(0%)</small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                            <i class="ti ti-users ti-sm"></i>
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
                            <span>Verification Pending</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">150</h3>
                                <small class="text-danger">(+6%)</small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="ti ti-user-circle ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-sm-6 col-xl-4">
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
                            <a href="#offcanvasAddUser" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
                                <button class="btn btn-primary mb-2 text-nowrap add-new-role">Add New</button>
                            </a>
                            <p class="mb-0 mt-1">Create New User</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post"
                    action="{{ route('stakeholders.store') }}">
                    @csrf
                    {{-- <input type="hidden" name="id" id="user_id"> --}}
                    <div class="mb-3">
                        <label class="form-label" for="fullName">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fullName" placeholder="John Doe" name="fullName"
                            aria-label="John Doe" required />
                        @error('fullName')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fatherName">Father Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fatherName" placeholder="Mark Doe" name="fatherName"
                            aria-label="John Doe" required />
                        @error('fatherName')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="cnic">CNIC <span class="text-danger">*</span></label>
                        <input type="text" id="cnic" class="form-control" placeholder="12345 12345678 1"
                            aria-label="" name="cnic" required max="14" />
                        @error('cnic')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-6" for="dob">Date of Birth <span
                                class="text-danger">*</span></label>
                        <input type="date" id="dob"
                            class="form-control form-control-md fs-6 flatpickr-input active valid"
                            placeholder="YYYY-MM-DD" aria-label="" name="dob" required />
                        @error('dob')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="gender">Gender <span class="text-danger">*</span></label>
                        <select id="gender" name="gender" class="select2 form-select" required>
                            <option value="">Please Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" id="email" class="form-control" placeholder="john.doe@example.com"
                            aria-label="john.doe@example.com" name="email" required />
                        @error('email')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <input type="text" id="password" class="form-control" placeholder="password"
                            name="password" required />
                        @error('password')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact">Contact <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">PK (+92)</span>
                            <input type="text" id="contact" class="form-control phone-mask" placeholder="345678901"
                                aria-label="" name="contact" required max="10" />
                        </div>
                        {{-- <input type="text" id="contact" class="form-control phone-mask" placeholder="03011111111"
                            aria-label="" name="contact" required /> --}}
                        @error('contact')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label" for="company">Company <span class="text-danger">*</span></label>
                        <input type="text" id="company" name="company" class="form-control"
                            placeholder="Web Developer" aria-label="jdoe1" />
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
                        <select id="country" name="country" class="select2 form-select" required>
                            <option value="">Please Select</option>
                            <option value="Pakistan">Pakistan</option>
                        </select>
                        @error('country')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="state">State <span class="text-danger">*</span></label>
                        <select id="state" name="state" class="select2 form-select" required>
                            <option value="">Please Select</option>
                            <option value="Islamabad">Islamabad</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Sindh">Sindh</option>
                            <option value="KPK">KPK</option>
                            <option value="Baluchistan">Baluchistan</option>
                            <option value="Gilgit & Baltistan">Gilgit & Baltistan</option>
                        </select>
                        @error('state')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                        <textarea name="address" id="address" class="form-control" placeholder="Your address here" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="role">User Role <span class="text-danger">*</span></label>
                        <select id="role" name="role[]" class="select2 form-select" required multiple
                            onchange="checkRole()">
                            {{-- <option selected value="">Please Select</option> --}}
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
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

        // Action buttons
        function action_buttons($id) {
            $('#loader_' + $id).show();
            $('#dropDownMenu_' + $id).empty()
            $.ajax({
                type: 'post',
                url: "{{ route('stakeholders.ajax-action-buttons', ['id' => ':id']) }}".replace(':id', $id),
                success: function(data) {
                    $('#dropDownMenu_' + $id).html(data)
                    $('#loader_' + $id).hide();
                },
                error: function(data) {
                    $('#loader_' + $id).hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }
            });
        }

        $('#routesInputSection').hide();

        function checkRole() {
            var media = ['Vehicle Media'];
            var roles = $('#role :selected').toArray().map(item => item.text);
            // console.log(roles, media);
            $.each(roles, function(key, value) {
                if ($.inArray(value, media) !== -1) {
                    $('#routesInputSection').show();
                } else {
                    $('#routesInputSection').hide();
                }
            });
        }
        $('#routesInputSection').hide();

        function edit_stakeholder($id) {
            showBlockUI();
            $('#addNewUserForm').attr('action', "{{ route('stakeholders.update', ['id' => ':id']) }}".replace(':id', $id));
            var url = "{{ route('stakeholders.ajax-get-user-data', ['id' => ':id']) }}".replace(':id', $id);
            $.ajax({
                type: "post",
                url: url,
                dataType: "json",
                data: {
                    id: $id,
                },
                success: function(response) {
                    if (response.success) {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);

                        var user = response.user,
                            roles = response.roles;

                        $('#offcanvasAddUser');
                        $('#fullName').val(response.user.name).trigger('change');
                        $('#fatherName').val(response.user.father_name).trigger('change');
                        $('#cnic').val(response.user.cnic).trigger('change');
                        $('#email').val(response.user.email).trigger('change');
                        var dob = $('#dob').flatpickr({
                            defaultDate: response.user.dob,
                            maxDate: "today",
                            altInput: !0,
                            altFormat: "F j, Y",
                            dateFormat: "Y-m-d"
                        });
                        $('#gender').val(response.user.gender).trigger('change');
                        $('#password').val(response.user.password).trigger('change');
                        $('#contact').val(response.user.contact).trigger('change');
                        $('#country').val(response.user.country).trigger('change');
                        $('#state').val(response.user.state).trigger('change');
                        $('#address').val(response.user.address).trigger('change');

                        var selected_roles = [];
                        $.each(roles, function() {
                            selected_roles.push(this.id);
                            checkRole();
                        });
                        $("#role").val(selected_roles).trigger('change');

                        var selected_routes = [];
                        $.each(roles, function() {
                            selected_routes.push(this.id);
                            checkRole();
                        });
                        $("#route").val(selected_routes).trigger('change');


                        // toastr.success(response
                        //     .message,
                        //     "Order Confirmed!", {
                        //         showMethod: "slideDown",
                        //         hideMethod: "slideUp",
                        //         timeOut: 2e3,
                        //         closeButton: !0,
                        //         tapToDismiss: !1,
                        //     });

                    } else {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something Went Wrong!'
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An Error Occured!'
                    });
                }
            });
        }
    </script>
@endsection
