@extends('layouts/layoutMaster')

@section('title', 'Create - Gallery')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12">
        <div class="row breadcrumbs-top mb-0">
            <div class="col-12 align-items-center d-flex">
                <h2 class="content-header-title float-start mb-0">Create</h2>
                <div class="breadcrumb-wrapper align-items-center">
                    {{ Breadcrumbs::render('gallery.create') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body portfolio_project_repeater">
                    <div data-repeater-list="project_repeater">
                        <div data-repeater-item>
                            <div class="row">
                                <div class="col-11 mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="img_title">Title</label>
                                            <input type="text" name="img_title" id="img_title"
                                                class="img_title form-control"
                                                placeholder="Image Title Here...">
                                        </div>
                                        <div class="col-6">
                                            <label for="price">Price</label>
                                            <input type="number" class="form-control price" required
                                                id="price" name="price" value=""
                                                placeholder="Image Price Here..." />
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="img_description">Description</label>
                                            <textarea name="img_description" id="img_description" class="form-control img_description"
                                                rows="3" placeholder="Image Description Here..."></textarea>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="project_attachment">Attachment</label>
                                            <input type="file" class=" project_attachment"
                                                name="project_attachment" id="project_attachment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <div class="d-flex">
                                        <button data-repeater-delete
                                            class="btn btn-outline-danger waves-effect waves-float waves-light btn-xs new-floor_btn"
                                            id="" type="button">
                                            <i class="ti ti-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <button
                                class="btn btn-outline-success waves-effect waves-float waves-light btn-xs new-floor_btn"
                                id="" type="button" data-repeater-create>
                                <i class="ti ti-plus"></i>
                            </button>
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
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection

@section('page-script')
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);

        $(document).ready(function() {});

        $('.select2').select2({});

        $('.portfolio_project_repeater').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                initFilePond($(this).find('.project_attachment').get(0));
            },
            hide: function(e) {
                $(this).slideUp(e)
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
                allowMultiple: false,
                maxFiles: 1,
                checkValidity: true,
                allowPdfPreview: true,
                // chunkUploads: true,
                // chunkSize: '200KB',
                // chunkForce: true,
                // server: {
                // timeout: 7000,
                // process: '/files/getUploadId',
                // revert: '/files/revertFile',
                // patch: '/files/uploadfileChunk?patch=',
                // headers: {
                // 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                // }
                // },
                credits: {
                    label: '',
                    url: ''
                }
            });
        }
    </script>
@endsection
