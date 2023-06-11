<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MainPageController extends Controller
{
    public function __invoke(): View
    {
        // TODO: design a proper main page
        return view('page-layout');
    }
}
