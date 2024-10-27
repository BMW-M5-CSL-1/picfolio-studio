@extends('layouts/layoutMaster')

@section('title', 'Create Event')

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
                    {{ Breadcrumbs::render('product.create') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="product_form">
        @csrf
        <div class="row">
            <div class="col-9">
                @include('app.product.form-fields')
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <button type="submit" id="btn_save"
                                class="btn btn-success btn-outline-success">Submit</button>
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
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/maps-leaflet.js') }}"></script> --}}

    <script>
        // $('.product_repeater').repeater({
        //     initEmpty: true,
        //     show: function() {
        //         $(this).slideDown();
        //         initFilePond($(this).find('.attachment').get(0));
        //         fv.addField($(this).find('.name').attr('name'), name);
        //         fv.addField($(this).find('.price').attr('name'), price);
        //         fv.addField($(this).find('.stock').attr('name'), stock);
        //     },
        //     hide: function(e) {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Warning',
        //             text: 'Are you sure ?',
        //             showCancelButton: true,
        //             cancelButtonText: 'No',
        //             confirmButtonText: 'Yes, Remove it!',
        //             confirmButtonClass: 'btn-danger',
        //             buttonsStyling: false,
        //             customClass: {
        //                 confirmButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
        //                 cancelButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1'
        //             },
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 fv.removeField($(this).find('.name').attr('name'));
        //                 fv.removeField($(this).find('.price').attr('name'));
        //                 fv.removeField($(this).find('.stock').attr('name'));

        //                 $(this).slideUp(e, function() {
        //                     $(this).remove();
        //                 });
        //             }
        //         });
        //     }
        // });

        const name = {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Name',
                    }
                },
            },
            price = {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Price',
                    },
                },
            },
            stock = {
                validators: {
                    notEmpty: {
                        message: 'Please Enter Stock',
                    },
                },
            };

        const product_form = document.getElementById('product_form');
        const fv = FormValidation.formValidation(product_form, {
            fields: {
                // name: {
                //     validators: {
                //         notEmpty: {
                //             message: 'Please Enter Full Name',
                //         }
                //     },
                // },
                // contact: {
                //     validators: {
                //         notEmpty: {
                //             message: 'Please Enter Contact No.',
                //         },
                //         // between: {
                //         //     min: 9,
                //         //     max: 11,
                //         //     message: 'Contact No. should be 10-11 digits long',
                //         // }
                //     },
                // },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: '',
                    rowSelector: function(field, ele) {
                        // field is the field name & ele is the field element
                        return '.mb-3';
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            }
        }).on('core.form.valid', function() {
            // alert('submit')
            $('#product_form').submit();
        }).on('core.form.invalid', function(data) {
            console.log(data);
        });

        $('.attachment').on('FilePond:processfiles', (function(file) {
            $('#btn_save').attr('disabled', false);
        }));
        $('.attachment').on('FilePond:processfilestart', (function(file) {
            $('#btn_save').attr('disabled', true);
        }));
        $('.attachment').on('FilePond:processfileabort', (function(file) {
            $('#btn_save').attr('disabled', false);
        }));

        FilePond.create(document.getElementById('attachment'), {
            styleButtonRemoveItemPosition: 'right',
            imageCropAspectRatio: '1:1',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '100000KB',
            ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
            storeAsFile: true,
            allowMultiple: true, // Make sure this is set to true
            checkValidity: true,
            allowPdfPreview: true,
            credits: {
                label: '',
                url: ''
            }
        });

        function initFilePond(element) {
            FilePond.create(element, {
                styleButtonRemoveItemPosition: 'right',
                imageCropAspectRatio: '1:1',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
                maxFileSize: '100000KB',
                ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
                storeAsFile: true,
                allowMultiple: true, // Make sure this is set to true
                checkValidity: true,
                allowPdfPreview: true,
                credits: {
                    label: '',
                    url: ''
                }
            });
        }

        let select2 = $('.select2').select2();
    </script>
@endsection
