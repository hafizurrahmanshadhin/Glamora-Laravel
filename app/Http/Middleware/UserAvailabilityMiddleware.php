<?php

namespace App\Http\Middleware;

use App\Services\Web\Frontend\UserAvailabilityService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAvailabilityMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response {
        // Run the user availability service to update user status
        UserAvailabilityService::run();

        return $next($request);
    }
}
