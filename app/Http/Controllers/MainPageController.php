<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MainPageController extends Controller
{
    public function __invoke(): View
    {
        return view('page-layout');
    }
}
