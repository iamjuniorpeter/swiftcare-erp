<link rel="icon" type="image/x-icon" href="{{ asset('@assets/img/favicon.ico') }}" />

<link href="{{ asset('@assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('@assets/js/loader.js') }}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{ asset('@assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
{{-- snackbar --}}
<link href=" {{ asset('@assets/plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('@assets/plugins/sweetalerts/promise-polyfill.js') }}"></script>
<link href="{{ asset('@assets/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
<link href="{{ asset('@assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('@assets/plugins/tagInput/tags-input.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ asset('@assets/plugins/loaders/custom-loader.css') }}" rel="stylesheet" type="text/css" /> --}}

<link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('@assets/assets/css/forms/theme-checkbox-radio.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/table/datatable/custom_dt_custom.css') }}">
<style>
    .tags-input-wrapper input {
        margin: 0 auto;
    }
</style>

<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

<style>
    .btn-group>.btn-group:not(:first-child),
    .btn-group>.btn:not(:first-child) {
        margin-left: -6px;
    }
</style>