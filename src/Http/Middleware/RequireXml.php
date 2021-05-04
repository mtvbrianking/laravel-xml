<?php

namespace Bmatovu\LaravelXml\Http\Middleware;

use Closure;

class RequireXml
{
    /**
     * Handle an incoming request.
     *
     * @see https://stackoverflow.com/a/11973933/2732184
     *
     * @param \Illuminate\Http\Request $request
     * @param null|string              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ('xml' !== $request->getContentType()) {
            return response()->xml(['error' => 'Only accepting xml content'], 415);
        }

        return $next($request);
    }
}
