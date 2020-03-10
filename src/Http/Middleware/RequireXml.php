<?php

namespace Bmatovu\LaravelXml\Http\Middleware;

use Closure;

class RequireXml
{
    /**
     * Handle an incoming request.
     *
     * @link https://stackoverflow.com/a/11973933/2732184
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->getContentType() != 'xml') {
            return response()->xml(['error' => 'Only accepting xml content'], 415);
        }

        return $next($request);
    }
}
