<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('pageTitle')</title>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logoUPB.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    @livewireStyles
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class="antialiased">
    <div class="page">
        <!-- Navbar -->
        @include('layouts.inc.header')
        <!-- Navbar -->
        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    {{ $slot }}
                </div>
            </div>
            {{-- footer --}}
            @include('layouts.inc.footer')
            {{-- footer --}}
        </div>
    </div>

    <script src="{{ asset('assets/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/lucide.min.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>
    @livewireScripts

    @stack('javascript')
</body>

</html>
