<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="robots" content="noindex">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArtificialKnow Login </title>
    @vite('resources/css/tailwind.css')
</head>
<body>
    <div class="flex h-screen w-screen flex-col items-center justify-center bg-gradient-to-bl from-slate-800 from-50% to-secondary-900">
        <form method="POST"
              action="/login"
              class="flex flex-col items-center gap-y-8 rounded-2xl border-2 border-slate-900 bg-slate-400 p-5 w-[20%]">
            @csrf
            <label>
                <input name="username"
                       type="text"
                       class="w-full rounded-2xl border-2 border-slate-900 bg-slate-300"
                       placeholder="Username">
            </label>
            <label>
                <input name="password"
                       type="password"
                       class="w-full rounded-2xl border-2 border-slate-900 bg-slate-300"
                       placeholder="Password">
            </label>
            <input type="submit"
                   class="cursor-pointer rounded-2xl border-2 border-slate-900 p-2 bg-secondary-400">
            @if($errors->any())
                <div class="rounded-2xl border-2 border-slate-900 p-2 text-red-800 bg-red-400/50">
                    Access denied.
                </div>
            @endif
        </form>
    </div>
</body>
</html>
