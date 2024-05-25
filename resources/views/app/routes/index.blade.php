@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'route.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Route')

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
                <h2 class="content-header-title float-start mb-0">Route</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('route.index') }}
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
                            <span>Total Routes</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($routes) }}</h3>
                                <small class="text-success">(
                                    @if (count($routes) > 0)
                                        {{ number_format((float) ((count($routes) / count($routes)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-route-square"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 17h4v4h-4z"></path>
                                <path d="M17 3h4v4h-4z"></path>
                                <path d="M11 19h5.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h4.5"></path>
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
                                    Route</button>
                            </a>
                            <p class="mb-0 mt-1">Add Route</p>
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
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Route</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post" action="{{ route('route.store') }}">
                    @csrf
                    {{-- <input type="hidden" name="id" id="user_id"> --}}
                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Route Name" name="name"
                            aria-label="A4" required />
                        <small class="text-muted">Route Name</small>
                        @error('name')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price_per_day">Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price_per_day" placeholder="Price" name="price_per_day"
                            aria-label="A4" required />
                        <small class="text-muted">Enter Price Per Day</small>
                        @error('name')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Save</button>
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
                url: "{{ route('route.ajax-action-buttons', ['id' => ':id']) }}".replace(':id', $id),
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
        // function editLocation($id) {
        //     $('#addNewUserForm').attr('action', "{{ route('location.update', ['id' => ':id']) }}".replace(':id', $id));
        //     $(document).ready(function() {
        //         var _token = '{{ csrf_token() }}';
        //         var url = "{{ route('location.edit', ['id' => ':id']) }}".replace(':id', $id);
        //         $.ajax({
        //             type: "get",
        //             url: url,
        //             dataType: "json",
        //             data: {
        //                 '_token': _token,
        //                 'id': $id,
        //             },
        //             success: function(response) {
        //                 console.log(response);
        //                 if (response.success == true) {
        //                     $('#name').val(response.name).trigger('change');
        //                     $('#house').val(response.house).trigger('change');
        //                     $('#shop').val(response.shop).trigger('change');
        //                     $('#school').val(response.school).trigger('change');
        //                     $('#park').val(response.park).trigger('change');
        //                 } else {
        //                     $('#name').val('').trigger('change');
        //                     $('#house').val('').trigger('change');
        //                     $('#shop').val('').trigger('change');
        //                     $('#school').val('').trigger('change');
        //                     $('#park').val('').trigger('change');
        //                 }
        //             }
        //         });
        //     });
        // }

        function clearFields() {
            $('#name').val('').trigger('change');
            $('#house').val('').trigger('change');
            $('#shop').val('').trigger('change');
            $('#school').val('').trigger('change');
            $('#park').val('').trigger('change');
            $('#addNewUserForm').attr('action', "{{ route('route.store') }}");
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

        function deleteRoute($id) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are You Sure ?',
                showCancelButton: true,
                cancelButtonText: 'No, Cancel',
                confirmButtonText: 'Yes',
                confirmButtonClass: 'btn-success',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                    cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
                },
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('route.destroy', ['id' => ':id']) }}".replace(':id', $id);
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {
                            'id': $id,
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response
                                    .message,
                                    "Route Deleted!", {
                                        showMethod: "slideDown",
                                        hideMethod: "slideUp",
                                        timeOut: 2e3,
                                        closeButton: !0,
                                        tapToDismiss: !1,
                                    });
                                $('#route-table').DataTable().ajax.reload();
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                        }
                    });
                }
            });

        }
    </script>
@endsection
