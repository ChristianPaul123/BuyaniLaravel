<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$requiredType): Response
    {
        $user = Auth::guard('admin')->user();

        if (!$user || $user->admin_type != $requiredType) {
            return redirect()->route('admin.index')->with('error', 'You are not authorized to access this page');
        }

        return $next($request);
    }
}
