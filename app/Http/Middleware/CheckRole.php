<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 2) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
