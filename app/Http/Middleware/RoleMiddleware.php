<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (auth()->check()) {
            $userRoles = auth()->user()->roles;

            if ($userRoles == $roles) {
                return $next($request);
            } elseif ($userRoles == '1') {
                return redirect()->route('rektor.dashboard');
            } elseif ($userRoles == '2') {
                return redirect()->route('operator.dashboard');
            }
        }

        return redirect()->back();
    }
}
