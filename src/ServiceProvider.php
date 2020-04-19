<?php

namespace BigHairEnergy\Preview;

use Illuminate\Support\Facades\Route;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup('preview', config('preview.middleware', []));

        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerPublishing();

        $this->loadViewsFrom(
            __DIR__.'/../resources/views', 'preview'
        );
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

   /**
    * Get the Preview route group configuration array.
    *
    * @return array
    */
    private function routeConfiguration()
    {
        return [
            'namespace' => 'BigHairEnergy\Preview\Http\Controllers',
            'middleware' => 'preview',
        ];
    }

    /**
     * Register the package's migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        if ($this->app->runningInConsole() && $this->shouldMigrate()) {
            $this->loadMigrationsFrom(__DIR__.'/Storage/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/Storage/migrations' => database_path('migrations'),
            ], 'preview-migrations');

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/preview'),
            ], 'preview-assets');

            $this->publishes([
                __DIR__.'/../config/preview.php' => config_path('preview.php'),
            ], 'preview-config');
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/preview.php', 'preview'
        );

        $this->commands([
            Console\InstallCommand::class,
            Console\StatusCommand::class,
            Console\UsersCommand::class,
        ]);
    }

    /**
     * Determine if we should register the migrations.
     *
     * @return bool
     */
    protected function shouldMigrate()
    {
        return Preview::$runsMigrations && config('preview.driver') === 'database';
    }
}
