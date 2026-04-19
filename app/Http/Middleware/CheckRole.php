<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        if (!$request->user() || !in_array($request->user()->role, $roles)) {
            // Kalau request API → return JSON
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Role tidak sesuai.',
                ], 403);
            }

            // Kalau request Web → abort 403
            abort(403, 'Akses ditolak. Role tidak sesuai.');
        }

        return $next($request);
    }
}
