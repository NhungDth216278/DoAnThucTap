<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'user')
                return redirect()->route('home.index'); // Chuyển hướng đến trang chủ
            else
                return redirect()->route('admin.index'); // Chuyển hướng đến trang admin
        }

        return $next($request);
    }
}
