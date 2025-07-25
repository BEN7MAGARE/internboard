<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class College
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            if (auth()->user()->role !== 'college' && auth()->user()->college_id === null) {
                return redirect()->route('login')->with('errors', 'You are not authorised to access this resource');
            }
            return $next($request);
        }
        return redirect()->route('login')->with('errors', 'You are not authorised to access this resource');
    }
}
