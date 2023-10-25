<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        //Verify if user is Authentified and these has role Admin
        if (auth()->check() && auth()->user()->role === 3) {
            return $next($request); // Continuez l'action
        }

        // if false, redirect user
        return redirect()->route('Admin.index');
    }
}
