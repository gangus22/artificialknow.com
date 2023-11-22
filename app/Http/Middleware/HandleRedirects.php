<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleRedirects
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        /** @var Redirect|null $outBoundRedirect */
        $outBoundRedirect = Redirect::query()->firstWhere('from', '=', $path);

        if ($outBoundRedirect !== null) {
            return response()->redirectTo($outBoundRedirect->to, $outBoundRedirect->type->value);
        }

        return $next($request);
    }
}
