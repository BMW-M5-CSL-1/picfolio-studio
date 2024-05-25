@foreach ($distribution->distributerUsers as $row)
    @php
        $data = $row->pivot
            ->where('distribution_id', $distribution->id)
            ->where('user_id', Auth::user()->id)
            ->get();
    @endphp
    {{-- {{ dd($data[0]->status) }} --}}
@endforeach
@if (count($superAdmin) == 0 && $data[0]->status == 'new')
    <a href="#" onclick="confirmOrder({{ $distribution->id }})" class="dropdown-item">
        <i class="ti ti-check"></i> &nbsp;
        Confirm Order
    </a>
@endif



@if (count($superAdmin) == 0 && $data[0]->status == 'confirmed')
    <a href="#" onclick="completeOrder({{ $distribution->id }})" class="dropdown-item">
        <i class="ti ti-checks"></i> &nbsp;
        Complete Order
    </a>
@endif

{{-- @if (count($superAdmin) > 0 && $distribution->status == 'new')
    <a href="#" onclick="confirmOrderForAll({{ $distribution->id }})" class="dropdown-item">
        <i class="ti ti-check"></i> &nbsp;
        Confirm Order
    </a>
@endif

@if (count($superAdmin) > 0 && $distribution->status == 'confirmed')
    <a href="#" onclick="completeOrderForAll({{ $distribution->id }})" class="dropdown-item">
        <i class="ti ti-checks"></i> &nbsp;
        Complete Order
    </a>
@endif --}}

{{-- <a href="#" class="dropdown-item">
    <i class="ti ti-eye"></i> &nbsp;
    Preview
</a> --}}

{{-- @if ($rejectOrder && $order->status != 'created' && $order->status != 'completed' && $order->status != 'rejected')
    <a href="#" onclick="rejectOrder({{ $order->id }})" class="dropdown-item text-danger">
        <i class="ti ti-x"></i> &nbsp;
        Reject Order
    </a>
@endif --}}
