<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('user') && $request->session()->get('user')->role->role === 'Admin') {
            Log::info($request->ip() . ' approached Admin page');
            return $next($request);
        }

        Log::warning($request->ip() . ' tried approaching Admin page without permissions!');
        return redirect()->route('cars.index')->with('error', 'Your account doesnt have admin privileges.');

    }
}
