<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Generate ID for new object if not provided
     *
     * @return void
     */
    protected function generateUId()
    {
        return md5(uniqid('', true) . '|' . microtime());
    }
}
