<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="robots" content="noindex">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArtificialKnow Login</title>
    @viteReactRefresh
    @vite('resources/css/tailwind.css')
    @vite('resources/ts/inertia-app.tsx')
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>
