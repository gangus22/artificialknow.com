<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class ResolveContent
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // TODO: alternatively, try to resolve the page with one big query, compare the query logs to see which one's faster
        $path = str($request->path())->explode('/')->last();

        /** @var Page $page */
        $page = Page::query()
            ->where('path', '=', $path)
            ->get()
            ->firstWhere('url', '=', $request->path());

        if ($page === null) {
            abort(404);
        }

        app()->instance(Page::class, $page);

        // TODO: register route, and add a controller that handles displaying of content
        // Route::bind(str($page->url)->prepend('/'), Controller);

        return $next($request);
    }
}
