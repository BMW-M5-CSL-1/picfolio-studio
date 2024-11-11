@if ($model->status == 'pending')
    <a href="javascript:void(0)" onclick="makePayment({{ $model->id }})" class="dropdown-item">
        <i class="ti ti-currency-real"></i> &nbsp;
        Pay
    </a>
@endif

@if ($model->status == 'paid')
    <a href="javascript:void(0)" onclick="review({{ $model->id }})" class="dropdown-item">
        <i class="ti ti-star"></i> &nbsp;
        Add Reviews
    </a>
@endif

@if ($model->status != 'paid' && $model->status != 'cancelled')
    <a href="javascript:void(0)" onclick="rejectOrder({{ $model->id }})" class="dropdown-item text-danger">
        <i class="ti ti-x"></i> &nbsp;
        Cancel Order
    </a>
@endif
