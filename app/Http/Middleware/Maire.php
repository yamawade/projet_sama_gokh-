<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Maire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('mairie')->check()) {
            dd('ok c fait');
            return $next($request);
        } else if (Auth::guard('web')->check()) {
            dd('enfoirer');
            return $next($request);
        } else {
            return abort('404');
        }
    }
}
