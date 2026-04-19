<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'photographer' && $user->is_banned) {
            return redirect()->route('banned')->with('banned_reason', $user->banned_reason);
        }

        return $next($request);
    }
}
