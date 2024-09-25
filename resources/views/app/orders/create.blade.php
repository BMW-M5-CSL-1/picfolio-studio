@extends('layouts/layoutMaster')

@section('seo-breadcrumb')
    <h4 class="fw-bold py-3 mb-4 ">
        <span class="text-muted fw-light">
            {{ Breadcrumbs::view('breadcrumbs::json-ld', 'booking.create') }}
        </span>
    </h4>
@endsection

@section('title', 'Create ')

@section('vendor-style')
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('page-style')
    <style>
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
        }

        .nav-tabs .nav-link.active {
            border: none !important;
            box-shadow: unset !important;
        }

        .nav-tabs .nav-link.active {
            border: 1px solid #7367F0 !important;
            border-radius: 8px !important;
        }

        .c_btns {
            display: flex;
        }

        @media(max-width: 767px) {
            .c_btns {
                display: grid;
                margin-bottom: 0;

            }

            .c_btns li {
                width: 100% !important;
                margin-bottom: 2rem;

            }

            .c_li_2 {
                margin-bottom: 0 !important;
            }
        }

        @media(max-width: 991.98px) {
            .c_col_map {
                width: 100% !important;
            }
        }
    </style>
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                {{-- <h2 class="content-header-title float-start mb-0">Create </h2> --}}
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('booking.create') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card mb-3">
                <h4 class="card-header">Booking Details</h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="shoot">Shoot</label>
                            <select name="shoot" id="shoot" class="select2 form-control">
                                <option value="">Please Select</option>
                                <option value="wedding">Wedding</option>
                                <option value="occassion">Occassion</option>
                                <option value="business">Business</option>
                            </select>
                        </div>

                        <div class="col-6 mb-3">
                            <label for="sub_type">Sub-Type</label>
                            <select name="sub_type" id="sub_type" class="select2 form-control">
                                <option value="">Please Select</option>
                            </select>
                        </div>

                        <div class="col-4">
                            <label for="budget">Budget</label>
                            <input type="number" name="budget" id="budget" class="form-control"
                                placeholder="Enter Your Budget">
                        </div>

                        <div class="col-4">
                            <label for="currency">Currency</label>
                            <select type="number" name="currency" id="currency" class="form-control select2">
                                <option value="">Please Select</option>
                                <option value="pkr">PKR</option>
                            </select>
                        </div>

                        <div class="col-4 mb-3">
                            <label for="photographer">Photographer</label>
                            <select name="photographer" id="photographer" class="select2 form-control">
                                <option value="">Please Select</option>
                                <option value="">Hamza</option>
                                <option value="">Ahsen</option>
                                <option value="">Ali</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <h4 class="card-header">
                        Photographer's Portfolio
                    </h4>
                    <div class="card-body">
                        <div class="card mb-3">
                            <h5 class="card-header">Work Experience</h5>
                            <div class="card-body">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <input disabled class="form-control" value="ABC Company">
                                            </div>
                                            <div class="col-3">
                                                <input disabled type="text" class="form-control"
                                                    value="Front End Developer" />
                                            </div>
                                            <div class="col-3">
                                                <input disabled class="form-control" value="01-01-2023" />
                                            </div>
                                            <div class="col-3">
                                                <input disabled class="form-control" value="01-12-2023" />
                                            </div>
                                            <div class="col-12 mt-2">
                                                <textarea disabled class="form-control work_description" rows="3">Working as a junior front end developer</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <h5 class="card-header">Projects</h5>
                            <div class="card-body">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <input disabled class="form-control" value="Pic Folio Studio">
                                            </div>
                                            <div class="col-6">
                                                <input disabled class="form-control" value="Front End Developer" />
                                            </div>
                                            <div class="col-12 mt-2">
                                                <textarea disabled class="form-control" rows="3">My Final Year Project Pic Folio Studio</textarea>
                                            </div>
                                            <div class="col-12 mt-2">
                                                Attachment...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <h5 class="card-header">Certificates</h5>
                            <div class="card-body">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <input disabled value="Meta Frontend Developer" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <input disabled class="form-control" value="Meta" />
                                            </div>
                                            <div class="col-3">
                                                <input disabled class="form-control" value="01-12-2022" />
                                            </div>
                                            <div class="col-3">
                                                <input disabled class="form-control" value="01-06-2023" />
                                            </div>
                                            <div class="col-12 mt-2">
                                                <textarea disabled class="form-control" rows="3">Meta Front End Developer Certificate</textarea>
                                            </div>
                                            <div class="col-12 mt-2">
                                                Attachment....
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-outline-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/maps-leaflet.js') }}"></script> --}}

    <script>
        let select2 = $('.select2');
        if (select2.length) {
            var $this = select2;
            $this.wrap('<div class="position-relative"></div>').select2({});
        }

        $('#shoot').on('change', function() {
            let options = [];
            if ($(this).val() == 'wedding') {
                options.push({
                    id: null,
                    text: 'Please Select',
                    selected: true,
                }, {
                    id: 'pre_wedding',
                    text: 'Pre Wedding'
                }, {
                    id: 'mehandi',
                    text: 'Mehandi'
                }, {
                    id: 'barat',
                    text: 'Barat'
                }, {
                    id: 'walima',
                    text: 'Walima'
                })
            } else if ($(this).val() == 'occassion') {
                options.push({
                    id: null,
                    text: 'Please Select',
                    selected: true,
                }, {
                    id: 'insta',
                    text: 'Insta Shoot'
                }, {
                    id: 'vlogging',
                    text: 'Vlogging'
                }, {
                    id: 'party_shoot',
                    text: 'Party Shoot'
                }, {
                    id: 'baby_shoot',
                    text: 'Baby & Kids Shoot'
                }, {
                    id: 'vocational_shoot',
                    text: 'Vocational Shoot'
                })
            } else if ($(this).val() == 'business') {
                options.push({
                    id: null,
                    text: 'Please Select',
                    selected: true,
                }, {
                    id: 'food_shoot',
                    text: 'Food Shoot'
                }, {
                    id: 'interior_shoot',
                    text: 'Interior Shoot'
                }, {
                    id: 'product_shoot',
                    text: 'Product Shoot'
                }, {
                    id: 'corporate_shoot',
                    text: 'Corporate Shoot'
                }, {
                    id: 'brand_shoot',
                    text: 'Brand Shoot'
                }, {
                    id: 'profile_shoot',
                    text: 'Profile & Headshot Shoot'
                })
            } else {
                options.push({
                    id: null,
                    text: 'Please Select'
                })
            }

            $('#sub_type').empty();
            options.forEach(element => {
                var newOption = new Option(element.text, element.id, element.selected ?? false, false);
                $('#sub_type').append(newOption);
            });
        })
    </script>
@endsection
