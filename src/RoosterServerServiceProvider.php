<?php

namespace Nacosvel\RoosterServer;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RoosterServerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if (false === $this->app->configurationIsCached()) {
            $this->registerConfig();
        }

        $this->app->bind('rooster-server', function () {
            return config('rooster-server', []);
        });
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/rooster-server.php', 'rooster-server');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
            $this->publishes([
                __DIR__ . '/../config/rooster-server.php' => config_path('rooster-server.php'),
            ], 'rooster-server-config');
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'rooster-server-migrations');
        }

        $connections = $this->app['config']['database.connections'];
        foreach (config('rooster-server.connections', []) as $name => $config) {
            $connections[$name] = $config;
        }
        $this->app['config']['database.connections'] = $connections;

        Route::middlewareGroup(Middleware::class, [
            Middleware::class,
        ]);
        $this->loadRoutesFrom(realpath(__DIR__ . '/../routes/rooster-server.php'));
    }

    /**
     * Register migration files.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

}
