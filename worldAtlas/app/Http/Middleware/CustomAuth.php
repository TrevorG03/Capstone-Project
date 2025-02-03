<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CustomAuth
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('loginId')) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Please authenticate first.'
            ]);
        }
        return $next($request);
    }
}