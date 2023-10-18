<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logoUPB.png') }}" type="image/x-icon">
    <title>@yield('pageTitle')</title>
    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>

    @livewireStyles
</head>

<body class=" d-flex flex-column bg-white">
    {{ $slot }}
    <script src="{{ asset('assets/js/tabler.min.js') }}" defer></script>
    @livewireScripts
</body>

</html>
