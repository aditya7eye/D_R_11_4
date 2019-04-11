<?php

namespace App\Http\Middleware;

use Closure;

class CheckStoreSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('store')) {
            // user value cannot be found in session
            return redirect('/login_store');
        }
        return $next($request);
    }
}
