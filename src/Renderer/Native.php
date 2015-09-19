<?php

namespace Coreplex\Core\Renderer;

use Coreplex\Core\Contracts\Renderer;
use Coreplex\Core\Exceptions\ViewNotFoundException;

class Native implements Renderer
{
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
        if ( ! file_exists($view)) {
            throw new ViewNotFoundException("No file found at '{$view}'");
        }

        ob_start();

        if ( ! empty($data)) {
            extract($data);
        }

        include($view);

        return ob_get_clean();
    }
}