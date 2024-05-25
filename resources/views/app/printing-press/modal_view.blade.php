<div class="row mb-2">
    <div class="col-xl-12 col-lg-12">
        @if ($design_template)
            {{-- @dd($design_template) --}}
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Design Template <small>(
                        {{ $design_template->printing_press->press_no }} )</small></h3>
                <div class="card-body">
                    <div class="text-center">
                        {{-- {{ $design_template->designs->getMedia }} --}}
                        @foreach ($design_template->designs->getMedia() as $item)
                            <a href="{{ $item->getUrl() }}" target="_blank">
                                <img class="w-100 m-2" src="{{ $item->getUrl() }}" alt="Design Template">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($attachments)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Client's Attachments <small>(
                        {{ $attachments->printing_press->press_no }} )</small></h3>
                <div class="card-body">
                    <div class="text-center">
                        @foreach ($attachments->getMedia('order_attachments') as $attachment)
                            <a href="{{ $attachment->getUrl() }}" target="_blank">
                                <img class="w-100 m-2" src="{{ $attachment->getUrl() }}" alt="User Attachments"><br>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($comments)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Details of print <small>(
                        {{ $comments->press_no }} )</small></h3>
                <div class="card-body">
                    <div class="text-center">
                        <h5>
                            {{ $comments['details'] }}
                        </h5>
                    </div>
                </div>
            </div>
        @endif

        @if ($print)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Assigned To <small>( {{ $print->press_no }}
                        )</small></h3>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>
                                        <span class="text-capitalize">
                                            <div class="d-flex justify-content-left align-items-center">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar avatar-sm me-2">
                                                        <img src="{{ $print->users->profile_photo_url ?? '-' }}" alt
                                                            class="h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a class="text-body text-truncate" href="#">
                                                        <span class="text-capitalize fw-semibold">
                                                            {{ $print->users->name ?? '-' }}
                                                        </span>
                                                    </a>
                                                </div>
                                        </span>
                                    </td>
                                    <td>
                                        @if ($print->status == 'new' && isset($print->created_at))
                                            <span data-toggle="tooltip" data-placement="bottom" title="Creation Date">
                                                {{ \Carbon\Carbon::parse($print->created_at)->toDayDateTimeString() ?? '-' }}
                                            </span>
                                        @elseif ($print->status == 'printing' && isset($print->confirmed_at))
                                            <span data-toggle="tooltip" data-placement="bottom"
                                                title="Confirmation Date">
                                                {{ \Carbon\Carbon::parse($print->confirmed_at)->toDayDateTimeString() ?? '-' }}
                                            </span>
                                        @elseif ($print->status == 'completed' && isset($print->completed_at))
                                            <span data-toggle="tooltip" data-placement="bottom" title="Completion Date">
                                                {{ \Carbon\Carbon::parse($print->completed_at)->toDayDateTimeString() ?? '-' }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($print->status == 'new')
                                            <span class="badge rounded-pill bg-label-warning text-capitalize">New</span>
                                        @elseif ($print->status == 'printing')
                                            <span
                                                class="badge rounded-pill bg-label-info text-capitalize">printing</span>
                                        @elseif ($print->status == 'completed')
                                            <span
                                                class="badge rounded-pill bg-label-success text-capitalize">completed</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($print->printer_id != null)
                                            <button class="btn btn-danger btn-xs" data-toggle="tooltip"
                                                onclick="rejectPrinter({{ $print->id }})"
                                                @if ($print->status == 'completed') @disabled(true) @endif
                                                data-placement="bottom" title="Reject Printer">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer
                        @if ($print->status == 'completed' || $print->printer_id != null) d-none @endif">
                    <div class="text-end">
                        <button class="btn btn-primary" onclick="addNewPrinter({{ $print->id }})"><i
                                class="ti ti-plus"></i>&nbsp;Add New Printer</button>
                    </div>
                </div>
        @endif
    </div>
</div>
