<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        $routeName = $request->route()->getName();
        $permissions = config('role_permissions');

        if (isset($permissions[$user->role]) && in_array($routeName, $permissions[$user->role])) {
            return $next($request);
        }

        abort(403, 'Bạn không có quyền truy cập chức năng này');

    }
}
