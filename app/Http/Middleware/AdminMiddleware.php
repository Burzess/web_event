<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Super Admin') {
            return $next($request);
        }

        return redirect('/admin/login')->withErrors('Anda tidak memiliki akses ke halaman ini.');
    }
}

