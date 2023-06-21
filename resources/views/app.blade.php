@php
    //TODO: remove robots noindex when production ready
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="robots" content="noindex">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ArtificialKnow</title>

        @viteReactRefresh
        @vite('resources/css/tailwind.css')
        @vite('resources/ts/app.tsx')

        @php($page ??= [])
        @inertiaHead
    </head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BNLK3BR63Q"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-BNLK3BR63Q');
    </script>
    <body>
        @inertia
        @yield('bodyContent')
    </body>
</html>
