<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->withErrors([
                'session' => 'Your session has expired. Please login again.'
            ]);
        }

        // Validate last activity
        $lastActivity = Session::get('last_activity');
        if (now()->diffInMinutes($lastActivity) > 30) {
            Session::flush();
            return redirect()->route('login')->withErrors([
                'session' => 'Session expired due to inactivity'
            ]);
        }

        // Update activity timestamp
        Session::put('last_activity', now());

        return $next($request);
    }
}