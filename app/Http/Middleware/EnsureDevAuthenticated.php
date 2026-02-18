<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureDevAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('is_developer')) {
            return redirect()->route('dev.login');
        }

        return $next($request);
    }
}
