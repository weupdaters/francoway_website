<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        /**
         * 1️⃣ User login hai ya nahi
         */
        if (!auth()->check()) {
            // Laravel default login route
            return redirect()->route('login');
        }

        /**
         * 2️⃣ User object safety check
         */
        $user = auth()->user();

        if (!$user || !isset($user->role)) {
            abort(403, 'Unauthorized');
        }

        /**
         * 3️⃣ Role match check
         */
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized access');
        }

        /**
         * 4️⃣ Sab sahi → request allow
         */
        return $next($request);
    }
}
