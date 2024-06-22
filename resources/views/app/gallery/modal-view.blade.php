<div class="row mb-2">
    <div class="col-xl-12 col-lg-12">

        @if ($userDetails)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Vehicle User Details <small>(
                        {{ $userDetails->vehicle_media_no }} )</small></h3>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($userDetails->vehicleUsers as $user)
                                    <tr>
                                        <td>
                                            <span class="text-capitalize">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-2">
                                                            <img src="{{ $user->profile_photo_url }}" alt
                                                                class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="text-body text-truncate" href="#">
                                                            <span class="text-capitalize fw-semibold">
                                                                {{ $user->name ?? '-' }}
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </span>
                                        <td>
                                            @if ($user->pivot->status == 'new')
                                                @if ($user->pivot->created_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Creation Date">
                                                        {{ \Carbon\Carbon::parse($user->pivot->created_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    <span class="text-capitalize">user doesn't confirmed</span>
                                                @endif
                                            @elseif ($user->pivot->status == 'confirmed')
                                                @if ($user->pivot->confirmed_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Confirmation Date">
                                                        {{ \Carbon\Carbon::parse($user->pivot->confirmed_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            @elseif ($user->pivot->status == 'completed')
                                                @if ($user->pivot->confirmed_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Completion Date">
                                                        {{ \Carbon\Carbon::parse($user->pivot->confirmed_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            @elseif ($user->pivot->status == 'rejected')
                                                @if ($user->pivot->rejected_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Rejection Date">
                                                        {{ \Carbon\Carbon::parse($user->pivot->rejected_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->pivot->status == 'new')
                                                <span class="badge rounded-pill bg-label-warning me-1 text-capitalize">
                                                    {{ $user->pivot->status }}
                                                </span>
                                            @elseif ($user->pivot->status == 'confirmed')
                                                <span class="badge rounded-pill bg-label-info me-1 text-capitalize">
                                                    {{ $user->pivot->status }}
                                                </span>
                                            @elseif ($user->pivot->status == 'completed')
                                                <span class="badge rounded-pill bg-label-success me-1 text-capitalize">
                                                    {{ $user->pivot->status }}
                                                </span>
                                            @elseif ($user->pivot->status == 'rejected')
                                                <span class="badge rounded-pill bg-label-danger me-1 text-capitalize">
                                                    {{ $user->pivot->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ number_format($user->pivot->amount_to_be_paid) }} Rs./-
                                        </td>
                                        <td>
                                            @if ($user->pivot->payment_status == 'partial_paid')
                                                <span class="badge rounded-pill bg-label-warning me-1 text-capitalize">
                                                    Partial Paid
                                                </span>
                                            @elseif ($user->pivot->payment_status == 'un_paid')
                                                <span class="badge rounded-pill bg-label-danger me-1 text-capitalize">
                                                    Un Paid
                                                </span>
                                            @elseif ($user->pivot->payment_status == 'paid')
                                                <span class="badge rounded-pill bg-label-success me-1 text-capitalize">
                                                    Paid
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @can('vehicle-media.ajax-reject-vehicle')
                                                <button class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                    onclick="reject_vehicle({{ $user->id }}, {{ $userDetails->id }})"
                                                    data-placement="bottom"
                                                    @if ($user->pivot->status == 'rejected' || $user->pivot->status == 'completed') disabled title="Order Completed" @endif
                                                    title="Reject Vehicle User">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            @endcan

                                            @can('vehicle-media.ajax-pay-vehicle')
                                                <button class="btn btn-info btn-xs" data-toggle="tooltip"
                                                    onclick="payVehicle({{ $user->id }}, {{ $userDetails->id }})"
                                                    data-placement="bottom"
                                                    @if ($user->pivot->payment_status == 'paid' || $user->pivot->status == 'new' || $user->pivot->status == 'rejected') disabled title="Already Paid" @endif
                                                    title="Pay Vehicle">
                                                    <i class="ti ti-coin"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div
                    class="card-footer @foreach ($userDetails->vehicleUsers as $user)
                        @if ($user->pivot->status == 'completed') d-none @endif" @endforeach >
                        <div class="text-end">
                    <button class="btn btn-primary" onclick="add_more_vehicles({{ $userDetails->id }})"><i
                            class="ti ti-plus"></i>&nbsp;Add New Vehicle User</button>
                </div>
            </div>
        @endif


        @if ($vehicle_media_details)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Details <small>(
                        {{ $vehicle_media_details['vehicle_media_no'] }}
                        )</small></h3>
                <div class="card-body">
                    <div class="text-center">
                        <h5>
                            {{ is_string($vehicle_media_details['details']) ? $vehicle_media_details['details'] : 'No Data' }}
                        </h5>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
