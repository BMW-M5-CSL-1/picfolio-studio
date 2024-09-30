@switch($query_for)
    @case('offer_list')
        <h3 >Offer Details</h3>
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
                            <td>{{ $offer->photographer->name ?? '-' }}</td>
                            <td>{{ $offer->offer ?? '' }}/- Rs .</td>
                            <td>
                                @switch($offer->status)
                                    @case('hired')
                                        <span class="badge rounded-pill bg-label-success text-capitalize">hired</span>
                                    @break

                                    @case('pending')
                                        <span class="badge rounded-pill bg-label-warning text-capitalize">pending</span>
                                    @break

                                    @case('cancelled')
                                        <span class="badge rounded-pill bg-label-danger text-capitalize">cancelled</span>
                                    @break

                                    @default
                                @endswitch

                            </td>
                            <td>
                                @if ($offer->status == 'pending')
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Hire Photographer"><i class="ti ti-plus"></i></a>
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
