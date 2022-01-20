<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = User::find(auth()->user()->id);
        
        if(!$user) {
            abord(403);
        }

        if($role == "admin" && $user->pofuserrole->id_role != 1) {
            abort(403);
        }

        if($role == "moniteur" && $user->pofuserrole->id_role != 2) {
            abort(403);
        }

        if($role == "client" && $user->pofuserrole->id_role != 3) {
            abort(403);
        }
        return $next($request);
    }
}