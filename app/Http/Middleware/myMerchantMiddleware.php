<?php

namespace App\Http\Middleware;

use Closure;

class myMerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        $merchants = $request->user()->merchants()->get();

        dd($merchants);
        return $next($request);
    }
}
