@extends('root.app')

@section('bodyContent')
    <div class="h-full w-full py-5 main-page-bg-gradient">
        <div class="sticky top-4 z-50 mx-auto mb-5 w-[95%]">
            <x-layout-navbar/>
        </div>
        <div class="container mx-auto rounded-2xl bg-white/30 backdrop-blur-sm">
            <div class="flex flex-col items-center gap-y-4 p-5">
                <div class="rounded-lg border border-slate-700 p-4 bg-primary-400">
                    I'm nice and green, because TailwindCSS works now.
                </div>
                @php($example = \App\Models\Example::all()->first())
                <div class="rounded-lg border border-slate-700 p-4 bg-secondary-400">
                    {{$example?->test_data}}
                </div>
            </div>
        </div>
        <div class="mx-auto my-5 h-screen w-full rounded-lg border border-slate-700">
            footer placeholder
        </div>
    </div>
@endsection
