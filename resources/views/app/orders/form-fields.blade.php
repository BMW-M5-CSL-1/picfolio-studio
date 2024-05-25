<div class="tab-content p-0">
    {{-- For new request --}}
    <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
        <form id="paper_media_form" action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="paper_media">
            <div class="card mb-2" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <div class="card-header mx-0">
                    <h3>Flyer/Brouchure</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-1 ">
                        <div class="col-md-3 col-sm-12 mb-2 c_col_map">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="d-block mb-2">
                                            <label for="order_no">Order No <span class="text-danger">*</span></label>
                                            <input type="text" readonly name="order_no" id="order_no"
                                                class="form-control" value="{{ $order_no }}">
                                            <div class="valid-feedback"> Looks good! </div>
                                            <div class="invalid-feedback"> Please enter your name. </div>
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="location">Location <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="location[]" id="location"
                                                required multiple onchange="quotation()">
                                                {{-- <option value="">Please Select</option> --}}
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="distributionType">Distribution Type <span
                                                    class="text-danger">*</span></label>
                                            <select name="distributionType" id="distributionType" required
                                                class="form-select select2" onchange="quotation()">
                                                <option selected value="all">All</option>
                                                <option value="residential">Residential</option>
                                                <option value="commerical">Commerical</option>
                                            </select>
                                        </div>

                                        <div class="d-block mb-2">
                                            <label for="paper">Paper Type <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="paper" id="paper" required
                                                onchange="quotation()">
                                                <option value="">Please Select</option>

                                                @foreach ($paper_for_paper_media as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}
                                                        ({{ $type->paper_qualities->name }})
                                                        ({{ $type->side == 'one' ? 'Only Front' : 'Front & Back' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="d-block mb-2">
                                            <label for="paperQuality">Paper Quality <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly name="paperQuality" id="paperQuality"
                                                class="form-control text-capitalize" placeholder="Paper Quality"
                                                required>
                                        </div>

                                        <div class="d-block mb-2">
                                            <label for="sides">Printing Side <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly name="sides" id="sides"
                                                class="form-control text-capitalize" placeholder="Sides To Print"
                                                required>
                                        </div>

                                        <div class="d-block mb-2">
                                            <label for="distributionDuaration">Distribution Duration <span
                                                    class="text-danger">*</span></label>
                                            <select name="distributionDuaration" id="distributionDuaration"
                                                class="form-select select2" onchange="duaration()" required>
                                                <option selected value="One Day">One Day</option>
                                                <option value="Two Days">Two Days</option>
                                                <option value="Three Days">Three Days</option>
                                                <option value="One Week">One Week</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3>Data</h3>
                                    <div class="row">
                                        <div class="d-block mb-2">
                                            <label for="no_of_houses">Number of Houses</label>
                                            <input type="number" readonly name="no_of_houses" id="no_of_houses"
                                                class="form-control" placeholder="Number of Houses">
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="no_of_shops">Number of Shops</label>
                                            <input type="number" readonly name="no_of_shops" id="no_of_shops"
                                                class="form-control" placeholder="Number of Shops">
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="no_of_schools">Number of Schools</label>
                                            <input type="number" readonly name="no_of_schools" id="no_of_schools"
                                                class="form-control" placeholder="Number of Schools">
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="no_of_parks">Number of Parks</label>
                                            <input type="number" readonly name="no_of_parks" id="no_of_parks"
                                                class="form-control" placeholder="Number of Parks">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="d-block mb-2">
                                            <label for="no_of_copies">Total Number of Copies</label>
                                            <input type="number" readonly name="no_of_copies" id="no_of_copies"
                                                class="form-control" placeholder="Number of Copies">
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="price">Total Price</label>
                                            <input type="number" readonly name="price" id="price"
                                                class="form-control" placeholder="Total Amount">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="d-block mb-2 text-center">
                                            <a data-bs-target="#quotation_for_flyer" data-bs-toggle="modal"
                                                class="btn btn-primary mb-2 text-nowrap cursor-pointer text-white">Generate
                                                Quotation</a>
                                        </div>
                                        {{-- <div class="d-block mb-2 text-center">
                                            <a class="btn btn-primary mb-2 text-nowrap cursor-pointer text-white"
                                                href="javascript:void(0)">Next</a>
                                        </div> --}}
                                    </div>
                                    {{-- Modal for design --}}

                                </div>
                            </div>


                        </div>
                        <div class="col-md-9 col-sm-12 mb-2 c_col_map">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row h-100">
                                        <div class="col-12">
                                            <div class="leaflet-map h-100 w-100" id="geoJson"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card" id="furtherPMOrderDetails"
                style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <div class="card-body">
                    <div class="col-xl-12 mb-2">
                        <div class="card" id="designCard">
                            <h5 class="card-header">Select A Design Template
                            </h5>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($designs_for_flyer as $design)
                                        <div class="col-md-3 col-lg-3 col-sm-4 mb-md-0 mb-2 custom_css_image">
                                            <div style="border-width: 5px !important; border-radius: 0.75rem !important;"
                                                class="form-check custom-option custom-option-image custom-option-image-radio">
                                                <label class="form-check-label custom-option-content"
                                                    for="{{ $design->id }}">
                                                    <span class="custom-option-body">
                                                        <img src="{{ $design->getFirstMediaUrl() }}"
                                                            alt="Design Template" />
                                                    </span>
                                                </label>
                                                <input name="design_template" class="form-check-input" type="radio"
                                                    required value="{{ $design->id }}" id="{{ $design->id }}" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Color Picker -->
                    <div class="col-12 mb-2">
                        <div class="card" id="colorPickrCard">
                            <h5 class="card-header">Select Your Colors</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="classic col col-sm-4 col-lg-4">
                                        <label for="primary_color">Primary Color <span
                                                class="text-danger">*</span></label>
                                        <input type="color" class="form-control form-control-color"
                                            id="primary_color" name="primary_color" title="Choose your primary color"
                                            required>
                                        <small class="text-muted">This is your primary
                                            color in the selected design.</small>
                                    </div>
                                    <div class="monolith col col-sm-4 col-lg-4">
                                        <label for="secondary_color">Secondary Color
                                            <span class="text-danger">*</span></label>
                                        <input type="color" class="form-control form-control-color"
                                            id="secondary_color" name="secondary_color"
                                            title="Choose your secondary color" required>
                                        <small class="text-muted">This is your
                                            secondary color in the selected
                                            design.</small>
                                    </div>
                                    <div class="nano col col-sm-4 col-lg-4">
                                        <label for="tertiary_color">Tertiary Color
                                            <span class="text-danger">*</span></label>
                                        <input type="color" class="form-control form-control-color"
                                            id="tertiary_color" name="tertiary_color"
                                            title="Choose your tertiary color" required>
                                        <small class="text-muted">Any other color in
                                            the selected design.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Color Picker-->

                    <div class="col-12 mb-2">
                        <div class="card" id="attachmentCard">
                            <h5 class="card-header">Upload Attachments</h5>
                            <div class="card-body">
                                <div class="row">
                                    <label class="form-label" for="pm_attachments">Attachments
                                        <span class="text-danger">*</span></label>
                                    <input id="pm_attachments" type="file" required
                                        class="filepond attachment form-control" name="pm_attachments[]" multiple
                                        accept=".png, .jpeg, .jpg" />
                                    <small class="text-muted">Upload Your Images i.e.,
                                        Logo, Pictures, etc.</small>
                                    @error('pm_attachments')
                                        <div class="invalid-feedback ">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card" id="detailsCard">
                            <h5 class="card-header">Details</h5>
                            <div class="card-body">
                                <div>
                                    <label for="comments" class="form-label">Enter
                                        Your Details <span class="text-danger">*</span></label>
                                    <textarea placeholder="Enter Your Details Here..." class="form-control" required name="comments" id="comments"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-12 text-end">
                            <button id="save_btn" class="btn btn-primary mb-2 text-nowrap me-3">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- Modal for Quotation --}}
    <div class="modal fade" id="quotation_for_flyer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-3">Quotation</h3>
                        <p class="text-muted">Quotation will be generated according to your selections.</p>
                    </div>

                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">

                        <h6 class="m-0 mb-2 mb-sm-0 me-5">Area Selected</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <p class="mb-0" id="modalArea"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">

                        <h6 class="m-0 mb-2 mb-sm-0">Paper Type</h6>
                        <div class="d-flex flex-wrap gap-2 text-capitalize">
                            <p class="mb-0" id="modalPaperType"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0">Paper Quality</h6>
                        <div class="d-flex flex-wrap gap-2 text-capitalize">
                            <p class="mb-0" id="modalPaperQuality"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">

                        <h6 class="m-0 mb-2 mb-sm-0">Printing Side</h6>
                        <div class="d-flex flex-wrap gap-2 text-capitalize">
                            <p class="mb-0" id="modalSides"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0">Distribution Type</h6>

                        <div class="d-flex flex-wrap gap-2">
                            <p class="mb-0" id="modalDistributionType"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0">Distribution Duration</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <p class="mb-0" id="modalDuration"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0">Number of Copies</h6>

                        <div class="d-flex flex-wrap gap-2">
                            <p class="mb-0" id="modalCopies"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0">Total Price (Rs.)</h6>

                        <div class="d-flex flex-wrap gap-2">
                            <p class="mb-0" id="modalPrice"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <form action="{{ route('orders.generate-pdf') }}" method="POST">
                                @csrf
                                <input type="hidden" name="quotation_for" id="quotation_for" value="paper media">
                                <input type="hidden" name="pdfArea" id="pdfArea" readonly>
                                <input type="hidden" name="pdfPaperType" id="pdfPaperType">
                                <input type="hidden" name="pdfPaperQuality" id="pdfPaperQuality">
                                <input type="hidden" name="pdfSides" id="pdfSides">
                                <input type="hidden" name="pdfDistributionType" id="pdfDistributionType">
                                <input type="hidden" name="pdfDuration" id="pdfDuration">
                                <input type="hidden" name="pdfCopies" id="pdfCopies">
                                <input type="hidden" name="pdfPrice" id="pdfPrice">


                                <button class="btn btn-primary mb-2 text-nowrap download-pdf">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-download mx-2" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 11l5 5l5 -5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                    Download PDF
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}

    {{-- Vehicle Media --}}
    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
        <form id="vehicle_media_form" action="{{ route('orders.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="card mb-2" style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <div class="card-header pb-0">
                    <h3>Vehicle Media</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col-md-3 col-sm-12 mb-2 c_col_map">
                            <div class="card">
                                <div class="card-body">

                                    <input type="hidden" name="type" value="vehicle_media">
                                    <div class="row">
                                        <div class="d-block mb-2">
                                            <div class="d-block mb-2">
                                                <label for="order_no">Order No <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" readonly name="order_no" id="order_no"
                                                    class="form-control" value="{{ $vehicle_order_no }}">
                                            </div>
                                            <label for="routes">Route <span class="text-danger">*</span></label>
                                            <select name="routes[]" id="routes" class="form-select select2"
                                                multiple onchange="vehicleMediaQuotation()">
                                                @foreach ($routes as $route)
                                                    <option value="{{ $route->id }}">{{ $route->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="banner">Paper Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select select2" name="banner" id="banner"
                                                required onchange="vehicleMediaQuotation()">
                                                <option value="0">Please Select</option>
                                                @foreach ($paper_for_vehicle_media as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}
                                                        ({{ $type->paper_qualities->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="vmQuality">Paper Quality <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly name="vmQuality" id="vmQuality"
                                                class="form-control text-capitalize" placeholder="Paper Quality"
                                                required>
                                        </div>

                                        <div class="d-block mb-2">
                                            <label for="adDuaration">Duaration <span
                                                    class="text-danger">*</span></label>
                                            <select name="adDuaration" id="adDuaration" class="form-select select2"
                                                onchange="vehicleMediaQuotation()">
                                                <option value="">Please Select</option>
                                                <option value="Half Month">15 Days</option>
                                                <option value="One Month">One Month</option>
                                                <option value="Two Month">Two Month</option>
                                                <option value="Three Month">Three Month</option>
                                                <option value="Six Month">Six Month</option>
                                            </select>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="d-block mb-2">
                                            <label for="no_of_cars">No. of Cars on Route</label>
                                            <input type="number" readonly name="no_of_cars" id="no_of_cars"
                                                class="form-control" placeholder="Number of Cars">
                                        </div>
                                        <div class="d-block mb-2">
                                            <label for="vmPrice">Total Price</label>
                                            <input type="number" readonly name="vmPrice" placeholder="Total Price"
                                                id="vmPrice" class="form-control">
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="d-block mb-2 text-center">
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quotation_for_vehicle"
                                                class="btn btn-primary mb-2 text-nowrap">Generate
                                                Quotation</a>
                                        </div>
                                        {{-- <div class="d-block mb-2 text-center">
                                            <a class="btn btn-primary mb-2 text-nowrap cursor-pointer text-white"
                                                href="javascript:void(0)">Next</a>
                                        </div> --}}
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 mb-2 c_col_map">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row h-100">
                                        <div class="col-12">
                                            <iframe class="h-100 w-100"
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15111.284023437054!2d72.99477746647725!3d33.69234997271105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbe1284ef4e6f%3A0x4bf634b6861b14d2!2sF-10%2C%20Islamabad%2C%20Islamabad%20Capital%20Territory%2C%20Pakistan!5e1!3m2!1sen!2s!4v1697727081360!5m2!1sen!2s"
                                                style="border:0;" allowfullscreen="" loading="lazy"
                                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="furtherVMOrderDetails"
                style="border: 2px solid #7367F0; border-style: dashed; border-radius: 0;">
                <div class="card-body">
                    <div class="col-xl-12 mb-2">
                        <div class="card" id="designCard">
                            <h5 class="card-header">Select A Design Template
                            </h5>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($designs_for_vehicle as $design)
                                        <div class="col-md-3 col-lg-3 col-sm-4 mb-md-0 mb-2 custom_css_image">
                                            <div style="border-width: 5px !important; border-radius: 0.75rem !important;"
                                                class="form-check custom-option custom-option-image custom-option-image-radio">
                                                <label class="form-check-label custom-option-content"
                                                    for="{{ $design->id }}">
                                                    <span class="custom-option-body">
                                                        <img src="{{ $design->getFirstMediaUrl() }}"
                                                            alt="Design Template" />
                                                    </span>
                                                </label>
                                                <input name="design_template" class="form-check-input" type="radio"
                                                    required value="{{ $design->id }}" id="{{ $design->id }}" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Color Picker -->
                    <div class="col-12 mb-2">
                        <div class="card" id="colorPickrCard">
                            <h5 class="card-header">Select Your Colors</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="classic col col-sm-4 col-lg-4">
                                        <label for="primary_color">Primary Color <span
                                                class="text-danger">*</span></label>
                                        <input type="color" class="form-control form-control-color"
                                            id="primary_color" name="primary_color" title="Choose your primary color"
                                            required>
                                        <small class="text-muted">This is your primary
                                            color in the selected design.</small>
                                    </div>
                                    <div class="monolith col col-sm-4 col-lg-4">
                                        <label for="secondary_color">Secondary Color
                                            <span class="text-danger">*</span></label>
                                        <input type="color" class="form-control form-control-color"
                                            id="secondary_color" name="secondary_color"
                                            title="Choose your secondary color" required>
                                        <small class="text-muted">This is your
                                            secondary color in the selected
                                            design.</small>
                                    </div>
                                    <div class="nano col col-sm-4 col-lg-4">
                                        <label for="tertiary_color">Tertiary Color
                                            <span class="text-danger">*</span></label>
                                        <input type="color" class="form-control form-control-color"
                                            id="tertiary_color" name="tertiary_color"
                                            title="Choose your tertiary color" required>
                                        <small class="text-muted">Any other color in
                                            the selected design.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Color Picker-->

                    <div class="col-12 mb-2">
                        <div class="card" id="attachmentCard">
                            <h5 class="card-header">Upload Attachments</h5>
                            <div class="card-body">
                                <div class="row">
                                    <label class="form-label" for="vm_attachments">Attachments
                                        <span class="text-danger">*</span></label>
                                    <input id="vm_attachments" type="file" required
                                        class="filepond attachment form-control" name="vm_attachments[]" multiple
                                        accept=".png, .jpeg, .jpg" />
                                    <small class="text-muted">Upload Your Images i.e.,
                                        Logo, Pictures, etc.</small>
                                    @error('vm_attachments')
                                        <div class="invalid-feedback ">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card" id="detailsCard">
                            <h5 class="card-header">Details</h5>
                            <div class="card-body">
                                <div>
                                    <label for="comments" class="form-label">Enter
                                        Your Details <span class="text-danger">*</span></label>
                                    <textarea placeholder="Enter Your Details Here..." class="form-control" required name="comments" id="comments"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-12 text-end">
                            <button id="save_btn" class="btn btn-primary mb-2 text-nowrap me-3">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End Vehicle Media --}}

    {{-- Modal for Quotation --}}
    <div class="modal fade" id="quotation_for_vehicle" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-3">Quotation</h3>
                        <p class="text-muted">Quotation will be generated according to your selections.</p>
                    </div>

                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">

                        <h6 class="m-0 mb-2 mb-sm-0 me-5">Route Selected</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <p id="modal_route" class="mb-0"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">

                        <h6 class="m-0 mb-2 mb-sm-0">Paper Type</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <p id="modal_paper_type" class="mb-0"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0">Duaration</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <p id="car_modal_duration" class="mb-0"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0">Number of Cars</h6>

                        <div class="d-flex flex-wrap gap-2">
                            <p id="modal_no_of_cars" class="mb-0"></p>
                        </div>
                    </div>
                    <div
                        class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom pb-1 mb-3">
                        <h6 class="m-0 mb-2 mb-sm-0" class="mb-0">Total Price</h6>

                        <div class="d-flex flex-wrap gap-2">
                            <p id="modal_total_price"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <form action="{{ route('orders.generate-pdf') }}" method="POST">
                                @csrf
                                <input type="hidden" name="quotation_for" id="quotation_for" value="vehicle_media">
                                <input type="hidden" name="pdf_routes" id="pdf_routes">
                                <input type="hidden" name="pdf_paper_type" id="pdf_paper_type">
                                <input type="hidden" name="pdf_duration" id="pdf_duration">
                                <input type="hidden" name="pdf_cars" id="pdf_cars">
                                <input type="hidden" name="pdf_price" id="pdf_price">

                                <button class="btn btn-primary mb-2 text-nowrap download-pdf">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-download mx-2" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 11l5 5l5 -5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                    Download PDF
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}

</div>
