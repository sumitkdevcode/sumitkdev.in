<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * Sets Cache-Control headers for public GET requests to enable
     * browser caching (60s) and CDN/proxy caching (5min).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $maxAge  Browser cache duration in seconds
     * @param  int  $sMaxAge  CDN/proxy cache duration in seconds
     * @return mixed
     */
    public function handle(Request $request, Closure $next, int $maxAge = 60, int $sMaxAge = 300)
    {
        $response = $next($request);

        // Only cache GET requests
        if (!$request->isMethod('GET')) {
            return $response;
        }

        // Don't cache if user is authenticated (admin pages)
        if ($request->user()) {
            return $response;
        }

        // Don't cache responses with flash data (form submissions)
        if (session()->has('success') || session()->has('error')) {
            return $response;
        }

        $response->headers->set('Cache-Control', "public, max-age={$maxAge}, s-maxage={$sMaxAge}");
        $response->headers->set('Vary', 'Accept-Encoding, X-Requested-With, X-SPA-Request');

        return $response;
    }
}
