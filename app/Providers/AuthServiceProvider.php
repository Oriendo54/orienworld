<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function(User $user) {
            
            if($user->pofuserrole->id_role === 1) {
                return true;
            }
            else {
                return false;
            }
        });

        Gate::define('moniteur', function(User $user) {
            
            if($user->pofuserrole->id_role === 2) {
                return true;
            }
            else {
                return false;
            }
        });

        Gate::define('client', function(User $user) {
            
            if($user->pofuserrole->id_role === 3) {
                return true;
            }
            else {
                return false;
            }
        });

        Gate::define('back-access', function(User $user) {

            if($user->pofuserrole->id_role != 1 && $user->pofuserrole->id_role != 2) {
                return false;
            }
            else {
                return true;
            }
        });
    }
}
