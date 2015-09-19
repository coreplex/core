<?php

namespace Coreplex\Core\Contracts;

interface Renderer
{
    /**
     * Render the provided view to a string. Optionally pass an array of data
     * to be passed to the view.
     *
     * @param       $view
     * @param array $data
     * @return string
     */
    public function make($view, $data = []);
}