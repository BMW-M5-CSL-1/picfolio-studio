@extends('layouts/layoutMaster')

@section('title', 'Profile')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-user-view.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                {{-- <h2 class="content-header-title float-start mb-0">Profile</h2> --}}
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('profile.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ Auth::user()->name ?? '-' }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item">
                                        <i class='ti ti-shield-lock'></i>
                                        @foreach (Auth::user()->roles as $role)
                                            {{ $role->name }}
                                            {{ !($loop->first || $loop->last) ? ',' : null }}
                                        @endforeach
                                    </li>
                                    @if (Auth::user()->country)
                                        <li class="list-inline-item">
                                            <i class='ti ti-map-pin'></i> {{ Auth::user()->country }}
                                        </li>
                                    @endif
                                    @if (Auth::user()->dob)
                                        <li class="list-inline-item">
                                            <i class='ti ti-calendar'></i> {{ Auth::user()->dob }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <a href="{{ route('profile.edit', ['id' => Auth::id()]) }}" class="btn btn-primary">
                                <i class='ti ti-user-check me-1'></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-user"></i><span class="fw-bold mx-2">Full
                                Name:</span> <span>{{ Auth::user()->name ?? '-' }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span
                                class="fw-bold mx-2">Status:</span> <span>Active</span></li>
                        <li class="d-block align-items-center mb-3"><i class="ti ti-shield-lock"></i><span
                                class="fw-bold mx-2">Role:</span>
                            <ul>
                                @foreach (Auth::user()->roles as $role)
                                    <li>
                                        {{ $role->name }}
                                        {{ !($loop->first || $loop->last) ? ',' : null }}
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-flag"></i><span
                                class="fw-bold mx-2">Country:</span> <span>{{ Auth::user()->country }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-file-description"></i><span
                                class="fw-bold mx-2">Languages:</span> <span>English</span></li>
                    </ul>
                    <small class="card-text text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span
                                class="fw-bold mx-2">Contact:</span> <span>(123) 456-7890</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-mail"></i><span
                                class="fw-bold mx-2">Email:</span> <span>{{ Auth::user()->email ?? '-' }}</span></li>
                    </ul>
                    {{-- <small class="card-text text-uppercase">Teams</small>
                    <ul class="list-unstyled mb-0 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-brand-angular text-danger me-2"></i>
                            <div class="d-flex flex-wrap"><span class="fw-bold me-2">Backend Developer</span><span>(126
                                    Members)</span></div>
                        </li>
                        <li class="d-flex align-items-center"><i class="ti ti-brand-react-native text-info me-2"></i>
                            <div class="d-flex flex-wrap"><span class="fw-bold me-2">React Developer</span><span>(98
                                    Members)</span></div>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <!--/ About User -->
            <!-- Profile Overview -->
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text text-uppercase">Overview</p>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span
                                class="fw-bold mx-2">Total Projects:</span> <span>13.5k</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-layout-grid"></i><span
                                class="fw-bold mx-2">Completed Projects:</span> <span>146</span></li>
                        <li class="d-flex align-items-center"><i class="ti ti-users"></i><span class="fw-bold mx-2">Pending
                                Projects:</span> <span>11</span></li>
                    </ul>
                </div>
            </div>
            <!--/ Profile Overview -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Projects table -->
            <div class="card mb-4">
                <div class="card-datatable table-responsive">
                    <table class="datatables-projects table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Name</th>
                                <th>Leader</th>
                                <th>Team</th>
                                <th class="w-px-200">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/ Projects table -->
        </div>
    </div>
    <!--/ User Profile Content -->
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-profile.js') }}"></script>
@endsection
