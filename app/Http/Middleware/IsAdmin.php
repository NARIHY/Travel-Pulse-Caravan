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
        // Vérifiez si l'utilisateur est authentifié et a le rôle d'administrateur (par exemple, le rôle 3)
        if (auth()->check() && auth()->user()->role === 3) {
            return $next($request); // Continuez l'action
        }

        // Redirigez l'utilisateur vers la page d'accueil (ou une autre page selon vos besoins)
        return redirect()->route('Admin.index'); // Vous pouvez personnaliser l'URL de redirection
    }
}
