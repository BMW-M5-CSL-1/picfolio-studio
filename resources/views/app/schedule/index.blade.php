@extends('layouts/layoutMaster')

@section('title', 'Schedule')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
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
                {{-- <h2 class="content-header-title float-start mb-0">Bookings</h2> --}}
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('schedule.index') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-action mb-4">
        <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Schedule</h5>
        </div>
        <div class="card-body pb-0">
            <ul class="timeline ms-1 mb-0">

                @forelse ($events as $event)
                    @php
                        $status_class = '';
                        $tooltip = 'Event Status: ';
                        switch ($event->status) {
                            case 'published':
                                $status_class = 'secondary';
                                $tooltip .= 'Published';
                                break;
                            case 'pending':
                                $status_class = 'warning';
                                $tooltip .= 'Pending';
                                break;
                            case 'in_process':
                                $status_class = 'primary';
                                $tooltip .= 'In Process';
                                break;
                            case 'locked':
                                $status_class = 'info';
                                $tooltip .= 'Locked';
                                break;
                            case 'closed':
                                $status_class = 'success';
                                $tooltip .= 'Closed';
                                break;
                            case 'cancelled':
                                $status_class = 'danger';
                                $tooltip .= 'Cancelled';
                                break;
                            default:
                                break;
                        }
                    @endphp

                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-{{ $status_class }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="{{ $tooltip }}"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">{{ ucwords(str_replace('_', ' ', $event->title)) }}</h6>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($event->start_date)->format('d M, Y') }}</small>
                            </div>
                            <p class="mb-2">
                                Event Time is
                                <b>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M, Y h:i A') }} to
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('d M, Y h:i A') }}
                                </b>
                            </p>
                            <div class="d-flex flex-wrap">
                                <div class="ms-1">
                                    {{-- <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                    <span>CEO of Infibeam</span> --}}
                                    <ul>
                                        @foreach ($event->eventPhotographers->where('status', 'hired') as $offer)
                                            @if ($admin_role)
                                                <li>
                                                    Organiser: <b>{{ $event->user->name ?? '-' }}
                                                        ({{ $event->user->email ?? '-' }})
                                                    </b>
                                                </li>
                                                <li>
                                                    Photographer: <b>{{ $offer->photographer->name ?? '-' }}
                                                        ({{ $offer->photographer->email ?? '-' }})</b>
                                                    <span
                                                        class="badge rounded-pill bg-label-success text-capitalize">hired</span>
                                                </li>
                                            @elseif ($photographer_role)
                                                <li>
                                                    Organiser: <b>{{ $event->user->name ?? '-' }}
                                                        ({{ $event->user->email ?? '-' }})</b>
                                                </li>
                                            @else
                                                <li>
                                                    Photographer: <b>{{ $offer->photographer->name ?? '-' }}
                                                        ({{ $offer->photographer->email ?? '-' }})</b>
                                                    <span
                                                        class="badge rounded-pill bg-label-success text-capitalize">hired</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">No Event Yet</h6>
                            </div>
                        </div>
                    </li>
                @endforelse

            </ul>
        </div>
    </div>

    {{-- Modal for Details --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-enable-otp modal-dialog-centered" style="max-width: 90%;">
            <div class="modal-content p-0">
                <div class="modal-header bg-transparent">
                    <button id="close_modal" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body pb-3 px-sm-3 pt-30" id="modalBody">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
@endsection
