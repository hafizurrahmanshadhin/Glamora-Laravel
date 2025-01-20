<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AllowBeautyExpertMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'beauty_expert') {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
