@extends('layouts/layoutMaster')

@section('title', 'Edit - Profile')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0"><span class="text-muted">Profile /</span> Edit</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{-- {{ Breadcrumbs::render('profile.edit') }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col">
        <div class="card mb-3">
            <div class="card-header" id="tabs">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-account"
                            role="tab" id="tabs-account">
                            Account
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link settingsTabs" data-bs-toggle="tab" data-bs-target="#form-tabs-portfolio"
                            role="tab" id="tabs-portfolio">
                            Portfolio
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card mb-3">
            <div class="tab-content">
                <!-- Pending -->
                <div class="tab-pane fade active show" id="form-tabs-account" role="tabpanel">
                    <div id="account">

                        <h5 class="card-header mb-0 pb-0">Profile Details</h5>
                        <form id="user_account" method="POST" action="{{ route('profile.update', ['id' => Auth::id()]) }}">
                            <!-- Account -->
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ Auth::user()->profile_photo_url }}" alt="user-avatar"
                                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" />
                                        </label>
                                        {{-- <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Reset</span>
                                            </button> --}}

                                        {{-- <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div> --}}
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Full Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="name" name="name" required
                                            value="{{ $user->name ?? '' }}" autofocus placeholder="Full Name" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="fatherName" class="form-label">Father Name</label>
                                        <input class="form-control" type="text" name="fatherName" id="fatherName"
                                            value="{{ $user->father_name ?? '' }}" placeholder="Father Name Here..." />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email" readonly
                                            value="{{ $user->email ?? '' }}" placeholder="john.doe@example.com" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="cnic">CNIC <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="cnic" class="form-control"
                                            value="{{ $user->cnic ?? '' }}" placeholder="12345 12345678 1" aria-label=""
                                            name="cnic" required max="14" />
                                        @error('cnic')
                                            <div class="invalid-feedback ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label fs-6" for="dob">Date of Birth <span
                                                class="text-danger">*</span></label>
                                        <input type="date" id="dob"
                                            class="form-control form-control-md fs-6 flatpickr-input active valid"
                                            value="{{ $user->dob ?? '' }}" placeholder="YYYY-MM-DD" aria-label=""
                                            name="dob" required />
                                        @error('dob')
                                            <div class="invalid-feedback ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="gender">Gender <span
                                                class="text-danger">*</span></label>
                                        <select id="gender" name="gender" class="select2 form-select" required>
                                            <option value="">Please Select</option>
                                            <option value="male" {{ $user->gender == 'male' ? 'selected' : null }}>
                                                Male
                                            </option>
                                            <option value="female"
                                                @if ($user->gender == 'female') @selected(true) @endif>
                                                Female
                                            </option>
                                            <option
                                                value="other"@if ($user->gender == 'other') @selected(true) @endif>
                                                Other</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-3 col-md-6">
                                                <label class="form-label" for="password">Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" id="password" class="form-control" placeholder="********"
                                                    value="" name="password" required />
                                                @error('password')
                                                    <div class="invalid-feedback ">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="contact">Contact <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">PK (+92)</span>
                                            <input type="text" id="contact" class="form-control phone-mask"
                                                value="{{ $user->contact ?? '' }}" placeholder="345678901"
                                                aria-label="" name="contact" required max="10" />
                                        </div>
                                        @error('contact')
                                            <div class="invalid-feedback ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="country">Country <span
                                                class="text-danger">*</span></label>
                                        <select id="country" name="country" class="select2 form-select" required>
                                            <option value="">Please Select</option>
                                            <option value="Pakistan"
                                                @if ($user->country == 'Pakistan') @selected(true) @endif>
                                                Pakistan
                                            </option>
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </div>
                            <!-- /Account -->
                        </form>
                        {{-- <div class="card">
                                <h5 class="card-header">Delete Account</h5>
                                <div class="card-body">
                                    <div class="mb-3 col-12 mb-0">
                                        <div class="alert alert-warning">
                                            <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                                            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                                        </div>
                                    </div>
                                    <form id="formAccountDeactivation" onsubmit="return false">
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" name="accountActivation"
                                                id="accountActivation" />
                                            <label class="form-check-label" for="accountActivation">I confirm my account
                                                deactivation</label>
                                        </div>
                                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                                    </form>
                                </div>
                            </div> --}}
                    </div>
                </div>
                <!-- Active -->
                <div class="tab-pane fade" id="form-tabs-portfolio" role="tabpanel">

                    <form id="portfolioForm" enctype="multipart/form-data">
                        <div class="card mb-3">
                            <h5 class="card-header">Work Experience</h5>
                            <div class="card-body">
                                <div class="card mb-3">
                                    <div class="card-body portfolio_work_repeater">
                                        <div data-repeater-list="work_repeater">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-11 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="company_name">Company Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="company_name" required
                                                                    id="company_name" class="company_name form-control"
                                                                    placeholder="Company Name Here...">
                                                            </div>
                                                            <div class="col">
                                                                <label for="job_title">Job Title <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control job_title"
                                                                    required id="job_title" name="job_title"
                                                                    value="" placeholder="Job Title Here..." />
                                                            </div>
                                                            <div class="col">
                                                                <label for="start_date">Start Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" class="form-control start_date"
                                                                    required id="start_date" name="start_date"
                                                                    value="" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="col">
                                                                <label for="end_date">End Date</label>
                                                                <input type="date" class="form-control end_date"
                                                                    required id="end_date" name="end_date"
                                                                    value="" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <label for="work_description">Description</label>
                                                                <textarea name="work_description" id="work_description" class="form-control work_description" rows="3"
                                                                    placeholder="Work Description Here..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="d-flex">
                                                            <button data-repeater-delete
                                                                class="btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                                id="" type="button">
                                                                <i class="ti ti-x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-outline-success waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                    id="" type="button" data-repeater-create>
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <h5 class="card-header">Projects</h5>
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body portfolio_project_repeater">
                                        <div data-repeater-list="project_repeater">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-11 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="project_name">Name</label>
                                                                <input type="text" name="project_name"
                                                                    id="project_name" class="project_name form-control"
                                                                    placeholder="Project Name Here...">
                                                            </div>
                                                            <div class="col">
                                                                <label for="your_role">Your Role</label>
                                                                <input type="text" class="form-control your_role"
                                                                    required id="your_role" name="your_role"
                                                                    value="" placeholder="Your Role Here..." />
                                                            </div>
                                                            <div class="col">
                                                                <label for="start_date">Start Date <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" class="form-control start_date"
                                                                    required id="start_date" name="start_date"
                                                                    value="" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="col">
                                                                <label for="end_date">End Date</label>
                                                                <input type="date" class="form-control end_date"
                                                                    required id="end_date" name="end_date"
                                                                    value="" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <label for="project_description">Description</label>
                                                                <textarea name="project_description" id="project_description" class="form-control project_description"
                                                                    rows="3" placeholder="Project Description Here..."></textarea>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <label for="project_attachment">Attachment</label>
                                                                <input type="file" class=" project_attachment"
                                                                    name="project_attachment" id="project_attachment">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="d-flex">
                                                            <button data-repeater-delete
                                                                class="btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                                id="" type="button">
                                                                <i class="ti ti-x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-outline-success waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                    id="" type="button" data-repeater-create>
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <h5 class="card-header">Certificates</h5>
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body portfolio_certificate_repeater">
                                        <div data-repeater-list="certificate_repeater">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-11 mb-3">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="certificate_name">Name</label>
                                                                <input type="text" name="certificate_name"
                                                                    id="certificate_name"
                                                                    class="certificate_name form-control"
                                                                    placeholder="Certificate Name Here...">
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="institute">Institution</label>
                                                                <input type="text" class="form-control institute"
                                                                    required id="institute" name="institute"
                                                                    value="" placeholder="Institute Name Here..." />
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="certificate_start_date">Start Date</label>
                                                                <input type="date"
                                                                    class="form-control certificate_start_date" required
                                                                    id="certificate_start_date"
                                                                    name="certificate_start_date" value=""
                                                                    placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="certificate_end_date">End Date</label>
                                                                <input type="date"
                                                                    class="form-control certificate_end_date" required
                                                                    id="certificate_end_date" name="certificate_end_date"
                                                                    value="" placeholder="DD-MM-YYYY" />
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <label for="certificate_description">Description</label>
                                                                <textarea name="certificate_description" id="certificate_description" class="form-control certificate_description"
                                                                    rows="3" placeholder="Certificate Description Here..."></textarea>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <label for="certificate_attachment">Attachment</label>
                                                                <input type="file" class=" certificate_attachment"
                                                                    name="certificate_attachment"
                                                                    id="certificate_attachment">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="d-flex">
                                                            <button data-repeater-delete
                                                                class="btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                                id="" type="button">
                                                                <i class="ti ti-x"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-outline-success waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                    id="" type="button" data-repeater-create>
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">Submit Portfolio</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script> --}}
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);

        $(document).ready(function() {});

        $('.select2').select2({});

        $('.portfolio_work_repeater').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                initFlatPickr($(this).find('.start_date').attr('id'));
                initFlatPickr($(this).find('.end_date').attr('id'));
            },
            hide: function(e) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure ?',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes, Remove it!',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).slideUp(e, function() {
                            $(this).remove();
                        });
                    }
                });
            }
        });

        $('.portfolio_certificate_repeater').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                initFlatPickr($(this).find('.certificate_start_date').attr('id'));
                initFlatPickr($(this).find('.certificate_end_date').attr('id'));
                initFilePond($(this).find('.certificate_attachment').get(0));
            },
            hide: function(e) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure ?',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes, Remove it!',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).slideUp(e, function() {
                            $(this).remove();
                        });
                    }
                });
            }
        });

        $('.portfolio_project_repeater').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                initFlatPickr($(this).find('.start_date').attr('id'));
                initFlatPickr($(this).find('.end_date').attr('id'));
                initFilePond($(this).find('.project_attachment').get(0));
            },
            hide: function(e) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure ?',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes, Remove it!',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).slideUp(e, function() {
                            $(this).remove();
                        });
                    }
                });
            }
        });

        // Submit the Form
        $('#portfolioForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('profile.ajax-portfolio-store') }}', // Ensure this is the correct URL
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonClass: 'btn btn-primary',
                    });
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '\n';
                    });

                    // Display the error in Swal for better UX
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessage,
                        confirmButtonClass: 'btn btn-danger',
                    });
                }
            });
        });

        $('#logo').on('FilePond:processfiles', (function(file) {
            $('#save_btn_general').attr('disabled', false);
        }));
        $('#logo').on('FilePond:processfilestart', (function(file) {
            $('#save_btn_general').attr('disabled', true);
        }));
        $('#logo').on('FilePond:processfileabort', (function(file) {
            $('#save_btn_general').attr('disabled', false);
        }));

        var file = '';

        function initFilePond(element) {
            FilePond.create(element, {
                styleButtonRemoveItemPosition: 'right',
                imageCropAspectRatio: '1:1',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                maxFileSize: '100000KB',
                ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
                storeAsFile: true,
                allowMultiple: true,
                // maxFiles: 1,
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
        }

        function initFlatPickr(element_class) {
            $('.' + element_class).flatpickr({
                defaultDate: "",
                altInput: !0,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d"
            });
        }

        var dob = $('#dob').flatpickr({
            defaultDate: "{{ $user->dob ?? '' }}",
            maxDate: "today",
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d"
        });

        const user_account = document.getElementById('user_account');
        const fv = FormValidation.formValidation(user_account, {
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Full Name',
                        }
                    },
                },
                fatherName: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Father Name',
                        }
                    },
                },
                cnic: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter CNIC',
                        },
                        // between: {
                        //     min: 13,
                        //     max: 14,
                        //     message: 'CNIC should be 14 digits long',
                        // }
                    },
                },
                contact: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Contact No.',
                        },
                        // between: {
                        //     min: 9,
                        //     max: 11,
                        //     message: 'Contact No. should be 10-11 digits long',
                        // }
                    },
                },
                dob: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Date of Birth',
                        }
                    },
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'Please Select Gender',
                        }
                    },
                },
                country: {
                    validators: {
                        notEmpty: {
                            message: 'Please Select Country',
                        }
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: function(field, ele) {
                        // field is the field name & ele is the field element
                        return '.mb-3';
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            }
        }).on('core.form.valid', function() {
            alert('submit')
        }).on('core.form.invalid', function(data) {
            console.log(data);
        });
    </script>
@endsection
