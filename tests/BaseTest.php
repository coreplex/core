<?php

namespace Coreplex\Core\Tests;

use Coreplex\Core\Session\Native;

class BaseTest
{
    /**
     * Get a session instance.
     *
     * @return Native
     */
    protected function session()
    {
        return new Native($this->config());
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
}