<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $site_name }} | {{ $title }}</title>

    <x-layouts.style />
    {{ $styles }}

</head>

<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <x-layouts.navbar />

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">
        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <x-layouts.sidebar :menutitle="strtolower($menutitle)" />

        {{-- Specific page content --}}
        {{ $slot }}

    </div>
    <!-- END MAIN CONTAINER -->

    <x-layouts.script />
    {{ $scripts }}
    <x-flash-message />

    <div class="modal fade" id="contactAdminModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">🔒 Access Required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    This feature is not available on your current access level. <br/><br/>
                    To request access or learn more about enabling this functionality, please contact your system administrator.<br/><br/>
                    <b>admin@swiftcaredistributions.com</b>
                </div>
                <div class="modal-footer">
                    <button class="btn modal-close-btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>