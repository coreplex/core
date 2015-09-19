<?php

namespace Coreplex\Core\Renderer;

use Coreplex\Core\Contracts\Renderer;
use Coreplex\Core\Exceptions\ViewNotFoundException;
use Illuminate\Contracts\View\Factory;

class Illuminate implements Renderer
{
    /**
     * An instance of the illuminate view class
     *
     * @var mixed
     */
    protected $view;

    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    /**
     * Render the provided view to a string. Optionally pass an array of data
     * to be passed to the view.
     *
     * @param string $view
     * @param array  $data
     * @return string
     * @throws ViewNotFoundException
     */
    public function make($view, $data = [])
    {
        try {
            return $this->view->make($view, $data)->render();
        } catch (\InvalidArgumentException $e) {
            throw new ViewNotFoundException("No file found at '{$view}'");
        }
    }
}