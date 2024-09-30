@if ($model->status == 'pending' && Auth::user()->can('event.edit'))
    <a href="{{ route('event.edit', ['id' => $model->id]) }}" class="dropdown-item text-body">Edit</a>
@endif

@if ($model->status == 'pending' && Auth::user()->can('event.publish'))
    <a href="javascript:void(0)" onclick="publishEvent({{ $model->id }})" class="dropdown-item text-body">Publish</a>
@endif

@if ($model->status == 'published' && Auth::user()->can('event.raise-offer'))
    <a href="javascript:void(0)" onclick="raiseOffer({{ $model->id }})" class="dropdown-item text-body">Raise Offer</a>
@endif
