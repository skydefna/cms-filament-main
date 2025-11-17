<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && ! config('app.debug') && config('app.env') == 'production') {
            // Check if password change is required
            $user = Auth::user();
            if (! $user->has_change_password) {
                if ($request->path() == 'admin/change-password') {
                    return $next($request);
                }

                return redirect('/admin/change-password');
            }
        }

        return $next($request);
    }
}
