<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(\Auth::guard('staff')->check() && (\Auth::guard('staff')->user()->role == 1 || \Auth::guard('staff')->user()->role == 2)) {
            return $next($request);
        }

        return redirect()->route('login');
        
    }
}
