<?php

namespace Coreplex\Core\Tests;

use Coreplex\Core\Renderer\Illuminate as IlluminateRenderer;
use Coreplex\Core\Session\Native;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Session\Store;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NullSessionHandler;

class BaseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return \Coreplex\Core\Renderer\Native
     */
    protected function renderer()
    {
        return new \Coreplex\Core\Renderer\Native();
    }

    protected function illuminateRenderer()
    {
        $app = new Container();

        $resolver = new EngineResolver;
        $resolver->register('php', function () { return new PhpEngine; });

        $finder = new FileViewFinder(new Filesystem, [realpath(__DIR__)]);

        $dispatcher = (new Dispatcher($app))->setQueueResolver(function () use ($app) {
            return $app->make('Illuminate\Contracts\Queue\Factory');
        });

        $env = new Factory($resolver, $finder, $dispatcher);

        $env->setContainer($app);

        $env->share('app', $app);

        return new IlluminateRenderer($env);
    }

    /**
     * Get a session instance.
     *
     * @return Native
     */
    protected function session()
    {
        return new Native($this->config()['session']);
    }

    /**
     * Get a illuminate session instance.
     *
     * @return Store
     */
    protected function illuminateSession()
    {
        return new Store($this->app['config']['session.cookie'], new NullSessionHandler());
    }

    /**
     * Get the package config.
     *
     * @return array
     */
    protected function config()
    {
        if ( ! isset($this->config)) {
            $this->config = require __DIR__ . '/../config/coreplex.php';
        }

        return $this->config;
    }

    public function testCommon()
    {
        //
    }
}