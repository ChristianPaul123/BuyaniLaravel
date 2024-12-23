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

        if (!$user) {
            return redirect()->route('user.index')->with('message',
                    'You are not authorized to access this page. The following could either be:<br>' .
                    '1. Your session has expired.<br>' .
                    '2. You don’t have an account.'
    );
    }

        if ($user->user_type != $requiredType) {
            if ($requiredType == 1) {
                return redirect()->route('user.farmer')->with('message', 'You are not a consumer. Only consumers can access this page.');
            } elseif ($requiredType == 2) {
                return redirect()->route('user.consumer')->with('message', 'You are not a farmer. Only farmers can access this page.');
            } else {
                return redirect()->route('user.index')->with('message', 'You are not authorized to access this page.');
            }
        }

        return $next($request);
    }
}
