@if ($model->status != 'cancelled')
    @if ($model->status == 'pending' && Auth::user()->can('event.edit'))
        <a href="{{ route('event.edit', ['id' => $model->id]) }}" class="dropdown-item text-body">Edit</a>
    @endif

    @if ($model->status == 'pending' && Auth::user()->can('event.publish'))
        <a href="javascript:void(0)" onclick="publishEvent({{ $model->id }})"
            class="dropdown-item text-body">Publish</a>
    @endif

    @if (
        $model->status == 'published' &&
            Auth::user()->can('event.raise-offer') &&
            !$model->eventPhotographers()->where('photographer_id', Auth::id())->exists())
        <a href="javascript:void(0)" onclick="raiseOffer({{ $model->id }})" class="dropdown-item text-body">Raise
            Offer</a>
    @endif

    @if (in_array($model->status, ['published', 'in_process']) &&
            Auth::user()->can('event.lock') &&
            $model->eventPhotographers()->where('status', 'hired')->count() > 0)
        <a href="javascript:void(0)" onclick="lockEvent({{ $model->id }})" class="dropdown-item text-body">Lock
            Event</a>
    @endif

    @if ($model->status == 'locked' && Auth::user()->can('event.close'))
        <a href="javascript:void(0)" onclick="closeEvent({{ $model->id }})" class="dropdown-item text-body">Close
            Event</a>
    @endif

    @if ($model->status != 'closed' && Auth::user()->can('event.cancel'))
        <a href="javascript:void(0)" onclick="cancelEvent({{ $model->id }})" class="dropdown-item text-body">Cancel
            Event</a>
    @endif
@endif
