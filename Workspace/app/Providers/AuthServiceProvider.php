<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

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

        Passport::routes();

        /**
         * Defining the user Roles
         */
        Gate::define('isAdmin', function ($user) {
            // if ($user->isAdmin()) {
            //     return true;
            // }

            // for simplicity
            return $user->type === 'admin';
        });

        Gate::define('isUserOrAdmin', function ($user) {
            // if ($user->isUser()) {
            //     return true;
            // }

            // for simplicity
            if( $user->type === 'user' || $user->type === 'admin')
            {
                return true;
            }
            else
            {
                return false;
            }
        });

        Gate::define('isSupplierOrAdmin', function ($user) {
            // if ($user->isUser()) {
            //     return true;
            // }

            // for simplicity
            if( $user->type === 'supplier' || $user->type === 'admin')
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    }
}
