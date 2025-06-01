<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('@assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('@assets/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('@assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('@assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script src="{{ asset('@assets/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>

<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
{{-- snackbar --}}
<script src="{{ asset('@assets/plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="{{ asset('@assets/js/scrollspyNav.js') }}"></script>

<script src="{{ asset('@assets/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('@assets/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('@assets/plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('@assets/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('@assets/plugins/blockui/custom-blockui.js') }}"></script>

<script src="{{ asset('@assets/plugins/highlight/highlight.pack.js') }}"></script>
<script src="{{ asset('@assets/js/custom.js') }}"></script>
<script>
    showModal(".contact-admin", "#contactAdminModal")
</script>