<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Récupérez l'utilisateur actuel
        $user = $request->user();

        // Vérifiez si l'utilisateur a le rôle égal à 1 (ou à la valeur que vous souhaitez)
        if ($user && $user->role == 1) {
            // Redirigez l'utilisateur vers la page d'accueil
            return redirect()->route('Public.index');
        }

        // Si l'utilisateur n'a pas le rôle égal à 1, continuez la requête
        return $next($request);
    }
}
