<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    //  on verifie que l'utilisateur rempli bien les conditions souhaitées
    // on verifie qu'il est bien administrateur
    public function handle(Request $request, Closure $next)
    {
        // si le user est connecté et qu'il est admin
        if (Auth::user() && Auth::user()->role_id == "2"){
        return $next($request);     // middleware passé => on continue
    }

        // sinon on renvoie une erreur 403 forbidden
        abort(403, 'Vous n\'etes pas administrateur accès refusé');
    }
}
