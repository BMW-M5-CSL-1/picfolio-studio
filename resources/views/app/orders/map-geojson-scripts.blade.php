<script>
    'use strict';

    (function() {
        var geoJsonMap = L.map('geoJson').setView([33.6899, 73.0129], 1);

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
            //bind click
            layer.on({
                click: whenClicked
            });
        }

        function whenClicked(e) {
            const layer = e.target;
            var location_id = layer.feature.id;

            layer.unbindPopup();

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
                        hideBlockUI();
                        layer.bindPopup(
                            '<div class="text-center mb-1"><h3 style="color: #766dfc !important;" class="mb-1">Data</h3></div><table class="table"><thead><tr><th style="color: #766dfc !important;">No. of Houses</th><th style="color: #766dfc !important;">' +
                            response.house +
                            '</th></tr><tr><th style="color: #766dfc !important;">No. of Shops</th><th style="color: #766dfc !important;">' +
                            response.shop +
                            '</th></tr><tr><th style="color: #766dfc !important;">Educational Institutes</th><th style="color: #766dfc !important;">' +
                            response.school +
                            '</th></tr><tr><th style="color: #766dfc !important;">No. of Parks</th><th style="color: #766dfc !important;">' +
                            response.park + '</th></tr></table>'
                        );
                        layer.setStyle({
                            fillColor: '#766dfc',
                            fillOpacity: 1
                        });

                        toastr.success(response
                            .message,
                            "Area Selected!", {
                                showMethod: "slideDown",
                                hideMethod: "slideUp",
                                timeOut: 2e3,
                                closeButton: !0,
                                tapToDismiss: !1,
                            });
                    } else {
                        Swal.fire({
                            icon: 'question',
                            title: 'Warning',
                            text: 'Something Went Wrong!',
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An Error Occured!',
                    });
                }
            });
        }
    })();
</script>
