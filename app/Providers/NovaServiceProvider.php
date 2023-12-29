<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public static $model = 'App\\Models\\User';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 9999;
        });

        Nova::withBreadcrumbs();

        Nova::footer(function ($request) {
            return Blade::render('
                <center>Copyright &copy; ' . now()->year . ' Zuse Technologies (Pvt) Ltd. All Rights Reserved.<br/>Based on the Zuse Backend Foundation. Created by Zuse Technologies (Pvt) Ltd.</center>
            ');
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            \Pktharindu\NovaPermissions\NovaPermissions::make()
                ->roleResource(Role::class),
            new \Bolechen\NovaActivitylog\NovaActivitylog(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
