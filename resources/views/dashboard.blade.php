<x-layouts.master title="Dashboard" menutitle="dashboard">

    {{-- PAGE LEVEL STYLES --}}
    <x-slot name="styles">
        <link href="{{ asset('@assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('@assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    </x-slot>
    {{-- END PAGE LEVEL STYLES --}}

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mt-5 ml-5">
                        <div class="card">

                            <div class="card-body">
                                <h1 class="text-center">
                                    <span class="greeting"></span>
                                    {{ Auth::user()->profile->surname }} {{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->other_names }} <br /><br /><br />

                                </h1>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

    {{-- PAGE LEVEL SCRIPTS --}}
    <x-slot name="scripts">
        {{--<script src="{{ asset('@assets/plugins/apex/apexcharts.min.js') }}"></script>
        <script src="{{ asset('@assets/js/dashboard/dash_1.js') }}"></script>--}}
        <script>
            $(document).ready(function() {
                var thehours = new Date().getHours();
                var themessage;
                var morning = ('Good morning');
                var afternoon = ('Good afternoon');
                var evening = ('Good evening');

                if (thehours >= 0 && thehours < 12) {
                    themessage = morning;

                } else if (thehours >= 12 && thehours < 17) {
                    themessage = afternoon;

                } else if (thehours >= 17 && thehours < 24) {
                    themessage = evening;
                }

                $('.greeting').append(themessage);
            });
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}

</x-layouts.master>