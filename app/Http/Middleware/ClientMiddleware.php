<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response {
        if (Auth::check()) {
            if (Auth::user()->role === 'client') {
                return $next($request);
            } elseif (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('beauty-expert-dashboard');
            }
        }

        return redirect()->route('login');
    }
}
