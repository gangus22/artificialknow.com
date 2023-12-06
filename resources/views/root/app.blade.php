@php
    use App\Models\Page;
    use App\DTOs\MetaDataDTO;

    /** @var Page $pageFromLaravel */
    $pageFromLaravel = app()->make(Page::class);
    $metaData = MetaDataDTO::from($pageFromLaravel->meta);
@endphp

        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @if(!$pageFromLaravel->indexed)
        <meta name="robots" content="noindex">
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaData->metaDescription }}">

    <meta property="og:title" content="{{ $metaData->ogTitle  }}"/>
    <meta property="og:description" content="{{ $metaData->ogDescription }}"/>
    <meta property="og:image" content="{{ $metaData->ogImage }}"/>

    <title>{{ $pageFromLaravel->title_tag }} | ArtificialKnow</title>
    <link rel="icon" href="{{ url('favicon.png') }}">

    @viteReactRefresh
    @vite('resources/css/tailwind.css')
    @vite('resources/ts/inertia-app.tsx')
    @inertiaHead
</head>
<body class="bg-white">
@inertia
</body>
</html>
