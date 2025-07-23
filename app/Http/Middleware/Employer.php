<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

use function PHPUnit\Framework\isNull;

class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (is_null(auth()->user()) || auth()->user()->role !== 'corporate') {
            return redirect()->route('login')->with('errors', 'You are not logged in to access this resource');
        }else{
            return $next($request);
        }
    }
}
