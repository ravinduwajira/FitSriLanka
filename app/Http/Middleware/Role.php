<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('login'); // Redirect to login if not authenticated
        }

        // Get the currently authenticated user
        $user = Auth::user();

        // Check the role of the user
        if ($user->role !== $role) {
            return redirect('/'); // Redirect to the home page if the role doesn't match
        }


        return $next($request);
    }
}
