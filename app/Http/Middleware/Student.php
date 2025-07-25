<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            if (auth()->user()->role !== 'student') {
                return redirect()->route('login')->with('errors', 'You are not logged in to access this resource');
            }
            return $next($request);
        }
        return redirect()->route('login')->with('errors', 'You are not logged in to access this resource');
    }
}
