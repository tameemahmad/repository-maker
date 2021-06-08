<?php

namespace Temify\RepositoryPattern;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Temify\RepositoryPattern\Commands\ServiceMakeCommand;

class ServiceLayerServiceProvider extends Command
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

     /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            ServiceMakeCommand::class,
        ]);
    
}