@if ($confirmOrder && ($order->status == 'created' || $order->status == 'edited'))
    <a href="javascript:void(0)" onclick="confirmOrder({{ $order->id }})" class="dropdown-item">
        <i class="ti ti-check"></i> &nbsp;
        Confirm Order
    </a>
@endif

@if (
    $paid_permission &&
        $order->status != 'edited' &&
        $order->status != 'created' &&
        $order->status != 'completed' &&
        $order->status != 'rejected' &&
        $order->payment_status != 'paid')
    <a href="javascript:void(0)" onclick="paid({{ $order->id }})" class="dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
            <path d="M12 7v10" />
        </svg>&nbsp;
        Paid
    </a>
@endif

@if (
    $partial_paid_permission &&
        $order->status != 'edited' &&
        $order->status != 'created' &&
        $order->status != 'completed' &&
        $order->status != 'rejected' &&
        $order->payment_status != 'partial_paid' &&
        $order->payment_status != 'paid')
    <a href="javascript:void(0)" onclick="partial_paid({{ $order->id }})" class="dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
            <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
            <path
                d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
            <path d="M3 6v10c0 .888 .772 1.45 2 2" />
            <path d="M3 11c0 .888 .772 1.45 2 2" />
        </svg>
        &nbsp;
        Partial Paid
    </a>
@endif

@if ($printOrder && $order->status == 'confirmed' && $order->payment_status != 'un_paid')
    <a href="javascript:void(0)" onclick="printOrder({{ $order->id }})" class="dropdown-item">
        <i class="ti ti-printer"></i> &nbsp;
        Print Order
    </a>
@endif

@if (
    $distributeOrder &&
        $order->type == 'paper_media' &&
        $order->status == 'printed' &&
        $order->payment_status == 'paid')
    <a href="javascript:void(0)" onclick="distributeOrder({{ $order->id }})" class="dropdown-item">
        <i class="ti ti-printer"></i> &nbsp;
        Distribute Order
    </a>
@endif

@if ($completeOrder && $order->status == 'distributed' && $order->payment_status == 'paid')
    <a href="javascript:void(0)" onclick="completeOrder({{ $order->id }})" class="dropdown-item">
        <i class="ti ti-checks"></i> &nbsp;
        Complete Order
    </a>
@endif

@if ($order->type == 'vehicle_media' && $order->status == 'printed' && $order->payment_status == 'paid')
    <a href="javascript:void(0)" onclick="pasteOnVehicle({{ $order->id }})" class="dropdown-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layers-intersect" width="24"
            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
            <path d="M4 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
        </svg>
        &nbsp;
        Paste on Vehicle
    </a>
@endif

@if ($edit_permission && ($order->status == 'created' || $order->status == 'edited'))
    <a href="javascript:void(0)" onclick="edit_order({{ $order->id }})" class="dropdown-item">
        <i class="ti ti-edit"></i> &nbsp;
        Edit
    </a>
@endif

@if ($preview_permission)
    <a href="javascript:void(0)" onclick="preview_order({{ $order->id }})" class="dropdown-item">
        <i class="ti ti-eye"></i> &nbsp;
        Preview
    </a>
@endif

@if ($rejectOrder || $destroy_permission)
    <hr>

    @if (
        $rejectOrder &&
            $order->status != 'created' &&
            $order->status != 'distributed' &&
            $order->status != 'completed' &&
            $order->status != 'rejected')
        <a href="javascript:void(0)" onclick="rejectOrder({{ $order->id }})" class="dropdown-item text-danger">
            <i class="ti ti-x"></i> &nbsp;
            Reject Order
        </a>
    @endif

    @if ($destroy_permission && ($order->status == 'created' || $order->status == 'edited'))
        <a href="javascript:void(0)" onclick="destroy_order({{ $order->id }})" class="dropdown-item text-danger">
            <i class="ti ti-trash"></i> &nbsp;
            Delete
        </a>
    @endif
@endif
