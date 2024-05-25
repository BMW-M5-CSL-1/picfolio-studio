<div class="row mb-2">
    <div class="col-xl-12 col-lg-12">

        @if ($order)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                @if ($order[0]->type == 'vehicle_media')
                    <h3 class="card-header text-uppercase">Routes <small>( {{ $order[0]->order_no }} )</small>
                    </h3>
                    <div class="card-body">
                        <div class="text-center">
                            @foreach ($order as $item)
                                @php
                                    $rows = $item->routes;
                                @endphp
                                @foreach ($rows as $row)
                                    <h5>{{ $row->name }}</h5>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @elseif($order[0]->type == 'paper_media')
                    <h3 class="card-header text-uppercase">Locations <small>( {{ $order[0]->order_no }} )</small>
                    </h3>
                    <div class="card-body">
                        <div class="text-center">
                            @foreach ($order as $item)
                                @php
                                    $rows = $item->locations;
                                @endphp
                                @foreach ($rows as $row)
                                    <h5>{{ $row->name }}</h5>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif

        @if ($design_template)
            {{-- @dd($design_template) --}}
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Design Template <small>( {{ $design_template->order_no }}
                        )</small></h3>
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
                <h3 class="card-header text-uppercase">Client's Attachment <small>( {{ $attachments->order_no }}
                        )</small></h3>
                <div class="card-body">
                    <div class="text-center ">
                        @foreach ($attachments->getMedia('order_attachments') as $attachment)
                            <a href="{{ $attachment->getUrl() }}" target="_blank">
                                <img class="w-100 m-2" src="{{ $attachment->getUrl() }}" alt="User Attachments">
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>

        @endif

        @if ($comments)
            <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <h3 class="card-header text-uppercase">Details <small>( {{ $comments->order_no }} )</small></h3>
                <div class="card-body">
                    <div class="text-center">
                        <h5>
                            {{ $comments['comments'] }}
                        </h5>
                    </div>
                </div>
            </div>
        @endif




    </div>
</div>
