@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}">
@endsection

@section('content')

    <div class="row">
        <!-- Welcome Card -->
        <div class="col-4 mb-4">
            <div class="card">
                {{-- <div class="m-1 p-1"> --}}
                <div class="card-header">
                    <h3 class="mb-0" style="color: #7367F0 !important; white-space: break-spaces;"> Welcome to
                        {{ config('app.name') }}
                    </h3>
                </div>
                <div class="card-body">
                    <p class="my-2 fs-5 text-normal" style="">Bringing Success To Your Doorstep <br>
                        Your Business, Our Photo Shoot Excellence</p>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <!--/ Welcome Card -->

        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <small class="d-block mb-1 text-muted">Total Events</small>
                        <p class="card-text text-success">100%</p>
                    </div>
                    <h4 class="card-title mb-1">{{ $totalEvents ?? 0 }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <span class="badge bg-label-success p-1 rounded"><i
                                        class="ti ti-calendar-event ti-xs"></i></span>
                                <p class="mb-0">Completed</p>
                            </div>
                            <h5 class="mb-0 pt-1 text-nowrap text-success">
                                {{ $completedEvents ?? 0 }}
                            </h5>
                            <small class="text-muted">Completed</small>
                        </div>
                        <div class="col-4">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                <p class="mb-0">Pending</p>
                                <span class="badge bg-label-warning p-1 rounded"><i
                                        class="ti ti-calendar-event ti-xs"></i></span>
                            </div>
                            <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0 text-warning">{{ $pendingEvents ?? 0 }}</h5>
                            <small class="text-muted">Pending</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="progress w-100" style="height: 8px;">
                            <div class="progress-bar bg-success"
                                @if (count(Auth::user()->roles->where('slug', 'admin')) > 0) style="width: {{ isset($completedEvents) && isset($pendingEvents) ? ($completedEvents + $pendingEvents > 0 ? ($completedEvents / ($completedEvents + $pendingEvents)) * 100 : 0) : 0 }}%"
                                @else
                                    style="width: 50%" @endif
                                role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            </div>
                            <div class="progress-bar bg-warning"
                                @if (count(Auth::user()->roles->where('slug', 'admin')) > 0) style="width: {{ isset($completedEvents) && isset($pendingEvents) ? ($completedEvents + $pendingEvents > 0 ? ($pendingEvents / ($completedEvents + $pendingEvents)) * 100 : 0) : 0 }}%"
                                @else
                                    style="width: 50%" @endif
                                role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Sales Overview -->
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <small class="d-block mb-1 text-muted">Total Orders</small>
                        <p class="card-text text-success">100%</p>
                    </div>
                    <h4 class="card-title mb-1">{{ $totalOrders ?? 0 }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <span class="badge bg-label-success p-1 rounded"><i
                                        class="ti ti-shopping-cart ti-xs"></i></span>
                                <p class="mb-0">Completed</p>
                            </div>
                            <h5 class="mb-0 pt-1 text-nowrap text-success">
                                {{ $completedOrders ?? 0 }}
                            </h5>
                            <small class="text-muted">Completed</small>
                        </div>
                        <div class="col-4">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                <p class="mb-0">Pending</p>
                                <span class="badge bg-label-warning p-1 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-shopping-cart-exclamation" width="20"
                                        height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M15 17h-9v-14h-2" />
                                        <path d="M6 5l14 1l-.854 5.976m-2.646 1.024h-10.5" />
                                        <path d="M19 16v3" />
                                        <path d="M19 22v.01" />
                                    </svg>
                                </span>
                            </div>
                            <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0 text-warning">{{ $pendingOrders ?? 0 }}</h5>
                            <small class="text-muted">Pending</small>
                        </div>
                    </div>
                    {{-- <div class="d-flex align-items-center mt-4">
                        <div class="progress w-100" style="height: 8px;">
                            <div class="progress-bar bg-success" @if (count(Auth::user()->roles->where('slug', 'admin')) > 0)
                                style="width: {{ isset($completed_orders) ? ($completed_orders < 10 ? $completed_orders * 10 : $completed_orders) : 0 }}%"
                                @else style="width: 50%"
                                @endif role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" @if (count(Auth::user()->roles->where('slug', 'admin')) > 0) style="width: {{ isset($pending_orders) ? ($pending_orders < 10 ? $pending_orders * 10 : $pending_orders) : 0 }}%"
                                @else
                                style="width: 50%" @endif aria-valuenow="30" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div> --}}

                    <div class="d-flex align-items-center mt-4">
                        <div class="progress w-100" style="height: 8px;">
                            <div class="progress-bar bg-success"
                                @if (count(Auth::user()->roles->where('slug', 'admin')) > 0) style="width: {{ isset($completedOrders) && isset($pendingOrders) ? ($completedOrders + $pendingOrders > 0 ? ($completedOrders / ($completedOrders + $pendingOrders)) * 100 : 0) : 0 }}%"
                                @else
                                    style="width: 50%" @endif
                                role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            </div>
                            <div class="progress-bar bg-warning"
                                @if (count(Auth::user()->roles->where('slug', 'admin')) > 0) style="width: {{ isset($completedOrders) && isset($pendingOrders) ? ($completedOrders + $pendingOrders > 0 ? ($pendingOrders / ($completedOrders + $pendingOrders)) * 100 : 0) : 0 }}%"
                                @else
                                    style="width: 50%" @endif
                                role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--/ Sales Overview -->

        <!-- Revenue Generated -->
        <div class="col-lg-2 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="card-icon">
                        <span class="badge bg-label-success rounded-pill p-2">
                            <i class='ti ti-credit-card ti-sm'></i>
                        </span>
                    </div>
                    <h5 class="card-title mb-0 mt-2">Rs. {{ $revenue ?? 0 }}/-</h5>
                    <small>{{ $admin ? 'Revenue' : 'Expense' }}</small>
                </div>
                <div id="revenueGenerated"></div>
            </div>
        </div>
        <!--/ Revenue Generated -->

        {{-- For Event --}}
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Event Statistics</h5>
                        {{-- <small class="text-muted">Spending on various categories</small> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div id="donutChartVehicleMedia"></div>
                </div>
            </div>
        </div>

        {{-- For Order --}}
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Order Statistics</h5>
                        {{-- <small class="text-muted">Spending on various categories</small> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div id="donutChartOrder"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/charts-apex.js') }}"></script> --}}

    @include('app.dashboard.chart-scripts')

@endsection
