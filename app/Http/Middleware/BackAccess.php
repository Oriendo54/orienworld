<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class BackAccess
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
        $user = User::find(auth()->user()->id);

        if($user->pofuserrole->id_role != 1 && $user->pofuserrole->id_role != 2) {
            abort(403);
        }
        return $next($request);
    }
}