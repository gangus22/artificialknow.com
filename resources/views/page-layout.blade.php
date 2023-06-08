@extends('app')

@section('bodyContent')
    <div class="h-full w-full py-5 main-page-bg-gradient">
        <div class="mx-auto mb-5 rounded-lg border border-slate-700 w-[95%]">
            <x-layout-navbar />
        </div>
        <div class="container mx-auto rounded-lg bg-white/30 backdrop-blur-sm">
            <div class="flex flex-col items-center gap-y-4 p-5">
                <div class="rounded-lg border border-slate-700 p-4 bg-primary-400">
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
        </div>
        <div class="mx-auto my-5 h-screen w-full rounded-lg border border-slate-700">
            footer placeholder
        </div>
    </div>
@endsection
