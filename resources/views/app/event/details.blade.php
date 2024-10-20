@switch($query_for)
    @case('offer_list')
        <h3>Offer Details</h3>
        <div class="table-responsive table-bordered">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Sr. #</th>
                        <th scope="col">Photographer</th>
                        <th scope="col">Offer</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $offer)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('profile.index', ['id' => $offer->photographer_id, 'only_view' => true]) }}" target="_blank">
                                    {{ $offer->photographer->name ?? '-' }}
                                </a>
                            </td>
                            <td>{{ $offer->offer ?? '' }}/- Rs .</td>
                            <td>
                                @switch($offer->status)
                                    @case('hired')
                                        <span class="badge rounded-pill bg-label-success text-capitalize">hired</span>
                                    @break

                                    @case('applied')
                                        <span class="badge rounded-pill bg-label-warning text-capitalize">applied</span>
                                    @break

                                    @case('cancelled')
                                        <span class="badge rounded-pill bg-label-danger text-capitalize">cancelled</span>
                                    @break

                                    @default
                                @endswitch

                            </td>
                            <td>
                                @if (
                                    $offer->status == 'applied' &&
                                        $event->eventPhotographers()->where('status', 'hired')->count() < $event->required_photographers)
                                    <a href="javascript:void(0)"
                                        onclick="hirePhotographer({{ $offer->event_id }}, {{ $offer->photographer_id }}, '{{ $offer->photographer->name }}', {{ $offer->offer ?? 0 }})"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hire Photographer"><i
                                            class="ti ti-plus"></i></a>
                                @endif

                                @if (
                                    !in_array($event->status, ['cancelled', 'locked', 'closed']) &&
                                        !in_array($offer->status, ['hired', 'cancelled']) &&
                                        $event->eventPhotographers()->where('status', 'hired')->count() <= $event->required_photographers)
                                    <a href="javascript:void(0)" class="text-danger"
                                        onclick="cancelPhotographer({{ $offer->event_id }}, {{ $offer->photographer_id }}, '{{ $offer->photographer->name }}', {{ $offer->offer ?? 0 }})"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancel Photographer"><i
                                            class="ti ti-x"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @break

        @default
    @endswitch
