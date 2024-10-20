<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/hammer/hammer.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/i18n/i18n.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/sweetalert2/sweetalert2.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/flatpickr/flatpickr.js')) }}"></script>
{{-- CDN Filepond --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="{{ asset('assets/js/extended-ui-blockui.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>


<script>
    function showBlockUI(element = null, message = '') {
        blockUIOptions = {
            message: '<div class=" text-primary" role="status"><img src="{{ asset('assets/img/loader.gif') }}"></div><br><div class="text-primary">' +
                message + '</div>',
            css: {
                backgroundColor: 'transparent',
                border: '0'
            },
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8
            }
        };
        if (element) {
            $(element).block(blockUIOptions);
        } else {
            $.blockUI(blockUIOptions);
        }
    }

    function hideBlockUI(element = null) {
        if (element) {
            $(element).unblock();
        } else {
            $.unblockUI();
        }
    }

    function datatableCustomReload() {
        var $searchRInput = $(document).find('.dataTables_filter input');
        $.each($searchRInput, function(key, value) {
            try {
                // console.log($(value).parent());
                // $(this).blur();
                var TableId = $(this).attr('aria-controls')
                window.LaravelDataTables[TableId]['ajax'].reload(null, false)
            } catch (error) {
                $(this).blur();
                console.error("Error: " + error);
            }
        })
    }

    function fixTooltipIssue() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'));

        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'hover'
            });
        });
    }

    $(document).ajaxStop(function() {
        setTimeout(function() {
            fixTooltipIssue();
        }, 1500);
    });

    // Pusher.logToConsole = true;

    // var pusher = new Pusher('9cc37d7ad5479dc34ceb', {
    //     cluster: 'ap3'
    // });

    // var chatChannel = pusher.subscribe('chat-send');
    // chatChannel.bind('App\\Events\\ChatEvent', function(data) {
    //     alert('in');
    //     // showBlockUI('#documents-table-form');
    //     // $('#document-approval-table').DataTable().ajax.reload();
    // });
</script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/app.js')) }}"></script>
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
