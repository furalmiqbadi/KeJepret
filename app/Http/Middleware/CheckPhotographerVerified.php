<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPhotographerVerified
{
    public function handle(Request $request, Closure $next): mixed
    {
        $user = $request->user();

        if (!$user->photographerProfile || !$user->photographerProfile->isVerified()) {
            return redirect()->route('photographer.waiting');
        }

        return $next($request);
    }
}
