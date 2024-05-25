@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'design.index') }}
        </span>
    </h4>
@endsection

@section('title', 'Design')

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
                <h2 class="content-header-title float-start mb-0">Design</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('design.index') }}
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

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Designs</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">{{ count($designs) }}</h3>
                                <small class="text-success">(
                                    @if (count($designs) > 0)
                                        {{ number_format((float) ((count($designs) / count($designs)) * 100), 2, '.', '') }}
                                    @else
                                        0
                                    @endif
                                    % )
                                </small>
                            </div>
                            <small>Recent analytics</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13"></path>
                                <path d="M9 4v13"></path>
                                <path d="M15 7v13"></path>
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
                                    Design</button>
                            </a>
                            <p class="mb-0 mt-1">Add Design</p>
                        </div>
                    </div>
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
    <div class="card">
        <div class="card-body">
            <form action="#" id="design_form" method="get">
                {{ $dataTable->table() }}
            </form>
        </div>

        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="create_paper_type" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Design</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post" action="{{ route('design.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="id" id="user_id"> --}}
                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Design Name"
                            name="name" aria-label="A4" required />
                        <small class="text-muted">Name</small>
                        @error('name')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="type">Paper For <span class="text-danger">*</span></label>
                        <select id="type" name="type" class="select2 form-select" required>
                            <option value="">Please Select</option>
                            <option value="paper_media">Paper Media</option>
                            <option value="vehicle_media">Vehicle Media</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback ">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fileDesign">Design <span class="text-danger">*</span></label>
                        <input type="file" class="form-control filepond" id="fileDesign" name="fileDesign" required
                            accept="image/png, image/jpeg, image/jpg" />
                        <small class="text-muted">Upload Image Design</small>
                        @error('fileDesign')
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
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('page-script')
    {{ $dataTable->scripts() }}

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

        FilePond.registerPlugin(FilePondPluginImagePreview);

        FilePond.create(document.getElementById('fileDesign'), {
            styleButtonRemoveItemPosition: 'right',
            imageCropAspectRatio: '1:1',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '100000KB',
            ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
            storeAsFile: true,
            // allowMultiple: true,
            maxFiles: 1,
            checkValidity: true,
            allowPdfPreview: true,
            // chunkUploads: true,
            // chunkSize: '200KB',
            // chunkForce: true,
            // server: {
            //     timeout: 7000,
            //     process: '/files/getUploadId',
            //     revert: '/files/revertFile',
            //     patch: '/files/uploadfileChunk?patch=',
            //     headers: {
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //     }
            // },
            credits: {
                label: '',
                url: ''
            }
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
        // Edit
        // function editLocation($id) {
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
        // FilePond
        // $('#fileDesign').filepond({
        //     allowMultiple: true,
        // });

        function clearFields() {
            $('#name').val('').trigger('change');
            $('#house').val('').trigger('change');
            $('#shop').val('').trigger('change');
            $('#school').val('').trigger('change');
            $('#park').val('').trigger('change');
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

        // var dob = $('#dob').flatpickr({
        //     defaultDate: "01-01-1995",
        //     maxDate: "today",
        //     altInput: !0,
        //     altFormat: "F j, Y",
        //     dateFormat: "Y-m-d"
        // });

        function destroyDesign($id) {

            // showBlockUI('#receipt-table-form');

            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Are You Sure You Want To Delete!!!',
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
                    // showBlockUI('#receipt-table-form');

                    let url = "{{ route('design.destroy', ['id' => ':id']) }}".replace(':id', $id);
                    location.href = url;
                    // hideBlockUI('#receipt-table-form');
                }
            });
            // hideBlockUI('#receipt-table-form');


        }
    </script>
@endsection
