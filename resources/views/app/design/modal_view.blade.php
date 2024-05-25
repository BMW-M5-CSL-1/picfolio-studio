<div class="row mb-2">
    <div class="col-xl-12 col-lg-12">
        <div class="card" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
            <h5 class="card-header">Design Template</h5>
            <div class="card-body">
                <div class="text-center">
                    @if ($design)
                        @foreach ($design->getMedia() as $item)
                            <a href="{{ $item->getUrl() }}" target="_blank">
                                <img class="w-100 h-100" src="{{ $item->getUrl() }}" height="250px" width="250px"
                                    style="vertical-align: 0%;" alt="Design Template" />
                            </a>
                        @endforeach
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
