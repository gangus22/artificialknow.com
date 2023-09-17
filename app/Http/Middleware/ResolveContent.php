<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ArticleController;
use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class ResolveContent
{
    /**
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = str($request->path())->explode('/')->last();

        /** @var Page $page */
        $page = Page::query()
            ->where('path', '=', $path)
            ->get()
            ->firstWhere('url', '=', $request->path());

        if ($page === null) {
            return $next($request);
        }

        app()->instance(Page::class, $page);

        Route::middleware('web')->get(str($page->url)->prepend('/')->toString(), ArticleController::class);

        return $next($request);
    }
}
