<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $site_name }} | {{ $title }}</title>
    <x-layouts.style />
    {{ $styles }}
    
</head>

<body class="form">

    {{ $slot }}

    <x-layouts.script />
    {!! $scripts !!}
    <x-flash-message />

</body>
</html>