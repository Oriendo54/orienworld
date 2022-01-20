<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class Initialize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Autorise l'accès uniquement à l'initialisation de l'application (aucun user enregistré en BDD)
        $user = User::first();
        if($user) {
            abort(403);
        }
        
        return $next($request);
    }
}
