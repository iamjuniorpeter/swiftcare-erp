<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>DHML-IHMS Portal® | Error 404</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('@assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('@assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('@assets/css/plugins.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ asset('@assets/css/pages/error/style-400.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="error404 text-center">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mr-auto mt-5 text-md-left text-center">
                <a href="{{ URL::previous() }}" class="ml-md-5">
                    <img alt="image-404" src="{{ asset('@assets/img/images.png') }}" class="theme-logo">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">404</h1>
            <p class="mini-text">Ooops!</p>
            <p class="error-text mb-4 mt-1">The page you requested was not found!</p>
            <a href="javascript:void(0)" onclick="goBackTwoPages()" class="btn btn-primary mt-5">Go Back</a>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('@assets/js/libs/jquery-3.1.1.min.js') }}">
    </script>
    <script src="{{ asset('@assets/bootstrap/js/popper.min.js') }}">
    </script>
    <script src="{{ asset('@assets/bootstrap/js/bootstrap.min.js') }}">
    </script>
    <script>
        function goBackTwoPages() {
            // Go back two pages in the user's history
            history.go(-2);
        }
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>

</html>