<div class="row mb-2">
    <div class="col-xl-12 col-lg-12">

        @if ($distributorDetails)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Distributor Details <small>(
                        {{ $distributorDetails->distribution_no }} )</small></h3>
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
                                @foreach ($distributorDetails->distributerUsers as $distributor)
                                    <tr>
                                        <td>
                                            <span class="text-capitalize">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-2">
                                                            <img src="{{ $distributor->profile_photo_url }}" alt
                                                                class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a class="text-body text-truncate" href="#">
                                                            <span class="text-capitalize fw-semibold">
                                                                {{ $distributor->name ?? '-' }}
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </span>
                                        <td>
                                            @if ($distributor->pivot->status == 'new')
                                                @if ($distributor->pivot->created_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Creation Date">
                                                        {{ \Carbon\Carbon::parse($distributor->pivot->created_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    <span class="text-capitalize">Distributor doesn't confirmed</span>
                                                @endif
                                            @elseif ($distributor->pivot->status == 'confirmed')
                                                @if ($distributor->pivot->confirmed_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Confirmation Date">
                                                        {{ \Carbon\Carbon::parse($distributor->pivot->confirmed_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            @elseif ($distributor->pivot->status == 'completed')
                                                @if ($distributor->pivot->confirmed_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Completion Date">
                                                        {{ \Carbon\Carbon::parse($distributor->pivot->confirmed_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            @elseif ($distributor->pivot->status == 'rejected')
                                                @if ($distributor->pivot->rejected_at != null)
                                                    <span data-toggle="tooltip" data-placement="bottom"
                                                        title="Rejection Date">
                                                        {{ \Carbon\Carbon::parse($distributor->pivot->rejected_at)->toDayDateTimeString() }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($distributor->pivot->status == 'new')
                                                <span class="badge rounded-pill bg-label-warning me-1 text-capitalize">
                                                    {{ $distributor->pivot->status }}
                                                </span>
                                            @elseif ($distributor->pivot->status == 'confirmed')
                                                <span class="badge rounded-pill bg-label-info me-1 text-capitalize">
                                                    {{ $distributor->pivot->status }}
                                                </span>
                                            @elseif ($distributor->pivot->status == 'completed')
                                                <span class="badge rounded-pill bg-label-success me-1 text-capitalize">
                                                    {{ $distributor->pivot->status }}
                                                </span>
                                            @elseif ($distributor->pivot->status == 'rejected')
                                                <span class="badge rounded-pill bg-label-danger me-1 text-capitalize">
                                                    {{ $distributor->pivot->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ number_format($distributor->pivot->amount_to_be_paid) }} Rs./-
                                        </td>
                                        <td>
                                            @if ($distributor->pivot->payment_status == 'un_paid')
                                                <span class="badge rounded-pill bg-label-danger me-1 text-capitalize">
                                                    Un Paid
                                                </span>
                                            @elseif ($distributor->pivot->payment_status == 'paid')
                                                <span class="badge rounded-pill bg-label-success me-1 text-capitalize">
                                                    Paid
                                                </span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @can('distributor.ajax-reject-distributor')
                                                <button class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                    onclick="rejectDistributor({{ $distributor->id }}, {{ $distributorDetails->id }})"
                                                    data-placement="bottom"
                                                    @if ($distributor->pivot->status == 'rejected' || $distributor->pivot->status == 'completed') disabled title="Order Completed" @endif
                                                    title="Reject Distributor">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            @endcan

                                            @can('distributor.ajax-pay-distributor')
                                                <button class="btn btn-info btn-xs" data-toggle="tooltip"
                                                    onclick="payDistributor({{ $distributor->id }}, {{ $distributorDetails->id }})"
                                                    data-placement="bottom"
                                                    @if (
                                                        $distributor->pivot->payment_status == 'paid' ||
                                                            $distributor->pivot->status == 'new' ||
                                                            $distributor->pivot->status == 'rejected') disabled title="Already Paid" @endif
                                                    title="Pay Distributor">
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
                    class="card-footer @foreach ($distributorDetails->distributerUsers as $distributor)
                        @if ($distributor->pivot->status == 'completed') d-none @endif" @endforeach >
                        <div class="text-end">
                    <button class="btn btn-primary" onclick="addMoreDistributors({{ $distributorDetails->id }})"><i
                            class="ti ti-plus"></i>&nbsp;Add New Distributor</button>
                </div>
            </div>

        @endif

        @if ($comments)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Details <small>( {{ $comments['distribution_no'] }} )</small>
                </h3>
                <div class="card-body">
                    <div class="text-center">
                        <h5>
                            {{ is_string($comments['details']) ? $comments['details'] : 'No Data' }}
                        </h5>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
