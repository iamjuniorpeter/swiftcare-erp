<x-layouts.pre-master title="Login" menu_title="Login">
    {{-- PAGE LEVEL STYLES --}}
    <x-slot name="styles">
        <link href="{{ asset('@assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/css/forms/theme-checkbox-radio.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/css/forms/switches.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/loaders/custom-loader.css') }}" />
        <style>
            @media (min-width: 768px) {
                .mobile-only {
                    display: none;
                }
            }
        </style>
    </x-slot>
    {{-- END PAGE LEVEL STYLES --}}

    <!--  BEGIN CONTENT AREA  -->
    <div class=" form-container">
        <div class="form-image">
            <div class="l-image">
                <img src="{{ asset('@assets/img/logo.png') }}" class="centered-image" />
                <!-- <h1 class="centered-text dhml">Swift Care Distribution</h1> -->
                <h3 class="centered-text text-white mt-5">ERP Solution</h3>
            </div>
        </div>
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container" >
                    <div class="form-content text-center">
                        <!-- <div style="background-color: #9a1b2e; width:100%; border:1px solid red;">
                            <img src="{{ asset('@assets/img/logo.png') }}" class="centered-image mobile-only" style="width:200px; height:200px;" />
                        </div> -->
                        <h1><a href=""><span class="brand-name">SwiftCare Distribution</span></a></h1>
                        <br>
                        <h5>Log into your account:</h5>
                        <form class="text-left" method="POST" action="{{ route('authenticate') }}" name="frmLogin" id="frmLogin">
                            @csrf
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username" />
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" />
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Show Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <div class="loader dual-loader mx-auto" style="display:none" id="loginLoader"></div>
                                        <button type="submit" class="btn btn-danger" style="background-color: #9a1b2e;" id="btnLogin" name="btnLogin" value="">Log In</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions">Copyright &copy; {{ now()->format('Y') }} All Rights Reserved. <br />
                            <a href="">SwiftCare Distribution</a> <br />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

    {{-- PAGE LEVEL SCRIPTS --}}
    <x-slot name="scripts">
        <script src="{{ asset('@assets/js/authentication/form-1.js') }}"></script>
        <script>
            login();
        </script>
    </x-slot>
    {{-- END PAGE LEVEL SCRIPTS --}}
</x-layouts.pre-master>