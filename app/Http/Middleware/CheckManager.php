<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckManager
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::user()->role !== 'Manager') {
            return redirect('/');
        }

        return $next($request);
    }
}
?>