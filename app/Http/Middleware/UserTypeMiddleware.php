<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $requiredType): Response
    {

        $user = Auth::guard('user')->user();

        if (!$user || $user->user_type != $requiredType) {
            return redirect()->route('user.index')->with('error', 'You are not authorized to access this page');
        }

        return $next($request);
    }
}
