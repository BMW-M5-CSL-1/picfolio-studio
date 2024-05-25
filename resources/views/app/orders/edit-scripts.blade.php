<script>
    FilePond.registerPlugin(FilePondPluginImagePreview);

    var files = [];
    @forelse($pm_attachments as $image)
        files.push({
            source: '{{ $image->getUrl() }}',
        });
    @empty
    @endforelse

    FilePond.create(document.getElementById('pm_attachments'), {
        files: files,
        styleButtonRemoveItemPosition: 'right',
        imageCropAspectRatio: '1:1',
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
        maxFileSize: '100000KB',
        ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
        storeAsFile: true,
        allowMultiple: true,
        // maxFiles: 1,
        checkValidity: true,
        allowPdfPreview: true,
        // chunkUploads: true,
        // chunkSize: '200KB',
        // chunkForce: true,
        // server: {
        //     timeout: 7000,
        //     process: '/files/getUploadId',
        //     revert: '/files/revertFile',
        //     patch: '/files/uploadfileChunk?patch=',
        //     headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     }
        // },
        credits: {
            label: '',
            url: ''
        }
    });

    var files = [];
    @forelse($vm_attachments as $image)
        files.push({
            source: '{{ $image->getUrl() }}',
        });
    @empty
    @endforelse

    FilePond.create(document.getElementById('vm_attachments'), {
        files: files,
        styleButtonRemoveItemPosition: 'right',
        imageCropAspectRatio: '1:1',
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
        maxFileSize: '100000KB',
        ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
        storeAsFile: true,
        allowMultiple: true,
        // maxFiles: 1,
        checkValidity: true,
        allowPdfPreview: true,
        // chunkUploads: true,
        // chunkSize: '200KB',
        // chunkForce: true,
        // server: {
        //     timeout: 7000,
        //     process: '/files/getUploadId',
        //     revert: '/files/revertFile',
        //     patch: '/files/uploadfileChunk?patch=',
        //     headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     }
        // },
        credits: {
            label: '',
            url: ''
        }
    });

    $('#paper').fadeOut(function() {
        quotation();
    });

    $('#banner').fadeIn(function() {
        vehicleMediaQuotation();
    });

    function quotation() {
        locationBaseSelection();
        getAttributesOfPaperType();
        duaration();
    }

    function locationBaseSelection() {
        showBlockUI();
        var locations = $('#location option:selected')
            .toArray().map(item => item.text).join();
        // $('#location').find(':selected').text();
        var location_id = $('#location').val();
        var distribution_type = $('#distributionType').val();
        var distributionTypeSelected = $('#distributionType').find(':selected').text();

        $(document).ready(function() {
            var _token = '{{ csrf_token() }}';
            let url = "{{ route('orders.ajax-location') }}";
            $.ajax({
                type: "post",
                url: url,
                dataType: "json",
                data: {
                    '_token': _token,
                    'location_id': location_id,
                    'distribution_type': distribution_type,
                },
                success: function(response) {
                    if (response.success == true) {
                        hideBlockUI();
                        $('#no_of_copies').val(response.totalCopies).trigger('change');
                        $('#no_of_houses').val(response.house).trigger('change');
                        $('#no_of_shops').val(response.shop).trigger('change');
                        $('#no_of_parks').val(response.park).trigger('change');
                        $('#no_of_schools').val(response.school).trigger('change');
                        // Change Values on Quotation
                        $('#modalArea').html(locations).trigger('change');
                        $('#pdfArea').val(locations).trigger('change');
                        $('#modalDistributionType').html(distributionTypeSelected).trigger(
                            'change');
                        $('#pdfDistributionType').val(distributionTypeSelected).trigger('change');
                    } else {
                        hideBlockUI();
                        $('#no_of_copies').val('').trigger('change');
                        $('#no_of_houses').val('').trigger('change');
                        $('#no_of_shops').val('').trigger('change');
                        $('#no_of_parks').val('').trigger('change');
                        $('#no_of_schools').val('').trigger('change');
                        $('#modalArea').empty();
                        $('#modalDistributionType').empty();
                        // $('#modalDuration').empty();
                    }
                },
                error: function(error) {
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }
            });
        });
    }

    function getAttributesOfPaperType() {
        showBlockUI();
        var type = $('#paper').val();
        var typeName = $('#paper').find(':selected').text();

        $(document).ready(function() {
            var _token = '{{ csrf_token() }}';
            let url = '{{ route('orders.ajax-attribute-of-paper-type') }}';
            $.ajax({
                type: "post",
                url: url,
                dataType: "json",
                data: {
                    '_token': _token,
                    'paper_type': type,
                },
                success: function(response) {
                    if (response.success == true) {
                        hideBlockUI();
                        var rate = response.rate;
                        var copies = $('#no_of_copies').val();
                        var totalPrice = rate * copies;

                        $('#paperQuality').val(response.quality).trigger('change');
                        $('#sides').val(response.sideToPrint).trigger('change');
                        $('#price').val(totalPrice).trigger('change');
                        // Change Values on Quotation
                        var paperQuality = $('#paperQuality').val();
                        var sides = $('#sides').val();

                        $('#modalPaperType').html(typeName).trigger('change');
                        $('#pdfPaperType').val(typeName).trigger('change');
                        $('#modalPaperQuality').html(paperQuality).trigger('change');
                        $('#pdfPaperQuality').val(paperQuality).trigger('change');
                        $('#modalSides').html(sides).trigger('change');
                        $('#pdfSides').val(sides).trigger('change');
                        $('#modalCopies').html(copies).trigger('change');
                        $('#pdfCopies').val(copies).trigger('change');
                        $('#modalPrice').html(totalPrice).trigger('change');
                        $('#pdfPrice').val(totalPrice).trigger('change');
                    } else {
                        hideBlockUI();
                        $('#paperQuality').val("").trigger('change');
                        $('#sides').val("").trigger('change');
                        $('#price').val("").trigger('change');
                        $('#modalPaperType').empty();
                        $('#modalPaperQuality').empty();
                        $('#modalSides').empty();
                        $('#modalPrice').empty();
                        // $('#modalDuration').empty();
                    }
                },
                error: function(error) {
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }
            });
        });
    }

    function duaration() {
        var distributeDuaration = $('#distributionDuaration').find(':selected').text();
        $('#modalDuration').trigger('change').html(distributeDuaration);
        $('#pdfDuration').trigger('change').val(distributeDuaration);
    }

    function vehicleMediaQuotation() {
        getAllVehicleOnRoute();
        getBannerType();
    }

    function getAllVehicleOnRoute() {
        showBlockUI();
        var routes = $('#routes option:selected').toArray().map(item => item.text).join();
        var route_id = $('#routes').val();
        $(document).ready(function() {
            var _token = '{{ csrf_token() }}';
            let url = "{{ route('orders.ajax-vehicle-media-routes') }}";
            $.ajax({
                type: "post",
                url: url,
                dataType: "json",
                data: {
                    '_token': _token,
                    'route_id': route_id,
                },
                success: function(response) {
                    if (response.success == true) {
                        hideBlockUI();
                        $('#no_of_cars').val(response.totalVehicles).trigger('change');
                    } else {
                        hideBlockUI();
                        $('#no_of_cars').val('').trigger('change');
                    }
                },
                error: function(error) {
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }
            });
        });
    }

    function getBannerType() {
        showBlockUI();
        var type = $('#banner').val();
        var typeName = $('#banner').find(':selected').text();

        $(document).ready(function() {
            var _token = '{{ csrf_token() }}';
            let url = '{{ route('orders.ajax-attribute-of-paper-type') }}';
            $.ajax({
                type: "post",
                url: url,
                dataType: "json",
                data: {
                    '_token': _token,
                    'banner': type,
                },
                success: function(response) {
                    if (response.success == true) {
                        hideBlockUI();
                        var rate = response.rate;
                        var vehicles = $('#no_of_cars').val();
                        var duration = $('#adDuaration').val();

                        switch (duration) {
                            case 'Half Month':
                                duration = 15;
                                break;
                            case 'One Month':
                                duration = 30;
                                break;
                            case 'Two Month':
                                duration = 60;
                                break;
                            case 'Three Month':
                                duration = 90;
                                break;
                            case 'Six Month':
                                duration = 180;
                                break;
                            default:
                                break;
                        }

                        var totalPrice = (rate * vehicles) * duration;

                        // console.log(rate, vehicles, totalPrice, duration);
                        $('#vmQuality').val(response.quality).trigger('change');
                        // $('#sides').val(response.sideToPrint).trigger('change');
                        $('#vmPrice').val(totalPrice).trigger('change');
                        // // Change Values on Quotation
                        // var paperQuality = $('#paperQuality').val();
                        // var sides = $('#sides').val();

                        // $('#modalPaperType').html(typeName).trigger('change');
                        // $('#pdfPaperType').val(typeName).trigger('change');
                        // $('#modalPaperQuality').html(paperQuality).trigger('change');
                        // $('#pdfPaperQuality').val(paperQuality).trigger('change');
                        // $('#modalSides').html(sides).trigger('change');
                        // $('#pdfSides').val(sides).trigger('change');
                        // $('#modalCopies').html(copies).trigger('change');
                        // $('#pdfCopies').val(copies).trigger('change');
                        // $('#modalPrice').html(totalPrice).trigger('change');
                        // $('#pdfPrice').val(totalPrice).trigger('change');
                    } else {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);
                        $('#vmPrice').val('').trigger('change');
                        // $('#paperQuality').val("").trigger('change');
                        // $('#sides').val("").trigger('change');
                        // $('#price').val("").trigger('change');
                        // $('#modalPaperType').empty();
                        // $('#modalPaperQuality').empty();
                        // $('#modalSides').empty();
                        // $('#modalPrice').empty();
                        // $('#modalDuration').empty();
                    }
                },
                error: function(error) {
                    setTimeout(function() {
                        hideBlockUI();
                    }, 4000);
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                }
            });
        });
    }

    $('.download-pdf').click(function(e) {
        showBlockUI();
        // e.preventDefault();
        setTimeout(function() {
            hideBlockUI();
        }, 4000);
    });

    // var validator = $("#paper_media_form").validate({
    //     // debug: true,
    //     rules: {
    //         'order_no': {
    //             required: true
    //         },
    //         // 1. PRIMARY DATA
    //         'location[]': {
    //             required: true
    //         },
    //         'distributionType': {
    //             required: true
    //         },
    //         'paperType': {
    //             required: true
    //         },
    //         'paperQuality': {
    //             required: true,
    //         },
    //         'sides': {
    //             required: true,
    //         },
    //         'distributionDuaration': {
    //             required: true,
    //         },
    //         'no_of_copies': {
    //             required: true,
    //         },
    //         'price': {
    //             required: true,
    //         },
    //         'design_template': {
    //             required: true
    //         },
    //         'primary_color': {
    //             required: true
    //         },
    //         'secondary_color': {
    //             required: true
    //         },
    //         'tertiary_color': {
    //             required: true,
    //         },
    //         'user_attachments[]': {
    //             required: true
    //         },
    //         'comments': {
    //             required: true
    //         },
    //     },
    //     // validClass: "is-valid",
    //     errorClass: 'is-invalid text-danger',
    //     errorElement: "span",
    //     // wrapper: "div",
    //     submitHandler: function(form) {
    //         form.submit();
    //         $('#save_btn').attr('disabled', true);
    //     }
    // });
</script>
