<?php

namespace Coreplex\Core\Session;

use Coreplex\Core\Contracts\Session;

class Native implements Session
{
    /**
     * The notifier config.
     *
     * @var array
     */
    protected $config = [];

    /**
     * An array of flashed data.
     *
     * @var array
     */
    protected $flash = [];

    /**
     * Flag to state if this is the first time the class has be instantiated.
     *
     * @var bool
     */
    protected $initialLoad = true;

    public function __construct(array $config)
    {
        $this->config = $config;

        if ( ! isset($_SESSION)) {
            session_start();
        }

        if ($this->initialLoad) {
            if (
                isset($_SESSION[$this->config['key']]) &&
                isset($_SESSION[$this->config['key']]['flash'])
            ) {
                $this->flash = $_SESSION[$this->config['key']]['flash'];
                unset($_SESSION[$this->config['key']]['flash']);
            }
            $this->initialLoad = false;
        }
    }

    /**
     * Check if an item exists in the session.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        $session = $this->getSessionData();

        return array_key_exists($key, $session);
    }

    /**
     * Retrieve a property from the session by its key.
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        $session = $this->getSessionData();

        return $this->has($key) ? $session[$key] : null;
    }

    /**
     * Put an item in the session.
     *
     * @param $key
     * @param $value
     */
    public function put($key, $value)
    {
        return $_SESSION[$this->config['key']][$key] = $value;
    }

    /**
     * Remove an item from the session.
     *
     * @param $key
     */
    public function forget($key)
    {
        if (
            isset($_SESSION[$this->config['key']]) &&
            isset($_SESSION[$this->config['key']][$key])
        ) {
            unset($_SESSION[$this->config['key']][$key]);
        }

        if (isset($this->flash[$key])) {
            unset($this->flash[$key]);
        }
    }

    /**
     * Flash an item to the session.
     *
     * @param $key
     * @param $value
     */
    public function flash($key, $value)
    {
        $_SESSION[$this->config['key']]['flash'][$key] = $value;
        $this->flash[$key] = $value;
    }

    /**
     * Merge all of the notifier session data and any flashed data.
     *
     * @return array
     */
    protected function getSessionData()
    {
        $data = isset($_SESSION[$this->config['key']]) ? $_SESSION[$this->config['key']] : [];

        return array_merge($data, $this->flash);
    }
}