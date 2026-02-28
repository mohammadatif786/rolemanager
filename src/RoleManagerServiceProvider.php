<?php

namespace Atif\RoleManager;

use Atif\RoleManager\Services\PermissionService;
use Atif\RoleManager\Services\RoleService;
use Illuminate\Support\ServiceProvider;

class RoleManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Merge the configuration file
        $this->mergeConfigFrom(
            __DIR__.'/../config/RoleManager.php', 'RoleManager'
        );

        // Bind Services
        $this->app->singleton(RoleService::class, function ($app) {
            return new RoleService();
        });

        $this->app->singleton(PermissionService::class, function ($app) {
            return new PermissionService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Load the package's routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load the package's views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'RoleManager');

        // Load the package's migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publish the package's configuration file
        $this->publishes([
            __DIR__.'/../config/RoleManager.php' => config_path('RoleManager.php'),
        ], 'config');

        // Publish the package's views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/RoleManager'),
        ], 'views');

        // Publish the package's migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }
}
