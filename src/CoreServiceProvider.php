<?php

namespace Coreplex\Core;

use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the config files.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/coreplex.php' => config_path('coreplex.php')
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../config/coreplex.php', 'coreplex');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $config = config('coreplex');

        $this->app->singleton('Coreplex\Core\Contracts\Renderer', function ($app) use ($config) {
            return (new ReflectionClass($config['renderer']['driver']))->newInstanceArgs($app['view']);
        });

        $this->app->singleton('Coreplex\Core\Contracts\Session', function ($app) use ($config) {
            return (new ReflectionClass($config['session']['driver']))->newInstanceArgs([$config['session'],
                $app['session.store']]);
        });

        $this->app->alias('Coreplex\Core\Contracts\Renderer', 'coreplex.core.renderer');
        $this->app->alias('Coreplex\Core\Contracts\Session', 'coreplex.core.session');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Coreplex\Core\Contracts\Session', 'Coreplex\Core\Contracts\Renderer'];
    }
}