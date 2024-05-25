@foreach ($vehicle_media->vehicleUsers as $row)
    @php
        $data = $row->pivot
            ->where('vehicle_media_id', $vehicle_media->id)
            ->where('user_id', Auth::user()->id)
            ->get();
    @endphp
@endforeach

@if (count($superAdmin) == 0 && $data[0]->status == 'new')
    <a href="javascript:void(0)" onclick="confirm_order({{ $vehicle_media->id }})" class="dropdown-item">
        <i class="ti ti-check"></i> &nbsp;
        Confirm Order
    </a>
@endif

@if (count($superAdmin) == 0 && $data[0]->status == 'confirmed')
    <a href="javascript:void(0)" onclick="complete_order({{ $vehicle_media->id }})" class="dropdown-item">
        <i class="ti ti-checks"></i> &nbsp;
        Complete Order
    </a>
@endif

{{-- @if (count($superAdmin) > 0 && $distribution->status == 'new')
    <a href="javascript:void(0)" onclick="confirmOrderForAll({{ $distribution->id }})" class="dropdown-item">
        <i class="ti ti-check"></i> &nbsp;
        Confirm Order
    </a>
@endif

@if (count($superAdmin) > 0 && $distribution->status == 'confirmed')
    <a href="javascript:void(0)" onclick="completeOrderForAll({{ $distribution->id }})" class="dropdown-item">
        <i class="ti ti-checks"></i> &nbsp;
        Complete Order
    </a>
@endif --}}

{{-- <a href="javascript:void(0)" class="dropdown-item">
    <i class="ti ti-eye"></i> &nbsp;
    Preview
</a> --}}

{{-- @if ($rejectOrder && $order->status != 'created' && $order->status != 'completed' && $order->status != 'rejected')
    <a href="javascript:void(0)" onclick="rejectOrder({{ $order->id }})" class="dropdown-item text-danger">
        <i class="ti ti-x"></i> &nbsp;
        Reject Order
    </a>
@endif --}}
