<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ArtificialKnow</title>
        @viteReactRefresh
        @vite('resources/ts/app.tsx')
        @vite('resources/css/tailwind.css')
    </head>
    <body>
        <div class="flex flex-col items-center gap-y-4 p-5">
            <div class="rounded-lg border border-slate-700 bg-emerald-400 p-4">
                I'm nice and green, because TailwindCSS works now.
            </div>
            <div id="react-root"></div>
        </div>
    </body>
</html>
