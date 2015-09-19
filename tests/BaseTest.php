<?php

namespace Coreplex\Core\Tests;

use Coreplex\Core\Session\Native;
use PHPUnit_Framework_TestCase;

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