<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $roleId)
    {
        $user = Auth::guard('admin')->user();

        if ($user && $user->id == $roleId) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
