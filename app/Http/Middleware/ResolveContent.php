<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ArticleController;
use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ResolveContent
{
    /**
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        /** @var Page $page */
        $page = Page::query()
            ->with('cluster')
            ->firstWhere('url', '=', $path);

        if ($page === null) {
            return $next($request);
        }

        app()->instance(Page::class, $page);

        if ($page->is_splash_page) {
            return $next($request);
        }

        Route::middleware('web')->get(Str::start($page->url, '/'), ArticleController::class);

        return $next($request);
    }
}
