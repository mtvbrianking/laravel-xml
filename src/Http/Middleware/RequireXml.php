<?php

namespace Bmatovu\LaravelXml\Http\Middleware;

use Bmatovu\LaravelXml\LaravelXml;
use Closure;

class RequireXml
{
    /**
     * Handle an incoming request.
     *
     * @see https://stackoverflow.com/a/11973933/2732184
     *
     * @param \Illuminate\Http\Request $request
     * @param bool                     $isValidXml
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $isValidXml = false)
    {
        if ('xml' !== $request->getContentType()) {
            return response()->xml(['message' => 'Only accepting content of type XML.'], 415);
        }

        if ($isValidXml && $request->getContent() && ! LaravelXml::is_valid($request->getContent())) {
            return response()->xml(['message' => 'The given data was malformed.'], 400);
        }

        return $next($request);
    }
}
