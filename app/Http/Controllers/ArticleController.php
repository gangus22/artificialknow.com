<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __invoke(Page $page): JsonResponse
    {
        // TODO: show actual article page
        return response()->json(json_decode($page->content->article), options: JSON_PRETTY_PRINT);
    }
}
