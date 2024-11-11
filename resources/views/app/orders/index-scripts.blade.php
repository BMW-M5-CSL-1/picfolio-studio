<script>
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
            title: 'Make Payment',
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                        });
                    }
                });
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
