<?php

namespace Coreplex\Core\Tests;

use Coreplex\Core\Session\Native;
use Illuminate\Session\Store;
use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NullSessionHandler;

class BaseTest extends PHPUnit_Framework_TestCase
{
    /**
     * Get a session instance.
     *
     * @return Native
     */
    protected function session()
    {
        return new Native($this->config()['session']);
    }

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