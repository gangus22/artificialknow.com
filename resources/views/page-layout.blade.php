@extends('app')

@section('bodyContent')
    <div class="h-full h-screen w-full bg-gradient-to-br bg-no-repeat from-secondary-50 via-70% via-primary-200 to-secondary-100">
        <div class="mx-auto my-5 w-full rounded-lg border border-slate-700 w-[95%]">
            navbar placeholder
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
        <div class="mx-auto my-5 w-full h-screen rounded-lg border border-slate-700 ">
            footer placeholder
        </div>
    </div>
@endsection
