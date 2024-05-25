<script>
    // Global Variable for checked map and location
    var multiple_selected_map_ids = [];
    var unique_map_ids = [];
    var AllLayers = [];

    // GeoJSON Map
    var geoJsonMap = L.map('geoJson').setView([33.6889, 73.0129], 1);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        minZoom: 14,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(geoJsonMap);
    const sectorBlocks = '{{ url('/') }}/geojson/map.geojson';
    $.get(sectorBlocks, {}, function(data) {
        var geojsonFeature = data;
        L.geoJSON(geojsonFeature, {
            onEachFeature: onEachFeature
        }).addTo(geoJsonMap);
    }, 'json');

    function onEachFeature(feature, layer) {
        layer.setStyle({
            fillColor: '#aea9f5',
            // weight: 1,
            opacity: 1,
            color: '#5145ff',
            // dashArray: '0.9',
            fillOpacity: 0.6
        });
        AllLayers.push(layer);
        //bind click
        layer.on({
            click: whenClicked
        });
    }

    function whenClicked(e) {
        const layer = e.target;
        var location_id = layer.feature.id;

        showBlockUI();
        $.ajax({
            type: "post",
            url: '{{ route('orders.ajax-map-data') }}',
            data: {
                'id': location_id,
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // multiple_selected_map_ids.push(location_id);
                    // console.log(location_id, multiple_selected_map_ids);

                    // $.each(multiple_selected_map_ids, function(index, element) {
                    //     if ($.inArray(element, unique_map_ids) === -1) {
                    //         unique_map_ids.push(element);
                    //     }
                    // });
                    // console.log("Unique Geo", unique_map_ids);
                    // console.log(layer.bindTooltip());
                    layer.bindTooltip(
                        '<div class="text-center mb-1"><h3 style="color: #766dfc !important;" class="mb-1">Data</h3></div><table class="table"><thead><tr><th style="color: #766dfc !important;">No. of Houses</th><th style="color: #766dfc !important;">' +
                        response.house +
                        '</th></tr><tr><th style="color: #766dfc !important;">No. of Shops</th><th style="color: #766dfc !important;">' +
                        response.shop +
                        '</th></tr><tr><th style="color: #766dfc !important;">Educational Institutes</th><th style="color: #766dfc !important;">' +
                        response.school +
                        '</th></tr><tr><th style="color: #766dfc !important;">No. of Parks</th><th style="color: #766dfc !important;">' +
                        response.park + '</th></tr></table>'
                    );
                    hideBlockUI();
                    // if(layer.isPopupOpen() == false) {
                    //     layer.bindPopup(
                    //         '<div class="text-center mb-1"><h3 style="color: #766dfc !important;" class="mb-1">Data</h3></div><table class="table"><thead><tr><th style="color: #766dfc !important;">No. of Houses</th><th style="color: #766dfc !important;">' +
                    //         response.house +
                    //         '</th></tr><tr><th style="color: #766dfc !important;">No. of Shops</th><th style="color: #766dfc !important;">' +
                    //         response.shop +
                    //         '</th></tr><tr><th style="color: #766dfc !important;">Educational Institutes</th><th style="color: #766dfc !important;">' +
                    //         response.school +
                    //         '</th></tr><tr><th style="color: #766dfc !important;">No. of Parks</th><th style="color: #766dfc !important;">' +
                    //         response.park + '</th></tr></table>'
                    //     );
                    // } else {
                    //     layer.unbindPopup();
                    //     console.log('else', layer.unbindPopup());
                    // }
                    // layer.setStyle({
                    //     fillColor: '#766dfc',
                    //     fillOpacity: 1
                    // });

                    // toastr.success(response
                    //     .message,
                    //     "Area Selected!", {
                    //         showMethod: "slideDown",
                    //         hideMethod: "slideUp",
                    //         timeOut: 2e3,
                    //         closeButton: !0,
                    //         tapToDismiss: !1,
                    //     });
                } else {
                    setTimeout(() => {
                        hideBlockUI();
                    }, 4000);
                    Swal.fire({
                        icon: 'question',
                        title: 'Warning',
                        text: 'Something Went Wrong!',
                    });
                }
            },
            error: function(response) {
                setTimeout(() => {
                    hideBlockUI();
                }, 4000);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An Error Occured!',
                });
            }
        });
    }
    // GeoJson End

    FilePond.registerPlugin(FilePondPluginImagePreview);

    FilePond.create(document.getElementById('pm_attachments'), {
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

    FilePond.create(document.getElementById('vm_attachments'), {
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

                        location_id.map(function(extract_locations) {
                            multiple_selected_map_ids.push(+extract_locations);
                            $.each(multiple_selected_map_ids, function(index, element) {
                                if ($.inArray(element, unique_map_ids) === -1) {
                                    unique_map_ids.push(JSON.parse(element));
                                }
                            });
                        })

                        // Reset Style of Layers
                        var filterdLayers = [];
                        unique_map_ids.map((map_id) => {
                            // console.log('AllLayers', AllLayers[0].feature.id)
                            let layer = AllLayers.find((item) => item.feature.id == map_id);
                            filterdLayers.push(layer);
                        });
                        filterdLayers.map((layer) => {
                            layer.setStyle({
                                fillColor: '#aea9f5',
                                fillOpacity: 0.6
                            });
                        });

                        // Convert the string array to an integer array (location_id Array)
                        const convertedLocationArrayToString = convertStringArrayToIntArray(
                            location_id);
                        // Find Intersection of Array location_id and unique_map_ids
                        const filteredArrayLocatioIdAndUniqueMapIds = findIntersection(
                            unique_map_ids, convertedLocationArrayToString);

                        // Change Layer to selected
                        var removedFilterdLayers = [];
                        filteredArrayLocatioIdAndUniqueMapIds.map((map_id) => {
                            // console.log('AllLayers', AllLayers[0].feature.id)
                            let layer = AllLayers.find((item) => item.feature.id == map_id);
                            removedFilterdLayers.push(layer);
                        });
                        removedFilterdLayers.map((layer) => {
                            layer.setStyle({
                                fillColor: '#766dfc',
                                fillOpacity: 1
                            });
                        });

                        // Updation Data on quotation and pdf
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

                        // Remove layer style if location_id array is blank
                        var removedFilterdLayers = [];
                        unique_map_ids.map((map_id) => {
                            // console.log('AllLayers', AllLayers[0].feature.id)
                            let layer = AllLayers.find((item) => item.feature.id == map_id);
                            removedFilterdLayers.push(layer);
                        });
                        removedFilterdLayers.map((layer) => {
                            layer.setStyle({
                                fillColor: '#aea9f5',
                                fillOpacity: 0.6
                            });
                        });

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

    // Function to convert a string array to an integer array
    function convertStringArrayToIntArray(strArray) {
        // Use map to convert each element to an integer using parseInt
        const intArray = strArray.map(element => parseInt(element, 10));
        return intArray;
    }

    // Intersection of Array unique_map_ids and location_id
    function findIntersection(arr1, arr2) {
        // Use Set to store unique elements of the first array
        const set = new Set(arr1);
        // Use filter to keep only the elements present in both arrays
        const intersection = arr2.filter(element => set.has(element));
        unique_map_ids.length = 0;
        Array.prototype.push.apply(unique_map_ids, intersection);
        return intersection;
    }

    // function removeStyle

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

                        $('#modal_route').html(routes).trigger('change');
                        $('#pdf_routes').val(routes).trigger('change');
                    } else {
                        hideBlockUI();
                        $('#no_of_cars').val('').trigger('change');

                        $('#modal_route').empty().trigger('change');
                        $('#pdf_routes').val('').trigger('change');
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
                        // $.number( totalPrice );
                        // console.log(totalPrice);

                        // console.log(rate, vehicles, totalPrice, duration);
                        $('#vmQuality').val(response.quality).trigger('change');
                        // $('#sides').val(response.sideToPrint).trigger('change');
                        $('#vmPrice').val(totalPrice).trigger('change');
                        // Change Values on Quotation

                        $('#modal_paper_type').html(typeName).trigger('change');
                        $('#pdf_paper_type').val(typeName).trigger('change');
                        $('#car_modal_duration').html(duration).trigger('change');
                        $('#pdf_duration').val(duration).trigger('change');
                        $('#modal_no_of_cars').html(vehicles).trigger('change');
                        $('#pdf_cars').val(vehicles).trigger('change');
                        $('#modal_total_price').html(totalPrice).trigger('change');
                        $('#pdf_price').val(totalPrice).trigger('change');
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
