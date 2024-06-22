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
                <h2 class="content-header-title float-start mb-0">Profile</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('profile.edit') }}
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
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <!-- Account -->
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
                                        <label for="fullName" class="form-label">First Name</label>
                                        <input class="form-control" type="text" id="fullName" name="fullName"
                                            value="{{ $user->name ?? '' }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="fatherName" class="form-label">Father Name</label>
                                        <input class="form-control" type="text" name="fatherName" id="fatherName"
                                            value="{{ $user->father_name ?? '' }}" placeholder="Father Name Here..." />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
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

                    <div class="card mb-3">
                        <h5 class="card-header">Work Experience</h5>
                        <div class="card-body">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-11 mb-3">
                                            <div class="row">
                                                <div class="col-3">
                                                    <input disabled class="form-control" value="ABC Company">
                                                </div>
                                                <div class="col-3">
                                                    <input disabled type="text" class="form-control"
                                                        value="Front End Developer" />
                                                </div>
                                                <div class="col-3">
                                                    <input disabled class="form-control" value="01-01-2023" />
                                                </div>
                                                <div class="col-3">
                                                    <input disabled class="form-control" value="01-12-2023" />
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <textarea disabled class="form-control work_description" rows="3">Working as a junior front end developer</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="d-flex">
                                                <button
                                                    class="remove_work btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                    id="" type="button">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body portfolio_work_repeater">
                                    <div data-repeater-list="work_repeater">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-11 mb-3">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="company_name">Company Name</label>
                                                            <input type="text" name="company_name" id="company_name"
                                                                class="company_name form-control"
                                                                placeholder="Company Name Here...">
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="job_title">Job Title</label>
                                                            <input type="text" class="form-control job_title" required
                                                                id="job_title" name="job_title" value=""
                                                                placeholder="Job Title Here..." />
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="start_date">Start Date</label>
                                                            <input type="date" class="form-control start_date" required
                                                                id="start_date" name="start_date" value=""
                                                                placeholder="DD-MM-YYYY" />
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="end_date">End Date</label>
                                                            <input type="date" class="form-control end_date" required
                                                                id="end_date" name="end_date" value=""
                                                                placeholder="DD-MM-YYYY" />
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
                        <h5 class="card-header">Certificates</h5>
                        <div class="card-body">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-11 mb-3">
                                            <div class="row">
                                                <div class="col-3">
                                                    <input disabled value="Meta Frontend Developer" class="form-control">
                                                </div>
                                                <div class="col-3">
                                                    <input disabled class="form-control" value="Meta" />
                                                </div>
                                                <div class="col-3">
                                                    <input disabled class="form-control" value="01-12-2022" />
                                                </div>
                                                <div class="col-3">
                                                    <input disabled class="form-control" value="01-06-2023" />
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <textarea disabled class="form-control" rows="3">Meta Front End Developer Certificate</textarea>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    Attachment....
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="d-flex">
                                                <button
                                                    class="remove_certificate btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                    id="" type="button">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                            <input type="text" class="form-control institute" required
                                                                id="institute" name="institute" value=""
                                                                placeholder="Institute Name Here..." />
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="certificate_start_date">Start Date</label>
                                                            <input type="date"
                                                                class="form-control certificate_start_date" required
                                                                id="certificate_start_date" name="certificate_start_date"
                                                                value="" placeholder="DD-MM-YYYY" />
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
                                                                name="certificate_attachment" id="certificate_attachment">
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
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-11 mb-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input disabled class="form-control" value="Pic Folio Studio">
                                                </div>
                                                <div class="col-6">
                                                    <input disabled class="form-control" value="Front End Developer" />
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <textarea disabled class="form-control" rows="3">My Final Year Project Pic Folio Studio</textarea>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    Attachment...
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="d-flex">
                                                <button
                                                    class="remove_project btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                                    id="" type="button">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body portfolio_project_repeater">
                                    <div data-repeater-list="project_repeater">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col-11 mb-3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="project_name">Name</label>
                                                            <input type="text" name="project_name" id="project_name"
                                                                class="project_name form-control"
                                                                placeholder="Project Name Here...">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="your_role">Your Role</label>
                                                            <input type="text" class="form-control your_role" required
                                                                id="your_role" name="your_role" value=""
                                                                placeholder="Your Role Here..." />
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
                $(this).slideUp(e)
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
                $(this).slideUp(e)
            }
        });

        $('.portfolio_project_repeater').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                initFilePond($(this).find('.project_attachment').get(0));
            },
            hide: function(e) {
                $(this).slideUp(e)
            }
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
    </script>
@endsection
