<?php

namespace Coreplex\Core\Session;

use Coreplex\Core\Contracts\Session;
use Illuminate\Session\Store;

class Illuminate implements Session
{
    /**
     * An instance of the illuminate session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * The package config.
     *
     * @var array
     */
    protected $config;

    public function __construct(array $config, Store $session)
    {
        $this->session = $session;
        $this->config = $config;
    }

    /**
     * Check if an item exists in the session.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return $this->session->has($this->getSessionKey($key));
    }

    /**
     * Retrieve a property from the session by its key.
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->session->get($this->getSessionKey($key));
    }

    /**
     * Put an item in the session.
     *
     * @param $key
     * @param $value
     */
    public function put($key, $value)
    {
        return $this->session->put($this->getSessionKey($key), $value);
    }

    /**
     * Remove an item from the session.
     *
     * @param $key
     */
    public function forget($key)
    {
        return $this->session->forget($this->getSessionKey($key));
    }

    /**
     * Flash an item to the session.
     *
     * @param $key
     * @param $value
     */
    public function flash($key, $value)
    {
        return $this->session->flash($this->getSessionKey($key), $value);
    }

    /**
     * Get the full session key.
     *
     * @param string $key
     * @return mixed
     */
    protected function getSessionKey($key)
    {
        return $this->config['key'] . '.' . $key;
    }
}