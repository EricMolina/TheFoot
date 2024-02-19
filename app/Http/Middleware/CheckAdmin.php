<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::user()->role !== 'Administrator') {
            return redirect('restaurants');
        }

        return $next($request);
    }
}
?>