<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Pktharindu\NovaPermissions\Traits\ValidatesPermissions;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;
    
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \Pktharindu\NovaPermissions\Role::class => \App\Policies\RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        foreach (config('nova-permissions.permissions') as $key => $permissions) {
            Gate::define($key, function (User $user) use ($key) {
                if ($this->nobodyHasAccess($key)) {
                    return true;
                }

                return $user->hasPermissionTo($key);
            });
        }
    }
}
