<?php

namespace Bmatovu\LaravelXml\Http\Middleware;

use Closure;

class RequireXml
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->header('Accept') != 'text/xml') {
            return response()->xml(['error' => 'Only accepting text/xml'], 406);
        }

        return $next($request);
    }

}