<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Contacts;
use App\Leads;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
        $this->registerContactsPolicies();
        $this->registerLeadsPolicies();
        $this->registerUsersPolicies();
    }

    public function registerContactsPolicies() {
        Gate::define('create-contacts', function ($user) {
            return $user->hasAccess(['create']);
        });
        Gate::define('update-contacts', function ($user) {
            return $user->hasAccess(['update']);
        });
        Gate::define('delete-contacts', function ($user) {
            return $user->hasAccess(['delete']);
        });
        Gate::define('read-contacts', function ($user) {
            return $user->hasAccess(['read']);
        });
    }

    public function registerLeadsPolicies() {
        Gate::define('create-leads', function ($user) {
            return $user->hasAccess(['create']);
        });
        Gate::define('update-leads', function ($user) {
            return $user->hasAccess(['update']);
        });
        Gate::define('delete-leads', function ($user) {
            return $user->hasAccess(['delete']);
        });
        Gate::define('read-leads', function ($user) {
            return $user->hasAccess(['read']);
        });
    }

    public function registerUsersPolicies() {
        Gate::define('create-users', function ($user) {
            return $user->hasAccess(['create']);
        });
        Gate::define('update-users', function ($user) {
            return $user->hasAccess(['update']);
        });
        Gate::define('delete-users', function ($user) {
            return $user->hasAccess(['delete']);
        });
        Gate::define('read-users', function ($user) {
            return $user->hasAccess(['read']);
        });
    }
}
