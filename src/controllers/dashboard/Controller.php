<?php

namespace src\Controllers\Dashboard;

/**
 * Description of Controller.
 *
 * @author Sabri Hamda
 */
class Controller extends \src\Controllers\Controller
{
    public function getViewsBasePath()
    {
        return realpath('../views/dashboard/');
    }
}
