<?php

return [

    'session' => [

        /*
        |--------------------------------------------------------------------------
        | Session Driver
        |--------------------------------------------------------------------------
        |
        | Select the class to be used to handle the session data.
        |
        | Supported: Coreplex\Core\Session\Native
        |            Coreplex\Core\Session\Illuminate
        |
        */

        'driver' => 'Coreplex\Core\Session\Native',

        /*
        |--------------------------------------------------------------------------
        | Session Key
        |--------------------------------------------------------------------------
        |
        | The key to store session variables against.
        |
        */

        'key' => 'coreplex.session'

    ],

    'renderer' => [

        /*
        |--------------------------------------------------------------------------
        | Renderer Driver
        |--------------------------------------------------------------------------
        |
        | Select the class to be used to render data.
        |
        | Supported: Coreplex\Core\Renderer\Native
        |            Coreplex\Core\Renderer\Illuminate
        |
        */

        'driver' => 'Coreplex\Core\Renderer\Native'

    ]

];