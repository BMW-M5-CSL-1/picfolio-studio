<script>
    function edit_order($id) {
        showBlockUI();
        setTimeout(function() {
            hideBlockUI();
        }, 4000);
        location.href = ("{{ route('orders.edit', ['id' => ':id']) }}").replace(':id', $id);
    }

    function preview_order($id) {
        showBlockUI();
        setTimeout(function() {
            hideBlockUI();
        }, 4000);
        location.href = ("{{ route('orders.show', ['id' => ':id']) }}").replace(':id', $id);
    }

    // Action buttons
    function action_buttons($id) {
        $('#loader_' + $id).show();
        $('#dropDownMenu_' + $id).empty()
        $.ajax({
            type: 'post',
            url: "{{ route('orders.ajax-action-buttons', ['id' => ':id']) }}".replace(':id', $id),
            // data: $('#floor_form').serialize(),
            success: function(data) {
                $('#dropDownMenu_' + $id).html(data)
                $('#loader_' + $id).hide();
                // console.log(data);
            },
            error: function(data) {
                $('#loader_' + $id).hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!',
                });
            }
        });
    }

    $(document).on('click', '.detailsModal', function(e) {
        id = $(this).data('id');
        type = $(this).attr('data-modaltype');
        $('#modalBody').html('');
        $.ajax({
            type: "POST",
            url: "{{ route('orders.ajax-get-details') }}",
            data: {
                id: id,
                type: type,
            },
            dataType: 'json',
            success: function(response) {
                $('#modalBody').html(response.view);
            },
            error: function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!',
                });
            }
        });
    });

    function confirmOrder($id) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Are You Sure ?',
            showCancelButton: true,
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes',
            confirmButtonClass: 'btn-success',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            showBlockUI();
            if (result.isConfirmed) {
                let url = "{{ route('orders.ajax-confirm-order', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'id': $id,
                    },
                    dataType: "json",
                    success: function(response) {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);
                        if (response.success == true) {
                            toastr.success(response
                                .message,
                                "Order Confirmed!", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }

    function partial_paid($id) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Are You Sure ?',
            showCancelButton: true,
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes, Partial Paid',
            confirmButtonClass: 'btn-success',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            showBlockUI();
            if (result.isConfirmed) {
                let url = "{{ route('orders.ajax-partial-paid-order', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'id': $id,
                    },
                    dataType: "json",
                    success: function(response) {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);
                        if (response.success == true) {
                            toastr.success(response.message,
                                'Order "' + response.order_no + '"' + " Partial Paid!", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }

    function paid($id) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Are You Sure ?',
            showCancelButton: true,
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes, Paid',
            confirmButtonClass: 'btn-success',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            showBlockUI();
            if (result.isConfirmed) {
                let url = "{{ route('orders.ajax-paid-order', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'id': $id,
                    },
                    dataType: "json",
                    success: function(response) {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);
                        if (response.success == true) {
                            toastr.success(response
                                .message,
                                'Order "' + response.order_no + '"' + " Paid!", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }

    function printOrder($id) {
        Swal.fire({
            icon: 'question',
            html: '<h2 class="swal2-title mb-0">Distribute</h2><p style=>Select Printeing Press & Enter Details</p><select id="printingPress" name="printingPress" class="mx-2 select2 form-select mb-1" required>@foreach ($printers as $printer)<option value="{{ $printer->id }}">{{ $printer->name }}</option>@endforeach</select><input class="form-control mt-2" type="number" name="price" id="price" placeholder="Enter Amount"><textarea id="printingDetails" name="printingDetails" class="mt-2 form-control" placeholder="Enter Details For Printing Press." required></textarea>',
            // title: 'Print',
            // text: '<p>Do You Want To Print This Order ?</p>',
            icon: 'question',
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes, Print',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
            },
            didOpen: function() {
                $('#printingPress').wrap('<div class="position-relative"></div>').select2({});
            }
        }).then((result) => {
            showBlockUI();
            if (result.isConfirmed) {
                var printingDetails = $('#printingDetails').val();
                var price = $('#price').val();
                var printingPressUserId = $('#printingPress').val();
                let url = "{{ route('orders.ajax-print-order', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        id: $id,
                        printingPressUserId: printingPressUserId,
                        price: price,
                        printingDetails: printingDetails,
                    },
                    dataType: "json",
                    success: function(response) {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);
                        if (response.success == true) {
                            toastr.success(response
                                .message,
                                'Order "' + response.order_no + '"' + " Sent For Printing!", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }

    function distributeOrder($id) {
        Swal.fire({
            // title: "Select Distributors",
            html: '<h2 class="swal2-title mb-0">Distribute</h2><p style=>Select Distributors & Enter Details</p><select id="distributor" name="distributor[]" class="select2 form-select mb-1" required multiple>@foreach ($distributors as $distributor)<option value="{{ $distributor->id }}">{{ $distributor->name }}</option>@endforeach</select><input class="form-control mt-2" type="number" name="distribution_budget" id="distribution_budget" placeholder="Enter Amount"><textarea id="distributionDetails" name="distributionDetails" class="form-control mt-1" placeholder="Enter Details About Distribution." required></textarea>',
            icon: 'question',
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes, Distribute',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
            },
            didOpen: function() {
                $('#distributor').wrap('<div class="position-relative"></div>').select2({});
            }
        }).then((result) => {
            if (result.isConfirmed) {
                showBlockUI();
                var distributor = $('#distributor').val(),
                    distributionDetails = $('#distributionDetails').val(),
                    distributionBudget = $('#distribution_budget').val();
                let url = "{{ route('orders.ajax-distribute-order', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        id: $id,
                        distributor: distributor,
                        distributionDetails: distributionDetails,
                        distributionBudget: distributionBudget,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            toastr.success(response
                                .message,
                                'Order "' + response.order_no + '"' +
                                " Sent For Distribution!", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }

    function pasteOnVehicle($id) {
        showBlockUI();
        $.ajax({
            type: "post",
            url: "{{ route('orders.ajax-routes-drivers', ['id' => ':id']) }}".replace(':id', $id),
            dataType: "json",
            data: {
                'order_id': $id,
            },
            success: function(response) {
                setTimeout(function() {
                    hideBlockUI();
                }, 4000);
                var vehiclesList = response.vehicles;
                var selectData =
                    '<select id="vehicles" name="vehicles[]" class="select2 form-select mb-1" required multiple></select>',
                    budget =
                    '<input class="form-control mt-2" type="number" name="vehicle_budget" id="vehicle_budget" placeholder="Enter Amount">';

                Swal.fire({
                    html: '<h2 class="swal2-title mb-0">Paste on Vehicles</h2><p style=>Select Vehicles & Enter Details</p>' +
                        selectData + budget +
                        '<textarea id="vehicleDetails" name="vehicleDetails" class="form-control mt-1" placeholder="Enter Details About Distribution." required></textarea>',
                    icon: 'question',
                    cancelButtonText: 'No, Cancel',
                    confirmButtonText: 'Yes, Paste',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1',
                    },
                    didOpen: function() {
                        $('#vehicles').wrap('<div class="position-relative"></div>')
                            .select2({});
                        for (let i = 0; i < vehiclesList.length; i++) {
                            $('#vehicles').append(new Option(vehiclesList[i].name,
                                vehiclesList[i].id)).trigger('change');
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        showBlockUI();
                        var vehicles = $('#vehicles').val(),
                            vehicleDetails = $('#vehicleDetails').val(),
                            vehicleBudget = $('#vehicle_budget').val();
                        let url = "{{ route('orders.ajax-paste-vehicle-order', ['id' => ':id']) }}"
                            .replace(':id', $id);
                        $.ajax({
                            type: "post",
                            url: url,
                            data: {
                                id: $id,
                                vehicles: vehicles,
                                vehicleDetails: vehicleDetails,
                                vehicleBudget: vehicleBudget,
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.success == true) {
                                    setTimeout(function() {
                                        hideBlockUI();
                                    }, 4000);
                                    toastr.success(response
                                        .message,
                                        'Order "' + response.order_no + '"' +
                                        " Pasting on Vehicles!", {
                                            showMethod: "slideDown",
                                            hideMethod: "slideUp",
                                            timeOut: 2e3,
                                            closeButton: !0,
                                            tapToDismiss: !1,
                                        });
                                    $('#order-table').DataTable().ajax.reload();
                                } else {
                                    hideBlockUI();
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
                    } else {
                        hideBlockUI();
                    }
                });
            },
            error: function(error) {
                setTimeout(function() {
                    hideBlockUI();
                }, 4000);
                console.log(error);
            }
        });
    }

    function rejectOrder($id) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Are You Sure ?',
            showCancelButton: true,
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes',
            confirmButtonClass: 'btn-success',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            showBlockUI();
            if (result.isConfirmed) {
                let url = "{{ route('orders.ajax-reject-order', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'id': $id,
                    },
                    dataType: "json",
                    success: function(response) {
                        setTimeout(function() {
                            hideBlockUI();
                        }, 4000);
                        if (response.success == true) {
                            toastr.success(response
                                .message,
                                'Order "' + response.order_no + '"' + " Rejected!", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }

    function completeOrder($id) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Are You Sure ?',
            showCancelButton: true,
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes',
            confirmButtonClass: 'btn-success',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            showBlockUI();
            if (result.isConfirmed) {
                let url = "{{ route('orders.ajax-complete-order', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'id': $id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            toastr.success(response
                                .message,
                                'Order "' + response.order_no + '"' + " Completed!", {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }

    function destroy_order($id) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Are You Sure ?',
            showCancelButton: true,
            cancelButtonText: 'No, Cancel',
            confirmButtonText: 'Yes, Delete',
            confirmButtonClass: 'btn-success',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-outline-success waves-effect waves-float waves-light me-1',
                cancelButton: 'btn btn-outline-danger waves-effect waves-float waves-light me-1'
            },
            showLoaderOnConfirm: true,
        }).then((result) => {
            showBlockUI();
            if (result.isConfirmed) {
                let url = "{{ route('orders.destroy', ['id' => ':id']) }}".replace(':id', $id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'id': $id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            setTimeout(function() {
                                hideBlockUI();
                            }, 4000);
                            toastr.success(response
                                .message,
                                'Order Deleted!', {
                                    showMethod: "slideDown",
                                    hideMethod: "slideUp",
                                    timeOut: 2e3,
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                });
                            $('#order-table').DataTable().ajax.reload();
                        } else {
                            hideBlockUI();
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
            } else {
                hideBlockUI();
            }
        });
    }
</script>
