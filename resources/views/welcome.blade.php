<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            //TODO: remove robots noindex when production ready
        @endphp
        <meta name="robots" content="noindex">

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
            <div class="rounded-lg border border-slate-700 bg-amber-400 p-4">
                @php
                    use \App\Models\Example;
                    /** @var Example $exampleModel */
                    $exampleModel = Example::all()->first();
                    echo $exampleModel->test_data;
                @endphp
            </div>
        </div>
    </body>
</html>
