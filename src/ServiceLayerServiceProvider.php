<?php

namespace Temify\RepositoryPattern;

use Illuminate\Support\ServiceProvider;

class ServiceLayerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServiceGenerator();
    }

    /**
     * Register the make:service generator.
     */
    private function registerServiceGenerator()
    {
        $this->app->singleton('command.temify.service', function ($app) {
            return $app['Temify\RepositoryPattern\Commands\ServiceMakeCommand'];
        });
        $this->commands('command.temify.service');
    }

   
    
}