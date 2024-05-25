@if ($prints->status == 'new')
    <a onclick="confirmPrint({{ $prints->id }})" class="dropdown-item" href="javascript:void(0)">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-down" width="24"
            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 20l16 0"></path>
            <path d="M12 14l0 -10"></path>
            <path d="M12 14l4 -4"></path>
            <path d="M12 14l-4 -4"></path>
        </svg> &nbsp;
        In Printing
    </a>
@endif

@if ($prints->status == 'printing')
    <a onclick="completePrint({{ $prints->id }})" class="dropdown-item" href="javascript:void(0)">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M5 12l5 5l10 -10"></path>
        </svg> &nbsp;
        Complete Print
    </a>
@endif

<a href="javascript:void(0)" class="dropdown-item" onclick="preview({{ $prints->id }})">
    <i class="ti ti-eye"></i> &nbsp;
    Preview
</a>

@if (
    $paid_permission &&
        $prints->status != 'rejected' &&
        $prints->payment_status != 'paid')
    <a href="javascript:void(0)" onclick="paid({{ $prints->id }})" class="dropdown-item">
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
        $prints->status != 'rejected' &&
        $prints->payment_status != 'partial_paid' &&
        $prints->payment_status != 'paid')
    <a href="javascript:void(0)" onclick="partial_paid({{ $prints->id }})" class="dropdown-item">
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
