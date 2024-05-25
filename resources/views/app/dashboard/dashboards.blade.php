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
        <div class="col-lg-6 mb-4">
            <div class="card">
                {{-- <div class="m-1 p-1"> --}}
                <div class="card-header">
                    <h3 class="mb-0" style="color: #7367F0 !important; white-space: break-spaces;"> Welcome to
                        {{ config('app.name') }}
                    </h3>
                </div>
                <div class="card-body">
                    <p class="my-2 fs-5 text-normal" style="white-space: break-spaces;">Bringing Success To Your Doorstep
                        Your Business, Our Photo Shoot Excellence</p>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <!--/ Welcome Card -->

        <!-- Sales Overview -->
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <small class="d-block mb-1 text-muted">Total Orders</small>
                        <p class="card-text text-success">100%</p>
                    </div>
                    <h4 class="card-title mb-1">{{ $total_orders ?? 0 }}</h4>
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
                                
                                    0
                                
                            </h5>
                            <small class="text-muted">Delivered</small>
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
                            <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0 text-warning">
                               
                                    0
                            </h5>
                            <small class="text-muted">In Process</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="progress w-100" style="height: 8px;">
                            <div class="progress-bar bg-success" {{-- @if (count(Auth::user()->roles->where('slug', 'super_admin')) > 0)
                                style="width: {{ isset($completed_orders) ? ($completed_orders < 10 ? $completed_orders * 10 : $completed_orders) : 0 }}%"
                                @else --}}
                                style="width: 50%"
                                {{-- @endif --}} role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" {{-- @if (count(Auth::user()->roles->where('slug', 'super_admin')) > 0) style="width: {{ isset($pending_orders) ? ($pending_orders < 10 ? $pending_orders * 10 : $pending_orders) : 0 }}%"
                                @else --}}
                                style="width: 50%"
                                {{-- @endif --}} aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Sales Overview -->

        <!-- Revenue Generated -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="card-icon">
                        <span class="badge bg-label-success rounded-pill p-2">
                            <i class='ti ti-credit-card ti-sm'></i>
                        </span>
                    </div>
                    <h5 class="card-title mb-0 mt-2">Rs. 10000/-</h5>
                    <small>{{ count(Auth::user()->roles->where('slug', 'user')) > 0 ? 'Total Expense' : 'Revenue Generated' }}</small>
                </div>
                <div id="revenueGenerated"></div>
            </div>
        </div>
        <!--/ Revenue Generated -->

        <!-- Radial bar Chart -->
        {{-- <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Overall Statistics</h5>
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle p-0" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="ti ti-calendar"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>
                            </li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                    Days</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30
                                    Days</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current
                                    Month</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                    Month</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div id="radialBarChart"></div>
                </div>
            </div>
        </div> --}}
        <!-- /Radial bar Chart -->

        {{-- For Order --}}
        @canany(['orders.index', 'orders.create', 'orders.edit', 'orders.update', 'orders.store'])
            <!-- Order Donut Chart -->
            <div class="col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">Order Statistics</h5>
                            {{-- <small class="text-muted">Spending on various categories</small> --}}
                        </div>
                        {{-- <div class="dropdown d-none d-sm-flex">
                    <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="ti ti-calendar"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                        </li>
                        <li><a href="javascript:void(0);"
                                class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                Days</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30
                                Days</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current
                                Month</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                Month</a></li>
                    </ul>
                </div> --}}
                    </div>
                    <div class="card-body">
                        <div id="donutChartOrder"></div>
                    </div>
                </div>
            </div>
            <!-- /Order Donut Chart -->

            <!-- Order Payment Tracker -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="mb-0">Payments</h5>
                            <small class="text-muted">Orders Payment Statistics.</small>
                        </div>
                        {{-- <div class="dropdown">
                        <button class="btn p-0" type="button" id="supportTrackerMenu" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                    <h1 class="mb-0">{{ $total_orders ?? 0 }}</h1>
                                    <p class="mb-0">Total Orders</p>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                        <div class="badge rounded bg-label-success p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                                <path d="M12 7v10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Paid Orders</h6>
                                            <small class="text-muted">{{ $paid_orders ?? 0 }}</small>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                        <div class="badge rounded bg-label-warning p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                                <path
                                                    d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                                <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                                <path d="M3 11c0 .888 .772 1.45 2 2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Partial Paid Orders</h6>
                                            <small class="text-muted">{{ $partial_paid_orders ?? 0 }}</small>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center pb-1">
                                        <div class="badge rounded bg-label-danger p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-coin-off" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-1m-2.82 1.171a2 2 0 0 0 1.82 2.829h1m2.824 2.822a2 2 0 0 1 -1.824 1.178h-2a2 2 0 0 1 -1.8 -1" />
                                                <path
                                                    d="M20.042 16.045a9 9 0 0 0 -12.087 -12.087m-2.318 1.677a9 9 0 1 0 12.725 12.73" />
                                                <path d="M12 6v2m0 8v2" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Un Paid Orders</h6>
                                            <small class="text-muted">{{ $un_paid_orders ?? 0 }}</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                <div id="orderPaymentTracker"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Order Payment Tracker -->
        @endcanany

        {{-- For Printing --}}
        @canany(['printing-press.index', 'printing-press.ajax-paid-order', 'printing-press.ajax-partial-paid-order'])
            <!-- Printing Donut Chart -->
            <div class="col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">Printing Press Statistics</h5>
                            {{-- <small class="text-muted">Spending on various categories</small> --}}
                        </div>
                        {{-- <div class="dropdown d-none d-sm-flex">
                <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="ti ti-calendar"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                    </li>
                    <li><a href="javascript:void(0);"
                            class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                            Days</a></li>
                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30
                            Days</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current
                            Month</a></li>
                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                            Month</a></li>
                </ul>
            </div> --}}
                    </div>
                    <div class="card-body">
                        <div id="donutChartPrinting"></div>
                    </div>
                </div>
            </div>
            <!-- /Printing Donut Chart -->

            <!-- Printing Payment Tracker -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="mb-0">Payments</h5>
                            <small class="text-muted">Printing Press Payment Statistics.</small>
                        </div>
                        {{-- <div class="dropdown">
                    <button class="btn p-0" type="button" id="supportTrackerMenu" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                    <h1 class="mb-0">{{ $total_prints ?? 0 }}</h1>
                                    <p class="mb-0">Total Prints</p>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                        <div class="badge rounded bg-label-success p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                                <path d="M12 7v10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Paid Prints</h6>
                                            <small class="text-muted">{{ $paid_prints ?? 0 }}</small>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                        <div class="badge rounded bg-label-warning p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                                <path
                                                    d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                                <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                                <path d="M3 11c0 .888 .772 1.45 2 2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Partial Paid Prints</h6>
                                            <small class="text-muted">{{ $partial_paid_prints ?? 0 }}</small>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center pb-1">
                                        <div class="badge rounded bg-label-danger p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-coin-off" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-1m-2.82 1.171a2 2 0 0 0 1.82 2.829h1m2.824 2.822a2 2 0 0 1 -1.824 1.178h-2a2 2 0 0 1 -1.8 -1" />
                                                <path
                                                    d="M20.042 16.045a9 9 0 0 0 -12.087 -12.087m-2.318 1.677a9 9 0 1 0 12.725 12.73" />
                                                <path d="M12 6v2m0 8v2" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Un Paid Prints</h6>
                                            <small class="text-muted">{{ $un_paid_prints ?? 0 }}</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                <div id="printingPaymentTracker"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Printing Payment Tracker -->
        @endcanany

        {{-- For Distribution --}}
        @canany(['distributor.index'])
            <!-- Distribution Donut Chart -->
            <div class="col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">Distribution Statistics</h5>
                            {{-- <small class="text-muted">Spending on various categories</small> --}}
                        </div>
                        {{-- <div class="dropdown d-none d-sm-flex">
                            <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="ti ti-calendar"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                                </li>
                                <li><a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                        Days</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30
                                        Days</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current
                                        Month</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                        Month</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div id="donutChartDistribution"></div>
                    </div>
                </div>
            </div>
            <!-- /Distribution Donut Chart -->

            <!-- Distribution Payment Tracker -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="mb-0">Payments</h5>
                            <small class="text-muted">Distribution Payment Statistics.</small>
                        </div>
                        {{-- <div class="dropdown">
                    <button class="btn p-0" type="button" id="supportTrackerMenu" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div> --}}
                    </div>
                    <div class="card-body mb-4">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                    <h1 class="mb-0">{{ $total_distributions ?? 0 }}</h1>
                                    <p class="mb-0">Total Distributions</p>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                        <div class="badge rounded bg-label-success p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                                <path d="M12 7v10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Paid Distribution</h6>
                                            <small class="text-muted">{{ $paid_distributions ?? 0 }}</small>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center pb-1">
                                        <div class="badge rounded bg-label-danger p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-coin-off" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-1m-2.82 1.171a2 2 0 0 0 1.82 2.829h1m2.824 2.822a2 2 0 0 1 -1.824 1.178h-2a2 2 0 0 1 -1.8 -1" />
                                                <path
                                                    d="M20.042 16.045a9 9 0 0 0 -12.087 -12.087m-2.318 1.677a9 9 0 1 0 12.725 12.73" />
                                                <path d="M12 6v2m0 8v2" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Un Paid Distribution</h6>
                                            <small class="text-muted">{{ $un_paid_distributions ?? 0 }}</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                <div id="distributionPaymentTracker"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Distribution Payment Tracker -->
        @endcanany

        {{-- For Vehicle Media --}}
        @canany(['vehicle-media.index'])
            <!-- Vehicle Media Donut Chart -->
            <div class="col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">Vehicle Media Statistics</h5>
                            {{-- <small class="text-muted">Spending on various categories</small> --}}
                        </div>
                        {{-- <div class="dropdown d-none d-sm-flex">
                            <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="ti ti-calendar"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                                </li>
                                <li><a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                        Days</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30
                                        Days</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current
                                        Month</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                        Month</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div id="donutChartVehicleMedia"></div>
                    </div>
                </div>
            </div>
            <!-- /Vehicle Media Donut Chart -->

            <!-- Vehicle Media Payment Tracker -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="mb-0">Payments</h5>
                            <small class="text-muted">Vehicle Media Payment Statistics.</small>
                        </div>
                        {{-- <div class="dropdown">
                    <button class="btn p-0" type="button" id="supportTrackerMenu" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div> --}}
                    </div>
                    <div class="card-body mb-4">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                    <h1 class="mb-0">{{ $total_vm_orders ?? 0 }}</h1>
                                    <p class="mb-0">Total Vehicle Media Orders</p>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                        <div class="badge rounded bg-label-success p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                                <path d="M12 7v10" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Paid Vehicles</h6>
                                            <small class="text-muted">{{ $paid_vm_orders ?? 0 }}</small>
                                        </div>
                                    </li>
                                    {{-- <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                        <div class="badge rounded bg-label-warning p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                                <path
                                                    d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                                <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                                <path d="M3 11c0 .888 .772 1.45 2 2" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Partial Paid Vehicle</h6>
                                            <small class="text-muted">{{ $partial_paid_prints ?? 0 }}</small>
                                        </div>
                                    </li> --}}
                                    <li class="d-flex gap-3 align-items-center pb-1">
                                        <div class="badge rounded bg-label-danger p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-coin-off" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M14.8 9a2 2 0 0 0 -1.8 -1h-1m-2.82 1.171a2 2 0 0 0 1.82 2.829h1m2.824 2.822a2 2 0 0 1 -1.824 1.178h-2a2 2 0 0 1 -1.8 -1" />
                                                <path
                                                    d="M20.042 16.045a9 9 0 0 0 -12.087 -12.087m-2.318 1.677a9 9 0 1 0 12.725 12.73" />
                                                <path d="M12 6v2m0 8v2" />
                                                <path d="M3 3l18 18" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Un Paid Vehicles</h6>
                                            <small class="text-muted">{{ $un_paid_vm_orders ?? 0 }}</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                <div id="vehicleMediaPaymentTracker"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Vehicle Media Payment Tracker -->
        @endcanany

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
