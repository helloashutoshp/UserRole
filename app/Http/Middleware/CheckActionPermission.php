<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckActionPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $actionId)
    {
        $user = Auth::guard('admin')->user();

        if ($user && $user->hasAction($actionId)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
