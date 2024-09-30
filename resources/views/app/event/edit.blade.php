@extends('layouts/layoutMaster')

@section('title', 'Edit Event')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
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
                    {{ Breadcrumbs::render('event.edit') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('event.update', ['id' => $event->id]) }}" method="POST" id="event_form">
        @csrf
        <div class="row">
            <div class="col-9">
                @include('app.event.form-fields')
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-outline-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
        $('#no_of_photographers').on('change', function() {
            if ($(this).val() < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No. of Photographers should be greater than 0',
                    showCancelButton: false,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Ok !',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-primary waves-effect waves-float waves-light me-1',
                        cancelButton: 'd-none',
                        denyButton: 'd-none'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {}
                    this.value = 1;
                });

            }
        })


        let select2 = $('.select2').select2();

        let start_date_flatpickr = document.getElementById('start_date').flatpickr({
            minDate: 'today',
            altInput: true,
            altFormat: 'd F Y, h:i K',
            dateFormat: 'Y-m-d H:i',
            enableTime: true,
        });

        let end_date_flatpickr = document.getElementById('end_date').flatpickr({
            minDate: 'today',
            altInput: true,
            altFormat: 'd F Y, h:i K',
            dateFormat: 'Y-m-d H:i',
            enableTime: true,
        });

        $('#start_date').on('change', function() {
            end_date_flatpickr.clear();
            end_date_flatpickr.set('minDate', this.value);
        })

        $('#start_date').trigger('change');
        setTimeout(() => {
            end_date_flatpickr.setDate('{{ $event->end_date }}');
        }, 100);

        const savedTitle = "{{ $event->title }}"; // Saved title from the backend

        function populateTitleOptions(type, selectedTitle = null) {
            let options = [];

            if (type === 'wedding') {
                options.push({
                    id: null,
                    text: 'Please Select',
                    selected: true
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
                });
            } else if (type === 'occassion') {
                options.push({
                    id: null,
                    text: 'Please Select',
                    selected: true
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
                });
            } else if (type === 'business') {
                options.push({
                    id: null,
                    text: 'Please Select',
                    selected: true
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
                });
            } else {
                options.push({
                    id: null,
                    text: 'Please Select'
                });
            }

            $('#title').empty(); // Clear current options
            options.forEach(function(element) {
                var isSelected = element.id === selectedTitle;
                var newOption = new Option(element.text, element.id, isSelected, isSelected);
                $('#title').append(newOption);
            });
        }

        // On type change, populate title options
        $('#type').on('change', function() {
            const selectedType = $(this).val();
            populateTitleOptions(selectedType);
        });

        // Prepopulate options based on saved event type
        const savedType = "{{ $event->type }}";
        if (savedType) {
            populateTitleOptions(savedType, savedTitle);
        }
    </script>
@endsection
